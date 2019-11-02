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
                            No Image Set
                        </div>
                    </div>
                    <div class="col-md-8  d-flex align-items-center">
                        <div>
                            <strong>Title:</strong> {{ post.title }}
                            <hr class="mt-0">
                            <p class="mb-0"><strong>Address:</strong> {{ post.address }}</p>
                            <p><strong>Per Hour:</strong> {{ post.per_hour }}</p>
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
