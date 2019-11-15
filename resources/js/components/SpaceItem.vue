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
                            <space-view v-if="onSpaceDetails" :post="post"></space-view>
                            <reservation-form
                                v-else
                                :user="user"
                                :types="types"
                                :spaces="spaces"
                            ></reservation-form>
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
