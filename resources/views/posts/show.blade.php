
@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">go back</a>
  <h1>{{$post->title}}</h1>

<div>
    {{$post->body}}
</div>
<hr>
<small>eritten on{{$post->created_at}}</small>
<hr>
@if (!Auth::guest())
  @if (Auth::user()->id == $post->user_id)
<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a><br><br>

{!!Form::open(['action'=>['postController@destroy' ,$post->id], 'method' =>'POST', ])!!}
   {{form::hidden('_method','DELETE')}}
   {{form::submit('Delete',['class'=>'btn btn-danger'])}}
{!! Form::close() !!}
@endif
@endif
@endsection