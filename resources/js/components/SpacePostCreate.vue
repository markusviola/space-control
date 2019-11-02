<template>
    <div>
        <div
            data-toggle="modal"
            data-target="#createPostModal"
            class="anti-neutral clickable d-flex justify-content-end mr-2">
            <i
                class="fas fa-plus fa-lg d-flex align-items-center"
            ></i>
            <span class="font-weight-bold ml-2">Post a Space</span>
        </div>
        <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary" id="createPostModalTitle">
                        <strong>
                            場所情報
                        </strong>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-if="render_image" class="form-group">
                        <img
                            class="w-100"
                            :src="render_image"
                        />
                        <div>
                        </div>
                        <button
                            @click="onImageRemoved"
                            class="btn-trans text-admin w-100 mt-3"
                        >
                            <h5><strong class="d-flex justify-content-center align-items-center">削除</strong></h5>
                        </button>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="post_image">場所写真</label>
                        <input
                            @change="onImageChanged"
                            type="file"
                            class="form-control-file"
                            id="post_image"
                        >
                    </div>
                    <div class="form-group">
                        <label for="title">投稿タイトル</label>
                        <input
                            v-model="title"
                            type="text"
                            class="form-control"
                            id="title"
                            placeholder="好きなタイトルを入力してください"
                        >
                    </div>
                    <div class="form-group">
                        <label for="address">場所住所</label>
                        <input
                            v-model="address"
                            type="text"
                            class="form-control"
                            id="address"
                            placeholder="場所の住所を入力してください"
                        >
                    </div>
                    <div class="form-group">
                        <label for="business_hours">営業時間</label>
                        <textarea
                            v-model="business_hours"
                            class="form-control"
                            id="business_hours"
                            rows="4"
                            placeholder="フォマットの書くルールが特にないので、自由に書いてください"
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="per_hour">使用時間あたり</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="yen">円</span>
                            </div>
                                <input
                                type="number"
                                step="0.01"
                                class="form-control"
                                id="per_hour"
                                v-model="per_hour"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">ノート</label>
                        <textarea
                            v-model="notes"
                            class="form-control"
                            id="notes"
                            rows="3"
                            placeholder="他のお客のための重要な詳細を書いてください"
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        @click="onCreatePostClicked"
                        type="button"
                        class="btn-trans text-secondary"
                        data-dismiss="modal"
                    >
                        <h5><strong>作成する</strong></h5>
                    </button>
                </div>
                </div>
            </div>
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
            render_image: '',
            title: null,
            post_image: null,
            address: null,
            business_hours: null,
            per_hour: 0,
            notes: null,
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
                console.log(response.data);
            })
            .catch(err => {
                const res = err.response;
                notifyUser('Something went wrong.');
                console.log(res);
            })
        },
        onCreatePostClicked() {
            if (!this.title) {
                notifyUser("タイトルは必要なフィールドです！");
            } else {
                let formData = new FormData();
                formData.append('title', this.title);
                formData.append('post_image', this.post_image);
                formData.append('address', this.address);
                formData.append('business_hours', this.business_hours);
                formData.append('per_hour', this.per_hour);
                formData.append('notes', this.notes);
                axios.post('posts', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                .then(response => {
                    console.log(response.data);
                })
                .catch(err => {
                    const res = err.response;
                    if (res.status == 422) {
                        notifyUser('Please re-check your fields!');
                    } else notifyUser('Something went wrong.');
                    console.log(res);
                })
            }
        },
        onImageChanged(e) {
            const files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
        },
        createImage(file) {
            const reader = new FileReader();
            this.post_image = file;

            reader.onload = (e) => {
                this.render_image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        onImageRemoved(e) {
            this.render_image = '';
            this.post_image = null;
        }
    }
}
</script>
