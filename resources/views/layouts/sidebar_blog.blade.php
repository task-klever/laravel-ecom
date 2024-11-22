<div class="sidebar">
    <div class="widget">
        <form action="{{ url('search') }}" method="post">
            @csrf
            <div class="search input-group md-form form-sm form-2 pl-0">
                <input name="search_string" class="form-control my-0 py-1 red-border" type="text" placeholder="{{ SEARCH_BLOG_DOT }}">
                <div class="input-group-append">
                    <button type="submit" name="form_search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="widget">
        <h3>{{ CATEGORIES }}</h3>
        <div class="type-1">
            <ul>
                @foreach($categories as $row)
                    <li><a href="{{ url('category/'.$row->category_slug) }}">{{ $row->category_name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3>{{ RECENT_POSTS }}</h3>
        <div class="type-2">
            <ul>
                @php $i=0 @endphp
                @foreach($blog_items_no_pagi as $row)
                    @php $i++ @endphp
                    @if($i > $g_setting->sidebar_total_recent_post)
                        @break
                    @endif
                    <li>
                        <img src="{{ asset('uploads/'.$row->blog_photo) }}">
                        <a href="{{ url('blog/'.$row->blog_slug) }}">{{ $row->blog_title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
