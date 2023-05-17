@extends('templates.layout')

@section('content')
    <h1>Home teste home teste</h1>
    <p>teste home</p>
    <h1>meu nome e : {{$nome}}</h1>

    <form action="/teste" method="post">
        <input type="text" name="name" value="darcio">

        <input type="text" name="age" value="31">
        <input type="text" name="email" value="darcio@dss">

        <button>Enviar</button>
    </form>
    

@endsection