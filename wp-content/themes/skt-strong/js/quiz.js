
const initWatu = function () {
    const questions = jQuery('.watu-question');
    questions.hide();
    manageButtons();
    Watu.filtered_questions = {};
    Watu.temp_questions = {};
    Watu.current_step = 1;
    Watu.isLastQuestion = false;
    Watu.total_steps = getNoOfSteps();
    Watu.total_questions = getNoOfQuestions();
    showNextStep(Watu.current_step);
    console.log(Watu);
};

const showNextStep = function (index, prevIndex) {
    Watu.filtered_questions[index].forEach(function (question_id) {
        jQuery("#" + question_id).show();
    });
    if (index > 1) {
        Watu.filtered_questions[prevIndex].forEach(function (question_id) {
            jQuery("#" + question_id).hide();
        });
    }
}

const showPrevStep = function (index, nextIndex) {
    Watu.filtered_questions[index].forEach(function (question_id) {
        jQuery("#" + question_id).show();
    });
    Watu.filtered_questions[nextIndex].forEach(function (question_id) {
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
            var index = Object.keys(Watu.filtered_questions)[Watu.current_step - 1];
            var prevIndex = Object.keys(Watu.filtered_questions)[Watu.current_step - 2];
            showNextStep(index, prevIndex);
            console.log(Watu.current_step - 1);
            if (Watu.current_step === Watu.total_steps) {
                jQuery(this).hide();
                jQuery("#submit-btn").show();
            }
            if (Watu.current_step > 1) {
                jQuery('#prev-question-btn').show();
            }
        });

        jQuery("#prev-question-btn").click(function () {
            Watu.current_step--;
            var index = Object.keys(Watu.filtered_questions)[Watu.current_step - 1];
            var nextIndex = Object.keys(Watu.filtered_questions)[Watu.current_step];
            showPrevStep(index, nextIndex);
            jQuery("#submit-btn").hide();
            if (Watu.current_step === 1) {
                jQuery(this).hide();
            }
            if (Watu.current_step !== Watu.total_steps) {
                jQuery('#next-question-btn').show();
            }
        });
    }
}

const getNoOfQuestions = function () {
    var i = 0;
    jQuery(".watu-question").each(function () {
        i++;
    });
    return i;
}

const getCurrentIndex = function (beforeQuestion) {
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

const getNoOfSteps = function () {

    var noOfSteps = 0;
    jQuery(".watu-question").each(function (k, v) {
        var fullQuestion = jQuery(v).find("p").text();
        console.log(fullQuestion);
        var question = "";
        if (fullQuestion.split("]")[1]) {
            question = fullQuestion.split("]")[1].trim();
            var beforeQuestion = fullQuestion.split("]")[0].trim();
            var currIndex = getCurrentIndex(beforeQuestion.replace(/ /g, ''));

            if (Watu.filtered_questions[currIndex]) {
                Watu.filtered_questions[currIndex].push(jQuery(this).attr('id'));
            }
            else {
                Watu.filtered_questions[currIndex] = [jQuery(this).attr('id')];
                noOfSteps++;
            }

        } else {
            question = fullQuestion.split(".")[1].trim();
            noOfSteps++;
            Watu.temp_questions[noOfSteps] = [jQuery(this).attr('id')];
        }
        // brisemo redni broj/index ispred pitanja
        jQuery(v).find("p").text(question);
    });

    // dodati iz temp_questiona 
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

    setTimeout(function () {
        if (jQuery(".entry-title").text() == "KALKULATOR RIZIKA") {
            initWatu();
            console.log("Total questions: " + Watu.total_questions);
            console.log("Total steps: " + Watu.total_steps);
            // Hide 'submit' btn and show 'previous' & 'next' buttons:
            if (!Watu.isLastQuestion) {
                jQuery('#action-button').hide();
            }
        }

    }, 100);

});







