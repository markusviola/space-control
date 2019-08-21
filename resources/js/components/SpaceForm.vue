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

        <div v-if="isCoworking" class="form-group form-check">
            <input
                name="will_stay"
                type="checkbox"
                class="form-check-input"
                id="willStay"
                v-model="willStay"
            >
            <label
                class="form-check-label"
                for="willStay"
            >Will you stay over?</label>
        </div>
        <hr>
        <span>Date and Time:</span>
        <input type="hidden" name="datesLength" :value="dateTimes.length">
        <div v-for="i in dateIncrement" v-bind:key="i">
            <div class="container">
                <div class="row mt-3">
                    <input type="hidden" :name="`date${i}`" :value="dateTimes[i - 1]">
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
        <hr>
        <div class="d-flex justify-content-center">
            <button class="btn btn-anti-neutral text-white" type="submit">Submit Reservation</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['types'],
        data() {
            return {
                dateIncrement: 1,
                dateTimes: [],
                isCoworking: true,
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
                if (this.chosenType == 1) {
                    this.chosenNumOfPeople = 1;
                    this.isCoworking = true;
                } else this.isCoworking = false;
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
                if(!existingKey) {
                    this.dateTimes.push(input)
                }
                console.log(this.dateTimes);
            },
            addClicked() {
                this.dateIncrement+=1;
            }
        }
    }
</script>
