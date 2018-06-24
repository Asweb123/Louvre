$(document).ready(function() {
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

});



// Create a Stripe client.
var stripe = Stripe('pk_test_XJEMQqTn9vPLz78h6NYr2bRb');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element.
var cardNumber = elements.create('cardNumber', {style: style});
var cardExpiry = elements.create('cardExpiry', {style: style});
var cardCvc = elements.create('cardCvc', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
cardNumber.mount('#cardNumber-element');
cardExpiry.mount('#cardExpiry-element');
cardCvc.mount('#cardCvc-element');

// Handle real-time validation errors from the card Element.
cardNumber.addEventListener('change', function(event) {
    var displayError = document.getElementById('cardNumber-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
cardExpiry.addEventListener('change', function(event) {
    var displayError = document.getElementById('cardExpiry-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});
cardCvc.addEventListener('change', function(event) {
    var displayError = document.getElementById('cardCvc-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('cardNumber-errors');
            errorElement.textContent = result.error.message;
            var errorElement = document.getElementById('cardExpiry-errors');
            errorElement.textContent = result.error.message;
            var errorElement = document.getElementById('cardCvc-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});