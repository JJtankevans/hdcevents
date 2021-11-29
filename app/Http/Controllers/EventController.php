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
        $event->date =  $req->date;
        $event->city = $req->city;
        $event->description = $req->description;
        $event->private = $req->private;
        $event->items = $req->items;

        //Image upload
        if($req->hasFile('image') && $req->file('image')->isValid()){
            
            $requestImage = $req->image;
            
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'),$imageName);

            $event->image = $imageName;
        }

        $event->save();

        return redirect('/')->with('msg','Evento criado com sucesso');
    }

    public function show($id) {

        $event =  Event::findOrFail($id);

        return view('Events.show', ['event' => $event]);
    }
}
