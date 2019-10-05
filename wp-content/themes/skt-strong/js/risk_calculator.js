
const initWatu = function () {
    const questions = jQuery('.watu-question');
    questions.hide();
    manageButtons();
    Watu.filtered_questions = {};
    Watu.current_step = 1;
    Watu.isLastQuestion = false;
    Watu.total_steps = getNoOfSteps();
    Watu.total_questions = getNoOfQuestions();
    showNextStep(Watu.current_step);
    console.log(Watu);
};

const showNextStep = function (step) {
    Watu.filtered_questions[step].forEach(function (question_id) {
        jQuery("#" + question_id).show();
    });
    if (step > 1) {
        Watu.filtered_questions[step - 1].forEach(function (question_id) {
            jQuery("#" + question_id).hide();
        });
    }
}

const showPrevStep = function (step) {
    Watu.filtered_questions[step].forEach(function (question_id) {
        jQuery("#" + question_id).show();
    });
    Watu.filtered_questions[step + 1].forEach(function (question_id) {
        jQuery("#" + question_id).hide();
    });
}

const manageButtons = function () {

    if (parseInt(Watu.singlePage)) {
        var nextBtn = '<a id="next-question-btn">SLEDEĆI KORAK</a>';
        var prevBtn = '<a id="prev-question-btn">PRETHODNI KORAK</a>';
        var submitBtn = '<a id="submit-btn" onclick="Watu.submitResult()">IZRAČUNAJ RIZIK</a>';
        jQuery('#action-button').after(prevBtn, nextBtn, submitBtn);
        jQuery('#prev-question-btn').hide();
        jQuery('#submit-btn').hide();
        jQuery("#next-question-btn").click(function () {
            Watu.current_step++;
            jQuery( ".ojh-progress-indicator .ojh-progress-indicator__step:nth-child("+ Watu.current_step + ")").addClass('ojh-progress-indicator__step--active');
            showNextStep(Watu.current_step);
            if (Watu.current_step === Watu.total_steps) {
                jQuery(this).hide();
                jQuery("#submit-btn").show();
            }
            if (Watu.current_step > 1) {
                jQuery('#prev-question-btn').show();
            }
        });

        jQuery("#prev-question-btn").click(function () {
            jQuery( ".ojh-progress-indicator .ojh-progress-indicator__step:nth-child("+ Watu.current_step + ")").removeClass('ojh-progress-indicator__step--active');
            Watu.current_step--;
            showPrevStep(Watu.current_step);
            if (Watu.current_step === 1) {
                jQuery(this).hide();
            }
            if (Watu.current_step !== Watu.total_steps) {
                jQuery('#next-question-btn').show();
            }});
    }
}

const getNoOfQuestions = function () {
    var i = 0;
    jQuery(".watu-question").each(function () {
        i++;
    });
    return i;
}

const getNoOfSteps = function () {

    var noOfSteps = 0;
    var prevIndex = 0;
    jQuery(".watu-question").each(function (k, v) {
        var fullQuestion = jQuery(v).find("p").text();
        var question = "";
        if (fullQuestion.split("]")[1]) {
            question = fullQuestion.split("]")[1].trim();
            var beforeQuestion = fullQuestion.split("]")[0].trim();
            var currIndex = beforeQuestion[beforeQuestion.length - 1];
            if (prevIndex == -1 || prevIndex !== currIndex) {
                noOfSteps++;
                Watu.filtered_questions[currIndex] = [jQuery(this).attr('id')];
            } else {
                Watu.filtered_questions[currIndex].push(jQuery(this).attr('id'));
            }
            prevIndex = currIndex;
        } else {
            question = fullQuestion.split(".")[1].trim();
            prevIndex++;
            noOfSteps++;
            Watu.filtered_questions[prevIndex] = [jQuery(this).attr('id')];
        }
        // brisemo redni broj/index ispred pitanja
        jQuery(v).find("p").text(question);
    });

    return noOfSteps;
}

jQuery(document).ready(function () {

    setTimeout(function () {
        initWatu();
        console.log("Total questions: " + Watu.total_questions);
        console.log("Total steps: " + Watu.total_steps);
        // Hide 'submit' btn and show 'previous' & 'next' buttons:
        if (!Watu.isLastQuestion) {
            jQuery('#action-button').hide();
        }


    }, 100);

});






