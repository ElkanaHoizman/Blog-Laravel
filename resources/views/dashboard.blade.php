@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">create post</a>
                    <h3>your Blog posts</h3>
                     @if(count( $posts) > 0)
                    <table class="table tbale-striped">
                       <tr>
                            <th>Title</th>
                            <th></th>
                             <th></th>
                        </tr>

                        @foreach($posts as $post)

                        <tr>
                            <td>{{$post->title}}</td>
                             <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                             <td>
                                 {!!Form::open(['action'=>['postController@destroy' ,$post->id], 'method' =>'POST', ])!!}
                                    {{form::hidden('_method','DELETE')}}
                                    {{form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                             </td>
                        </tr>

                        @endforeach
                    </table>
                    @else
                    <p>you have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
