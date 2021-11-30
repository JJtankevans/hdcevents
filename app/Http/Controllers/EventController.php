<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index() {
        
        $search = request('search');

        if($search){
            $events = Event::where([
                ['title','like','%'.$search.'%']
            ])->get();
        }else{
            $events = Event::all();
        }


        return view('Events.welcome',['events' => $events, 'search'=> $search]);
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

        //Atribuindo um evento que está sendo criado a um usuário
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg','Evento criado com sucesso');
    }

    public function show($id) {

        $event =  Event::findOrFail($id);

        $eventOwner = User::where('id',$event->user_id)->first()->toArray();

        return view('Events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard(){
        $user = auth()->user();

        $events =  $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', [
            'events' => $events, 
            'eventsasparticipant' => $eventsAsParticipant]
        );
    }

    public function destroy($id){
        
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg','Evento excluído com sucesso!');
    }

    public function edit($id){
        
        $user =  auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user->id){
            return redirect('/dashboard');
        }

        return view('Events.edit',['event' => $event]);
    }

    public function update(Request $req){

        $data = $req->all();

        //Image upload
        if($req->hasFile('image') && $req->file('image')->isValid()){
            
            $requestImage = $req->image;
                    
            $extension = $requestImage->extension();
        
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
            $requestImage->move(public_path('img/events'),$imageName);
        
            $data['image'] = $imageName;
        }

        Event::findOrFail($req->id)->update($data);

        return redirect('/dashboard')->with('msg','Evento editado com sucesso!');
    }

    public function joinEvent($id) {

        //pega o usuário autenticado
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Sua presença está confirmada no evento ' . $event->title);
    }
}
