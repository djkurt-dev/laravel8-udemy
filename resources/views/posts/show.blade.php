@extends('layouts.app')

@section('title',$post['title'])

@section('content')
    @if ($post['is_new'])
        <p>A new blog post that is new</p>
    @else
        <p>This blog post is old.</p>    
    @endif

    @unless ($post['is_new'])
        <p>It is an old blog post... using unless</p>
    @endunless

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

    @isset($post['has_comments'])
        <h5>This post has some comments... using isset</h5>
    @endisset
@endsection