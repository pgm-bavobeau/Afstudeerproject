<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Statamic\Facades\Entry;
use Mollie\Laravel\Facades\Mollie;

class MolliePaymentController extends Controller
{
    public function preparePayment(Request $request)
    {
        // Create a Mollie payment
        $payment = Mollie::api()->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => number_format($request->total_price, 2, '.', ''), // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'Reservation for ' . $request->title,
            'redirectUrl' => route('payment.success', ['id' => $request->payment_id]),
            // 'webhookUrl' => route('webhook.mollie'), // not able to test in local environment
            'metadata' => [
                'order_id' => $request->payment_id,
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * After the customer has completed the transaction,
     * you can fetch, check and process the payment.
     * This logic typically goes into the controller handling the inbound webhook request.
     * See the webhook docs in /docs and on mollie.com for more information.
     */
    public function handleWebHookNotification(Request $request)
    {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid()) {
            // Payment is paid and the funds are transferred.
        } elseif (!$payment->isOpen()) {
            // The payment isn't paid and has expired.
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Get the reservation entry and update the payment status
        $reservation = Entry::query()
            ->where('collection', 'reservations')
            ->where('payment_id', $request->id)
            ->first();
        $reservation->set('payment', 'paid');
        $reservation->save();
        return view('payment.success', compact('reservation'));
    }
}
