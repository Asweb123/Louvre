$(document).ready(function() {
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
