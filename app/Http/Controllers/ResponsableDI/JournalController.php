<?php


namespace App\Http\Controllers\ResponsableDI;


use App\Http\Controllers\Controller;
use App\Journal;

class JournalController extends Controller
{
    public function show() {
        $events = Journal::all();
        return view('di.journal')->with('events', $events);
    }
}