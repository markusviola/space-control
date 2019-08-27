<template>
    <div>
        <div class="card-body p-0 pt-3" style="height: 100%;">
            <div class="text-left">
                <h5 class="alt-neutral">
                    <strong>
                        {{ form ? form.type.name : `Select a ${(user.is_admin ? 'Request' : 'Form')}` }}
                    </strong>
                </h5>
                <div class="d-flex justify-content-between">
                    <div class="text-muted">{{
                        form ? (user.is_admin ? form.name : `Submitted on ${form.created_at}`) : 'Choose from the list to start chatting!'
                    }}</div>
                    <div v-if="form">
                        <form-info :form="form"></form-info>
                        <button class="btn-trans anti-neutral" data-toggle="modal" data-target="#form-info">
                            <strong>View Form</strong>
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
                                rounded-lg py-2 px-2
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
                    placeholder="Write your thoughts here..."
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
        }
    },
}
</script>
