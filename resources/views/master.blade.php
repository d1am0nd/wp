<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> 
<html lang="en"> <!--<![endif]-->
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Community-generated repository for useful and/or funny hearthstone content">
    <meta name="google-site-verification" content="dbZm6GFuvEGRol9FGnF-6D5vofQHk5Z6mTSy4s_-23w" />
    @if(isset($filter))
    <meta name="robots" content="noindex,follow"/>
    @endif
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@WizardPokerCom" />
    <meta name="twitter:image" content="/hslogo.png" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="/hslogo.png" />
    @yield('meta')

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="/css/headers/header-v4.css">
    <link rel="stylesheet" href="/css/footers/footer-v8.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/plugins/animate.css">
    <link rel="stylesheet" href="/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/css/custom.css">
    <style>
    .tags-margin-bot{
        margin-bottom:5px;
    }
    .i.votes-icon{
        text-align:center; display:inline-block; width:100%
    }
    .upvoted{
        color:green;
    }
    .downvoted{
        color:red;
    }
    .modal-container{
        background-color: white;
        margin-top: 20px;
        margin-left:auto; 
        margin-right:auto; 
        max-width:380px; 
        padding:15px;
        border-radius: 3px;
    }
    .modal-container-new-item{
        background-color: white;
        margin-top: 20px;
        margin-left:auto; 
        margin-right:auto;
        padding:15px;
        border-radius: 3px;
    }
    .sky-form{
        border-style: none!important;
    }
    .selected-tag{
        border-bottom: 2px outset #ff0000;
        border-top: none;
    }
    .no-link-style:hover{
        text-decoration: none;
    }
    ul.top-v1-data h1{
        margin:0;
        padding:0;
        font-size: 12px
    }
    </style>

    @yield('head')
</head>

<body>
<div class="wrapper">
    <!--=== Header v4 ===-->
    <div class="header-v4">
        <!-- Topbar -->
        <div class="topbar-v1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-inline top-v1-data">
                            @if(!Auth::check())
                            <li><a href="" id="login-click">Login</a></li>
                            <li><a href="" id="register-click">Register</a></li>
                            @else
                            <li><a href="page_faq.html" class="new-item"><strong>Add new</strong></a></li>
                            <li><a href="{{action('Auth\AuthController@getLogout')}}">Logout {{Auth::user()->email}}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="/"><img id="logo-header" height="100px" src="hslogo.png" alt="Logo"></a>
                        </div>
                        <div class="col-md-7">
                            <!--<a href="#"><img class="header-banner img-responsive" src="hslogo.png" alt=""></a>-->
                        </div>
                    </div>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="full-width-menu">Menu Bar</span>
                        <span class="icon-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="clearfix"></div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li>
                            <a href="{{ action('PagesController@index') }}" title="Pages">
                                <i class="fa fa-hand-o-up fa-2x"></i>
                            </a>
                        </li>
                        <!-- End Home -->
                    </ul>
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li>
                            <a href="{{ action('VideosController@index') }}" title="Videos">
                                <i class="fa fa-youtube-play fa-2x"></i>
                            </a>
                        </li>
                        <!-- End Home -->
                    </ul>

                    <!-- Search Block -->
                    <ul class="nav navbar-nav navbar-border-bottom navbar-right">
                        @foreach($tags as $tag)
                        @if(isset($filter) && in_array($tag->name, $filter))
                        <li class="no-border selected-tag">
                        @else
                        <li class="no-border">
                        @endif
                            <a class="sqaare-4x filter-tag" href="javascript:;">{{ $tag->name }}</a>
                        </li>
                        @endforeach
                        {{ Form::close() }}
                        <li class="no-border">
                            <i class="search tags-filter-cancel fa fa-times"></i>
                        </li>
                    </ul>
                    <!-- End Search Block -->
                </div><!--/end container-->
            </div><!--/navbar-collapse-->
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v4 ===-->

    @yield('content')

     <!--=== Footer Version 1 ===-->

    <div class="footer-v8" id="footer-v8">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 column-one md-margin-bottom-50">
                        <span>Site under construction</span>
                        <p>Uses cookies for login and google analytics. <small>Beware</small></p>
                        <a href="https://twitter.com/WizardPokerCom"><i class="fa fa-twitter fa-2x"></i> @WizardPokerCom</a>
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Tags</h2>
                        <!-- Tag Links v4 -->
                        <ul class="tags-v4 margin-bottom-40">
                            @foreach($tags as $tag)
                            <li><a class="sqaare-4x filter-tag" href="javascript:;">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                        <!-- End Tag Links v4 -->
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Latest Pages</h2>
                        <!-- Latest Newws -->
                        @foreach($latestPages as $page)
                        <a href="{{$page->url}}" class="no-link-style">
                            <div class="latest-news margin-bottom-20">
                                <img src="{{ $page->thumbnail_path }}" alt="">
                                <h3>{{ $page->title }}</h3>
                                <p>{{ $page->description }}</p>
                            </div>
                        </a>
                        <hr>
                        @endforeach
                        <!-- End Latest News -->
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Latest Videos</h2>
                        <!-- Latest Newws -->
                        @foreach($latestVideos as $video)
                        <a href="{{$video->url}}" class="no-link-style">
                            <div class="latest-news margin-bottom-20">
                                <img src="{{ $video->thumbnail_path }}" alt="">
                                <h3>{{ $video->title }}</h3>
                                <p>{{ $video->description }}</p>
                            </div>
                        </a>
                        <hr>
                        @endforeach
                        <!-- End Latest News -->
                    </div>
                </div><!--/end row-->
            </div><!--/end container-->
        </footer>

        <footer class="copyright">
            <div class="container">
                <ul class="list-inline terms-menu">
                    <li>2016 &copy; All Rights Reserved.</li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div><!--/end container-->
        </footer>
    </div>
    <!--=== End Footer Version 1 ===-->
