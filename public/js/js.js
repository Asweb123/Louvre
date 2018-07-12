$(document).ready(function() {
    $('.flatpickr').flatpickr({
        locale: "fr",
        dateFormat: "d/m/Y",
        minDate: "today",
        maxDate: new Date().fp_incr(365),
        allowInput: true,
        disable: [
            function (date) {
                return (
                    date.getDay() === 0
                    || date.getDay() === 2
                    || (date.getDate() === 1 && date.getMonth() === 4)
                    || (date.getDate() === 1 && date.getMonth() === 10)
                    || (date.getDate() === 25 && date.getMonth() === 11)
                );
            }
        ]
    });

    //Styling symfony forms
    $('.form-group > label').css('font-weight', 'bold').css('color', '#212529');
    $('.form-check > label').css('font-weight', 'bold').css('color', '#212529');
    $('legend').css('font-weight', 'bold').css('color', '#212529');
    $('form > fieldset > legend').css('font-size', '1.65rem').css('color', '#727272').addClass('text-center');
    $('form > fieldset > div').addClass('mb-5');

    //Flip cards price on Index
    $('.fieldset-s > label').click(function() {
        $('.scene-card').toggleClass('is-flipped');
    });

});
