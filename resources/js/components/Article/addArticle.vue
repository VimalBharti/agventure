<template>
    <form class="add-new-post" v-on:submit.prevent="addArticle">
        <v-row class="add-article">
            <v-col md="8">
                <div class="caption">Post Article</div>
                <p class="title text--primary">
                    Add New Article
                </p>
                <v-card>
                    <v-card-text>
                        <v-text-field
                            label="Article Title"
                            outlined
                            v-model="title"
                        ></v-text-field>
                        <div v-if="!$v.title.required">Please enter title</div>
                        <div v-if="!$v.title.minLength">
                            Please enter atleast 4 characters
                        </div>
                        <vue-editor v-model="content"></vue-editor>
                        <div v-if="!$v.content.required">
                            Please enter content
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col md="4">
                <v-card>
                    <v-card-text>
                        <p class="title text--primary">
                            Actions
                        </p>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-btn
                            block
                            color="teal"
                            class="white--text"
                            type="submit"
                            :disabled="$v.$invalid"
                        >
                            Publish
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </form>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
import { required, minLength } from "vuelidate/lib/validators";

export default {
    components: {
        VueEditor
    },
    data() {
        return {
            title: "",
            content: ""
        };
    },
    validations: {
        title: {
            required,
            minLength: minLength(6)
        },
        content: {
            required
        }
    },
    methods: {
        addArticle() {
            axios
                .post("addNew", {
                    title: this.title,
                    content: this.content
                })
                .then(res => {
                    console.log(res);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
};
</script>

<style></style>
