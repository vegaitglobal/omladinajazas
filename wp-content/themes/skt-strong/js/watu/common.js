const addWatuAnswerEventListeners = function () {
  // handle answer selected event in all radio buttons type questions
  const radioButtonAnswers = document.querySelectorAll('.watu-question .answer[type=radio]');
  addRadioButtonsEventListener(radioButtonAnswers);
  const checkboxButtonAnswers = document.querySelectorAll('.watu-question .answer[type=checkbox]');
  // rerender checkbox labels
  hideCheckboxSingleAnswerStringCode(checkboxButtonAnswers)
  // handle answer selected event in all checkbox type questions
  addCheckboxEventListener(checkboxButtonAnswers);
};

const addRadioButtonsEventListener = function (elements) {
  elements.forEach(element => {
    element.addEventListener('click', event => {
      const answer = getAnswerInputParentDiv(event.target)
      handleAnswerSelected(answer, true)
    });
  });
};

const addCheckboxEventListener = function (elements) {
  elements.forEach(element => {
    element.addEventListener('click', event => {
      const answer = getAnswerInputParentDiv(event.target);
      if (!answer.find('input').prop('checked')) {
        handleAnswerNotSelected(answer)
        return
      }
      handleAnswerSelected(answer)
      // if checkbox answer is "single" king answer, uncheck all other answers
      if (isSingleKindAnswer(answer)) {
        const siblingAnswers = answer.siblings('div:not(.question-content)');
        siblingAnswers.each(function () {
          const siblingAnswer = jQuery(this);
          handleAnswerNotSelected(siblingAnswer)
        });
      }
      // if checkbox answer is "one of many" kind of answer, uncheck all "single" kind answers
      else {
        answer.siblings('div:not(.question-content)').each(function () {
          const siblingAnswer = jQuery(this);
          if (isSingleKindAnswer(siblingAnswer)) {
            handleAnswerNotSelected(siblingAnswer)
          }
        })
      }
    })
  })
};

const handleAnswerSelected = function (answer, uncheckSiblings) {
  answer.css('background', '#7a7a7a').css('color', 'white')
  answer.find('input').prop('checked', true);
  if (uncheckSiblings) {
    answer
      .siblings('div:not(.question-content)')
      .css('background', 'white')
      .css('color', '#7a7a7a');
  }
}

const handleAnswerNotSelected = function (answer) {
  answer.css('background', 'white').css('color', '#7a7a7a');
  answer.find('input').prop('checked', false);
}

const getAnswerInputParentDiv = function (answerInput) {
  return jQuery(answerInput).parent('div:first')
}

const isSingleKindAnswer = function (answer) {
  return answer.find('span').html().includes(['[single]'])
}

const hideCheckboxSingleAnswerStringCode = function (answerInputs) {
  // wrap "[single]" in <span> and hide it
  answerInputs.forEach(answerInput => {
    const answer = getAnswerInputParentDiv(answerInput)
    if (isSingleKindAnswer(answer)) {
      hideStringCode(answer.find('span'), '[single]')
    }
  })
}

const hideStringCode = function (element, code) {
  const label = element.html();
  const newLabel = label.replace(code, `<span style="display: none">${code}</span>`)
  element.html(newLabel)
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
  addWatuAnswerEventListeners();
});
