<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use Statamic\Events\FormSubmitted;
use Statamic\Facades\Entry;

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
            $id = Str::orderedUuid();
            $data = $event->submission->data();
            $data->put('payment_id', $id);
            // calculate total price
            $total = 0;
            for ($i = 0; $i < count($data->get('reservation_details')); $i++) {
                $total += $data->get('reservation_details')[$i]['price'] * $data->get('reservation_details')[$i]['quantity'];
            }
            $data->put('total_price', $total);
            $data->put('payment', 'pending');
            $data->put('created_at', now()->format('Y-m-d H:i:s'));

            // create a reservation entry in Reservations
            $entry = Entry::make()
                ->collection('reservations')
                ->data($data)
                ->published(true)
                ->save();

            return false;
        }
    }

}
