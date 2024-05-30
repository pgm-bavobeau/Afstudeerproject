<?php

namespace App\Listeners;

use Statamic\Events\FormSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Statamic\Events\FormSubmitted;
use Statamic\Facades\Form;
use Illuminate\Support\Facades\Redirect;

use illuminate\http\Request;
use Mollie\Laravel\Facades\Mollie;

class ReservationFormListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FormSubmitted $event)
    {
        // Check if the saved form is the one you want to redirect from
        if ($event->submission->form->handle === 'reservation') {
            // handle the payment
            // Create a Mollie payment
            $id = uniqid();
            $data = $event->submission->data();
            $data->put('id', $id);
            $data->put('title', $data->get('event') . ' - ' . $data->get('name')); 
            // calculate total price
            $total = 0;
            for ($i = 0; $i < count($data->get('reservation_details')); $i++) {
                $total += $data->get('reservation_details')[$i]['price'] * $data->get('reservation_details')[$i]['quantity'];
            }
            $data->put('total_price', $total);
            $data->put('payment', 'pending');
        }
    }

}
