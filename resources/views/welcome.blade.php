@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
<h1>Testando titulo</h1>

@if(10>5)
    <p>A condição é true</p>
@endif

<p>{{$nome}}</p>

@if($nome == "Pedro")
    <p>O nome é Pedro</p>
@elseif($nome == "Vitor")
    <p>O nome do individuo é {{$nome}}</p>
@else
    <p>O nome não é nenhum dos 2</p>
@endif
@endsection