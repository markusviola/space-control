<template>
    <div class="container shadow border neutral-round bg-white">
        <div class="row">
            <div class="col-md-4 m-0 p-0 border-right">
                <form-list :user="user" :forms="forms" @selected="fetchMessages"/>
            </div>
            <div class="col-md-8">
                <conversation
                    :user="user"
                    :form="selectedForm"
                    :spaces="spaces"
                    :messages="messages"
                    @newMessage="pushNewMessage"
                    @onFormApproved="changeFormStatus"
                />
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
            choice: {
                type: [Object, Number],
                required: true,
            },
            spaces: {
                type: Array,
                required: true,
            }
        },
        data() {
            return {
                forms: [],
                messages: [],
                selectedForm: null,
                updatePhase: false,
            }
        },
        mounted() {
            this.fetchForms();
        },
        methods: {
            fetchForms() {
                axios.get('/chats/forms')
                .then(response => {
                    this.forms = response.data;
                    this.forms.forEach(form => {
                        Echo.private(`chat.${form.id}`)
                            .listen('MessageSent', event => {
                                this.handleMessage(event.message);
                            });
                        if (this.choice && !this.updatePhase) {
                            this.fetchMessages(this.choice);
                            this.updatePhase = true;
                        }
                    });
                })
            },
            fetchMessages(form) {
                this.updateReadState(form, true);
                axios.get(`/chats/messages/${form.id}`)
                .then(response => {
                    this.messages = response.data;
                    this.selectedForm = form;
                })
            },
            changeFormStatus($updatedForm) {
                this.updatePhase = false;
                this.fetchForms();
                this.selectedForm = $updatedForm;
            },
            pushNewMessage(message) {
                this.messages.push(message);
            },
            handleMessage(message) {
                if (this.selectedForm && message.to == this.selectedForm.id) {
                    this.pushNewMessage(message);
                    return;
                }
                this.updateReadState(message.to_form, false);
            },
            updateReadState(form, reset) {
                this.forms = this.forms.map((currForm) => {
                    if (currForm.id !== form.id)
                        return currForm;
                    if (reset)
                        currForm.unread_count = 0;
                    else
                        currForm.unread_count += 1;
                    return currForm;
                })
            }
        }
    }
</script>
