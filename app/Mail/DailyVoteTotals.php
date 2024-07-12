<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyVoteTotals extends Mailable
{
    use Queueable, SerializesModels;

    public $totals;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($totals)
    {
        $this->totals = $totals;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Daily Vote Totals')
                    ->markdown('emails.daily_vote_totals')
                    ->with('totals', $this->totals);
    }
}