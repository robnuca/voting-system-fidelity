<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyVoteTotals;
use App\Models\Choice;

class SendDailyVoteTotals extends Command
{
    protected $signature = 'send:daily-vote-totals';
    protected $description = 'Send daily vote totals to dev@unifysoftware.com';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $totals = Choice::withCount('votes')->get();
        Mail::to('dev@unifysoftware.com')->send(new DailyVoteTotals($totals));
    }
}