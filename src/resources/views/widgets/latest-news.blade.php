<div class="row">
    <div class="col-xs-12">
        <ul class="list-group">
            <li class="list-group-item list-group-item-heading"><i class="fa fa-newspaper-o"></i> {{$widget->title}}
            </li>
            @forelse($articles as $article)
                <li><a href="{{$article->getUrl()}}">{{str_limit($article->title, 60)}}</a></li>
            @empty
                <p>WHOOPS, THERE ARE NO ARTICLES HERE YET :/</p>
            @endforelse
        </ul>
    </div>
</div>