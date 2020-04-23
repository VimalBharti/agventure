<v-dialog v-model="comment" fullscreen hide-overlay transition="dialog-bottom-transition">
    <template v-slot:activator="{ on }">
        <v-btn outlined v-on="on" small class="text-capitalize">
            All Comments
            <span class="grey--text ml-1">{{$post->comments->count()}}</span>
        </v-btn>
    </template>
    <v-card tile class="pb-12">
        <v-toolbar dense flat class="comment-nav">
            <v-btn icon @click="comment = false">
                <v-icon color="grey darken-3">mdi-arrow-left</v-icon>
            </v-btn>
            <v-btn text class="text-capitalize pl-0">Comments</v-btn>
        </v-toolbar>

        @include('Comments.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
        <div class="empty-space"></div>

        <div class="add-new-comment">
        @guest
        @else
            <form method="post" action="{{ route('comments.store'   ) }}">
                @csrf
                <v-list class="pa-0">
                    <v-list-item>
                        <v-list-item-avatar size="32">
                            <v-img
                                src="/storage/profile/{{$user->image}}"
                                lazy-src="{{asset('images/lazy.jpg')}}"
                                aspect-ratio="1"
                                color="grey"
                            ></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <textarea autofocus type="text" name="body" placeholder="Comment as {{$user->name}}"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-btn small text type="submit">Post</v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>
            </form>
            @endguest
        </div>
    </v-card>
</v-dialog>