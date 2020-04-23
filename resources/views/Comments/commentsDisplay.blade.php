@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:0.5em;" @endif>

        <v-list>
            <v-list-item class="pa-0">
                <v-list-item-avatar>
                    <v-img
                        src="/storage/profile/{{$comment->user->image}}"
                        lazy-src="{{asset('images/lazy.jpg')}}"
                        aspect-ratio="1"
                    ></v-img>
                </v-list-item-avatar>
                <p class="comment-body"><strong class="mr-1">{{ $comment->user->name }}</strong>{{ $comment->body }}</p>
            </v-list-item>
            <div class="caption grey--text comment-date">{{ $comment->created_at->format('d M') }}</div>
        </v-list>

        <!-- <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <v-list>
                <v-list-item>
                    <input type="text" name="body" class="form-control" placeholder="Reply..." />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                    <v-btn type="submit" text class="text-capitalize">Post</v-btn>
                </v-list-item>
            </v-list>
        </form> -->
        @include('Comments.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach