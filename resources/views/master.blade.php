<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> 
<html lang="en"> <!--<![endif]-->
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="dbZm6GFuvEGRol9FGnF-6D5vofQHk5Z6mTSy4s_-23w" />
    {!! Request::input() ? '<meta name="robots" content="noindex,follow"/>' : '' !!}
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@WizardPokerCom" />
    <meta name="twitter:image" content="http://www.wizard-poker.com/hslogo.png" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="http://www.wizard-poker.com/hslogo.png" />
    @yield('meta')

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico">

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
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="/css/pages/page_log_reg_v1.css">
    <link rel="stylesheet" href="/plugins/brand-buttons/brand-buttons-inversed.css">
    <link rel="stylesheet" href="/plugins/brand-buttons/brand-buttons.css">
    <link rel="stylesheet" href="/plugins/animate.css">

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
    .modal-container-two{
        background-color: white;
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
        border-bottom: 2px inset #ff0000;
        height: 42px;
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
    .img-wrapper { 
       position: relative; 
       width: 100%; /* for IE 6 */
    }
    .img-tag {
        margin-right: 5px;
    }
    .img-tags {
       position: absolute;
       top: 5px;
       left: 5px;
    }
    .menu-rtl{
        right:inherit!important;
    }
    .new-item-h{
        font-size: 27px;
    }
    </style>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-74992400-1', 'auto');
      ga('send', 'pageview');
    </script>

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
                            <li><a href="" class="toggle-login"><i class="fa fa-twitter"></i> <i class="fa fa-facebook"></i> <i class="fa fa-google-plus"></i> Login</a></li>
                            <li><a href="" class="toggle-register">Register</a></li>
                            @else
                            @if(Auth::check() && Auth::user()->needs_new_username)
                            <li><a class="text-danger" href="{{ action('AccountsController@getUsernameEdit') }}">Change your username or confirm this one!</a></li>
                            @endif
                            @if(Request::url() == action('PagesController@index') || Request::url() == action('PagesController@getPages'))
                            <li><a href="" class="new-item"><strong>Add new page</strong></a></li>
                            @elseif(Request::url() == action('VideosController@index'))
                            <li><a href="" class="new-item"><strong>Add new video</strong></a></li>
                            @endif
                            <li><a href="{{action('Auth\AuthController@getLogout')}}">Logout {{Auth::user()->username}}</a></li>
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
                            <a href="/"><img id="logo-header" height="100px" src="/hslogo.png" alt="Logo"></a>
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
            <div class="collapse mega-menu navbar-collapse navbar-responsive-collapse">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li title="Home" @if(Request::url() == action('GeneralController@getHome'))class="active" @endif>
                            <a href="{{ action('GeneralController@getHome') }}" title="Home">
                                Home
                            </a>
                        </li>
                        <li title="Cards" @if(Request::url() == action('CardsController@index'))class="active" @endif>
                            <a href="{{ action('CardsController@index') }}" title="Hearthstone cards">
                               Cards
                            </a>
                        </li>
                        <li title="Pages" @if(Request::url() == action('PagesController@index'))class="active" @endif>
                            <a href="{{ action('PagesController@index') }}" title="Hearthstone Pages">
                               Pages
                            </a>
                        </li>
                        <li title="Videos" @if(Request::url() == action('VideosController@index'))class="active" @endif>
                            <a href="{{ action('VideosController@index') }}" title="Hearthstone Videos">
                               Videos
                            </a>
                        </li>
                        <!-- End Home -->
                    </ul>
                    @yield('filters')
                </div><!--/end container-->
            </div><!--/navbar-collapse-->
        </div>
        <!-- End Navbar -->
    </div>
    @if(Session::has('info'))
    <!--=== End Header v4 ===-->
    <div class="alert-container container content">
        <div class="alert alert-warning fade in">
            <button aria-hidden="true" class="close close-alert" type="button">×</button>
            <strong>Info!</strong> {!! Session::get('info') !!}
        </div>
    </div>
    @endif
    @yield('content')

     <!--=== Footer Version 1 ===-->

    <div class="footer-v8" id="footer-v8">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 column-one md-margin-bottom-50">
                        <p><a href="{{ action('GeneralController@getTos') }}">Terms of Service</a></p>
                        <p>Contact: info@wizard-poker.com</p>
                        <span>Social networks:</span>
                        <a href="https://twitter.com/WizardPokerCom"><i class="fa fa-twitter fa-2x"></i> @WizardPokerCom</a>
                        <br>
                        <a href="https://www.facebook.com/Wizard-Pokercom-939793112737015/" title="Follow Wizard-Poker.com on Facebook"><i class="fa fa-facebook fa-2x"></i> Wizard-Poker.com</a>
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Tags</h2>
                        <!-- Tag Links v4 -->
                        <ul class="tags-v4 margin-bottom-40">
                            @foreach($tags as $tag)
                            <li><a class="sqaare-4x filter-tag" href="{{ url_with_get(Request::url(),  array_merge(Request::input() ? Request::input() : [], ['tag' => $tag->name])) }}">{{ $tag->name }}</a></li>
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
                    <li><a href="{{ action('GeneralController@getTos') }}">Terms of Service</a></li>
                </ul>
            </div><!--/end container-->
        </footer>
    </div>
    <!--=== End Footer Version 1 ===-->
</div><!--/End Wrapepr-->

@if(!Auth::check())
<!-- Modal -->
<div id="myModalLogin" class="modal fade" role="dialog">
    <!--=== Content Part ===-->
    <div class="container content">
        <div class="row brand-page">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                {!! Form::open(['class'=>'reg-page', 'action' => 'Auth\\AuthController@postLogin', 'id' => 'login-form']) !!}
                    <div class="reg-header">
                        <h2>Login to your account</h2>
                    </div>

                    <div class="has-error">
                        <label class="control-label" style="display:none;" login-error="email"></label>
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" name="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="has-error">
                        <label class="control-label" style="display:none;" login-error="password"></label>
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <button class="btn-u" type="submit" id="login-submit">Login</button>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn pull-right toggle-login" type="button">Cancel</button>
                        </div>
                    </div>

                    <hr>

                    <h4>Or:</h4>
                    <a href="{{ action('AuthController@redirectToProvider', ['provider' => 'twitter']) }}" class="btn btn-block btn-lg btn-twitter-inversed">
                      <i class="fa fa-twitter"></i> Connect with Twitter
                    </a>
                    <a href="{{ action('AuthController@redirectToProvider', ['provider' => 'facebook']) }}" class="btn btn-block btn-lg btn-facebook-inversed">
                      <i class="fa fa-facebook"></i> Connect with Facebook
                    </a>                    
                    <a href="{{ action('AuthController@redirectToProvider', ['provider' => 'google']) }}" class="btn btn-block btn-lg btn-google-inversed">
                      <i class="fa fa-google"></i> Connect with Google
                    </a>
                        
                    <!--
                    <h4>Forget your Password ?</h4>
                    <p>no worries, <a class="color-green" href="#">click here</a> to reset your password.</p>
                    -->
                {!! Form::close() !!}
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
<!-- Modal -->
<div id="myModalRegister" class="modal fade" role="dialog">
    <!--=== Content Part ===-->
    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                {!! Form::open(['class'=>'reg-page', 'action' => 'Auth\\AuthController@postRegister', 'id' => 'register-form']) !!}
                    <div class="reg-header">
                        <h2>Register a new account</h2>
                        <!--<p>Already Signed Up? Click <a href="page_login.html" class="color-green">Sign In</a> to login your account.</p>-->
                    </div>

                    <label>Username</label>
                    <div class="has-error">
                        <label class="control-label" style="display:none;" register-error="username"></label>
                    </div>
                    <input type="text" name="username" class="form-control margin-bottom-20">

                    <label>Email</label>
                    <div class="has-error">
                        <label class="control-label" style="display:none;" register-error="email"></label>
                    </div>
                    <input type="text" name="email" class="form-control margin-bottom-20">

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Password <span class="color-red">*</span></label>
                            <div class="has-error">
                                <label class="control-label" style="display:none;" register-error="password"></label>
                            </div>
                            <input type="password" name="password" class="form-control margin-bottom-20">
                        </div>
                        <div class="col-sm-6">
                            <label>Confirm Password <span class="color-red">*</span></label>
                            <div class="has-error">
                                <label class="control-label" style="display:none;" register-error="password"></label>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control margin-bottom-20">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-xs-6">
                            <button class="btn-u" type="button">Register</button>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button class="btn toggle-register" type="submit">Cancel</button>
                        </div>
                    </div>
                {!! Form::close() !!} 
            </div>
        </div>
    </div><!--/container-->
</div>
@endif
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
</script>
<!--[if lt IE 9]>
    <script src="/plugins/respond.js"></script>
    <script src="/plugins/html5shiv.js"></script>
    <script src="/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
@if(!Auth::check())
<script>
$(".toggle-login").on('click', function(event){
    event.preventDefault();
    $("#myModalLogin").modal("toggle");
});
$(".toggle-register").on('click', function(event){
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
            console.log(data);
            jQuery.each(response, function(i, val){
                var dom = $("[login-error='" + i + "']");
                dom.html(val[0]);
                dom.show();
                setTimeout(function(){
                    dom.hide();
                }, 5000);
            });
        },
        success: function(xhr, status, error){
            location.reload();
        }
    });
});
@if(Session::has('info'))
$('.close-alert').on('click', function(event){
    $(event.target).closest('.alert-container').hide(200);
});
@endif
</script>
@endif
@yield('foot')
<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<script type="text/javascript">
    window.cookieconsent_options = {"message":"This website uses Google cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":"{{ action('GeneralController@getTos') }}#privacy","theme":"dark-floating"};
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->
</body>
</html>