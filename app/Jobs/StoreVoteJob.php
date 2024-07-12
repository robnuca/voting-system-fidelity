<?php

namespace App\Jobs;

use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StoreVote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $choiceId;
    protected $ipAddress;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $choiceId, $ipAddress)
    {
        $this->userId = $userId;
        $this->choiceId = $choiceId;
        $this->ipAddress = $ipAddress;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vote = new Vote();
        $vote->user_id = $this->userId;
        $vote->choice_id = $this->choiceId;
        $vote->ip_address = $this->ipAddress;
        $vote->location = ''; // You might want to add logic to get the location

        $vote->save();

        Log::info('Vote stored successfully', ['vote' => $vote]);
    }
}