@foreach($posts as $post)
    <div class="single-mobile-post box-shadow">
        <div class="card-top-action">
            <div class="auth-avatar">
                @if($post->user->image)
                    <img src="/storage/profile/{{$post->user->image}}" />
                @else
                    <span class="username">{{Str::limit($post->user->name, 1, '')}}</span>
                @endif
            </div>
            <div class="auth-details">
                <div>{{$post->user->name}}</div>
                <div class="timestamp">{{$post->created_at->format('d M, Y')}}</div>
            </div> 
            <div class="action-btn">
                @if (Auth::check())
                    <like
                        :post={{ $post->id }}
                        :favorited={{ $post->favorited() ? 'true' : 'false' }}
                    ></like>
                @else
                    <v-icon size="22" color="grey">mdi-heart-outline</v-icon>
                @endif
                <span class="grey--text">{{$post->likes->count()}}</span>
            </div>
        </div>

        <div class="px-3 mb-2 post-body">
            <a href="{{route('singleMobile', $post->slug)}}">{{str_limit($post->about, 200, '...')}}</a>
        </div>
        <div class="photoset square portrait">
            @isset($post->postdetails)
                @foreach($post->postdetails as $image)
                <a class="photo" style="background-image:url('/storage/thumbnails/{{$image->thumb}}')"></a>
                @endforeach
            @endisset
        </div>
    </div>
@endforeach

<div class="pagination-links">{{$posts->links()}}</div>