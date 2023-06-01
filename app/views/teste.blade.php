@extends('templates.layout')

@section('content')
    <div style="padding-left:16px">
      <h2>Responsive Topnav Example</h2>
      <p>Resize the browser window to see how it works.</p>
    </div>


    <h1>Home teste home teste</h1>
    <p>teste home</p>
    <h1>meu nome e : {{$nome}}</h1>

    <form id="form1" action="/teste" method="post">
        <input type="text" name="name" value="darcio">
        {!! Csrf::csrf() !!}
        <input type="text" name="age" value="31">
        <input type="text" name="email" value="darcio@dss">

        <button>Enviar</button>
    </form>

    <hr>
    <h1>criar user</h1>
    
    <form  id="form2" action="/teste" method="post" enctype="multipart/form-data">      

      <input type="text" name="email"  placeholder="email" value="name@email">
      {!!FlashMessage::message('email','alert alert-danger')!!}
      <hr>
      <input type="text" name="name" placeholder="name" value="name-teste">
      {!!FlashMessage::message('name','alert alert-danger')!!}
      <hr>
      <input type="text" name="password" placeholder="password" value="123">
      
      {{-- <input type="file" name="file" placeholder="foto"> --}}

      <button>Enviar</button>
  </form>
    

@endsection


