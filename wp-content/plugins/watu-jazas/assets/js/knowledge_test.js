const initView = function () {
  const questionElements = jQuery('.watu-question');
  questionElements.hide();
  var otherQuestions = [];
  var allQuestions = [];
  var elem = null;
  jQuery.each(questionElements, function (index, value) {
    elem = jQuery(value);
    if (value.innerText.replace(/ /g, '').indexOf('[1]') >= 0) {
      value.classList.add('firstStep');
      jQuery('.firstStep:first').find('div').addClass('radio-button')
      elem.removeClass('watu-question').css('display', 'block');
      elem.children('textarea').attr('rows', 1).css('height', '40px');
      elem.children('textarea').attr('rows', 1).css('height', '40px');
      allQuestions.push(jQuery(value));
      jQuery(value).show();
    } else {
      otherQuestions.push(jQuery(value));
    }
  });
  const firstStepQuestionNo = allQuestions.length;
  const randomQuestions = getRandomQuestions(otherQuestions);
  allQuestions.push(...randomQuestions);

  manageTestButtons();
  Watu.filtered_questions = {};
  Watu.temp_questions = {};
  Watu.current_step = 1;
  Watu.isLastQuestion = false;
  Watu.total_steps = getNumberOfSteps(allQuestions, firstStepQuestionNo);
  Watu.total_questions = getNumberOfQuestions();
  _showNextStep(Watu.current_step);
};

//	Question randomizer
const getRandomQuestions = function (questions) {
  var randomNumbers = [];
  const count = questions.length;
  while (randomNumbers.length < 10) {
    var randomNo = Math.floor((Math.random() * count) + 1);
    if (!randomNumbers.includes(randomNo)) {
      randomNumbers.push(randomNo);
    }
  }

  var randomQuestions = [];
  jQuery.each(randomNumbers, function (key, value) {
    randomQuestions.push(questions[value - 1]);
  });
  return randomQuestions;
};

const manageTestButtons = function () {
  if (parseInt(Watu.singlePage)) {
    var nextBtn = '<a id="test-next-question-btn">SLEDEĆI KORAK</a>';
    var prevBtn = '<a id="test-prev-question-btn">PRETHODNI KORAK</a>';
    var submitBtn = '<a id="test-submit-btn" onclick="Watu.submitResult()">POGLEDAJ REZULTAT</a>';
    const introText = jQuery('.quiz-area p:nth-child(2)');
    jQuery('#action-button').after(prevBtn, nextBtn, submitBtn);
    jQuery('#action-button').hide();
    jQuery('#test-prev-question-btn').hide();
    jQuery('#test-submit-btn').hide();
    jQuery("#test-next-question-btn").click(function () {
      introText.hide();
      Watu.current_step++;
      jQuery(".ojh-progress-indicator .ojh-progress-indicator__step:nth-child(" + Watu.current_step + ")").addClass('ojh-progress-indicator__step--active');
      var index = Object.keys(Watu.filtered_questions)[Watu.current_step - 1];
      var prevIndex = Object.keys(Watu.filtered_questions)[Watu.current_step - 2];
      _showNextStep(index, prevIndex);
      if (Watu.current_step === Watu.total_steps) {
        jQuery(this).hide();
        jQuery("#test-submit-btn").show();
      }
      if (Watu.current_step > 1) {
        jQuery('#test-prev-question-btn').show();
      }
    });

    jQuery("#test-prev-question-btn").click(function () {
      jQuery(".ojh-progress-indicator .ojh-progress-indicator__step:nth-child(" + Watu.current_step + ")").removeClass('ojh-progress-indicator__step--active');
      Watu.current_step--;
      var index = Object.keys(Watu.filtered_questions)[Watu.current_step - 1];
      var nextIndex = Object.keys(Watu.filtered_questions)[Watu.current_step];
      showPreviousStep(index, nextIndex);
      jQuery("#test-submit-btn").hide();
      if (Watu.current_step === 1) {
        introText.show();
        jQuery(this).hide();
      }
      if (Watu.current_step !== Watu.total_steps) {
        jQuery('#test-next-question-btn').show();
      }
    });
  }
}

const _showNextStep = function (index, prevIndex) {
  Watu.filtered_questions[index].forEach(function (question_id) {
    jQuery("#" + question_id).show();
  });
  if (index > 1) {
    Watu.filtered_questions[prevIndex].forEach(function (question_id) {
      jQuery("#" + question_id).hide();
    });
  }
}

const showPreviousStep = function (index, nextIndex) {
  Watu.filtered_questions[index].forEach(function (question_id) {
    jQuery("#" + question_id).show();
  });
  Watu.filtered_questions[nextIndex].forEach(function (question_id) {
    jQuery("#" + question_id).hide();
  });
}

const getNumberOfQuestions = function () {
  var i = 0;
  jQuery(".watu-question").each(function () {
    i++;
  });
  return i;
}

const getCurrIndex = function (beforeQuestion) {
  var currIndex = '';
  if (beforeQuestion[beforeQuestion.length - 2] == '[')
    currIndex = beforeQuestion[beforeQuestion.length - 1];
  else {
    var first = beforeQuestion[beforeQuestion.length - 2];
    var second = beforeQuestion[beforeQuestion.length - 1];
    currIndex = first + second;
  }
  return currIndex;
}

