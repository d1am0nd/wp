@extends('master')

@section('meta')
<title>Wizard-Poker</title>
<meta property="og:title" content="Wizard-Poker" />
<meta property="og:url" content="{{ action('GeneralController@getHome') }}" />
<meta name="twitter:title" content="Community posted hearthstone content" />
<meta name="twitter:description" content="Links to hearthstone content all over the internet" />
@stop

@section('content')


    <!--=== Container Part ===-->
    <div class="container content-sm">
        <div class="headline-center margin-bottom-60">
            <h1>Wizard-Poker</h1>
            <h2><a href="{{ action('PagesController@index') }}"><strong><span class="icon-link"></span> Pages</strong></a> | <a href="{{ action('VideosController@index') }}"><strong><span class="icon-social-youtube"></span> Videos</strong></a></h2>
            <br>
            <h3>About</h3>
            <br>
            <span>
                <p style="font-size:115%">
                    Community posted links to fun and/or useful Hearthstone related content
                </p>
                <p style="font-size:115%">
                    The name comes from the viral <a href="https://www.reddit.com/r/hearthstone/comments/36qt9z/when_my_teacher_caught_me_playing_hearthstone_in/">reddit post</a> on <a href="https://www.reddit.com/r/hearthstone/">r/hearthstone</a>
                </p>
                <p style="font-size:115%">
                    It is not connected in any way to similarly named Youtube channel <a href="https://www.youtube.com/channel/UCxu7RS3xnsK7NNLZkgurH9A">WizardPoker</a>. 
                </p>
                <p style="font-size:115%">
                    The site was born as a result of a few things: <strong>a)</strong> I love Hearthstone <strong>b)</strong> I had the domain lying arouond since I snatched it right after the <a href="https://www.reddit.com/r/hearthstone/comments/36qt9z/when_my_teacher_caught_me_playing_hearthstone_in/">reddit post</a> <strong>c)</strong> I develop websites
                </p>
            </span>
            
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-5 col-xs-4 md-margin-bottom-50">
                <img class="img-responsive" title="Knowledge is power and I know a lot!" src="/cards/dalaran-aspirant.png" alt="">
            </div>
            <div class="col-md-8 col-sm-7 col-xs-8">
                <p>The website has 2 categories:</p><br>
                <div class="row">
                    <ul class="col-xs-12 list-unstyled lists-v1">
                        <li><i class="fa fa-angle-right"></i>
                            <a href="{{ action('PagesController@index') }}"><strong><span class="icon-link"></span> Pages</strong></a> - links to Hearthstone related websites
                        </li>
                        <li><i class="fa fa-angle-right"></i>
                            <a href="{{ action('VideosController@index') }}"><strong><span class="icon-social-youtube"></span> Videos</strong></a> - links to Hearthstone related Youtube videos and channels
                        </li>
                    </ul>
                </div>
                <br>
                <p>It also has incredibly strong representation on social media:</p>
                <div class="row">
                    <ul class="col-xs-12 list-unstyled lists-v1">
                        <li><i class="fa fa-twitter"></i>
                            <a href="https://twitter.com/WizardPokerCom">@<u>WizardPokerCom</u></a>
                        </li>
                    </ul>
                </div>
                <p>
                    <strong>Cool stuff:</strong> The Twitter account currently posts a link to Tempostorm's new meta snapshot within 30min of the post <span style="font-size:30%" title="It's f**king hard to test, since it comes out once a month!!">I think</span>
                </p>
                <br>
                <p>Contact me on:</p>
                <div class="row">
                    <ul class="col-xs-12 list-unstyled lists-v1">
                        <li><i class="fa fa-angle-right"></i>
                            wizardpokercom@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
        </div><!--/end row-->
        <br>
        <div class="row">
            <div class="col-md-8 col-sm-7 col-xs-8">
                <div class="margin-bottom-60">
                    <h3 id="privacy">Privacy policy</h2>
                    <p>
                        <a href="/">wizard-poker.com</a> uses cookies for login and Google Analytics. More on GA cookied <a href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage">here</a>
                    </p>
                </div>
                <div class="margin-bottom-60">
                    <h3 id="tos">Terms of Service</h2>
                    <p>
                        You should only post Hearthstone related content. The title has to be relevant to the content. 
                    </p>
                    <p>
                        I reserve all right ro remove any content from site for whatever reason. I will be removing irrelevant or self-promoting posts to bad content, <small>mostl</small>
                    </p>
                </div>
                <div class="margin-bottom-60">
                    <h3>Geek stuff</h2>
                    <p>
                        The website also serves as a reference of my work in my resume. As such I've decided to opensource the code - <a href="https://github.com/d1am0nd/wp">github</a>. <small>Shitty non-constructive comments about my code or lack of tests are not welcome. Bug reports, security holes... (helpful constructive stuff) more than welcome on wizardpokercom@gmail.com</small>
                        <br>
                        It's based entirely on <i>amazing</i> php framework - Laravel 5.2
                        <br>
                        The template (Unify) is not included :)
                        <br>
                        I'm working on this site every week, so it might change a lot. New features, new design stuff like that
                        <br>
                    <p>
                </div>
            </div>
            <div class="col-md-4 col-sm-5 col-xs-4 md-margin-bottom-50">
                <img class="img-responsive" title="Lorewalker Cho archives and shares tales from the land of Pandaria, but his favorite story is the one where Joey and Phoebe go on a road trip." src="/cards/lorewalker.png" alt="">
            </div>
        </div><!--/end row-->
    </div>
    <!--=== End Container Part ===-->
@stop