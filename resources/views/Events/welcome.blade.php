@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    <div id="search-container" class="col-md-12">
        <h1>Busque o evento</h1>
        <form action="">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">

        </form>
    </div>
    <div id="events-container" class="col-md-12">
        <h2>Próximos eventos</h2>
        <p class="subtitle">Veja os eventos dos próximos dias</p>
        <div id="cards-container" class="row">
            @foreach($events as $item)
                <div class="card col-md-3">
                    <img src="/img/events/{{ $item->image }}" alt="{{ $item->title }}">
                    <div class="card-body">
                        <p class="card-date">{{ date('d/m/Y', strtotime($item->date))}}</p>
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-participants">X Participantes</p>
                        <a href="/events/{{ $item->id }}" class="btn btn-primary"> Saber mais</a>
                    </div>
                </div>
            @endforeach
            @if(count($events) == 0)
                <p>Não há eventos disponíveis</p>
            @endif
        </div>
    </div>

@endsection