const getNumberOfSteps = function (randomQuestions, firstStepQuestionNo) {
  var noOfSteps = 0;
  Watu.question_ids = [];
  var i = 1;
  jQuery(randomQuestions).each(function (k, v) {
    var fullQuestion = jQuery(v).find("p").text();
    var question = "";
    if (fullQuestion.split("]")[1]) {
      question = fullQuestion.split("]")[1].trim();
      var beforeQuestion = fullQuestion.split("]")[0].trim();
      var currIndex = getCurrIndex(beforeQuestion.replace(/ /g, ''));

      if (Watu.filtered_questions[currIndex]) {
        Watu.filtered_questions[currIndex].push(jQuery(this).attr('id'));
      } else {
        Watu.filtered_questions[currIndex] = [jQuery(this).attr('id')];
        noOfSteps++;
      }

    } else {
      if (fullQuestion.split(".")[2])
        question = fullQuestion.split(".")[1] + ". " + fullQuestion.split(".")[2].trim();
      else if (fullQuestion.split(".")[1])
        question = fullQuestion.split(".")[1].trim();
      else question = fullQuestion;
      noOfSteps++;
      Watu.temp_questions[noOfSteps] = [jQuery(this).attr('id')];
    }
    Watu.question_ids.push(v.context.id.split('-')[1]);
    // deleting oder number/index before question
    jQuery(v).find("p").text(question);
    if (i <= firstStepQuestionNo) {
      i++;
    } else {
      const number = '<span class="watu_num">' + (i - firstStepQuestionNo) + '. ' + '</span>';
      jQuery(v).find("p").prepend(number);
      i++;
    }
  });

  // add from temp_question
  jQuery.each(Watu.temp_questions, function (k, v) {
    var i = 1;
    while (1) {
      if (!Watu.filtered_questions.hasOwnProperty(i)) {
        Watu.filtered_questions[i] = v;
        break;
      }
      i++;
    }
  });
  delete Watu.temp_questions;
  return noOfSteps;
}

jQuery(document).ready(function () {
  if (jQuery("#quiz-3").get(0)) {

    setTimeout(function () {
      initView();
      initQuizProgressIndicator();
      jQuery("#test-quiz-complete-overlay").css("display", "block").parents(".site-main").addClass("site-quiz");
    }, 100);
  }
});

jQuery(document).ajaxComplete(function () {
  if (jQuery('#knowledge-test-achieved-points').get(0)) {
    jQuery('#knowledge-test-achieved-points').append("<div id='qresults'> </div>");
    const questions = jQuery('.show-question');
    let i = 1;
    const questionDivs = [];
    jQuery.each(questions, function (k, v) {
      jQuery(this).hide();
      const questionIndex = jQuery(this).children().find("p").text().split(".")[0].trim();
      if (jQuery.inArray(questionIndex, Watu.question_ids) != -1) {
        i++;
        if (jQuery(this).children().find("p").text().replace(/ /g, '').indexOf("[1]") >= 0) {
          jQuery(this).hide();
        } else {
          jQuery(this).show();
          var clonedObject = jQuery.extend({}, jQuery(this));
          questionDivs.push(clonedObject);
        }
        jQuery(this).hide();
      }

    });
    i = 1;
    jQuery('.show-question').remove();
    jQuery.each(Watu.question_ids, function (key, questionId) {
      jQuery.each(questionDivs, function (k, v) {
        const questionIndex = this.children().find("p").text().split(".")[0].trim();
        if (questionId == questionIndex) {

          const newText = i + ". " + this.children().find("p").text().split(".")[1];
          i++;

          let isAnsweredCorrectly = null;
          if (jQuery(this).find('.answer.correct-answer.user-answer').length) {
            isAnsweredCorrectly = true
          } else if (jQuery(this).find('.answer.user-answer').length) {
            isAnsweredCorrectly = false;
          }

          const correctAnswerMessage = '<div class="watu-correct-answer">ODGOVORILI STE TAČNO</div>';
          const incorrectAnswerMessage = '<div class="watu-incorrect-answer">ODGOVORILI STE NETAČNO</div>';
          const unansweredMessage = '<div class="watu-incorrect-answer">NISTE ODGOVORILI NA OVO PITANJE</div>';

          const correctAnswer = jQuery(this).find('.answer.correct-answer');
          const feedbackStart = '<div class="watu-correct-answer-msg">TAČAN ODGOVOR JE: ';
          const feedbackEnd = '</div>';
          const additionalQuestionFeedback = jQuery(this).find('.show-question-feedback')
          const questionFeedback = feedbackStart + correctAnswer.html() + additionalQuestionFeedback.length ? additionalQuestionFeedback.html() : '' + feedbackEnd

          jQuery(this).html(`<div class="watu-result-question">${newText}</div>`)
          jQuery(this).find('ul').remove()

          if (isAnsweredCorrectly) {
            jQuery(this).append(correctAnswerMessage)
          } else if (isAnsweredCorrectly === false) {
            jQuery(this).append(incorrectAnswerMessage)
          } else {
            jQuery(this).append(unansweredMessage)
          }
          jQuery(this).append(questionFeedback)

          this.children().first('p').css("margin-bottom", "20px");
          this.show();
          jQuery('#qresults').append(this.prop('outerHTML'));
          return false;
        }
      });
    });
    const unansweredQuestions = document.getElementsByClassName('unanswered');
    while (unansweredQuestions.length > 0) {
      unansweredQuestions[0].parentNode.removeChild(unansweredQuestions[0]);
    }
  }
});
