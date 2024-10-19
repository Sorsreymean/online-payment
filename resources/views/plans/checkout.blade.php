<x-app-layout>
    @section('styles')
    <style>
        .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1.5em 1.5em;
        -webkit-tap-highlight-color: transparent;
      }

      .submit-button:disabled {
        cursor: not-allowed;
        background-color: #D1D5DB;
        color: #111827;
      }

      .submit-button:disabled:hover {
        background-color: #9CA3AF;
      }

      .credit-card {
        max-width: 420px;
        margin-top: 3rem;
      }

      @media only screen and (max-width: 420px)  {
        .credit-card .front {
          font-size: 100%;
          padding: 0 2rem;
          bottom: 2rem !important;
        }

        .credit-card .front .number {
          margin-bottom: 0.5rem !important;
        }
      }
    </style>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>
    <div class="m-4">
        <div class="credit-card w-full sm:w-auto shadow-lg mx-auto rounded-xl bg-white" x-data="creditCard">
          <header class="flex flex-col justify-center items-center">
            <div
              class="relative"
             
            >
              <img class="w-full h-auto" src="https://www.computop-paygate.com/Templates/imagesaboutYou_desktop/images/svg-cards/card-visa-front.png" alt="front credit card">
              <div class="front bg-transparent text-lg w-full text-white px-12 absolute left-0 bottom-12">
                <p class="number mb-5 sm:text-xl">0000 0000 0000 0000</p>
                <div class="flex flex-row justify-between">
                  <p>苏 岁 敏</p>
                  <div class="">
                    <span>04</span>
                    <span >/</span>
                    <span >2027</span>
                  </div>
                </div>
              </div>
            </div>
          </header>
          <form action="{{route('plan.process')}}" method="POST" id="subscribe-form">
            @csrf
            <main class="mt-4 p-4">
                <h1 class="text-xl font-semibold text-gray-700 text-center">Card payment</h1>
                <input type="hidden" name="id" value="{{$plan->plan_id}}">
                <input type="hidden" name="plan_id" value="{{$plan->stripe_plan_id}}">
                <input type="hidden" name="billing_period" value="{{$plan->bill_period}}">
                <input type="hidden" name="period" value="{{$plan->period}}">
                <div class="py-4">
                    <div class="my-2">
                    <label class="text-[14px]">Card Holder Name</label>
                    <input
                    type="text"
                    class="block w-full px-5 py-2 border rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                    placeholder="Card holder name"
                    maxlength="22"
                    id="card-holder-name"
                    />
                </div>
                <div class="my-3">
                    {{-- <input
                    type="text"
                    class="block w-full px-5 py-2 border rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                    placeholder="Card number"
                    maxlength="19"
                    id="card-element"
                    /> --}}
                    <label class="text-[14px]">Card Number,Expired Date, CVV</label>
                    <div id="card-element" class="block w-full px-5 py-2 border rounded-lg bg-white shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none">
                    </div>
                </div>
                </div>
            </main>
            <footer class="mt-4 p-4">
                <button  id="card-button" data-secret="{{ $intent->client_secret }}" 
                class="submit-button px-4 py-3 rounded-full bg-blue-300 text-blue-900 focus:ring focus:outline-none w-full text-xl font-semibold transition-colors"
                >
                Pay now
                </button>
            </footer>
          </form>
        </div>
    </div>
    @section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
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
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log("attempting");
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value },
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            paymentMethodHandler(setupIntent.payment_method);
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
@endsection
</x-app-layout>
