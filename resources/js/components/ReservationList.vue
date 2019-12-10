<template>
    <div>
        <reservation-item
            :form="selected_form"
            :statuses="statuses"
        ></reservation-item>
        <div v-for="(approved_form, index) in approved_forms" :key="index">
            <div class="container py-3 panel-highlight" @click="onFormSelected(approved_form)" data-toggle="modal" data-target="#reservation-item">
                <div class="row">
                    <div class="col-md-8 alt-neutral">
                        <h5>
                            #{{ approved_form.reservation.id }} > <span class="text-muted">{{ approved_form.post.title }}</span>
                        </h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end text-muted">
                        予約者名・{{ approved_form.name }}
                    </div>
                </div>
                <div class="row">
                    <h5 class="font-weight-bold col-md-6 text-secondary mb-0">{{ approved_form.reservation.status.name }}</h5>
                    <div class="col-md-6 text-muted text-right">
                        初期使用日・{{ approved_form.schedules[0].start_time['date'] }}
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
        statuses: {
            type: Array,
            required: true,
        },
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
