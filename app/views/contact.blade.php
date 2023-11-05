@extends('templates.layout')

@section('content')

<h1>Contato</h1>
    
<form action="/contact" method="post">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="subject" placeholder="subject">
    <textarea name="message" id="" cols="30" rows="10"></textarea>

    <button type="submit">Send</button>
</form>

@endsection