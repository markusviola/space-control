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
                                        :value="one"
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
                                        :value="zero"
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
                                <strong class="text-muted">Visit Place</strong>
                            </div>
                            <div class="col-md-8">
                                <input
                                    v-model="visit_place"
                                    type="text"
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div v-if="type_id == 2" class="row mb-3">
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
                                                v-model="check_spaces[index].is_selected"
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
                        <div v-if="type_id == 1" class="row mb-2">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">Stay Over?</strong>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input
                                        v-model="will_stay"
                                        class="form-check-input"
                                        type="radio" id="willStay"
                                        :value="one"
                                    >
                                    <label class="form-check-label" for="willStay">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        v-model="will_stay"
                                        class="form-check-input"
                                        type="radio"
                                        id="wontStay"
                                        :value="zero"
                                    >
                                    <label class="form-check-label" for="wontStay">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <strong class="text-muted">Schedules</strong>
                        </div>
                        <div v-if="will_stay">
                            <div class="container mt-3 p-0 px-4">
                                <check-in-out
                                    :setDate="date_times[0]"
                                    @onCheckInOutChosen="changeDateTime"
                                ></check-in-out>
                            </div>
                        </div>
                        <div v-else>
                            <div v-for="i in dateIncrement" v-bind:key="i">
                                <div class="container">
                                    <div class="row mt-3">
                                        <div class="col-md-12 p-0">
                                            <schedule-picker
                                                @onDateTimeChosen="changeDateTime"
                                                :dateTimeId="i"
                                                :setDate="date_times[i-1]"
                                            ></schedule-picker>
                                        </div>
                                        <div
                                            v-if="i == dateIncrement"
                                            class="col-md-12 p-0 d-flex justify-content-end px-1"
                                        >
                                            <i
                                                v-on:click="addClicked"
                                                class="fas fa-plus fa-lg edit mt-3"
                                            ></i>
                                            <i
                                                v-if="i != 1"
                                                v-on:click="removeClicked"
                                                class="fas fa-minus-circle fa-lg delete pl-3 mt-3"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
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
                                        :value="one"
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
                                        :value="zero"
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
                        <div v-if="status_id == 4" class="row mb-3">
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
                                        :value="one"
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
                                        :value="zero"
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
                        <button
                            type="button"
                            class="btn-trans text-secondary"
                            data-dismiss="modal"
                            data-toggle="modal"
                            data-target="#updateFormModal"
                        >
                            <strong>Update</strong>
                        </button>
                        <button type="button" class="btn-trans text-muted" data-dismiss="modal">
                            <strong>Close</strong>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateFormModal" tabindex="-1" role="dialog" aria-labelledby="updateFormModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-admin" id="updateFormModal"><strong>Confirmation</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-muted">
                    Do you really intend to update this reservation?
                </div>
                    <div class="modal-footer">
                        <button
                            @click="updateReservation"
                            type="button"
                            class="btn-trans text-admin"
                            data-dismiss="modal"
                        >
                            <strong>YES</strong>
                        </button>
                        <button type="button" class="btn-trans text-admin" data-dismiss="modal">
                            <strong>NO</strong>
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
        type_id: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            dateIncrement: 0,
            status_id: null,
            discovery_id: null,
            is_independent: null,
            corporate_name: null,
            visit_date: null,
            visit_place: null,
            will_noise: null,
            will_stay: null,
            remarks: null,
            cancel_reason: null,
            actual_hours: null,
            payment_cost: null,
            discounted_cost: null,
            invoice: null,
            paydate: null,
            actual_paydate: null,
            check_spaces: [],
            date_times: [],
            one: true,
            zero: false,
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
        this.will_stay = this.form.will_stay ? true : false;
        this.is_independent = this.form.reservation.is_independent ? true : false;

        this.visit_date = this.form.reservation.visit_date ?
            new Date(this.form.reservation.visit_date) : null;
        this.paydate = this.form.reservation.paydate ?
            new Date(this.form.reservation.paydate) : null;
        this.actual_paydate = this.form.reservation.actual_paydate ?
            new Date(this.form.reservation.actual_paydate) : null;

        if (this.type_id == 2) {
            for (let i = 0; i < this.spaces.length; i+=1) {
                let hasMatch = false;
                for (let j = 0; j < this.form.bulk_spaces.length; j+=1) {
                    if (this.form.bulk_spaces[j].space_id == this.spaces[i].id) {
                        hasMatch = !hasMatch;
                        this.check_spaces.push({
                            id: this.spaces[i].id,
                            is_selected: hasMatch
                        });
                        break;
                    }
                }
                if (!hasMatch) {
                    this.check_spaces.push({
                        id: this.spaces[i].id,
                        is_selected: false,
                    });
                }
            }
        }

        this.initReservationDates();
    },
    methods: {
        initReservationDates() {
            if (this.form.schedules.length > 0) {
                this.form.schedules.forEach(schedule => {
                    this.date_times.push({
                        id: ++this.dateIncrement,
                        startDateTime: new Date(schedule.start_time),
                        endDateTime: new Date(schedule.end_time),
                    })
                });
            }
        },
        updateReservation() {
            axios.patch(`/reservations/${this.form.reservation.id}/edit`, {
                type_id: this.type_id,
                status_id: this.status_id,
                discovery_id: this.discovery_id,
                is_independent: this.is_independent,
                corporate_name: this.corporate_name,
                visit_date: this.visit_date,
                visit_place: this.visit_place,
                will_noise: this.will_noise,
                will_stay: this.will_stay,
                remarks: this.remarks,
                cancel_reason: this.cancel_reason,
                actual_hours: this.actual_hours,
                payment_cost: this.payment_cost,
                discounted_cost: this.discounted_cost,
                invoice: this.invoice,
                paydate: this.paydate,
                actual_paydate: this.actual_paydate,
                check_spaces: JSON.stringify(this.check_spaces),
                date_times: JSON.stringify(this.date_times),
            })
            .then(response => {
                console.log(response.data);
                // if (response.data) {
                //     notifyUser("Reservation approved! ");
                //     this.$emit('onFormApproval', response.data);
                // } else notifyUser("Something went wrong.");
            })
        },
        changeDateTime(input) {
            let existingKey = false;
            for (let i = 0; i < this.date_times.length; i+=1) {
                if (this.date_times[i].id == input.id) {
                    this.date_times[i].startDateTime = input.startDateTime;
                    this.date_times[i].endDateTime = input.endDateTime;
                    existingKey = true;
                    break;
                }
            }
            if(!existingKey) this.date_times.push(input);
            console.log(this.date_times);
        },
        addClicked() {
            this.dateIncrement+=1;
        },
        removeClicked() {
            this.dateIncrement-=1;
        },
        range(start, end) {
            return Array(end - start + 1)
                .fill().map((_, idx) => start + idx)
        },
    }
}
</script>
