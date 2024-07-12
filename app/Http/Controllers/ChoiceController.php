<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Choice;
use Illuminate\Support\Facades\Log;

class ChoiceController extends Controller
{
    public function index()
    {
        $choices = Choice::all();
        Log::info('Choices:', $choices->toArray());
        return $choices;
    }
}
