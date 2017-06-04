@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Videos</title>
<meta name="description" content="Wizard-Poker Videos - Community picked best Hearthstone videos">
<meta property="og:title" content="Wizard-Poker Videos - Community picked best Hearthstone videos" />
<meta name="twitter:title" content="Wizard-Poker Videos" />
<meta name="twitter:description" content="Community picked best Hearthstone videos" />
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

@section('content')
<div class="container content-md" ng-app="videosApp" ng-controller="SimpleController" data-ng-init="csrf='{{ csrf_token() }}'">
    <main ui-view></main>
</div>
<div id="myModalNewItem" class="modal fade" role="dialog">
    <div class="container modal-container-new-item">
        {!! Form::open(['action' => 'VideosController@store', 'class' => 'sky-form', 'id' => 'new-video-form', "style" => "margin-bottom:20px"]) !!}
        <fieldset style="border-style:none">
            <div class="container">
                <span class="new-item-h">Add a new Hearthstone related video</span>
            </div>
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
    </div>
</div>
@stop

@section('foot')
<script>
videosUrl = "{{ action('VideosController@getVideosJson') }}";
tagsUrl = "{{ action('TagsController@getTagsJson') }}";
orderByUrl = "{{ action('GeneralController@getOrderByJson') }}";
</script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.18/angular-ui-router.min.js"></script>
{!! Html::script('/customJs/angular/videos.js') !!}

<script>
$(".new-item").on('click', function(event){
    event.preventDefault();
    $("#myModalNewItem").modal("toggle");
});
$(document).on('submit', '#new-video-form', function(event){
    event.preventDefault();
    $(event.target).ajaxSubmit({
        complete: function(data){
            response = data.responseJSON;
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
</script>
@stop