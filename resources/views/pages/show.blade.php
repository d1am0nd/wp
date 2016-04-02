@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Pages</title>
<meta property="og:title" content="Wizard-Poker Hearthstone related pages" />
<meta name="twitter:title" content="{{ $page->title }}" />
<meta name="twitter:description" content="{{ $page->description }}" />
@stop

@section('head')
@stop

@section('filters')
@stop

@section('content')
    <div class="container content parallax-about">
        <div class="title-box-v2">
            <a href="{{ $page->url }}" target="_blank" class="no-link-style"><h2>{{ $page->title }}</h2></a>
            <a href="{{ $page->url }}" target="_blank" class="no-link-style"><p>{{ $page->description }}</p></a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ $page->url }}" target="_blank"><img style="margin-left:auto; margin-right: auto" class="img-responsive" src="{{ $page->thumbnail_path }}" alt=""></a>
                <div class="clearfix margin-bottom-20"></div>
            </div>
            <div class="col-md-6">
            <h3>Comments</h3>
            @if(Auth::check())
            <div class="profile-blog">
                {{ Form::open(['action' => ['PagesController@postComment', $page->slug]]) }}
                <div class="form-group">
                    <label for="text">Post a comment</label>
                    <input type="text" name="text" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-u btn-u-green">Post</button>
                </div>
                {{ Form::close() }}
                <hr>
            </div>
            @endif
            @foreach($page->comments as $comment)
                <div class="profile-blog">
                    <div class="name-location">
                        <strong>{{ $comment->user->username }}</strong> - {{ $comment->created_at->diffForHumans() }}
                    </div>
                    <div class="clearfix margin-bottom-20"></div>
                    <p>{{ $comment->text }}</p>
                    <hr>
                </div>
            @endforeach
            </div>
        </div>
    </div><!--/container-->
@stop

@section('foot')
@stop