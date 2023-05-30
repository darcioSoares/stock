@extends('templates.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <h1>home</h1>
            <p>{{ \Helper::auth()->name }} - {{\Helper::auth()->email }}</p>

        </div>
    </div>
</div>
    

@endsection