<template>
    <div>
        <div
            v-if="form"
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
                            取引詳細
                        </strong>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <h5
                                    @click="onArrangement = !onArrangement"
                                    :class="`nav-link anti-neutral clickable ${onArrangement ? 'active' : ''}`"
                                >予約情報</h5>
                            </li>
                            <li class="nav-item">
                                <h5
                                    @click="onArrangement = !onArrangement"
                                    :class="`nav-link anti-neutral clickable ${!onArrangement ? 'active' : ''}`"
                                >予約者情報</h5>
                            </li>
                        </ul>
                        <div v-if="onArrangement">
                            <div class="row mb-4">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">問合せ日</strong>
                                </div>
                                <div class="col-md-8">{{ form.created_at }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">使用理由</strong>
                                </div>
                                <div class="col-md-8">{{ form.reason }}</div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">ステータス</strong>
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
                                    <strong class="text-muted">利用区分</strong>
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
                                            個人
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
                                            法人
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">法人名</strong>
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
                                    <strong class="text-muted">使用人数</strong>
                                </div>
                                <div class="col-md-8">
                                    <input
                                        v-model="user_count"
                                        type="number"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">見学日</strong>
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
                                    <strong class="text-muted">見学場所</strong>
                                </div>
                                <div class="col-md-8">
                                    <input
                                        v-model="visit_place"
                                        type="text"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <strong class="text-muted">使用日・時間</strong>
                            </div>
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
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">音を出す</strong>
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
                                            はい
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
                                            いいえ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">備考</strong>
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
                                    <strong class="text-muted">キャンセル理由</strong>
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
                                    <strong class="text-muted">本予約利用時間数</strong>
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
                                    <strong class="text-muted">請求金額</strong>
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
                                    <strong class="text-muted">値引き後</strong>
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
                                    <strong class="text-muted">請求書提示</strong>
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
                                            はい
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
                                            いいえ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">支払日時</strong>
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
                                    <strong class="text-muted">支払日</strong>
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
                        <div class="mt-2" v-else>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">名前</strong>
                                </div>
                                <div class="col-md-8">{{ form.name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">ふりがな</strong>
                                </div>
                                <div class="col-md-8">{{ form.furigana }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">性別</strong>
                                </div>
                                <div class="col-md-8">{{ form.gender ? '女' : '男' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">生年月日</strong>
                                </div>
                                <div class="col-md-8">{{ form.birthday }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">住所</strong>
                                </div>
                                <div class="col-md-8">{{ form.address }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">メールアドレス</strong>
                                </div>
                                <div class="col-md-8">
                                    <input
                                        v-model="email"
                                        type="text"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">電話番号</strong>
                                </div>
                                <div class="col-md-8">
                                    <input
                                        v-model="phone"
                                        type="text"
                                        class="form-control"
                                    >
                                </div>
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
                            <h5><strong>更新する</strong></h5>
                        </button>
                        <button type="button" class="btn-trans text-muted" data-dismiss="modal">
                            <h5><strong>閉める</strong></h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateFormModal" tabindex="-1" role="dialog" aria-labelledby="updateFormModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-admin" id="updateFormModal"><strong>確認</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-muted">
                    この予約情報を更新するつもりですか？
                </div>
                    <div class="modal-footer">
                        <button
                            @click="updateReservation"
                            type="button"
                            class="btn-trans text-secondary"
                            data-dismiss="modal"
                        >
                            <strong>はい</strong>
                        </button>
                        <button type="button" class="btn-trans text-muted" data-dismiss="modal">
                            <strong>いいえ</strong>
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
            default: null,
        },
        statuses: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            onArrangement: true,
            dateIncrement: 0,
            status_id: null,
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
            date_times: [],
            email: null,
            phone: null,
            user_count: null,
            one: true,
            zero: false,
        }
    },
    watch: {
        form: {
            handler(newForm, oldForm) {
                this.updateFormFields();
            }
        }
    },
    methods: {
        updateFormFields() {
            this.status_id = this.form.reservation.status.id;
            this.corporate_name = this.form.reservation.corporate_name;
            this.visit_place = this.form.reservation.visit_place;
            this.remarks = this.form.reservation.remarks;
            this.cancel_reason = this.form.reservation.cancel_reason;
            this.actual_hours = this.form.reservation.actual_hours;
            this.payment_cost = this.form.reservation.payment_cost;
            this.discounted_cost = this.form.reservation.discounted_cost;
            this.phone = this.form.phone;
            this.email = this.form.email;
            this.user_count = this.form.user_count;

            this.invoice = this.form.reservation.invoice ? true : false;
            this.will_noise = this.form.reservation.will_noise ? true : false;
            this.is_independent = this.form.reservation.is_independent ? true : false;

            this.visit_date = this.form.reservation.visit_date ?
                new Date(this.form.reservation.visit_date) : null;
            this.paydate = this.form.reservation.paydate ?
                new Date(this.form.reservation.paydate) : null;
            this.actual_paydate = this.form.reservation.actual_paydate ?
                new Date(this.form.reservation.actual_paydate) : null;

            this.initReservationDates();
        },
        formatToUTC(date) {
            if (date) {
                return new Date(Date.UTC(
                    date.getFullYear(),
                    date.getMonth(),
                    date.getDate(),
                    date.getHours(),
                    date.getMinutes()
                ));
            }
        },
        initReservationDates() {
            this.dateIncrement = 0;
            this.date_times = [];
            if (this.form.schedules.length > 0) {
                this.form.schedules.forEach(schedule => {
                    this.date_times.push({
                        id: ++this.dateIncrement,
                        startDateTime: new Date(schedule.start_time['raw']),
                        endDateTime: new Date(schedule.end_time['raw']),
                    })
                });
            }
        },
        updateReservation() {
            axios.patch(`/reservations/${this.form.reservation.id}/edit`, {
                status_id: this.status_id,
                is_independent: this.is_independent,
                corporate_name: this.corporate_name,
                visit_place: this.visit_place,
                will_noise: this.will_noise,
                email: this.email,
                phone: this.phone,
                remarks: this.remarks,
                invoice: this.invoice,
                cancel_reason: this.cancel_reason,
                paydate: this.formatToUTC(this.paydate),
                visit_date: this.formatToUTC(this.visit_date),
                actual_paydate: this.formatToUTC(this.actual_paydate),
                actual_hours: parseInt(this.actual_hours),
                user_count: parseInt(this.user_count),
                payment_cost: parseFloat(this.payment_cost),
                discounted_cost: parseFloat(this.discounted_cost),
                date_times: JSON.stringify(this.date_times),
            })
            .then(() => {
                window.location.href="#updated-form";
                location.reload();
            });
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
        },
        addClicked() {
            this.dateIncrement+=1;
        },
        removeClicked() {
            this.dateIncrement-=1;
            this.date_times.pop();
        },
        range(start, end) {
            return Array(end - start + 1)
                .fill().map((_, idx) => start + idx)
        },
    }
}
</script>



