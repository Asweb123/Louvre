$(document).ready(function() {
    //Styling symfony forms
    $('.form-group > label').css('font-weight', 'bold').css('color', '#212529');
    $('.form-check > label').css('font-weight', 'bold').css('color', '#212529');
    $('legend').css('font-weight', 'bold').css('color', '#212529');
    $('form > fieldset > legend').css('font-size', '1.65rem').css('color', '#727272').addClass('text-center');
    $('form > fieldset > div').addClass('mb-5');

    //Flip cards price on Index
    var card = $('.scene-card');

    $('.fieldset-s > label[for="full-day"]').click(function()  {
         if (card.hasClass('is-flipped-h')){
             card.removeClass('is-flipped-h').addClass('is-flipped-f');
         }
    });

    $('.fieldset-s > label[for="half-day"]').click(function() {
        if (!(card.hasClass('is-flipped-h'))){
            card.removeClass('is-flipped-f').addClass('is-flipped-h');
        }
    });

/*
    card.click(function(){
        if (card.hasClass('is-flipped-h')){
            $('.fieldset-s > label[for="full-day"]').trigger('click');

        }else if (!(card.hasClass('is-flipped-h'))){
            $('.fieldset-s > label[for="half-day"]').trigger('click');
        }
    });
*/

});
