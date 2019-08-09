<template>

    <div class="row m-0">

        <input type="hidden" name="birthday" :value="finalDate">
        <select
            @change="updateDate()"
            v-model="chosenYear"
            class="col-md-3 form-control p-0 mr-2"
        >
            <option
                v-for="(year, index) in range(startYear, endYear)"
                :key="index"
                :value="year"
                :selected="year == setYear"
            >{{ year }}</option>
        </select>
        <div class="col-md-1 p-0 align-self-center">
            <strong>{{ yearText }}</strong>
        </div>

        <select
            @change="updateDate()"
            v-model="chosenMonth"
            class="col-md-2 form-control p-0 mr-2"
        >
            <option
                v-for="(month, index) in endMonth"
                :key="index"
                :value="month"
            >{{ month }}</option>
        </select>
        <div class="col-md-1 p-0 align-self-center">
            <strong>{{ monthText }}</strong>
        </div>

        <select
            @change="updateDate()"
            v-model="chosenDay"
            class="col-md-2 form-control p-0 mr-2"
        >
            <option
                v-for="(day, index) in endDay"
                :key="index"
                :value="day"
                :disabled="limit < day"
            >{{ day }}</option>
        </select>
        <div class="col-md-1 p-0 align-self-center">
            <strong>{{ dayText }}</strong>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                limit: 31,
                thirties: [2, 4, 6, 9, 11],
                finalDate: null,
                startYear: 1950,
                endYear: 2300,
                endMonth: 12,
                endDay: 31,
                setYear: 2000,
                chosenYear: 2000,
                chosenMonth: 1,
                chosenDay: 1,
                yearText: '年',
                monthText: '月',
                dayText: '日',
            }
        },
        mounted() {
            this.updateDate();
        },
        methods: {
            range(start, end) {
                return Array(end - start + 1)
                    .fill().map((_, idx) => start + idx)
            },
            updateDate() {
                this.checkDayLimit();
                this.finalDate = `${this.chosenYear}-${this.chosenMonth}-${this.chosenDay}`;
            },
            checkDayLimit() {
                if(this.thirties.includes(this.chosenMonth)) {
                    if (this.chosenMonth == 2) {
                        if (this.chosenYear % 4 == 0 &&
                           (this.chosenYear % 100 != 0 ||
                            this.chosenYear % 400 == 0)) {
                            this.limit = 29;
                        } else this.limit = 28;
                    } else this.limit = 30;
                } else this.limit = 31;
            }
        }
    }
</script>
