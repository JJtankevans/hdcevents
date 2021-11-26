<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index() {
        
        $events = Event::all();

        return view('Events.welcome',['events' => $events]);
    }

    public function create() {
        return view('Events.create');
    }

    public function store(Request $req) {
        $event = new Event;

        $event->title = $req->title;
        $event->city = $req->city;
        $event->description = $req->description;
        $event->private = $req->private;

        $event->save();

        return redirect('/')->with('msg','Evento criado com sucesso');
    }
}
