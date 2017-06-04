@extends('master')

@section('meta')
<title>Wizard-Poker | {{ $page->title }}</title>
<meta name="description" content="Wizard-Poker Website Discussion - {{ $page->title }}">
<meta property="og:title" content="{{ $page->title }}" />
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
                {{ Form::open(['action' => ['PagesController@postComment', $page->slug], 'autocomplete' => 'off']) }}
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
                    <div class="clearfix margin-bottom-20"></div>
                    <p>{{ $comment->text }}</p>
                    <ul class="list-inline news-v1-info">
                    <li><i class="fa fa-chevron-down downvote votes-icon @if($comment->my_vote == -1)downvoted @endif" commentId="{{ $comment->id }}"></i></li>
                    <li>                            
                        <div class="vote-sum" commentId="{{ $comment->id }}">
                        {{ $comment->vote_sum}}
                        </div>
                    </li>
                    <li><i class="fa fa-chevron-up upvote votes-icon @if($comment->my_vote == 1)upvoted @endif" commentId="{{ $comment->id }}"></i></li>
                    <li>|</li>
                    <li><i class="fa fa-user"></i> {{ $comment->user->username }} </li>
                    <li>|</li>
                    <li><i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}</li>
                </ul>
                </div>
            @endforeach
            </div>
        </div>
    </div><!--/container-->
@stop

@section('foot')
<script>
$(".upvote").on('click', function(event){
    event.preventDefault();
    var commentId = $(event.target).attr('commentId');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: 1};

    $.ajax({
        type: "POST",
        url: "/comments/" + commentId + '/vote',
        data: data,
        success: function(diff) {
            console.log(diff);
            changeVoteSum(commentId, diff, $(event.target));
        }
    });
});

$(".downvote").on('click', function(event){
    event.preventDefault();
    var commentId = $(event.target).attr('commentId');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: -1};

    $.ajax({
        type: "POST",
        url: "/comments/" + commentId + '/vote',
        data: data,
        success: function(diff) {
            console.log(diff);
            changeVoteSum(commentId, diff, $(event.target));
        }
    });
});

function changeVoteSum(commentId, diff, dom){
    var sumDom = $(".vote-sum[commentId='" + commentId + "']");
    var lastSum = parseInt(sumDom.html());
    console.log(lastSum);
    var newSum = lastSum + parseInt(diff);
    sumDom.html("" + newSum);

    if(diff == 2){
        dom.addClass("upvoted");
        $('.downvote[commentId="' + commentId + '"]').removeClass("downvoted");
    }
    else if(diff == 1){
        if(dom.hasClass("downvoted"))
            dom.removeClass("downvoted");
        else
            dom.addClass("upvoted");
    }
    else if(diff == -1){
        if(dom.hasClass("upvoted"))
            dom.removeClass("upvoted");
        else
            dom.addClass("downvoted");
    }
    else if(diff == -2){
        dom.addClass("downvoted");
        $('.upvote[commentId="' + commentId + '"]').removeClass("upvoted");
    }
}
</script>
@stop