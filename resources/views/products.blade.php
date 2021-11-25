@extends('layouts.main')

@section('title', 'Produto')

@section('content')
<h1>Tela de produtos</h1>
@if($busca != '')
    <p>O usuário esta buscando por {{$busca}}</p>
@endif

@endsection