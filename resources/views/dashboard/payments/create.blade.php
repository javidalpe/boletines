@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
      // Create a Stripe client.
      var stripe = Stripe('{{config('services.stripe.key')}}');

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
          color: '#e51c23',
          iconColor: '#e51c23'
        }
      };

      // Create an instance of the card Element.
      var card = elements.create('card', {style: style, hidePostalCode: true, iconStyle: "solid"});

      // Add an instance of the card Element into the `card-element` <div>.
      card.mount('#card-element');

      //Errors
      card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });


      var intentElement = document.getElementById('intent');
      var clientSecret = intentElement.dataset.secret;

      // Create a token or display an error when the form is submitted.
      var form = document.getElementById('form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.handleCardSetup(clientSecret, card).then(function(data) {
            var error = data.error;
            var setupIntent = data.setupIntent;

          if (error) {
            // Inform the customer that there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
          } else {
            // Send the token to your server.
            stripeTokenHandler(setupIntent);
          }
        });
      });

      function stripeTokenHandler(setupIntent) {
        // Insert the token ID into the form so it gets submitted to the server

          var paymentMethodhiddenInput = document.createElement('input');
          paymentMethodhiddenInput.setAttribute('type', 'hidden');
          paymentMethodhiddenInput.setAttribute('name', 'paymentMethod');
          paymentMethodhiddenInput.setAttribute('value', setupIntent.payment_method);
          form.appendChild(paymentMethodhiddenInput);

        // Submit the form
        form.submit();
      }

    </script>

@endpush



<div class="row">
    <div class="col-md-8">
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
        <div id="intent" data-secret="{{ $intent->client_secret }}"></div>
    </div>
    <div class="col-md-4">
        <a href="https://stripe.com/es" target="_blank"><img src="/img/powered_by_stripe.svg" alt="Powered by Stripe" class="img-fluid" style="margin-top: 8px;"></a>
    </div>
</div>




@push('styles')
    <style>
        /**
        * The CSS shown here will not be introduced in the Quickstart guide, but shows
        * how you can use CSS to style your Element's container.
        */
        .StripeElement {
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #e51c23;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endpush
