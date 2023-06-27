<script>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "../Layouts/AppLayout.vue";
import ArticlePreview from "../Components/ArticlePreview.vue";
export default {
    computed: {
        isCheck() {
            return $page.props.auth.user;
        },
        isGuest() {
            return !this.authCheck;
        },
    },
    components: {
        Link,
        AppLayout,
        ArticlePreview,
    },
    props: {
        tags: Array,
        articles: Array,
    },
};
</script>
<template>
    <AppLayout>
        <div class="home-page">
            <div class="banner">
                <div class="container">
                    <h1 class="logo-font"  style="font-family: 'Inter', Cambria, Times;">Keep Learning</h1>
                    <p style="font-family: sohne, 'Helvetica Neue', Helvetica, Cambria, sans-serif;">Explore narratives, thoughts, and knowledge shared<br/> by authors covering a wide range of subjects.</p>
                    <button class="pb-2" variant="outline-primary" >
                        <Link href="/login">Start Reading</Link>
                    </button>
                </div>
            </div>

            <div class="container page">
                <div class="row">
                    <div class="col-md-9">
                        <div class="feed-toggle">
                            <ul class="nav nav-pills outline-active">
                                <li class="nav-item">
                                    <Link
                                        class="nav-link"
                                        :href="
                                            $page.props.auth.guest
                                                ? '#'
                                                : route('feed')
                                        "
                                        :class="{
                                            disabled: $page.props.auth.guest,
                                        }"
                                    >
                                        Your Feed
                                    </Link>
                                </li>
                                <li class="nav-item">
                                    <Link
                                        class="nav-link active"
                                        :href="route('home')"
                                    >
                                        Global Feed
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        <div v-if="articles.length === 0">
                            There's no article currently
                        </div>
                        <ArticlePreview
                            v-for="article in articles"
                            :key="`article_${article.id}`"
                            :article="article"
                        />
                    </div>

                    <div class="col-md-3">
                        <div class="sidebar">
                            <p>Popular Tags</p>

                            <div class="tag-list">
                                <Link
                                    :href="
                                        route('tags.show', { slug: tag.slug })
                                    "
                                    class="tag-pill tag-default"
                                    v-for="(tag, index) in tags"
                                    :key="tag.id"
                                >
                                    {{ tag.name }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
