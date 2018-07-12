$(document).ready(function() {
    $('.flatpickr').flatpickr({
        dateFormat: "d/m/Y",
    //    altInput: false,
    //    altFormat: "F j, Y",
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

    /*
    flatpickr{
        onDayCreate: function (dayElem, date) {
            // Utilize dayElem.dateObj, which is the corresponding Date

            if (dayElem.getDay() === 2
                || (dayElem.getDate() === 1 && date.getMonth() === 4)
                || (dayElem.getDate() === 1 && date.getMonth() === 10)
                || (dayElem.getDate() === 25 && date.getMonth() === 11)
                )
                dayElem.innerHTML += "<span class='closed'></span>";

            else if (Math.random() > 0.85)
                dayElem.innerHTML += "<span class='event busy'></span>";
        }
    }


    flatpickr.l10ns.fr.firstDayOfWeek = 1;
    flatpickr.l10ns.fr.altFormat = "j/m/Y"
*/


    $('.form-group > label').css('font-weight', 'bold').css('color', '#212529');
    $('.form-check > label').css('font-weight', 'bold').css('color', '#212529');
    $('legend').css('font-weight', 'bold').css('color', '#212529');

    $('form > fieldset > legend').css('font-size', '1.65rem').css('color', '#727272').addClass('text-center');
    $('form > fieldset > div').addClass('mb-5');


    $('.fieldset-s > label').click(function() {
        $('.scene-card').toggleClass('is-flipped');
    });



});



