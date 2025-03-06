<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;


class PaymentController extends Controller
{
    /**
     * Afficher le formulaire de paiement.
     */
    public function paymentForm()
    {
        return view('payment.form'); // Créez une vue pour afficher le formulaire de paiement
    }

    /**
     * Traiter le paiement via Stripe.
     */
    public function createCheckoutSession(Request $request)
    {
        // Validez le montant
        $request->validate([
            'amount' => 'required|numeric|min:0.50', // Montant minimum de 0.50$
        ]);

        // Initialiser Stripe avec la clé secrète
        Stripe::setApiKey(config('services.stripe.secret'));

        // Créer une session Stripe Checkout
        $session = Session::create([
            'payment_method_types' => ['card'], // Méthodes de paiement acceptées
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Paiement unique',
                    ],
                    'unit_amount' => intval($request->amount * 100), // Convertir en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment', // Mode de paiement (payment, subscription, etc.)
            'success_url' => route('payment.success'), // URL après succès
            'cancel_url' => route('payment.cancel'),   // URL si annulé
        ]);

        // Redirigez l'utilisateur vers Stripe Checkout
        return redirect()->away($session->url);
    }

    /**
     * Page de confirmation de paiement.
     */
    public function success()
    {
        return view('payment.success'); 
    }
}