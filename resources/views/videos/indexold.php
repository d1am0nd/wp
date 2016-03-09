@extends('master')

@section('head')
<link rel="stylesheet" href="/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<!-- CSS Customization -->
<style>
.sky-form{
    padding-bottom: 20px;
}
</style>
@stop


@section('content')
<!--=== Content Part ===-->
<div class="container content">
    <div class="row">
        <!-- Begin Content -->
        <div class="col-md-12">
            @if(Auth::check())
            {!! Form::open(['action' => 'VideosController@store', 'class' => 'sky-form', 'id' => 'new-video-form', "style" => "margin-bottom:20px"]) !!}
            <fieldset>
                <section>
                    <div class="form-group">
                        <label class="col-md-1 control-label">Title</label>
                        <div class="col-md-11">
                            <input type="text" name="title" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-offset-1 col-md-11">
                            <label class="control-label small" video-error="title" style="display:none;"></label>
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
                            <label class="control-label small" video-error="description" style="display:none;"></label>
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
                            <label class="control-label small" video-error="url" style="display:none;"></label>
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
                            <label class="control-label small" video-error="tag_id" style="display:none;"></label>
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
            @endif
            <!-- Thumbnails v1 -->
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-3">
                        <div class="tag-box tag-box-v2 margin-bottom-40">
                            <div class="row">
                                <div class="col-sm-2 pull-right">
                                    <i class="fa fa-chevron-up votes-icon upvote" videoId="{{ $video->id }}" style="text-align:center; display:inline-block; width:100%"></i>
                                    <div class="row vote-sum" videoId="{{ $video->id }}" style="text-align:center;">
                                        {{ $video->votes }}
                                    </div>
                                    <i class="fa fa-chevron-down votes-icon downvote" videoId="{{ $video->id }}" style="text-align:center; display:inline-block; width:100%"></i>
                                </div>
                                <div class="col-sm-10">
                                        <a href="{{ $video->url }}">
                                            <h2 style="overflow:hidden;">{{ $video->title }}</h2>
                                            <p style="overflow:hidden;">{{ $video->description }}</p>
                                            <p style="overflow:hidden;"><small>Video published on: {{ $video->published_at }}</small></p>
                                        </a>
                                        @foreach($video->tags as $tag)
                                        <a href="{{ action('TagsController@show', $tag->name) }}">
                                            <button class="btn-u btn-u-xs btn-u-blue tags-margin-bot" type="button">{{ $tag->name }}</button>
                                        </a>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <!-- End Thumbnails v4 -->
        </div>
        <!-- End Content -->
    </div>
</div><!--/container-->
<!--=== End Content Part ===-->
@stop

@section('foot')
<script>
@if(Auth::check())

$(".upvote").on('click', function(event){
    event.preventDefault();
    var id = $(event.target).attr('videoId');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: 1};

    $.ajax({
        type: "POST",
        url: "/videos/" + id,
        data: data,
        success: function(diff) {
            changeVoteSum(id, diff);
        }
    });
});

$(".downvote").on('click', function(event){
    event.preventDefault();
    var id = $(event.target).attr('videoId');
    var token = $("input[name='_token']").val();
    var data = {_token: token, vote: -1};

    $.ajax({
        type: "POST",
        url: "/videos/" + id,
        data: data,
        success: function(diff) {
            changeVoteSum(id, diff);
        }
    });
});

$(document).on('submit', '#new-video-form', function(event){
    event.preventDefault();
    $(event.target).ajaxSubmit({
        complete: function(data){
            response = data.responseJSON;
            console.log(response);
            jQuery.each(response, function(i, val){
                var dom = $("[video-error='" + i + "']");
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

function changeVoteSum(videoId, diff){
    var dom = $(".vote-sum[videoId='" + videoId + "']");
    var lastSum = parseInt(dom.html());
    console.log(lastSum);
    var newSum = lastSum + parseInt(diff);
    dom.html("" + newSum);
}
@endif
</script>
@include('_votes')
@stop