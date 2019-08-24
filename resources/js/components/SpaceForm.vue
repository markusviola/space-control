<template>
    <div>
        <div class="row">
            <div class="col-md-9 form-group">
                <label for="type">Type of Reservation</label>
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
                <label for="userCount">No. of People</label>

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
            <label for="reason">Reason for Using</label>
            <textarea
                name="reason"
                class="form-control"
                id="reason"
                rows="3"
                required
            ></textarea>
        </div>

        <div v-if="isRental">
            <div class="row">
                <div v-for="space in spaces" v-bind:key="space" class="col-md-3">
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
                name="will_stay"
                type="checkbox"
                class="form-check-input"
                id="willStay"
            >
            <label
                class="form-check-label"
                for="willStay"
            >Will you stay over?</label>
        </div>
        <hr>
        <span>Date and Time:</span>
        <input type="hidden" name="dates" :value="JSON.stringify(dateTimes)">
        <div v-if="chosenType == 1">
            <check-in-out></check-in-out>
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
                        <div v-if="i == dateIncrement"
                            v-on:click="addClicked"
                            class="col-md-1 p-0 offset-md-1 btn btn-anti-neutral text-white d-flex align-items-center justify-content-center"
                        >Add</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center">
            <button class="btn btn-anti-neutral text-white" type="submit">Submit Reservation</button>
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

                if (this.dateTimes.length > 1) {
                    for (let i = 0; i < this.dateTimes.length; i+=1) {
                        let existDate = new Date(this.dateTimes[i].startDateTime);
                        let inputDate = new Date(input.startDateTime);
                        if (existDate.toDateString() == inputDate.toDateString()) {
                            existingDuplicate = true;
                            break;
                        }
                    }
                }
                console.log(this.dateTimes);
            },
            addClicked() {
                this.dateIncrement+=1;
            }
        }
    }
</script>
