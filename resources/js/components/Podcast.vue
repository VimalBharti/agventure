<template>
    <div>
        <v-list three-line>
            <v-subheader>Podcast</v-subheader>

            <v-list-item v-for="post of posts" :key="post.id">
                <v-list-item-avatar>
                    <v-icon large>mdi-play-circle-outline</v-icon>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>{{ post.slug }}</v-list-item-title>
                    <v-list-item-subtitle>{{ post.body }}</v-list-item-subtitle>
                    <APlayer :audio="`/storage/audio/${post.audio}`" />
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </div>
</template>

<script>
export default {
    data: () => ({
        posts: null
    }),
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios
                .get("/api-podcasts")
                .then(response => {
                    this.posts = response.data;
                })
                .catch(e => {
                    this.error.push(e);
                });
        }
    }
};
</script>

<style></style>
