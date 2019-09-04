<template>
    <div class="container">
        <div class="row">

            <span class="col-md-1  d-flex align-items-center justify-content-center">
                <strong class="text-muted">IN</strong>
            </span>

            <div class="col-md-4 p-0 offset-md-1">
                <v-date-picker
                    locale="ja"
                    @input="onDateTimeUpdated"
                    v-model="startDate"
                    :input-props='{
                        readonly: true,
                    }'
                >
                </v-date-picker>
            </div>

            <select
                v-on:change="onDateTimeUpdated"
                v-model="chosenStartHour"
                class="col-md-2 form-control offset-md-1"
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

        </div>
        <div class="row">

            <span class="col-md-1 d-flex align-items-center justify-content-center">
                <strong class="text-muted">OUT</strong>
            </span>

            <div class="col-md-4 p-0 offset-md-1">
                <v-date-picker
                    locale="ja"
                    @input="onDateTimeUpdated"
                    v-model="endDate"
                    :input-props='{
                        readonly: true,
                    }'
                >
                </v-date-picker>
            </div>

            <select
                v-on:change="onDateTimeUpdated"
                v-model="chosenEndHour"
                class="col-md-2 form-control offset-md-1"
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
        props: {
            setDate: {
                type: Object,
                required: null,
            }
        },
        data() {
            return {
                startDate: new Date(),
                endDate: new Date(),
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
            if (this.setDate) {
                this.startDate = this.setDate.startDateTime;
                this.endDate = this.setDate.endDateTime;
                this.chosenStartHour = this.setDate.startDateTime.getHours();
                this.chosenEndHour = this.setDate.endDateTime.getHours();
                this.chosenStartMin = this.setDate.startDateTime.getMinutes();
                this.chosenEndMin = this.setDate.endDateTime.getMinutes();
            }
        },
        methods: {
            range(start, end) {
                return Array(end - start + 1)
                    .fill().map((_, idx) => start + idx)
            },
            onDateTimeUpdated() {

                let startDateTime = new Date(this.startDate);
                let endDateTime = new Date(this.endDate);
                startDateTime.setHours(this.chosenStartHour, this.chosenStartMin);
                endDateTime.setHours(this.chosenEndHour, this.chosenEndMin);

                // Fixes Timezone problem when JSON parsing
                startDateTime = new Date(Date.UTC(
                    startDateTime.getFullYear(),
                    startDateTime.getMonth(),
                    startDateTime.getDate(),
                    startDateTime.getHours(),
                    startDateTime.getMinutes())
                );
                endDateTime = new Date(Date.UTC(
                    endDateTime.getFullYear(),
                    endDateTime.getMonth(),
                    endDateTime.getDate(),
                    endDateTime.getHours(),
                    endDateTime.getMinutes())
                );

                this.$emit('onCheckInOutChosen', {
                    id: 1,
                    startDateTime,
                    endDateTime,
                });
            },
            resetDateTime() {
                this.date = new Date(),
                this.chosenStartHour = 0;
                this.chosenStartMin = 0;
                this.chosenEndHour = 0;
                this.chosenEndMin = 0;
            }
        }
    }
</script>