</div><!--/End Wrapepr-->

@if(!Auth::check())
<!-- Modal -->
<div id="myModalLogin" class="modal fade" role="dialog">
    <div class="modal-container">
        {!! Form::open(['class'=>'reg-page', 'action' => 'Auth\\AuthController@postLogin', 'id' => 'login-form']) !!}
            <div class="reg-header">
                <h2>Login to your account</h2>
            </div>

            <div class="has-error">
                <label class="control-label" style="display:none;" login-error="email"></label>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="email" placeholder="Email" class="form-control">
            </div>

            <div class="has-error">
                <label class="control-label" style="display:none;" login-error="password"></label>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn-u pull-right" type="submit" id="login-submit">Login</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- Modal -->
<div id="myModalRegister" class="modal fade" role="dialog">
    <div class="modal-container">
    {!! Form::open(['class'=>'reg-page', 'action' => 'Auth\\AuthController@postRegister', 'id' => 'register-form']) !!}
        <div class="reg-header">
            <h2>Register a new account</h2>
        </div>

        <div class="has-error">
            <label class="control-label" style="display:none;" register-error="email"></label>
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="email" placeholder="Email" class="form-control">
        </div>

        <div class="has-error">
            <label class="control-label" style="display:none;" register-error="password"></label>
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password" class="form-control">
        </div>

        <div class="has-error">
            <label class="control-label" style="display:none;" register-error="password_confirmation"></label>
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" name="password_confirmation" placeholder="Password confirmation" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-12">
                <button class="btn-u pull-right" type="submit" id="register-submit">Register</button>
            </div>
        </div>
    {!! Form::close() !!}    
    </div>
</div>
@endif
{{ Form::open(['method' => 'get', 'id' => 'filter-form', 'style' => 'display:none']) }}
@foreach($tags as $tag)
@if(isset($filter) && in_array($tag->name, $filter))
<input type="checkbox" name="filter[]" checked=true value="{{ $tag->name }}">
@else
<input type="checkbox" name="filter[]" value="{{ $tag->name }}">
@endif
@endforeach
{{ Form::close() }}
<!-- JS Global Compulsory -->
<script type="text/javascript" src="/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="/plugins/back-to-top.js"></script>
<script type="text/javascript" src="/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript" src="/js/plugins/fancy-box.js"></script>

{!! Html::script('/js/jquery.form.min.js') !!}
<script type="text/javascript">
jQuery(document).ready(function() {
    App.init();
    FancyBox.initFancybox();
});

$(".team-img").on('click', function(event){
    event.preventDefault();
    var url = $(event.target).closest('.team-img').attr('url');
    window.open(url,'_blank');
});
$('.tags-filter-cancel').on('click', function(event){
    event.preventDefault();
    var filterForm = $("#filter-form");
    $('#filter-form input[type="checkbox"]').removeAttr('checked');
    filterForm.submit();
});
$(".filter-tag").on('click', function(event){
    event.preventDefault();
    var dom = $(event.target);
    var tagName = dom.html();
    var checkbox = $("input[value='" + tagName + "']")
    checkbox.prop('checked', !checkbox.prop('checked'));
    $("#filter-form").submit();
});
</script>
<!--[if lt IE 9]>
    <script src="/plugins/respond.js"></script>
    <script src="/plugins/html5shiv.js"></script>
    <script src="/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
@if(!Auth::check())
<script>
$("#login-click").on('click', function(event){
    event.preventDefault();
    $("#myModalLogin").modal("toggle");
});
$("#register-click").on('click', function(event){
    event.preventDefault();
    $("#myModalRegister").modal("toggle");
});

$(document).on('submit', '#register-form', function(event){
    event.preventDefault();
    $("#register-form").ajaxSubmit({
        complete: function(data){
            response = data.responseJSON;
            jQuery.each(response, function(i, val){
                var dom = $("[register-error='" + i + "']");
                dom.html(val[0]);
                dom.show();
                setTimeout(function(){
                    dom.hide();
                }, 5000);
            });
        },
        error: function(xhr, status, error){
            if(xhr.status != 422)
                location.reload();
        }
    });
});
$(document).on('submit', '#login-form', function(event){
    event.preventDefault();
    $("#login-form").ajaxSubmit({
        complete: function(data){
            response = data.responseJSON;
            console.log(response);
            jQuery.each(response, function(i, val){
                var dom = $("[login-error='" + i + "']");
                dom.html(val[0]);
                dom.show();
                setTimeout(function(){
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
@yield('foot')
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74992400-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>