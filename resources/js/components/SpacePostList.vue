<template>
    <div class="mt-3">
        <space-post-create
            :user="user"
            @onPostCreated="addNewPost"
        ></space-post-create>
        <hr>
        <div v-for="post in posts" :key="post.id">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center bg-dark" >
                        <div v-if="post.post_image">
                            <img class="mw-100" style="height: 7rem;" :src="`storage/${post.post_image}`">
                        </div>
                        <div class="w-100 text-white font-weight-bold d-flex align-items-center justify-content-center" style="height: 7rem;" v-else>
                            写真なし
                        </div>
                    </div>
                    <div class="col-md-8 pr-0 d-flex align-items-center">
                        <div class="w-100">
                            <div class="row mb-2">
                                <div class="col-md-3 text-md-right border-right">
                                    <strong class="text-muted">タイトル</strong>
                                </div>
                                <div class="col-md-9">{{ post.title }}</div>
                            </div>
                            <hr class="mt-0">
                             <div class="row">
                                <div class="col-md-3 text-md-right border-right">
                                    <strong class="text-muted">住所:</strong>
                                </div>
                                <div class="col-md-9">{{ post.address }}</div>
                            </div>
                             <div class="row">
                                <div class="col-md-3 text-md-right border-right">
                                    <strong class="text-muted">時間金額:</strong>
                                </div>
                                <div class="col-md-9">{{ post.per_hour }} 円</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios.get('posts/list')
            .then(response => {
                this.posts = response.data;
            })
            .catch(err => {
                const res = err.response;
                notifyUser('Something went wrong.');
                console.log(res);
            })
        },
        addNewPost(newPost) {
            this.posts.unshift(newPost);
            console.log(this.posts);
        }
    }
}
</script>
