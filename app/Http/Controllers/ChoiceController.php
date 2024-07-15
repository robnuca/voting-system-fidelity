<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Choice;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller; // Import the Controller class

class ChoiceController extends Controller
{
    public function index()
    {
        $choices = Choice::all();
        Log::info('Choices fetched from the database:', ['choices' => $choices->toArray()]);
        return response()->json($choices); // Explicitly return JSON
    }
}