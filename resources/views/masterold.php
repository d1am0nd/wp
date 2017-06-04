<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> 
<html lang="en"> <!--<![endif]-->
<head>
    <title>Thumbnails | Unify - Responsive Website Template</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="/css/headers/header-default.css">
    <link rel="stylesheet" href="/css/footers/footer-v8.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/plugins/animate.css">
    <link rel="stylesheet" href="/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/fancybox/source/jquery.fancybox.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="/css/pages/page_log_reg_v1.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/css/custom.css">
    <style>
    .tags-margin-bot{
        margin-bottom:5px;
    }
    .i.votes-icon{
        text-align:center; display:inline-block; width:100%
    }
    .upvote{
        font-color:green;
    }
    </style>

    @yield('head')
</head>

<body>
<!--=== End Content Part ===-->
<div class="wrapper">
    <!--=== Header ===-->
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <img src="/hslogo.png" alt="Logo">
            </a>
            <!-- End Logo -->

            <!-- Topbar -->
            <div class="topbar">
                <ul class="loginbar pull-right">
                    <li><a href="page_faq.html">Privacy policy</a></li>
                    <li class="topbar-devider"></li>
                    @if(!Auth::check())
                    <li><a href="" id="login-click">Login</a></li>
                    <li class="topbar-devider"></li>
                    <li><a href="" id="register-click">Register</a></li>
                    @else
                    <li><a href="{{action('Auth\AuthController@getLogout')}}">Logout {{Auth::user()->username}}</a></li>
                    @endif
                </ul>
            </div>
            <!-- End Topbar -->

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                    <!-- Home -->
                    <li>
                        <a href="{{action('PagesController@index')}}">
                            Pages
                        </a>
                    </li>
                    <!-- End Home -->

                    <li>
                        <a href="{{action('VideosController@index')}}">
                            Videos
                        </a>
                    </li>

                    <!-- Misc Pages -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            Misc
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="page_misc_blank.html">Blank page</a></li>
                            <li><a href="page_misc_boxed.html">Boxed Page</a></li>
                            <li><a href="page_misc_boxed_img.html">Boxed Image Page</a></li>
                            <li><a href="page_misc_boxed_fixed_header.html">Boxed Fixed Menu</a></li>
                            <li><a href="page_misc_dark.html">Dark Page</a></li>
                            <li><a href="page_misc_dark_boxed.html">Dark Boxed Page</a></li>
                            <li><a href="page_misc_dark_other_color.html">Dark Page with Theme Color</a></li>
                            <li><a href="page_misc_sticky_footer.html">Sticky Footer Example</a></li>
                        </ul>
                    </li>
                    <!-- End Misc Pages -->

                    <!-- Search Block -->
                    <li>
                        <i class="search fa fa-search search-btn"></i>
                        <div class="search-open">
                            <div class="input-group animated fadeInDown">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn-u" type="button">Go</button>
                                </span>
                            </div>
                        </div>
                    </li>
                    <!-- End Search Block -->
                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->


    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Thumbnails</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="">Features</a></li>
                <li class="active">Thumbnails</li>
            </ul>
        </div>
    </div><!--/breadcrumbs-->



    @yield('content')

     <!--=== Footer Version 1 ===-->

    <div class="footer-v8" id="footer-v8">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 column-one md-margin-bottom-50">
                        <a href="index.html"><img class="footer-logo" src="assets/img/logo1-white.png" alt=""></a>
                        <p class="margin-bottom-20">Unify is an ultra fully responsive template with modern and smart design.</p>
                        <span>Headquarters:</span>
                        <p>795 Folsom Ave, Suite 600, San Francisco, CA 94107</p>
                        <hr>
                        <span>Phone:</span>
                        <p>(+123) 456 7890</p>
                        <p>(+123) 456 7891</p>
                        <hr>
                        <span>Email Address:</span>
                        <a href="#">support@htmlstream.com</a>
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Tags</h2>
                        <!-- Tag Links v4 -->
                        <ul class="tags-v4 margin-bottom-40">
                            @foreach($tags as $tag)
                            <li><a class="sqaare-4x" href="{{ action('TagsController@show', $tag->name) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                        <!-- End Tag Links v4 -->
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Latest Pages</h2>
                        <!-- Latest Newws -->
                        @foreach($latestPages as $page)
                        <div class="latest-news margin-bottom-20">
                            <img src="{{ $page->thumbnail_path }}" alt="">
                            <h3><a href="#">{{ $page->title }}</a></h3>
                            <p>{{ $page->description }}</p>
                        </div>
                        <hr>
                        @endforeach
                        <!-- End Latest News -->
                    </div>

                    <div class="col-md-3 col-sm-6 md-margin-bottom-50">
                        <h2>Latest Videos</h2>
                        <!-- Latest Newws -->
                        @foreach($latestVideos as $video)
                        <div class="latest-news margin-bottom-20">
                            <img src="{{ $video->thumbnail_path }}" alt="">
                            <h3><a href="#">{{ $video->title }}</a></h3>
                            <p>{{ $video->description }}</p>
                        </div>
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
                    <li>2015 &copy; All Rights Reserved.</li>
                    <li class="home"><a href="#">Terms of Use</a></li>
                    <li><a href="#">Privacy and Policy</a></li>
                </ul>
            </div><!--/end container-->
        </footer>
    </div>
    <!--=== End Footer Version 1 ===-->
</div><!--/End Wrapepr-->

@if(!Auth::check())
<!-- Modal -->
<div id="myModalLogin" class="modal fade" role="dialog">
    <div style="margin-left:auto; margin-right:auto; width:380px; padding:10px;">
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
    <div style="margin-left:auto; margin-right:auto; width:380px; padding:10px;">
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
            <label class="control-label" style="display:none;" register-error="username"></label>
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="username" placeholder="Username" class="form-control">
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
</body>
</html>