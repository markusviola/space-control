<template>
    <div>
        <div class="text-center pt-3 pb-3">
            <h5 class="alt-neutral">
                {{ user.is_admin ? 'Reservation Requests' : 'Submission List' }}
            </h5>
            <div class="text-muted">
                {{ user.is_admin ? 'Negotiate with your clients!' : 'Chat with the person-in-charge!' }}
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
                                    <strong>{{ form.type.name }}</strong>
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
                                <span
                                    class="text-primary"
                                >
                                    <strong>{{ form.user_id ? 'User • ' : 'Guest • ' }}</strong>
                                </span>{{ form.name }}
                            </div>
                            <div>{{ form.created_at }}</div>
                        </div>
                    </div>
                    <div class="px-3 py-3" v-else>
                        <div class="alt-anti-neutral" @click="selectForm(form)">
                            <div class="d-flex justify-content-between">
                                <h6>
                                    <strong>{{ form.type.name }}</strong>
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
                No reservation {{ user.is_admin ? 'requests' : 'submissions' }} yet.
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
