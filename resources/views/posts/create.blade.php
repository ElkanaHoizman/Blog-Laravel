
@extends('layouts.app')

@section('content')

  <h3>create</h3>
{!! Form::open(['action'=>'postController@store', 'method' =>'POST', 'enctype'=>'multipart/form-data']) !!}
   <div class="form-group">
       {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
   </div>
   <div class="form-group">
       {{Form::label('body','Body')}}
        {{Form::textarea('body','',[ 'id'=> 'article-ckeditor' ,'class'=>'form-control','placeholder'=>'Body Text'])}}
   </div>
   <div class="from-group">
     {{form::file('cover_image')}}
   </div><hr>
   {{form::submit('submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection