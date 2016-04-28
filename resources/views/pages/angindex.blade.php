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

@section('content')
<div class="container content-md" ng-app="pagesApp" ng-controller="SimpleController" data-ng-init="csrf='{{csrf_token()}}'">
    <h1 class="margin-bottom-10">Hearthstone Card Collection</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h3>Search by name:</h3>
                    <form method="GET" ng-submit="getByTitle(search.name);">
                        <input type="text" data-ng-model="search.title"/> @{{ search.name }}</input>
                        <br>
                        <small ng-show="queryParams.title"><i class="icon-close" ng-click="clearTitleSearch()"></i> Searched for: @{{ queryParams.title }}</small>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Tags</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn-u btn-u-green" style="width:100%;" ng-class="queryParams.tag == null ? 'btn-u-sea' : ''" ng-click="queryParams.tag = undefined;">ALL</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="tag in tags">
                    <div class="margin-bottom-15">
                        <button class="btn-u" style="width:100%;" ng-class="queryParams.tag == tag.name ? 'btn-u-sea' : ''" ng-click="queryParams.tag = tag.name">@{{ tag.name }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Order by</h3>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="(ob, array) in orderBy">
                    <div class="margin-bottom-15">
                        <button class="btn-u" style="width:100%;" ng-class="queryParams.orderBy == ob ? 'btn-u-sea' : ''" ng-click="queryParams.orderBy = ob">@{{ array.pretty }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-4 col-xs-6" data-ng-repeat="page in pages | filter:search">
                    <a ng-href="@{{ page.url }}" href="@{{ page.url }}" target="_blank">
                        <div class="img-wrapper">
                            <div class="img-tags" data-ng-repeat="tag in page.tags">
                                <span class="img-tag label label-u label-default">@{{ tag.name }}</span>
                            </div>
                            <img class="img-responsive" src="@{{ page.thumbnail_path }}" alt="">
                        </div>
                    </a>
                    <br>
                    <p style="overflow:hidden;"><a href="@{{ page.url }}" target="_blank">@{{ page.title }}</a></p>
                    <p style="overflow:hidden;"  style="margin-bottom:5px!important">@{{ page.description }}</p>
                    <ul class="list-inline news-v1-info">
                        <li><i class="fa fa-chevron-down downvote votes-icon" ng-class="page.my_vote == -1 ? 'downvoted' : ''" ng-click="vote(page.slug, -1);"></i></li>
                        <li>
                            <div class="vote-sum">
                            @{{ page.vote_sum }}
                            </div>
                        </li>
                        <li><i class="fa fa-chevron-up upvote votes-icon" ng-class="page.my_vote == 1 ? 'upvoted' : ''" ng-click="vote(page.slug, 1);"></i></li>
                        <br>
                        <li><i class="fa fa-clock-o"></i> @{{ page.created_at }}</li>
                        <li class="pull-right"><a href="/pages/@{{ page.slug }}"><i class="fa fa-comments-o"></i> @{{ page.comment_count }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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