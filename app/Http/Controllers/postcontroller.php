<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
class postcontroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
       
        //$post = post::all;
       // return post::where('title','post Two')->get();
      // $posts = DB::select('SELECT * FROM posts');

       // $posts = post::orderBy('title','desc')->take(2)->get();
       //$posts = post::orderBy('title','desc')->get();
       $posts = post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
             'body'=>'required',
             'cover_image'=>'image|nullable|max:1999'
        ]);
        //Handle file Upload
        if($request->hasFile('cover_image')){
           //Get filename wite the extension 
           $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
           //Get gust filename
            $filename = pathinfo($filenameWithExt, PATHINFO_EXTENSION);// PATHINFO_FIENAME
            //Get gust ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
           $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore='noimage.jpg';
        }

        //create Post
        $post = new post;
        $post->title= $request->input('title');
        $post->body= $request->input('body');
        $post->user_Id= auth()->user()->id;
        $post->cover_image= $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $post = Post::find($id);
       return view('posts.show')->with('post',$post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $post = Post::find($id);
          //check for correct user
          if(auth()->user()->id !==$post->user_id){
              return redirect('/posts')->with('error','Unauthorized page');

          }
           return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
             'body'=>'required'
        ]);
        //create Post
     $post = Post::find($id);
        $post->title= $request->input('title');
        $post->body= $request->input('body');
        $post->save();
        return redirect('/posts')->with('success',' Post update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post = Post::find($id);
         //check for correct user
          if(auth()->user()->id !==$post->user_id){
              return redirect('/posts')->with('error','Unauthorized page');

          }
          $post->delete();
          return redirect('/posts')->with('success',' Post removed');
    }
}
