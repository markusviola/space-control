<template>
    <div>
        <reservation-item
            :type_id="type_id"
            :form="selected_form"
            :types="types"
            :spaces="spaces"
            :discoveries="spaces"
            :statuses="statuses"
        ></reservation-item>
        <div v-for="(approved_form, index) in approved_forms" :key="index">
            <div class="container py-3 panel-highlight" @click="onFormSelected(approved_form)" data-toggle="modal" data-target="#reservation-item">
                <div class="row">
                    <div class="col-md-8 alt-neutral">
                        <h5>
                            <strong class="text-secondary">{{ approved_form.reservation.status.name }} ></strong>
                            Reservation #{{ approved_form.reservation.id }}
                        </h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end text-muted">
                        Client | {{ approved_form.name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-muted">
                        Initial Reservation Date: {{ approved_form.schedules[0].start_time['date'] }}
                    </div>
                </div>
            </div>
            <hr class="m-0 p-0">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        approved_forms: {
            type: Array,
            required: true,
        },
        types: {
            type: Array,
            required: true,
        },
        spaces: {
            type: Array,
            required: true,
        },
        discoveries: {
            type: Array,
            required: true,
        },
        statuses: {
            type: Array,
            required: true,
        },
        type_id: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            selected_form: null,
        }
    },
    methods: {
        onFormSelected(form) {
            this.selected_form = form;
        }
    }
}
</script>
