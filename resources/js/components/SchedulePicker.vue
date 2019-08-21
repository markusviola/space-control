<template>
    <div class="container">
        <div class="row">

            <div class="col-md-3 p-0">
                <v-date-picker
                    locale="ja"
                    @input="onDateTimeUpdated"
                    v-model="date"
                    :input-props='{
                        readonly: true,
                    }'
                >
                </v-date-picker>
            </div>

            <select
                v-on:change="onDateTimeUpdated"
                v-model="chosenStartHour"
                class="col-md-2 form-control"
            >
                <option
                    v-for="(hour, index) in range(startHour, endHour)"
                    :key="index"
                    :value="hour"
                >{{ `${hour}`.length == 1 ? `0${hour}` : hour }}</option>
            </select>

            <select
                v-on:change="onDateTimeUpdated"
                v-model="chosenStartMin"
                class="col-md-2 form-control"
            >
                <option
                    v-for="(minute, index) in range(startMin, endMin)"
                    :key="index"
                    :value="minute"
                >{{ `${minute}`.length == 1 ? `0${minute}` : minute }}</option>
            </select>

            <span class="col-md-1 p-0 d-flex align-items-center justify-content-center">
                <strong>to</strong>
            </span>

            <select
                v-on:change="onDateTimeUpdated"
                v-model="chosenEndHour"
                class="col-md-2 form-control"
            >
                <option
                    v-for="(hour, index) in range(startHour, endHour)"
                    :key="index"
                    :value="hour"
                >{{ `${hour}`.length == 1 ? `0${hour}` : hour }}</option>
            </select>

            <select
                v-on:change="onDateTimeUpdated"
                v-model="chosenEndMin"
                class="col-md-2 form-control"
            >
                <option
                    v-for="(minute, index) in range(startMin, endMin)"
                    :key="index"
                    :value="minute"
                >{{ `${minute}`.length == 1 ? `0${minute}` : minute }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dateTimeId'],
        data() {
            return {
                date: new Date(),
                startHour: 0,
                startMin: 0,
                endHour: 23,
                endMin: 59,
                chosenStartHour: 0,
                chosenStartMin: 0,
                chosenEndHour: 0,
                chosenEndMin: 0,
            }
        },
        mounted() {
            console.log('Date Picker mounted successfully.');
        },
        methods: {
            range(start, end) {
                return Array(end - start + 1)
                    .fill().map((_, idx) => start + idx)
            },
            onDateTimeUpdated() {
                let startDateTime = new Date(this.date);
                let endDateTime = new Date(this.date);
                startDateTime.setHours(this.chosenStartHour, this.chosenStartMin);
                endDateTime.setHours(this.chosenEndHour, this.chosenEndMin);

                this.$emit('onDateTimeChosen', {
                    id: this.dateTimeId,
                    startDateTime,
                    endDateTime,
                });
            }
        }
    }
</script>
