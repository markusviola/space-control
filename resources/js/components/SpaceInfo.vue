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
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>
