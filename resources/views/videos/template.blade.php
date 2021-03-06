
<h1 class="margin-bottom-10">Community picked best Hearthstone Youtube channels and videos</h1>
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
                    <a class="btn-u btn-u-green" style="width:100%;" ng-class="queryParams.tag == null ? 'btn-u-sea' : ''" ui-sref="filter({page : undefined, orderBy : queryParams.orderBy, tag : undefined})">ALL</a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-4" data-ng-repeat="tag in tags">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100%;" ng-class="queryParams.tag == tag.name ? 'btn-u-sea' : ''" ui-sref="filter({page : undefined, orderBy : queryParams.orderBy, tag : tag.name})">@{{ tag.name }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Order by</h3>
            </div>
            <div class="col-sm-4 col-xs-4" data-ng-repeat="(ob, array) in orderBy">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100%;" ng-class="queryParams.orderBy == ob ? 'btn-u-sea' : ''" ui-sref="filter({page : undefined, orderBy : ob, tag : queryParams.tag})">@{{ array.pretty }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div data-ng-repeat="video in videos.data | filter:search">
            <div ng-if="$index % 3 == 0" class="clearfix visible-lg visible-md visible-sm"></div>
            <div ng-if="$index % 2 == 0" class="clearfix visible-xs"></div>
            <div class="col-sm-4 col-xs-6">
                <a ng-href="@{{ video.url }}" href="@{{ video.url }}" target="_blank" title="@{{ video.title }}">
                    <div class="img-wrapper">
                        <div class="img-tags" data-ng-repeat="tag in video.tags">
                            <span class="img-tag label label-u label-default">@{{ tag.name }}</span>
                        </div>
                        <img class="img-responsive" ng-src="@{{ video.thumbnail_path }}" alt="">
                    </div>
                </a>
                <br>
                <p style="overflow:hidden;"><a href="@{{ video.url }}" target="_blank">@{{ video.title }}</a></p>
                <p style="overflow:hidden;"  style="margin-bottom:5px!important">@{{ video.description }}</p>
                <ul class="list-inline news-v1-info">
                    <li><i class="fa fa-chevron-down downvote votes-icon" ng-class="video.my_vote == -1 ? 'downvoted' : ''" ng-click="vote(video.slug, -1);"></i></li>
                    <li>
                        <div class="vote-sum">
                        @{{ video.vote_sum }}
                        </div>
                    </li>
                    <li><i class="fa fa-chevron-up upvote votes-icon" ng-class="video.my_vote == 1 ? 'upvoted' : ''" ng-click="vote(video.slug, 1);"></i></li>
                    <br>
                    <li><i class="fa fa-clock-o"></i> @{{ video.created_at }}</li>
                    <li class="pull-right"><a href="/videos/@{{ video.slug }}"><i class="fa fa-comments-o"></i> @{{ video.comment_count }}</a></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row" ng-if="videos.last_page > 1">
            <div class="col-md-12">
                <div class="pagination-div">
                 
                 <ul class="pagination">
                  
                  <li>
                  
                  <a ui-sref="filter({page : (videos.current_page > 1) ? (videos.current_page - 1) : 1, orderBy : queryParams.orderBy, tag : queryParams.tag})"> Prev</a>
                  
                  </li>
                  
                  <li data-ng-repeat="page in getPaginationPages()" ng-class="videos.current_page == page ? 'active' : ''">
                  
                  <a ui-sref="filter({page : page, orderBy : queryParams.orderBy, tag : queryParams.tag})">@{{ page }}</a>
                  
                  </li>
                  
                  <li>
                  
                  <a ui-sref="filter({page : (videos.current_page < videos.last_page) ? (videos.current_page + 1) : videos.last_page, orderBy : queryParams.orderBy, tag : queryParams.tag})">Next </a>
                  
                  </li>
                 
                 </ul>

                </div>
            </div>
        </div>
    </div>
</div>