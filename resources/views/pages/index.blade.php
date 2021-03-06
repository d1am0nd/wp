@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Pages</title>
<meta name="description" content="Wizard-Poker Pages - Community picked best Hearthstone websites">
<meta property="og:title" content="Wizard-Poker Pages - Community picked best Hearthstone websites" />
<meta name="twitter:title" content="Wizard-Poker Pages" />
<meta name="twitter:description" content="Community picked best Hearthstone websites" />
@stop

@section('head')
<link rel="stylesheet" href="/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<!-- CSS Customization -->
    <!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="/plugins/animate.css">
<link rel="stylesheet" href="/plugins/line-icons/line-icons.css">
<link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/plugins/fancybox/source/jquery.fancybox.css">
<link rel="stylesheet" href="/css/custom.css">
@stop

@section('filters')
@include('filters.navbar')
@stop

@section('content')
<div class="container content-md">
    @foreach(array_chunk($pages->getCollection()->all(), 3) as $row)
    <div class="row news-v1">
        @foreach($row as $page)
        <div class="col-md-4 md-margin-bottom-40">
            <div class="news-v1-in">
                <a href="{{ $page->url }}" target="_blank">
                    <div class="img-wrapper">
                        <div class="img-tags">
                            @foreach($page->tags as $tag)
                            <span class="img-tag label label-u label-default">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <img class="img-responsive" src="{{ $page->thumbnail_path }}" alt="">
                    </div>
                </a>
                <h3 style="overflow:hidden;"><a href="{{ $page->url }}" target="_blank">{{ $page->title }}</a></h3>
                <p style="overflow:hidden;" >{{ $page->description }}</p>
                <ul class="list-inline news-v1-info">
                    <li><i class="fa fa-chevron-down downvote votes-icon @if($page->my_vote == -1)downvoted @endif" pageSlug="{{ $page->slug }}"></i></li>
                    <li>
                        <div class="vote-sum" pageSlug="{{ $page->slug }}">
                        {{ $page->vote_sum }}
                        </div>
                    </li>
                    <li><i class="fa fa-chevron-up upvote votes-icon @if($page->my_vote == 1)upvoted @endif"  pageSlug="{{ $page->slug }}"></i></li>
                    <li>|</li>
                    <li><i class="fa fa-clock-o"></i> {{ $page->created_at }}</li>
                    <li class="pull-right"><a href="{{ action('PagesController@show', $page->slug) }}"><i class="fa fa-comments-o"></i> {{ $page->comment_count }}</a></li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>

<div id="myModalNewItem" class="modal fade" role="dialog">
    <div class="container modal-container-new-item">
        {!! Form::open(['action' => 'PagesController@store', 'class' => 'sky-form', 'id' => 'new-page-form', "style" => "margin-bottom:20px"]) !!}
        <fieldset style="border-style:none">
            <div class="container">
                <span class="new-item-h">Add a new Hearthstone related page</span>
            </div>
            <section>
                <div class="form-group">
                    <label class="col-md-1 control-label">Title</label>
                    <div class="col-md-11">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </div>
                    <div class="col-md-offset-1 col-md-11">
                        <label class="control-label small" page-error="title" style="display:none;"></label>
                    </div>
                </div>
            </section>
            <section>
                <div class="form-group">
                    <label class="col-md-1 control-label">Description</label>
                    <div class="col-md-11">
                        <input type="text" name="description" class="form-control" placeholder="Description">
                    </div>
                    <div class="col-md-offset-1 col-md-11">
                        <label class="control-label small" page-error="description" style="display:none;"></label>
                    </div>
                </div>
            </section>
            <section>
                <div class="form-group">
                    <label class="col-md-1 control-label">URL</label>
                    <div class="col-md-11">
                        <input type="text" name="url" class="form-control" id="inputUrl1" placeholder="URL">
                    </div>
                    <div class="col-md-offset-1 col-md-11">
                        <label class="control-label small" page-error="url" style="display:none;"></label>
                    </div>
                </div>
            </section>
            <section>
                <div class="form-group">
                    <label class="col-md-1 control-label">Tags</label>
                    <div class="col-md-11">
                        <div class="inline-group">
                            @foreach($tags as $tag)
                            <label class="checkbox"><input type="checkbox" name="tag_id[]" value="{{ $tag->id }}"><i></i>{{ $tag->name }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-11">
                        <label class="control-label small" page-error="tag_id" style="display:none;"></label>
                    </div>
                </div>
            </section>
            <section>
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-11">
                        <button type="submit" class="btn-u btn-u-green">Submit</button>
                    </div>
                </div>
            </section>
        </fieldset>
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('foot')
@if(Auth::check())
<script>
$(".upvote").on('click', function(event){
    event.preventDefault();
    var id = $(event.target).attr('pageSlug');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: 1};

    $.ajax({
        type: "POST",
        url: "/pages/" + id + '/vote',
        data: data,
        success: function(diff) {
            changeVoteSum(id, diff, $(event.target));
        }
    });
});

$(".downvote").on('click', function(event){
    event.preventDefault();
    var id = $(event.target).attr('pageSlug');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: -1};

    $.ajax({
        type: "POST",
        url: "/pages/" + id + '/vote',
        data: data,
        success: function(diff) {
            changeVoteSum(id, diff, $(event.target));
        }
    });
});

function changeVoteSum(pageSlug, diff, dom){
    var sumDom = $(".vote-sum[pageSlug='" + pageSlug + "']");
    var lastSum = parseInt(sumDom.html());
    console.log(lastSum);
    var newSum = lastSum + parseInt(diff);
    sumDom.html("" + newSum);

    if(diff == 2){
        dom.addClass("upvoted");
        $('.downvote[pageSlug="' + pageSlug + '"]').removeClass("downvoted");
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
        $('.upvote[pageSlug="' + pageSlug + '"]').removeClass("upvoted");
    }
}

$(".new-item").on('click', function(event){
    event.preventDefault();
    $("#myModalNewItem").modal("toggle");
});
$(document).on('submit', '#new-page-form', function(event){
    event.preventDefault();
    $(event.target).ajaxSubmit({
        complete: function(data){
            response = data.responseJSON;
            jQuery.each(response, function(i, val){
                var dom = $("[page-error='" + i + "']");
                dom.addClass('has-error')
                dom.html(val[0]);
                dom.show();
                setTimeout(function(){
                    dom.removeClass('has-error');
                    dom.hide();
                }, 5000);
            });
        },
        success: function(){
            location.reload();
        }
    });
});
</script>
@endif
@include('_votes')
@stop