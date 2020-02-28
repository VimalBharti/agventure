<v-card flat class="post-type-tabs">
    <v-row>
        <v-col class="new-post-container">
            @guest
                <v-container>
                    <v-textarea
                        label="Please login to Share Post...!!!"
                        solo
                        flat
                        rows="1"
                        disabled
                    ></v-textarea>
                    <v-btn class="float-right" color="primary" disabled>Share</v-btn>
                    <!-- If Logged IN -->
                </v-container>
            @else
                <v-tabs
                    color="grey darken-3"
                    slider-color="grey"
                    grow
                >
                    <v-tab ripple>
                        <v-icon class="mr-4 grey--text text--darken-1">mdi-format-quote-close</v-icon>
                        <span class="d-none d-md-block d-lg-block">Share an update</span>
                    </v-tab>
                    <v-tab ripple>
                        <v-icon class="mr-4 grey--text text--darken-1">mdi-image</v-icon>
                        <span class="d-none d-md-block d-lg-block">Upload a photo</span>
                    </v-tab>

                    <!-- Tab Content -->
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                                <form action="/post/create_post" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <v-textarea
                                        name="body"
                                        label="Share new post"
                                        solo
                                        flat
                                        rows="1"
                                        auto-grow
                                    ></v-textarea>
                                    <div class="text-right mr-5">
                                        <input type="submit" class="post-btn cyan darken-2" value="Share"/>
                                    </div>
                                </form>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <!-- Image  -->
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                                <image-upload></image-upload>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>  
                </v-tabs>
            @endguest
        </v-col>
    </v-row>
</v-card>    

