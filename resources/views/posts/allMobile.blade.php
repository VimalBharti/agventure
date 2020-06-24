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
                <div class="author-name">{{$post->user->name}}</div>
                <div class="timestamp">{{$post->created_at->format('d M, Y')}}</div>
            </div> 
            <div class="action-btn">
                @if (Auth::check())
                    <like
                        :post={{ $post->id }}
                        :favorited={{ $post->favorited() ? 'true' : 'false' }}
                    ></like>
                @else
                    <v-img src="{{asset('images/black.png')}}"></v-img>
                @endif
                <!-- <span class="grey--text">{{$post->likes->count()}}</span> -->
            </div>
        </div>

        <div class="post-body" style="padding-left:12px;margin-bottom:12px;">
            <a href="{{route('singleMobile', $post->slug)}}">{{str_limit($post->about, 200, '...')}}</a>
        </div>
        <div class="photoset square portrait">
            @isset($post->postdetails)
                @foreach($post->postdetails as $image)
                    <a class="photo" style="background-image:url('/storage/thumbnails/{{$image->thumb}}')"></a>
                @endforeach
            @endisset
        </div>
        @isset($post->video)
            <video 
                class="video-js vjs-big-play-centered vjs-4-3"
                data-setup="{}" 
                controls
                preload="none"
                poster="https://d158vexbkkk4m1.cloudfront.net/videos/{{$post->poster}}"
            >
                <source src="https://d158vexbkkk4m1.cloudfront.net/{{$post->video}}" type="video/mp4" />
            </video>
        @endif
    </div>
@endforeach

<div class="pagination-links">{{$posts->links()}}</div>