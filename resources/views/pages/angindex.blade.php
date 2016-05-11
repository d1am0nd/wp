@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Websites</title>
<meta name="description" content="Wizard-Poker Websites - Community picked best Hearthstone websites">
<meta property="og:title" content="Wizard-Poker Websites - Community picked best Hearthstone websites" />
<meta name="twitter:title" content="Wizard-Poker Websites" />
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

@section('content')
<div class="container content-md" ng-app="pagesApp" ng-controller="SimpleController" data-ng-init="csrf='{{ csrf_token() }}'">
    <main ui-view></main>
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
<script>
pagesUrl = "{{ action('PagesController@getPagesJson') }}";
tagsUrl = "{{ action('TagsController@getTagsJson') }}";
orderByUrl = "{{ action('GeneralController@getOrderByJson') }}";
</script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.18/angular-ui-router.min.js"></script>
{!! Html::script('/customJs/angular/pages.js') !!}

<script>
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
@stop