@guest
@else
    <v-card flat>
        <v-card-text>
            <image-upload :user="{{ Auth::user() }}"></image-upload>
        </v-card-text>
    </v-card>
@endguest

