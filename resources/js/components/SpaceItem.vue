<template>
    <div>
        <div
            v-if="post"
            class="modal fade"
            id="space-item"
            tabindex="-1"
            role="dialog"
            aria-labelledby="scrollableForm"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-primary" id="scrollableForm">
                        <strong>
                            スペース詳細
                        </strong>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <h5
                                    @click="onSpaceDetails = !onSpaceDetails"
                                    :class="`nav-link anti-neutral clickable ${onSpaceDetails ? 'active' : ''}`"
                                >スペース情報</h5>
                            </li>
                            <li class="nav-item">
                                <h5
                                    @click="onSpaceDetails = !onSpaceDetails"
                                    :class="`nav-link anti-neutral clickable ${!onSpaceDetails ? 'active' : ''}`"
                                >予約フォーム</h5>
                            </li>
                        </ul>
                        <keep-alive>
                            <div v-if="onSpaceDetails">
                                <div v-if="post.post_image">
                                    <img
                                        class="w-100"
                                        :src="`storage/${post.post_image}`"
                                    />
                                    <hr>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4 text-md-right border-right">
                                        <strong class="text-muted">場所のタイトル</strong>
                                    </div>
                                    <div class="col-md-8">{{ post.title }}</div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4 text-md-right border-right">
                                        <strong class="text-muted">場所住所</strong>
                                    </div>
                                    <div class="col-md-8">{{ post.address || 'なし' }}</div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4 text-md-right border-right">
                                        <strong class="text-muted">営業時間</strong>
                                    </div>
                                    <div class="col-md-8 preserve-breaks">{{ post.business_hours || 'なし' }}</div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4 text-md-right border-right">
                                        <strong class="text-muted">使用料金 | 1時間</strong>
                                    </div>
                                    <div class="col-md-8">{{ post.per_hour || 0 }} 円</div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4 text-md-right border-right">
                                        <strong class="text-muted">ノート</strong>
                                    </div>
                                    <div class="col-md-8 preserve-breaks">{{ post.notes || 'なし' }}</div>
                                </div>
                            </div>
                            <div class="mt-2" v-else>

                                <div class="text-right mr-2">
                                    <h5 v-if="user" class="text-dark my-0">ユーザーモード</h5>
                                    <h5 v-else class="text-dark my-0">ゲストモード</h5>
                                </div>
                                <hr class="mt-2">
                                <form id="space-form-submit" class="pt-2" action="/forms" method="POST">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input v-if="user" type="hidden" name="user_id" :value="user.id">
                                    <form-guest v-else></form-guest>

                                        <space-form
                                            :types="types"
                                            :spaces="spaces"
                                        ></space-form>

                                </form>
                            </div>
                        </keep-alive>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="!onSpaceDetails"
                            type="button"
                            class="btn-trans text-secondary"
                            data-dismiss="modal"
                            data-toggle="modal"
                            data-target="#submitFormModal"
                        >
                            <h5>
                                <strong>提出する</strong>
                            </h5>
                        </button>
                        <button type="button" class="btn-trans text-muted" data-dismiss="modal">
                            <h5><strong>閉める</strong></h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="submitFormModal" tabindex="-1" role="dialog" aria-labelledby="submitFormModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-admin" id="submitFormModal"><strong>確認</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-muted">
                    この予約フォームを提出するつもりですか？
                </div>
                    <div class="modal-footer">
                        <button
                            @click="submitForm"
                            type="button"
                            class="btn-trans text-admin"
                            data-dismiss="modal"
                        >
                            <strong>はい</strong>
                        </button>
                        <button type="button" class="btn-trans text-admin" data-dismiss="modal">
                            <strong>いいえ</strong>
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
        post: {
            type: Object,
            default: null,
        },
        types: {
            type: Array,
            required: true,
        },
        spaces: {
            type: Array,
            required: true,
        },
        user: {
            type: [Object, Number],
            default: 0,
        }
    },
    data() {
        return {
            onSpaceDetails: true,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
    mounted() {
    },
    methods: {
        submitForm() {
            document.getElementById("space-form-submit").submit();
        }
    }
}
</script>
