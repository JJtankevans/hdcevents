@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    @foreach($events as $event_item)
        <p>{{ $event_item->title }} -- {{ $event_item->description}}</p>
    @endforeach
@endsection