@extends('master')

@section('meta')
<title>Wizard-Poker</title>
<meta property="og:title" content="Wizard-Poker Hearthstone Related Content" />
<meta name="twitter:title" content="Wizard-Poker Hearthstone Related Content" />
<meta name="twitter:description" content="Wizard-Poker features links to best Hearthstone related content" />
@stop

@section('head')
    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/plugins/animate.css">
    <link rel="stylesheet" href="/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/revolution-slider/rs-plugin/css/settings.css" type="text/css" media="screen">
    <!--[if lt IE 9]><link rel="stylesheet" href="/plugins/revolution-slider/rs-plugin/css/settings-ie8.css" type="text/css" media="screen"><![endif]-->
@stop

@section('content')
 <div class="tp-banner-container">
    <div class="tp-banner">
        <ul>
            <!-- SLIDE -->
            <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 1">
                <!-- MAIN IMAGE -->
                <img src="/backgrounds/demon-hunter-bg.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">

                <!-- LAYER -->
                <div class="tp-caption re-title-v1 sft start"
                    data-x="center"
                    data-hoffset="0"
                    data-y="0"
                    data-speed="1500"
                    data-start="500"
                    data-easing="Back.easeInOut"
                    data-endeasing="Power1.easeIn"
                    data-endspeed="300">
                    Wizard-Poker
                </div>
                <!-- END LAYER -->

                <!-- LAYER -->
                <div class="tp-caption re-text-v1 sft"
                    data-x="center"
                    data-hoffset="0"
                    data-y="100"
                    data-speed="1400"
                    data-start="2000"
                    data-easing="Power4.easeOut"
                    data-endspeed="300"
                    data-endeasing="Power1.easeIn"
                    data-captionhidden="off"
                    style="z-index: 6">
                    Share awesome Hearthstone related content!<br>
                    Wizard-Poker features links to community picked best Hearthstone related content.
                </div>
                <!-- END LAYER -->

                <!-- LAYER -->
                <div class="tp-caption sft"
                    data-x="center"
                    data-hoffset="0"
                    data-y="220"
                    data-speed="1600"
                    data-start="2800"
                    data-easing="Power4.easeOut"
                    data-endspeed="300"
                    data-endeasing="Power1.easeIn"
                    data-captionhidden="off"
                    style="z-index: 6">
                    <a href="{{ action('PagesController@index') }}" class="btn-u btn-u-lg re-btn-brd margin-right-5">Hearthstone Pages</a>
                    <a href="{{ action('VideosController@index') }}" class="btn-u btn-u-lg re-btn-brd margin-right-5">Hearthstone Videos</a>
                </div>
                <!-- END LAYER -->
            </li>
            <!-- END SLIDE -->
        </ul>
        <div class="tp-bannertimer tp-bottom"></div>
    </div>
</div>
<!--=== End Slider ===-->
@stop

@section('foot')
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="/plugins/counter/jquery.counterup.min.js"></script>
<script type="text/javascript" src="/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="/js/plugins/revolution-slider.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initCounter();
        App.initParallaxBg();
        RevolutionSlider.initRSfullScreenOffset();
    });
</script>
@stop