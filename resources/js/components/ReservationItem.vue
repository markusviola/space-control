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
                        <div class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Type</strong>
                            </div>
                            <div class="col-md-8 font-weight-bold text-secondary">{{ form.type.name }}</div>
                        </div>
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
                                <strong class="text-muted">Usage</strong>
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
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Visit Date</strong>
                            </div>
                            <div class="col-md-8">
                                <v-date-picker
                                    locale="ja"
                                    @input="onVisitPicked"
                                    v-model="visit_date"
                                    :input-props='{
                                        readonly: true,
                                    }'
                                >
                                </v-date-picker>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Place to Check</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="visit_place"
                                    type="text"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div v-if="typeid == 2" class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Rooms</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="container">
                                    <div class="row">
                                        <div
                                            v-for="(space, index) in spaces"
                                            :key="index"
                                            class="form-check col-6"
                                        >
                                            <input
                                                v-on:change="onSpacesChanged"
                                                v-model="checkSpaces[index].is_selected"
                                                class="form-check-input"
                                                type="checkbox"
                                                :id="space.name"
                                            >
                                            <label class="form-check-label" :for="space.name">
                                                {{ space.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Loud Activities?</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input
                                        v-model="will_noise"
                                        class="form-check-input"
                                        type="radio"
                                        id="yes"
                                        value="true"
                                    >
                                    <label class="form-check-label" for="yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        v-model="will_noise"
                                        class="form-check-input"
                                        type="radio"
                                        id="no"
                                        value="false"
                                    >
                                    <label class="form-check-label" for="no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Remarks</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="remarks"
                                    type="text"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Cancellation Reason</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="cancel_reason"
                                    type="text"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Actual Hours</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="actual_hours"
                                    type="number"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Payment Cost</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="payment_cost"
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Discounted Cost</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="discounted_cost"
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Invoiced?</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input
                                        v-model="invoice"
                                        class="form-check-input"
                                        type="radio"
                                        id="has_invoice"
                                        value="true"
                                    >
                                    <label class="form-check-label" for="has_invoice">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        v-model="invoice"
                                        class="form-check-input"
                                        type="radio"
                                        id="no_invoice"
                                        value="false"
                                    >
                                    <label class="form-check-label" for="no_invoice">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Paydate</strong>
                            </div>
                            <div class="col-md-8">
                                <v-date-picker
                                    locale="ja"
                                    @input="onPaydatePicked(true)"
                                    v-model="paydate"
                                    :input-props='{
                                        readonly: true,
                                    }'
                                >
                                </v-date-picker>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Actual Paydate</strong>
                            </div>
                            <div class="col-md-8">
                                <v-date-picker
                                    locale="ja"
                                    @input="onPaydatePicked(false)"
                                    v-model="actual_paydate"
                                    :input-props='{
                                        readonly: true,
                                    }'
                                >
                                </v-date-picker>
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
        },
        typeid: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            status_id: null,
            discovery_id: null,
            is_independent: null,
            corporate_name: null,
            visit_date: null,
            visit_place: null,
            will_noise: null,
            remarks: null,
            cancel_reason: null,
            actual_hours: null,
            payment_cost: null,
            discounted_cost: null,
            invoice: null,
            paydate: null,
            actual_paydate: null,
            checkSpaces: [],
        }
    },
    created() {
        this.status_id = this.form.reservation.status.id;
        this.discovery_id = this.form.reservation.discovery.id;
        this.corporate_name = this.form.reservation.corporate_name;
        this.visit_place = this.form.reservation.visit_place;
        this.remarks = this.form.reservation.remarks;
        this.cancel_reason = this.form.reservation.cancel_reason;
        this.actual_hours = this.form.reservation.actual_hours;
        this.payment_cost = this.form.reservation.payment_cost;
        this.discounted_cost = this.form.reservation.discounted_cost;

        this.invoice = this.form.reservation.invoice ? true : false;
        this.will_noise = this.form.reservation.will_noise ? true : false;
        this.is_independent = this.form.reservation.is_independent ? true : false;

        this.visit_date = this.form.reservation.visit_date ?
            new Date(this.form.reservation.visit_date) : null;
        this.paydate = this.form.reservation.paydate ?
            new Date(this.form.reservation.paydate) : null;
        this.actual_paydate = this.form.reservation.actual_paydate ?
            new Date(this.form.reservation.actual_paydate) : null;

        for (let i = 0; i < this.spaces.length; i+=1) {
            let hasMatch = false;
            for (let j = 0; j < this.form.bulk_spaces.length; j+=1) {
                if (this.form.bulk_spaces[j].space_id == this.spaces[i].id) {
                    hasMatch = !hasMatch;
                    this.checkSpaces.push({
                        id: this.spaces[i].id,
                        is_selected: hasMatch
                    });
                    break;
                }
            }
            if (!hasMatch) {
                this.checkSpaces.push({
                    id: this.spaces[i].id,
                    is_selected: false,
                });
            }
        }

        console.log(this.checkSpaces);
    },
    methods: {
        onVisitPicked() {

        },
        onSpacesChanged() {
            console.log(this.checkSpaces);
        },
        range(start, end) {
            return Array(end - start + 1)
                .fill().map((_, idx) => start + idx)
        },
        onPayDatePicked(isActual) {
            console.log(isActual);
        }
    }
}
</script>
