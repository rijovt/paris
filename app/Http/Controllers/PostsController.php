<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
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
        $posts=Post::orderBy('created_at', 'desc')
                ->get();
        return view('posts.index')->with('Posts',$posts);
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
            'image_upload'=>'image|nullable|max:1999'
        ]);
        if($request->hasFile('image_upload')){
          $imagetostore=time().'_'.$request->file('image_upload')->getClientOriginalName();
          $request->file('image_upload')->storeAS('public/uploads',$imagetostore);
        }
        else {
          $imagetostore='noname.jpg';
        }
        $post= new Post;
        $post->title=$request->title;
        $post->body=$request->body;
        $post->user_id=auth()->user()->id;
        $post->cover_image=$imagetostore;
        $post->save();
        return redirect('posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findorfail($id);
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
      $post=Post::find($id);
      if(auth()->user()->id!==$post->user_id){
        return redirect('posts')->with('error','Unauthorized Page !!');
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

      $post= Post::find($id);
      $post->title=$request->title;
      $post->body=$request->body;
      $post->save();
      return redirect('posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post= Post::find($id);
      $post->delete();
      return redirect('posts')->with('success','Post Deleted');
    }
}
