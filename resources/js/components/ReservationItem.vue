<template>
    <div>
        <div
            class="modal fade"
            id="reservation-item"
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
                            Reservation Details
                        </strong>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Inquiry Date</strong>
                            </div>
                            <div class="col-md-8">{{ form.created_at }}</div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Status</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select
                                        v-model="status_id"
                                        class="form-control"
                                    >
                                        <option
                                            v-for="(status, index) in statuses"
                                            :key="index"
                                            :value="status.id"
                                            :selected="status.id == form.reservation.status.id"
                                        >{{ status.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Route</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select
                                        v-model="discovery_id"
                                        class="form-control"
                                    >
                                        <option
                                            v-for="(discovery, index) in discoveries"
                                            :key="index"
                                            :value="discovery.id"
                                            :selected="discovery.id == discovery_id"
                                        >{{ discovery.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Usage Category</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input
                                        v-model="is_independent"
                                        class="form-check-input"
                                        type="radio" id="individual"
                                        value="true"
                                    >
                                    <label class="form-check-label" for="individual">
                                        Individual
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        v-model="is_independent"
                                        class="form-check-input"
                                        type="radio"
                                        id="corporate"
                                        value="false"
                                    >
                                    <label class="form-check-label" for="corporate">
                                        Corporate
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Corporate Name</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="corporate_name"
                                    type="text"
                                >
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-trans text-muted" data-dismiss="modal">
                            <strong>Close</strong>
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
        form: {
            type: Object,
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
        }
    },
    data() {
        return {
            status_id: null,
            discovery_id: null,
            is_independent: null,
            corporate_name: null,
        }
    },
    created() {
        this.status_id = this.form.reservation.status.id;
        this.discovery_id = this.form.reservation.discovery.id;
        this.is_independent = this.form.reservation.is_independent ? true : false;
        this.corporate_name = this.form.reservation.corporate_name;
    }
}
</script>
