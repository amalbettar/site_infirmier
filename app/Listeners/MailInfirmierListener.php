<?php

namespace App\Listeners;

use App\Events\MailInfirmierEvent;

use App\Mail\SendStautCompteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailInfirmierListener
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
    public function handle(MailInfirmierEvent $event): void
    {
        Mail::to($event->user->email)->send(new SendStautCompteMail($event->user,$event->validation));
    }
}
