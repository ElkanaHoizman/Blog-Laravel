
@extends('layouts.app')

@section('content')
<h1>{{$title}}</h1>
@if(count($servces>0 ))
<ul class="list-group">

   @foreach($servces as $servce)
    
        <li class="list-group-item">{{$servce}}</li>

    @endforeach
    
    
</ul>
@endif

@endsection