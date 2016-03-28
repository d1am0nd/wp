<!-- Search Block -->
<ul class="nav navbar-nav pull-right">
    <li class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
            {{ isset($filterTag) ? $filterTag : 'Tags'}} 
        </a>
        <ul class="dropdown-menu menu-rtl">
            <li>
                <a href="{{ url_with_get(Request::segment(1),  array_diff_key(Request::input() ? Request::input() : [], ['tag' => ''])) }}">
                    All tags
                </a>
            </li>
            @foreach($tags as $tag)
            <li>
                <a href="{{ url_with_get(Request::segment(1),  array_merge(Request::input() ? Request::input() : [], ['tag' => $tag->name])) }}">
                    {{ $tag->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </li>
</ul>
<ul class="nav navbar-nav pull-right">
    <li class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
            {{ isset($filterOrderBy) ? $filterOrderBy : 'Best rated'}} 
        </a>
        <ul class="dropdown-menu menu-rtl">
            <li><a href="{{ url_with_get(Request::segment(1),  array_diff_key(Request::input() ? Request::input() : [], ['orderBy' => ''])) }}">Best rated</a></li>
            <li><a href="{{ url_with_get(Request::segment(1),  array_merge(Request::input() ? Request::input() : [], ['orderBy' => 'newest'])) }}">Newest</a></li>
        </ul>
    </li>
</ul>
<!-- End Search Block -->