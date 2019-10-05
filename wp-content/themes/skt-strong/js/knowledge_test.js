const initQuizProgressIndicator = function () {
    var total_steps = Watu.total_steps;
    var step_num = null;
    var indicatorWrapper = jQuery("#ojh-risk-indicator-wrapper");
    var indicator = indicatorWrapper.find('.ojh-progress-indicator:first');
    for (var i = 1; i <= total_steps; i++) {
        step_num = i < 10 ? '0' + i : i;
        indicator.append(
            ' <div class="ojh-progress-indicator__step">' + step_num + '</div>'
        );
    }
    indicatorWrapper.find('.ojh-progress-indicator:first').find('.ojh-progress-indicator__step:first').addClass('ojh-progress-indicator__step--active');
};

jQuery(document).ready(function () {
    setTimeout(function () {
        initQuizProgressIndicator();

    }, 100);

});


