<template>
    <div>
        <div class="modal fade" id="updatePostModal" tabindex="-1" role="dialog" aria-labelledby="updatePostModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary" id="updatePostModalTitle">
                        <strong>
                            場所情報
                        </strong>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div
                        class="bg-light rounded-lg py-2 mb-4 panel-highlight btn-trans"
                        data-dismiss="modal"
                        data-toggle="modal"
                        data-target="#confirmDeletePostModal"
                    >
                        <div class="d-flex justify-content-center">
                            <i class="text-admin fas fa-trash-alt fa-lg d-flex align-items-center"></i>
                            <span class="text-admin font-weight-bold ml-2">Delete Space?</span>
                        </div>
                    </div>
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
                            class="form-control preserve-breaks"
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
                            class="form-control preserve-breaks"
                            id="notes"
                            rows="3"
                            placeholder="他のお客のための重要な詳細を書いてください"
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        @click="onUpdatePostClicked"
                        type="button"
                        class="btn-trans text-secondary"
                        data-dismiss="modal"
                    >
                        <h5><strong>更新する</strong></h5>
                    </button>
                </div>
                </div>
            </div>
        </div>
        <space-post-delete
            :post="post"
            @onPostDeleted="onPostDeleted"
        ></space-post-delete>
    </div>

</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            render_image: null,
            id: null,
            user_id: null,
            title: null,
            post_image: null,
            address: null,
            business_hours: null,
            per_hour: 0,
            notes: null,
        }
    },
    watch: {
        post: {
            handler(newPost, oldForm) {
                this.updatePostFields(newPost);
            }
        }
    },
    methods: {
        updatePostFields(newPost) {
            this.id = newPost.id,
            this.user_id = newPost.user_id;
            this.title = newPost.title;
            this.post_image = null;
            this.address = newPost.address;
            this.business_hours = newPost.business_hours;
            this.per_hour = newPost.per_hour || 0;
            this.notes = newPost.notes;
            this.render_image = null;

            if (newPost.post_image) {
                this.render_image = `storage/${newPost.post_image}`;
            }
        },
        onUpdatePostClicked() {
            if (!this.title) {
                notifyUser("タイトルは必要なフィールドです！");
            } else {
                let formData = new FormData();
                formData.append('_method', 'put');
                formData.append('title', this.title);
                if (this.post_image) formData.append('post_image', this.post_image);
                if (this.address) formData.append('address', this.address);
                if (this.business_hours) formData.append('business_hours', this.business_hours);
                if (this.per_hour) formData.append('per_hour', this.per_hour);
                if (this.notes) formData.append('notes', this.notes);

                axios.post(`posts/${this.id}`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                .then(response => {
                    console.log(response.data);
                    notifyUser('Space successfully updated!');
                    this.$emit('onPostUpdated', response.data);
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
        onPostDeleted(id) {
            this.$emit('onPostDeleted', id);
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
