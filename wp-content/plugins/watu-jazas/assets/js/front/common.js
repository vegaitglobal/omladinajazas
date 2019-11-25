const addWatuAnswerEventListeners = function () {

  if (typeof Watu === 'undefined') {
    return;
  }

  const radioButtonAnswers = document.querySelectorAll(
    '.watu-question .answer[type=radio]'
  );

  const checkboxButtonAnswers = document.querySelectorAll(
    '.watu-question .answer[type=checkbox]'
  );

  addCssClassToAnswers([...radioButtonAnswers, ...checkboxButtonAnswers])
  // handle answer selected event in all radio buttons type questions
  addRadioButtonsEventListener(radioButtonAnswers);
  // calculate max points for checkboxes
  hideAndRememberCheckboxPointsCode(checkboxButtonAnswers);
  // re-render checkbox labels
  hideCheckboxSingleAnswerStringCode(checkboxButtonAnswers);
  // handle answer selected event in all checkbox type questions
  addCheckboxEventListener(checkboxButtonAnswers);

  const questions = jQuery('.watu-question');
  prepareCommentsInQuestion(questions)
};

const addCssClassToAnswers = function (answers) {
  answers.forEach(function (value) {
    jQuery(value).parent().addClass('watu-question-wrapper')
  })
}

const prepareCommentsInQuestion = function (questions) {
  questions.each(function (index, value) {
    const question = jQuery(value);
    const questionElement = question.find('.question-content p');
    const commentStart = questionElement.html().indexOf('{')
    // abort the preparation if the question has no comment
    if (commentStart < 0) {
      return;
    }
    const commentEnd = questionElement.html().indexOf('}')
    const comment = questionElement.html().substr(commentStart, commentEnd)
    // remove comment from question label
    questionElement.html(questionElement.html().replace(comment, ''))
    // put comment to separate element in question
    const commentElement = `<div class="question-comment-wrapper"><p class="question-comment">${comment.substr(1, comment.length - 2)}</p></div>`
    // show comment when user chooses an answer
    question.find('.answer').on('click', function (event) {
      const questionComment = question.find('.question-comment')
      if (questionComment.length) {
        return
      }
      question.append(commentElement)
      questionComment.removeAttr('style');
    })
  })
}

const addRadioButtonsEventListener = function (elements) {
  elements.forEach(element => {
    element.addEventListener('click', event => {
      const answer = getAnswerInputParentDiv(event.target);
      handleAnswerSelected(answer, true);
    });
  });
};

const addCheckboxEventListener = function (elements) {
  elements.forEach(element => {
    element.addEventListener('click', event => {
      const answer = getAnswerInputParentDiv(event.target);
      if (!answer.find('input').prop('checked')) {
        handleAnswerNotSelected(answer);
        return;
      }
      handleAnswerSelected(answer);
      // if checkbox answer is "single" king answer, uncheck all other answers
      if (isSingleKindAnswer(answer)) {
        const siblingAnswers = answer.siblings('.watu-question-wrapper');
        siblingAnswers.each(function () {
          const siblingAnswer = jQuery(this);
          handleAnswerNotSelected(siblingAnswer);
        });
      }
      // if checkbox answer is "one of many" kind of answer, uncheck all "single" kind answers
      else {
        answer.siblings('.watu-question-wrapper').each(function () {
          const siblingAnswer = jQuery(this);
          if (isSingleKindAnswer(siblingAnswer)) {
            handleAnswerNotSelected(siblingAnswer);
          }
        });
      }
    });
  });
};

const handleAnswerSelected = function (answer, uncheckSiblings) {
  answer.css('background', '#7a7a7a').css('color', 'white');
  answer.find('input').prop('checked', true);
  if (uncheckSiblings) {
    answer
      .siblings('.watu-question-wrapper')
      .css('background', 'white')
      .css('color', '#7a7a7a');
  }
};

const handleAnswerNotSelected = function (answer) {
  answer.css('background', 'white').css('color', '#7a7a7a');
  answer.find('input').prop('checked', false);
};

const getAnswerInputParentDiv = function (answerInput) {
  return jQuery(answerInput).parent('div:first');
};

const isSingleKindAnswer = function (answer) {
  return answer
    .find('span')
    .html()
    .includes(['[single]']);
};

const hideCheckboxSingleAnswerStringCode = function (answerInputs) {
  // wrap "[single]" in <span> and hide it
  answerInputs.forEach(answerInput => {
    const answer = getAnswerInputParentDiv(answerInput);
    if (isSingleKindAnswer(answer)) {
      hideStringCode(answer.find('span'), '[single]');
    }
  });
};

