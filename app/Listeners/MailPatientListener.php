<?php

namespace App\Listeners;

use App\Events\MailPatientEvent;
use App\Mail\SendStautRvMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailPatientListener
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
    public function handle(MailPatientEvent $event): void
    {
        $email=$event->rv->patient->user->email;

        Mail::to($email)->send(new SendStautRvMail($event->rv,$event->etat));
    }
}
