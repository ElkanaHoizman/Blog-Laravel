
@extends('layouts.app')

@section('content')

  <h3>posts</h3>
@if(count($posts) > 0)
    @foreach($posts as $post)
        <div class="well">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                </div>
            <div class="col-md-8 col-sm-8">
                 <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>written on{{$post->created_at}} </small>
             </div>
            </div>
        </div>
    @endforeach 
    {{$posts->links()}}
@else
<p> no posts found</p>

@endif
@endsection