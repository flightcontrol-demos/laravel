<script>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
    components: {
        AppLayout,
        Head,
        Link,
    },
    setup() {
        const form = useForm({
            title: null,
            excerpt: null,
            content: null,
            tags: null,
        });
        const submitForm = () => {
            form.post("/articles", {
                // Include the CSRF token in the request data
                _token: "{{ csrf_token() }}", // Replace with your server-side code to retrieve the CSRF token
            });
        };
        return { form,  submitForm};
    },
};
</script>
<template>
    <AppLayout>
        <div class="editor-page">
            <div class="container page">
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-xs-12">
                        <form @submit.prevent="form.post('/articles')">
                            <fieldset>
                                <fieldset class="form-group">
                                    <input
                                        type="text"
                                        class="form-control form-control-lg"
                                        placeholder="Article Title"
                                        v-model="form.title"
                                    />
                                </fieldset>
                                <fieldset class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="What's this post about?"
                                        v-model="form.excerpt"
                                    />
                                </fieldset>
                                <fieldset class="form-group">
                                    <textarea
                                        class="form-control"
                                        rows="8"
                                        placeholder="Write your article (in markdown)"
                                        v-model="form.content"
                                    ></textarea>
                                </fieldset>
                                <fieldset class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter tags"
                                        v-model="form.tags"
                                    />
                                    <div class="tag-list"></div>
                                </fieldset>
                                <button
                                    class="btn btn-lg pull-xs-right btn-primary"
                                    type="button"
                                    @click="submitForm()"
                                >
                                    Publish Article
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
