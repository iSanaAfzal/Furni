<!DOCTYPE html>
<html>

<head>
    <title>Stripe Payment</title>
</head>

<body>
    <h1>Stripe Payment Form</h1>

    <form id="payment-form">
        @csrf
        <div>
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button id="submit-button">Submit Payment</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {
                token,
                error
            } = await stripe.createToken(card);
            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                const response = await fetch('/charge', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        token: token.id
                    })
                });

                const responseData = await response.json();
                if (responseData.success) {
                    alert('Payment successful!');
                } else {
                    alert('Payment failed: ' + responseData.message);
                }
            }
        });
    </script>
</body>

</html>
