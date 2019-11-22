// HANDLE WATU QUIZ RESULTS
jQuery(document).ajaxComplete(function () {
  if (jQuery('#watu-achieved-points').get(0)) {

    const hivRiscPercentage = getResultPercentage();
    const hivBar = jQuery('.bar.hiv');
    let hivRiskLevel = 'low';
    hivBar.css('width', `${hivRiscPercentage}%`);
    if (hivRiscPercentage > 67) {
      hivBar.parent('div:first').addClass('danger');
      hivRiskLevel = 'high';
    } else if (hivRiscPercentage > 33 && hivRiscPercentage < 67) {
      hivBar.parent('div:first').addClass('warning');
      hivRiskLevel = 'medium';
    }
    jQuery(`#hiv-results-msg .${hivRiskLevel}-risk-msg`).removeAttr('style');
  }
});

const getResultPercentage = function () {
  const achieved = jQuery('#watu-achieved-points').get(0).innerText;
  const maximum = jQuery('#watu-max-points').get(0).innerText;
  const percentage = achieved / maximum * 100;
  return percentage.toFixed(0);
};

const addWatuAnswerEventListener = function () {
  // handle answer selected event in all radio buttons type questions
  const radioButtonAnswers = document.querySelectorAll('.watu-question .answer[type=radio]');
  addRadioButtonsEventListener(radioButtonAnswers);
  const checkboxButtonAnswers = document.querySelectorAll('.watu-question .answer[type=checkbox]');
  // rerender checkbox labels
  hideAnswerLabelCode(checkboxButtonAnswers)
  // handle answer selected event in all checkbox type questions
  addCheckboxEventListener(checkboxButtonAnswers);
};

const addRadioButtonsEventListener = function (elements) {
  elements.forEach(element => {
    element.addEventListener('click', event => {
      getAnswerInputParentDiv(event.target)
        .css('background', '#7a7a7a')
        .css('color', 'white')
        .siblings('div:not(.question-content)')
        .css('background', 'white')
        .css('color', '#7a7a7a');
    });
  });
};

const addCheckboxEventListener = function (elements) {
  elements.forEach(element => {
    element.addEventListener('click', event => {
      const answer = getAnswerInputParentDiv(event.target);
      answer
        .css('background', '#7a7a7a')
        .css('color', 'white')
      // if checkbox answer is "single" king answer, uncheck all other answers
      if (isSingleKindAnswer(answer)) {
        const siblingAnswers = answer.siblings('div:not(.question-content)');
        siblingAnswers.each(function () {
          const siblingAnswer = jQuery(this);
          siblingAnswer.css('background', 'white').css('color', '#7a7a7a');
          siblingAnswer.find('input').prop('checked', false);
        });

      }
      // if checkbox answer is "one of many" kind of answer, uncheck all "single" kind answers
      else {
        answer.siblings('div:not(.question-content)').each(function () {
          const siblingAnswer = jQuery(this);
          if (siblingAnswer.find('span').html().includes(['[single]'])) {
            siblingAnswer.css('background', 'white').css('color', '#7a7a7a');
            siblingAnswer.find('input').prop('checked', false);
          }
        })
      }
    })
  })
};

const getAnswerInputParentDiv = function (answerInput) {
  return jQuery(answerInput).parent('div:first')
}

const isSingleKindAnswer = function (answer) {
  return answer.find('span').html().includes(['[single]'])
}

const hideAnswerLabelCode = function (answerInputs) {
  // wrap "[single]" in <span> and hide it
  answerInputs.forEach(answerInput => {
    const answer = getAnswerInputParentDiv(answerInput)
    if (isSingleKindAnswer(answer)) {
      const label = answer.find('span').html();
      const newLabel = label.replace('[single]', '<span style="display: none">[single]</span>')
      answer.find('span').html(newLabel)
    }
  })
}

const initQuizProgressIndicator = function () {
  const watuForm = jQuery(`#quiz-${Watu.exam_id}`);
  watuForm.parent('div:first').prepend('<div id="ojh-quiz-steps-wrapper"><div class="ojh-progress-indicator"></div></div>');

  const total_steps = Watu.total_steps;
  let step_num = null;
  const indicatorWrapper = jQuery("#ojh-quiz-steps-wrapper");
  const indicator = indicatorWrapper.find('.ojh-progress-indicator:first');

  for (let i = 1; i <= total_steps; i++) {
    step_num = i < 10 ? '0' + i : i;
    indicator.append(
      `<div class="ojh-progress-indicator__step"><span class="ojh-progress-indicator__step__dot"></span><span class="ojh-progress-indicator__step__number">${step_num}</span></div>`
    );
  }
  indicatorWrapper.find('.ojh-progress-indicator:first').find('.ojh-progress-indicator__step:first').addClass('ojh-progress-indicator__step--active');
};


jQuery(document).ready(function () {
  jQuery('h2.section-title, .logo h1, .slide_info h2, .cols-3 h5').each(function (index, element) {
    const heading = jQuery(element);
    let word_array, last_word, first_part;
    word_array = heading.html().split(/\s+/); // split on spaces
    last_word = word_array.pop();             // pop the last word
    first_part = word_array.join(' ');        // rejoin the first words together
    heading.html([first_part, ' <span>', last_word, '</span>'].join(''));
  });
  addWatuAnswerEventListener();
});


// KNOWLEDGE TEST
jQuery(document).ajaxComplete(function () {
  if (jQuery('#knowledge-test-achieved-points').get(0)) {
    jQuery('#knowledge-test-achieved-points').append("<div id='qresults'> </div>");
    const question = jQuery('.show-question');
    let i = 1;
    const questionDivs = [];
    const allQuestions = jQuery.each(question, function (k, v) {
      jQuery(this).hide();
      const questionIndex = jQuery(this).children().find("p").text().split(".")[0].trim();
      if (jQuery.inArray(questionIndex, Watu.question_ids) != -1) {
        var newText = i + ". " + jQuery(this).children().find("p").text().split(".")[1];
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
          this.children().first('p').text(newText);
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
