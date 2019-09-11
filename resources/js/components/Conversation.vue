<template>
    <div>
        <div class="card-body p-0 pt-3" style="height: 100%;">
            <div class="text-left">
                <h5 class="alt-neutral">
                    <strong>
                        <i v-if="form && form.is_approved" class="text-primary fas fa-check fa-lg"></i>
                        {{ form ? form.type.name : `${(user.is_admin ? '要求' : 'フォーム')}を選択ください` }}
                    </strong>
                </h5>
                <div class="d-flex justify-content-between">
                    <div class="text-muted">
                        <span
                            v-if="form"
                            class="text-muted"
                        >
                            <strong>{{ form.user_id ? 'ユーザー •' : 'ゲスト •' }}</strong>
                        </span>
                        {{
                            form ? (user.is_admin ? ` ${form.name}` : `提出日 ${form.created_at}`) : 'チャットをするため、リストに選んでください'
                        }}
                    </div>
                    <div v-if="form">
                    <form-info
                        :form="form"
                        :user="user"
                        :spaces="spaces"
                        @onFormApproval="formApproved"
                    ></form-info>
                        <button class="btn-trans anti-neutral" data-toggle="modal" data-target="#form-info">
                            <strong>フォームを見る</strong>
                        </button>
                    </div>
                </div>
            </div>

            <hr class="mb-3">
            <ul class="border list-unstyled bg-white message-box" v-chat-scroll>
                <li class="p-2 pl-3"
                    v-for="message in messages"
                    :key="message.id"
                >
                    <div :class="`text-${message.from == user.id ? 'right' : 'left'}`">
                        <div
                            :class="`d-inline-block
                                plus-${message.from == user.id ? 'anti-' : ''}neutral
                                rounded-lg py-2 px-3
                                half-size`"
                        >
                            <div class="mb-1">
                                <strong class="text-white">
                                    {{ message.from_user.name }}
                                </strong>
                            </div>
                            <div class="text-white text-left long-text mb-1">{{ message.message }}</div>
                            <small
                                :class="`text-${message.from == user.id ? 'left' : 'right'} form-text text-white`"
                            >{{ message.created_at }}</small>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="form-group mt-2">
                <textarea
                    v-model="message"
                    class="w-100 form-control"
                    placeholder="メッセージをここに書けますよ。"
                    @keydown.enter="sendMessage"
                    rows="2"
                    :disabled="form && !form.user_id"
                ></textarea>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            default: null,
        },
        form: {
            type: Object,
            default: null,
        },
        messages: {
            type: Array,
            default: [],
        },
        spaces: {
            type: Array,
            default: null,
        }
    },
    data() {
        return {
            message: '',
        }
    },
    methods: {
        sendMessage(event) {
            event.preventDefault();
            if (this.message == '' || !this.form) {
                return;
            }
            axios.post('messages', {
                to: this.form.id,
                message: this.message
            })
            .then(response => {
                this.$emit('newMessage', response.data);
                this.message = '';
            });
        },
        formApproved($updatedForm) {
            this.$emit('onFormApproved', $updatedForm);
        }
    },
}
</script>
