<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement avec Stripe</title>
    <!-- Incluez Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Personnalisation des styles Stripe */
        .StripeElement {
            background-color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            transition: border-color 0.2s ease;
        }

        .StripeElement--focus {
            border-color: #4299e1; /* Bleu */
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }

        .StripeElement--invalid {
            border-color: #f56565; /* Rouge */
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-8 bg-gray-800 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-yellow-400 text-center">Effectuez un paiement</h1>

        <form id="payment-form" action="{{ route('create.checkout.session') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="amount" class="block text-sm font-medium mb-1 text-gray-400">Montant (USD) :</label>
                <input type="number" id="amount" name="amount" step="0.01" required
                    class="w-full px-4 py-2 rounded-md border border-gray-700 bg-gray-700 text-white focus:outline-none focus:border-blue-500">
            </div>


            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 rounded-md shadow-md transition duration-300">
                Payer
            </button>

            @if ($errors->any())
                <ul class="mt-4 space-y-2 text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>

    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#ffffff',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#f56565',
                    iconColor: '#f56565'
                }
            }
        });
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { token, error } = await stripe.createToken(cardElement);

            if (error) {
                alert(error.message);
            } else {
                // Ajoutez le jeton au formulaire et soumettez-le
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'token');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    </script>
</body>
</html>