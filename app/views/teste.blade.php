@extends('templates.layout')

@section('content')
    <div style="padding-left:16px">
      <h2>Responsive Topnav Example</h2>
      <p>Resize the browser window to see how it works.</p>
    </div>


    <h1>Home teste home teste</h1>
    <p>teste home</p>
    <h1>meu nome e : {{$nome}}</h1>

    <form action="/teste" method="post">
        <input type="text" name="name" value="darcio">

        <input type="text" name="age" value="31">
        <input type="text" name="email" value="darcio@dss">

        <button>Enviar</button>
    </form>

    <hr>
    <h1>criar user</h1>
    <form action="/create-user" method="post" enctype="multipart/form-data">
      

      <input type="text" name="email" value="" placeholder="email">
      <input type="text" name="name" placeholder="name">
      <input type="text" name="password" placeholder="password">
      
      <input type="file" name="file" placeholder="foto">

      <button>Enviar</button>
  </form>
    

@endsection


