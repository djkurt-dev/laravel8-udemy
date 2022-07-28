<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Http\Requests\StorePost;

class PostsController extends Controller
{
    // private $posts = [
    //     1 => [
    //         'title' => 'Intro to Laravel',
    //         'content' => 'This is a short intro to Laravel',
    //         'is_new' => true,
    //         'has_comments' => true
    //     ],
    //     2 => [
    //         'title' => 'Intro to PHP',
    //         'content' => 'This is a short intro to PHP',
    //         'is_new' => false
    //     ],
    //     3 => [
    //         'title' => 'Intro to Java',
    //         'content' => 'This is a short intro to Java',
    //         'is_new' => true
    //     ],
    //     4 => [
    //         'title' => 'Intro to Javascript',
    //         'content' => 'An introduction to Javascript',
    //         'is_new' => false
    //     ]
    // ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('posts.index', ['posts' => BlogPost::orderBy('created_at','desc')->take(5)->get()]);
        return view('posts.index', ['posts' => BlogPost::all()]);
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
    public function store(StorePost $request)
    {
        // $request->validate([
        //     'title'=>'bail|required|min:5|max:100',
        //     'content'=>'required|min:10'
        // ]);
        $validated = $request->validated();
        $post = BlogPost::create($validated); //using model mass assignment
        // $post = new BlogPost();
        // //$post->title = $request->input('title');
        // $post->title = $validated['title'];
        // //$post->content = $request->input('content');
        // $post->content = $validated['content'];
        // $post->save();
        
        $request->session()->flash('status','Blog post was created!');
        return redirect()->route('posts.show',['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //abort_if(!isset($this->posts[$id]),404);
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit',['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validated();
        $post->fill($validated); // mass assignment
        $post->save();

        $request->session()->flash('status','The blog post was updated successfully!');
        return redirect()->route('posts.show',['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        session()->flash('status','Blog post was deleted successfully!');
        return redirect()->route('posts.index');
    }
}
