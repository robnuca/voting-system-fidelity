<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Jobs\StoreVote;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        Log::info('VoteController@store called', [
            'request' => $request->all(),
            'user' => $request->user()
        ]);

        $validator = Validator::make($request->all(), [
            'choice_id' => 'required|exists:choices,id',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $request->user();
        
        if (Vote::where('user_id', $user->id)->exists()) {
            return response()->json([
                'message' => 'You have already voted',
            ], 403);
        }

        // Queuing the vote to handle high traffic
        StoreVote::dispatch($user->id, $request->input('choice_id'), $request->ip());

        Log::info('Vote queued successfully', ['user_id' => $user->id]);

        return response()->json([
            'message' => 'Vote recorded successfully',
        ]);
    }
}