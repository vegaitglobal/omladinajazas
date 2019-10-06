
// Knowledge test
const initView = function () {
    const questionElements = jQuery('.watu-question');
    questionElements.hide();
    var otherQuestions = [];
    var allQuestions = [];
    jQuery.each(questionElements, function (index, value) {
        if (value.innerText.replace(/ /g, '').indexOf('[1]') >= 0) {
            value.classList.add("firstStep");
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
        var nextBtn = '<a id="test-next-question-btn">SLEDEĆI KORAK ></a>';
        var prevBtn = '<a id="test-prev-question-btn">< PRETHODNI KORAK</a>';
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
            if (fullQuestion.split(".")[1])
                question = fullQuestion.split(".")[1].trim();
            else question = fullQuestion;
            noOfSteps++;
            Watu.temp_questions[noOfSteps] = [jQuery(this).attr('id')];
        }
        Watu.question_ids.push(v.context.id.split('-')[1]);
        // deleting oder number/index before question
        jQuery(v).find("p").text(question);
        if(i <= firstStepQuestionNo) {
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
        }, 100);
    }
});