const hideAndRememberCheckboxPointsCode = function (answerInputs) {
  let totalPoints = 0;
  let multipleAnswerMaxPoints = 0;
  let singleAnswerMaxPoints = 0;
  answerInputs.forEach(answerInput => {
    const answer = getAnswerInputParentDiv(answerInput);
    const answerPoints = getPointsFromLabelAndRemovePointsCode(
      answer.find('span')
    );
    totalPoints += answerPoints;
    if (isSingleKindAnswer(answer)) {
      if (singleAnswerMaxPoints < answerPoints) {
        singleAnswerMaxPoints = answerPoints;
      }
    } else {
      multipleAnswerMaxPoints += answerPoints;
    }
    // TODO: hide the code string [point:??]
  });
  const maxPoints =
    singleAnswerMaxPoints > multipleAnswerMaxPoints
      ? singleAnswerMaxPoints
      : multipleAnswerMaxPoints;
  const subtractFromMaxResult = totalPoints - maxPoints;
  if (Watu.subtractFromMaxResult) {
    Watu.subtractFromMaxResult += subtractFromMaxResult;
  } else {
    Watu.subtractFromMaxResult = subtractFromMaxResult;
  }
};

const getPointsFromLabelAndRemovePointsCode = function (labelElement) {
  const pointsCode = '[points:';
  if (labelElement.html().includes(pointsCode)) {
    const pointsIndex =
      labelElement.html().indexOf(pointsCode) + pointsCode.length;
    const twoDigitNumber = labelElement.html().substr(pointsIndex, 2);
    let fullPointsCode = `${pointsCode}${twoDigitNumber}]`;
    if (isNaN(twoDigitNumber) && labelElement.html().includes(fullPointsCode)) {
      // case where "XX" in "[points:XX]" pattern is not a valid number
      throwInvalidAnswerPointsCode(labelElement.html());
    }
    if (!isNaN(twoDigitNumber)) {
      // case where "[points:XX]" is used pattern and "XX" in that pattern is a valid number
      labelElement.html(labelElement.html().replace(fullPointsCode, ''));
      return twoDigitNumber * 1;
    }
    const oneDigitNumber = labelElement.html().substr(pointsIndex, 1);
    fullPointsCode = `${pointsCode}${oneDigitNumber}]`;
    if (!isNaN(oneDigitNumber)) {
      // case where "[points:X]" is used and "X" in that pattern is a valid number
      labelElement.html(labelElement.html().replace(fullPointsCode, ''));
      return oneDigitNumber * 1;
    }
    // case where neither "[points:XX]" or "[points:X]" patterns were used,
    // or "X" in "[points:X]" pattern is not a valid number
    throwInvalidAnswerPointsCode(labelElement.html());
  }
};

const throwInvalidAnswerPointsCode = function (label) {
  throw new Error(
    `Invalid answer points code in label "${label}". Valid answer points code pattern: "[points:00]" or "[points:0]".`
  );
};

const hideStringCode = function (element, code) {
  const label = element.html();
  const newLabel = label.replace(
    code,
    `<span style="display: none">${code}</span>`
  );
  element.html(newLabel);
};

const initQuizProgressIndicator = function () {
  const watuForm = jQuery(`#quiz-${Watu.exam_id}`);
  watuForm
    .parent('div:first')
    .prepend(
      '<div id="ojh-quiz-steps-wrapper"><div class="ojh-progress-indicator"></div></div>'
    );

  const total_steps = Watu.total_steps;
  let step_num = null;
  const indicatorWrapper = jQuery('#ojh-quiz-steps-wrapper');
  const indicator = indicatorWrapper.find('.ojh-progress-indicator:first');

  for (let i = 1; i <= total_steps; i++) {
    step_num = i < 10 ? '0' + i : i;
    indicator.append(
      `<div class="ojh-progress-indicator__step"><span class="ojh-progress-indicator__step__dot"></span><span class="ojh-progress-indicator__step__number">${step_num}</span></div>`
    );
  }
  indicatorWrapper
    .find('.ojh-progress-indicator:first')
    .find('.ojh-progress-indicator__step:first')
    .addClass('ojh-progress-indicator__step--active');
};

jQuery(document).ready(function () {
  jQuery('h2.section-title, .logo h1, .slide_info h2, .cols-3 h5').each(
    function (index, element) {
      const heading = jQuery(element);
      let word_array, last_word, first_part;
      word_array = heading.html().split(/\s+/); // split on spaces
      last_word = word_array.pop(); // pop the last word
      first_part = word_array.join(' '); // rejoin the first words together
      heading.html([first_part, ' <span>', last_word, '</span>'].join(''));
    }
  );
  addWatuAnswerEventListeners();
});
