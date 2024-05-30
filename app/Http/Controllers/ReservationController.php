<?php

namespace App\Http\Controllers;

use Statamic\Events\FormSubmitted;
use Statamic\Http\Controllers\Controller;
use Statamic\Facades\Form;

class ReservationController extends Controller
{
    public function formController(FormSubmitted $event)
    {
        dd($event);
        error_log(json_encode($event->all(), JSON_PRETTY_PRINT) . ' request!');
        $data = $event->validate([
            'name' => 'required',
            'email' => 'required|email',
            'event' => 'required',
            'reservation_details' => 'required|array',
        ]);

        error_log($data . ' data!');

        $form = Form::find('reservation');
        $form->makeSubmission()
            ->data($data)
            ->save();

        return redirect()->route('payment.create', $request->all());
    }
}