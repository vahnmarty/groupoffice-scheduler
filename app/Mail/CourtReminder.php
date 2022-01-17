<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Judicial;

class CourtReminder extends Mailable
{
    use Queueable, SerializesModels;

    public Judicial $judicial;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Judicial $judicial)
    {
        $this->judicial = $judicial;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.court-reminders.today', [
            'judicial' => $this->judicial
        ]);
    }
}
