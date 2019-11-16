<template>
    <div>
        <div class="form-group">
            <label class="text-muted font-weight-bold" for="userCount">使用人数</label>
            <input
                name="user_count"
                type="number"
                class="form-control"
                id="userCount"
                v-model="chosenNumOfPeople"
                required
            >
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="reason">使用理由</label>
            <textarea
                name="reason"
                class="form-control"
                id="reason"
                rows="3"
                spellcheck="false"
                required
            ></textarea>
        </div>
        <hr>
        <span class="text-muted font-weight-bold">使用日付・時間</span>
        <input type="hidden" name="dates" :value="JSON.stringify(dateTimes)">
        <div class="mb-4">
            <div v-for="i in dateIncrement" v-bind:key="i">
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-12 p-0">
                            <schedule-picker
                                @onDateTimeChosen="changeDateTime"
                                :dateTimeId="i"
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
        <!-- <hr>
        <div class="d-flex justify-content-center">
            <button class="btn btn-anti-neutral text-white" type="submit"><h5 class="m-0">要求を提出する</h5></button>
        </div> -->
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                default: null,
            }
        },
        data() {
            return {
                dateIncrement: 1,
                dateTimes: [],
                chosenNumOfPeople: 1,
                currentDate: null,
                currentTime: null,
            }
        },
        mounted() {
            console.log('Space Form mounted successfully.');
        },
        methods: {
            changeDateTime(input) {
                let existingKey = false;
                for (let i = 0; i < this.dateTimes.length; i+=1) {
                    if (this.dateTimes[i].id == input.id) {
                        this.dateTimes[i].startDateTime = input.startDateTime;
                        this.dateTimes[i].endDateTime = input.endDateTime;
                        existingKey = true;
                        break;
                    }
                }
                if(!existingKey) this.dateTimes.push(input);
            },
            addClicked() {
                this.dateIncrement+=1;
            },
            removeClicked() {
                this.dateIncrement-=1;
                this.dateTimes.pop();
            }
        }
    }
</script>
