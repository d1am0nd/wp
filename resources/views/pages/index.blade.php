@extends('master')

@section('meta')
<title>Wizard-Poker | Pages</title>
<meta property="og:title" content="Wizard-Poker Pages" />
<meta property="og:url" content="{{ action('PagesController@index') }}" />
<meta name="twitter:title" content="Community-picked hearthstone pages" />
<meta name="twitter:description" content="If one boom bot is good, two are better. Pages with hearthstone advice and stuff" />
@stop

@section('head')
<link rel="stylesheet" href="/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<!-- CSS Customization -->
@stop

@section('filters')
@include('filters.navbar')
@stop

@section('content')<!--=== Team v1 ===-->

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
<div class="container content-md team-v1">
    <ul class="list-unstyled row">
        @foreach($pages as $key => $page)
        @if($key % 4 == 0)
        <div class="row">
            <div class="col-md-12">
        @endif
                <li class="col-sm-3 col-xs-6 md-margin-bottom-30">
                    <div class="team-img" url="{{ $page->url }}">
                        <a href="{{ $page->url }}">
                            <div class="img-wrapper">
                                <div class="img-tags">
                                    @foreach($page->tags as $tag)
                                    <span class="img-tag label label-u label-default">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                <img class="img-responsive" src="{{ $page->thumbnail_path }}" alt="">
                            </div>
                            <ul>
                                <li><i class="icon-custom icon-sm rounded-x icon-cursor"></i></li>
                            </ul>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-xs-10">
                            <h3 style="overflow:hidden;">{{ $page->title}}</h3>
                            <h4>{{ $page->published_at}}</h4>
                            <p style="overflow:hidden;">{{ $page->description }}</p>
                        </div>
                        <div class="col-xs-2">
                            <i class="fa fa-chevron-up icon-sm upvote votes-icon @if($page->my_vote == 1)upvoted @endif"  pageId="{{ $page->id }}"></i>
                            <div class="vote-sum" pageId="{{ $page->id }}" style="text-align:center;">
                                {{ $page->vote_sum }}
                            </div>
                            <i class="fa fa-chevron-down icon-sm downvote votes-icon @if($page->my_vote == -1)downvoted @endif" pageId="{{ $page->id }}"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                        </div>
                    </div>
                </li>
        @if($key % 4 == 3 || $key == (count($pages) - 1))
            </div>
        </div>
        @endif
        @endforeach
    </ul>
</div>
<!--=== End Team v1 ===-->
@stop

@section('foot')
@if(Auth::check())
<script>
$(".new-item").on('click', function(event){
    event.preventDefault();
    $("#myModalNewItem").modal("toggle");
});
$(".upvote").on('click', function(event){
    event.preventDefault();
    var id = $(event.target).attr('pageId');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: 1};

    $.ajax({
        type: "POST",
        url: "/pages/" + id,
        data: data,
        success: function(diff) {
            changeVoteSum(id, diff, $(event.target));
        }
    });
});

$(".downvote").on('click', function(event){
    event.preventDefault();
    var id = $(event.target).attr('pageId');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: -1};

    $.ajax({
        type: "POST",
        url: "/pages/" + id,
        data: data,
        success: function(diff) {
            changeVoteSum(id, diff, $(event.target));
        }
    });
});

$(document).on('submit', '#new-page-form', function(event){
    event.preventDefault();
    $(event.target).ajaxSubmit({
        complete: function(data){
            response = data.responseJSON;
            console.log(response);
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

function changeVoteSum(pageId, diff, dom){
    var sumDom = $(".vote-sum[pageId='" + pageId + "']");
    var lastSum = parseInt(sumDom.html());
    console.log(lastSum);
    var newSum = lastSum + parseInt(diff);
    sumDom.html("" + newSum);

    if(diff == 2){
        dom.addClass("upvoted");
        $('.downvote[pageId="' + pageId + '"]').removeClass("downvoted");
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
        $('.upvote[pageId="' + pageId + '"]').removeClass("upvoted");
    }
}
</script>
@endif
@include('_votes')
@stop