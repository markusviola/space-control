<template>
    <div>
        <div class="text-center pt-3 pb-3">
            <h4 class="alt-neutral">
                予約{{ user.is_admin ? '要求' : '提出' }}リスト
            </h4>
            <div class="text-muted">
                {{ user.is_admin ? 'お客さんと交渉しよう！' : '管理者に問い合わせよう！' }}
            </div>
        </div>
        <hr class="m-0 p-0">
        <div class="formlist-column" v-if="forms.length > 0">
            <div
                v-for="form in forms"
                :key="form.id"
            >
                <div class="panel-highlight" @click="selectForm(form)">
                    <div class="px-3 py-3" v-if="user.is_admin">
                        <div class="alt-anti-neutral">
                            <div class="d-flex justify-content-between">
                                <h6>
                                    <strong>
                                        <i v-if="form.is_approved" class="text-primary fas fa-check-circle fa-lg"></i>
                                        {{ form.post.title }}
                                    </strong>
                                </h6>
                                <h6 v-if="form.unread_count">
                                    <strong class="alt-neutral d-flex align-items-center">
                                        <i class="fas fa-envelope fa-sm"></i>
                                        <div class="ml-2">{{ form.unread_count }}</div>
                                    </strong>
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted">
                            <div>
                                <strong>
                                    <span
                                        :class="`text-${form.user_id ? 'primary' : 'admin'}`"
                                    >
                                        {{ form.user_id ? 'ユーザー' : 'ゲスト ' }}
                                    </span> •
                                </strong>{{ form.name }}
                            </div>
                            <div>{{ form.created_at }}</div>
                        </div>
                    </div>
                    <div class="px-3 py-3" v-else>
                        <div class="alt-anti-neutral" @click="selectForm(form)">
                            <div class="d-flex justify-content-between">
                                <h6>
                                    <strong>
                                        <i v-if="form.is_approved" class="text-primary fas fa-check-circle fa-lg"></i>
                                        {{ form.post.title }}
                                    </strong>
                                </h6>
                                <h6 v-if="form.unread_count">
                                    <strong class="alt-neutral d-flex align-items-center">
                                        <i class="fas fa-envelope fa-sm"></i>
                                        <div class="ml-2">{{ form.unread_count }}</div>
                                    </strong>
                                </h6>
                            </div>
                        </div>
                        <div class="text-muted text-left">
                            {{ form.created_at }}
                        </div>
                    </div>
                    <hr class="p-0 m-0">
                </div>
            </div>
        </div>
        <div v-else>
            <div class="text-muted text-center mt-4 mb-4">
                 何も予約{{ user.is_admin ? '要求' : 'フォーム' }}は提出されていません。
            </div>
        </div>
        <hr class="mt-0">
    </div>
</template>

<script>
export default {
    props: {
        forms: {
            type: Array,
            default: [],
        },
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            selected: this.forms.length ? this.forms[0] : null
        };
    },
    methods: {
        selectForm(form) {
            this.selected = form;
            this.$emit('selected', form);
        },
    },
    computed: {
        sortedForms() {
            // unread
        }
    }
}
</script>
