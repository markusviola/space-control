<template>
    <div>
        <div class="row">
            <div class="col-md-9 form-group">
                <label class="text-muted font-weight-bold" for="type">予約タイプ</label>
                <select
                    class="form-control"
                    id="type"
                    name="type_id"
                    v-model="chosenType"
                    v-on:change="onTypeChanged"
                >
                    <option
                        v-for="(type, index) in types"
                        :key="index"
                        :value="type.id"
                    >{{ type.name }}</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="text-muted font-weight-bold" for="userCount">使用人数</label>
                <input
                    name="user_count"
                    type="number"
                    class="form-control"
                    id="userCount"
                    v-model="chosenNumOfPeople"
                    :disabled="isCoworking"
                    required
                >
            </div>
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

        <div v-if="isRental">
            <div class="row">
                <div v-for="(space, index) in spaces" v-bind:key="index" class="col-md-auto">
                    <div class="d-flex justify-content-between form-group form-check">
                        <input
                            :name="`space_${space.id}`"
                            type="checkbox"
                            class="form-check-input"
                            :id="`space${space.id}`"
                        >
                        <label
                            class="form-check-label"
                            :for="`space${space.id}`"
                        >{{ space.name }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="isCoworking" class="form-group form-check">
            <input
                v-model="willStay"
                name="will_stay"
                type="checkbox"
                class="form-check-input"
                id="willStay"
            >
            <label

                class="form-check-label text-muted font-weight-bold"
                for="willStay"
            >泊まりますか?</label>
        </div>
        <hr>
        <span class="text-muted font-weight-bold">使用日付・時間</span>
        <input type="hidden" name="dates" :value="JSON.stringify(dateTimes)">
        <div v-if="willStay">
            <div class="mt-3 p-0">
                <check-in-out
                    @onCheckInOutChosen="changeDateTime"
                ></check-in-out>
            </div>
        </div>
        <div v-else>
            <div v-for="i in dateIncrement" v-bind:key="i">
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-10 p-0">
                            <schedule-picker
                                @onDateTimeChosen="changeDateTime"
                                :dateTimeId="i"
                            ></schedule-picker>
                        </div>
                        <i
                            v-if="i == dateIncrement"
                            v-on:click="addClicked"
                            class="col-md-1 p-0 fas fa-plus fa-lg edit d-flex align-items-center justify-content-center"
                        ></i>
                        <i
                            v-if="i == dateIncrement && i != 1"
                            v-on:click="removeClicked"
                            class="col-md-1 p-0 fas fa-minus-circle fa-lg delete d-flex align-items-center justify-content-center"
                        ></i>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center">
            <button class="btn btn-anti-neutral text-white" type="submit"><h5 class="m-0">要求を提出する</h5></button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['types', 'spaces'],
        data() {
            return {
                dateIncrement: 1,
                dateTimes: [],
                isCoworking: true,
                isRental: false,
                chosenNumOfPeople: 1,
                chosenType: 1,
                willStay: false,
                currentDate: null,
                currentTime: null,
            }
        },
        mounted() {
            console.log('Space Form mounted successfully.');
        },
        methods: {
            onTypeChanged() {
                this.chosenType;
                switch(this.chosenType) {
                    case 1:
                        this.chosenNumOfPeople = 1;
                        this.isCoworking = true;
                        this.isRental = false;
                        break;
                    case 2:
                        this.isRental = true;
                        this.isCoworking = false;
                        break;
                    default:
                        this.isCoworking = false;
                        this.isRental = false;
                }
            },
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
