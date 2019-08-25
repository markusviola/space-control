<template>
    <div
        class="modal fade"
        id="form-info"
        tabindex="-1"
        role="dialog"
        aria-labelledby="scrollableForm"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="scrollableForm">Form Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-dark mb-3">Client Information</h5>
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
                           <strong class="text-muted">メールアドレス</strong>
                        </div>
                        <div class="col-md-8">{{ form.email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-right border-right">
                           <strong class="text-muted">電話番号</strong>
                        </div>
                        <div class="col-md-8">{{ form.phone }}</div>
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
                    <hr>
                    <h5 class="text-dark mb-3">Reservation</h5>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-right border-right">
                           <strong class="text-muted">Type</strong>
                        </div>
                        <div class="col-md-8">{{ form.type.name }}</div>
                    </div>
                    <div v-if="form.type_id > 1" class="row mb-3">
                        <div class="col-md-4 text-md-right border-right">
                           <strong class="text-muted">No. of People</strong>
                        </div>
                        <div class="col-md-8">{{ form.user_count }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-right border-right">
                           <strong class="text-muted">Reason</strong>
                        </div>
                        <div class="col-md-8">{{ form.reason }}</div>
                    </div>
                    <div v-if="form.type_id == 1" class="row mb-3">
                        <div class="col-md-4 text-md-right border-right">
                           <strong class="text-muted">Stay</strong>
                        </div>
                        <div class="col-md-8">{{ form.will_stay ? 'Yes': 'No' }}</div>
                    </div>
                    <hr>
                    <h5 class="text-dark mb-3">Date &amp; Time</h5>
                    <div v-if="form.will_stay && formDates.length > 0">
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">IN</strong>
                            </div>
                            <strong class="col-md-6 d-flex">
                                <div class="mr-2">{{ formDates[0].sDate }} |</div>
                                <div>{{ `${formDates[0].sHour}:${formDates[0].sMinute}` }}</div>
                            </strong>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right border-right">
                                <strong class="text-muted">OUT</strong>
                            </div>
                            <strong class="col-md-6 d-flex">
                                <div class="mr-2">{{ formDates[0].eDate }} |</div>
                                <div>{{ `${formDates[0].eHour}:${formDates[0].eMinute}` }}</div>
                            </strong>
                        </div>
                    </div>
                    <div v-else>
                        <div v-for="(currDate, index) in formDates" :key="index">
                            <div class="row mb-3">
                                <div class="col-md-4 text-md-right border-right">
                                    <strong class="text-muted">{{ index + 1 }}</strong>
                                </div>
                                <strong class="col-md-8 d-flex">
                                    <div class="mr-2">{{ currDate.sDate }}</div>
                                    <div class="mr-2">{{ `${currDate.sHour}:${currDate.sMinute}` }}</div>
                                    <div>{{ `${currDate.eHour}:${currDate.eMinute}` }}</div>
                                </strong>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-trans anti-neutral" data-dismiss="modal">
                        <strong>Close</strong>
                    </button>
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
            }
        },
        data() {
            return {
                formDates: [],
            }
        },
        methods: {
            arrangeDates(newDates) {
                let currDates = [];

                newDates.forEach(date => {
                    const startDate = new Date(date.start_time);
                    const endDate = new Date(date.end_time);

                    currDates.push({
                        sDate: `${startDate.getFullYear()}-${startDate.getMonth()}-${startDate.getDate()}`,
                        sHour: `${(startDate.getHours()+'').length == 1 ? '0': ''}${startDate.getHours()}`,
                        sMinute: `${(startDate.getMinutes()+'').length == 1 ? '0': ''}${startDate.getMinutes()}`,
                        eDate: `${endDate.getFullYear()}-${endDate.getMonth()}-${endDate.getDate()}`,
                        eHour: `${(endDate.getHours()+'').length == 1 ? '0': ''}${endDate.getHours()}`,
                        eMinute: `${(endDate.getMinutes()+'').length == 1 ? '0': ''}${endDate.getMinutes()}`,
                    });
                });

                this.formDates = currDates;
            }
        },
        watch: {
            form: {
                immediate: true,
                handler(newForm, oldForm) {
                    axios.get(`forms/${newForm.id}/dates`)
                    .then(response => {
                        this.arrangeDates(response.data);
                    })
                }
            }
        }
    }
</script>
