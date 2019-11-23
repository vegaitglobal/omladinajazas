const initWatu = function() {
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
};

const showNextStep = function(index, prevIndex) {
	Watu.filtered_questions[index].forEach(function(question_id) {
		jQuery('#' + question_id).show();
	});
	if (index > 1) {
		Watu.filtered_questions[prevIndex].forEach(function(question_id) {
			jQuery('#' + question_id).hide();
		});
	}
};

const showPrevStep = function(index, nextIndex) {
	Watu.filtered_questions[index].forEach(function(question_id) {
		jQuery('#' + question_id).show();
	});
	Watu.filtered_questions[nextIndex].forEach(function(question_id) {
		jQuery('#' + question_id).hide();
	});
};

const manageButtons = function() {
	if (parseInt(Watu.singlePage)) {
		const nextBtn = '<a id="next-question-btn">SLEDEĆI KORAK</a>';
		const prevBtn = '<a id="prev-question-btn">PRETHODNI KORAK</a>';
		const submitBtn =
			'<a id="submit-btn" onclick="Watu.submitResult()">IZRAČUNAJ RIZIK</a>';
		jQuery('#action-button').after(prevBtn, nextBtn, submitBtn);
		jQuery('#prev-question-btn').hide();
		jQuery('#submit-btn').hide();
		jQuery('#next-question-btn').click(function() {
			Watu.current_step++;
			jQuery(
				'.ojh-progress-indicator .ojh-progress-indicator__step:nth-child(' +
					Watu.current_step +
					')'
			).addClass('ojh-progress-indicator__step--active');
			const index = Object.keys(Watu.filtered_questions)[Watu.current_step - 1];
			const prevIndex = Object.keys(Watu.filtered_questions)[
				Watu.current_step - 2
			];
			showNextStep(index, prevIndex);
			if (Watu.current_step === Watu.total_steps) {
				jQuery(this).hide();
				jQuery('#submit-btn').show();
			}
			if (Watu.current_step > 1) {
				jQuery('#prev-question-btn').show();
			}
		});

		jQuery('#prev-question-btn').click(function() {
			jQuery(
				'.ojh-progress-indicator .ojh-progress-indicator__step:nth-child(' +
					Watu.current_step +
					')'
			).removeClass('ojh-progress-indicator__step--active');
			Watu.current_step--;
			const index = Object.keys(Watu.filtered_questions)[Watu.current_step - 1];
			const nextIndex = Object.keys(Watu.filtered_questions)[Watu.current_step];
			showPrevStep(index, nextIndex);
			jQuery('#submit-btn').hide();
			if (Watu.current_step === 1) {
				jQuery(this).hide();
			}
			if (Watu.current_step !== Watu.total_steps) {
				jQuery('#next-question-btn').show();
			}
		});
	}
};

const getNoOfQuestions = function() {
	let i = 0;
	jQuery('.watu-question').each(function() {
		i++;
	});
	return i;
};

const getCurrentIndex = function(beforeQuestion) {
	let currIndex = '';
	if (beforeQuestion[beforeQuestion.length - 2] == '[')
		currIndex = beforeQuestion[beforeQuestion.length - 1];
	else {
		const first = beforeQuestion[beforeQuestion.length - 2];
		const second = beforeQuestion[beforeQuestion.length - 1];
		currIndex = first + second;
	}
	return currIndex;
};

const getNoOfSteps = function() {
	let noOfSteps = 0;
	jQuery('.watu-question').each(function(k, v) {
		const fullQuestion = jQuery(v)
			.find('p')
			.text();
		let question = '';
		if (fullQuestion.split(']')[1]) {
			question = fullQuestion.split(']')[1].trim();
			const beforeQuestion = fullQuestion.split(']')[0].trim();
			const currIndex = getCurrentIndex(beforeQuestion.replace(/ /g, ''));

			if (Watu.filtered_questions[currIndex]) {
				Watu.filtered_questions[currIndex].push(jQuery(this).attr('id'));
			} else {
				Watu.filtered_questions[currIndex] = [jQuery(this).attr('id')];
				noOfSteps++;
			}
		} else {
			question = fullQuestion.split('.')[1].trim();
			noOfSteps++;
			Watu.temp_questions[noOfSteps] = [jQuery(this).attr('id')];
		}
		// deleting oder number/index before question
		jQuery(v)
			.find('p')
			.text(question);
		const number = '<span class="watu_num">' + noOfSteps + '. ' + '</span>';
		jQuery(v)
			.find('p')
			.prepend(number);
	});

	// add from temp_question
	jQuery.each(Watu.temp_questions, function(k, v) {
		let i = 1;
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
};

jQuery(document).ready(function() {
	if (jQuery('#quiz-5').get(0)) {
		setTimeout(function() {
			initWatu();
			jQuery('#risk-calc-complete-overlay')
				.css('display', 'block')
				.parents('.site-main')
				.addClass('site-quiz');
			// Hide 'submit' btn and show 'previous' & 'next' buttons:
			if (!Watu.isLastQuestion) {
				jQuery('#action-button').hide();
			}
			initQuizProgressIndicator();
		}, 100);
	}
});

// handle results page
jQuery(document).ajaxComplete(function() {
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

const getResultPercentage = function() {
	const achieved = jQuery('#watu-achieved-points').get(0).innerText;
	const maximum =
		jQuery('#watu-max-points').get(0).innerText - Watu.subtractFromMaxResult ||
		0;
	const percentage = (achieved / maximum) * 100;
	console.log(
		`Risk Calculator results \n\t acv score: ${achieved} \n\t max score: ${maximum} \n\t percentage: ${percentage}%`
	);
	return percentage.toFixed(0);
};
