<template>
    <div>
        <input
            type="hidden"
            name="chosenDate"
            :value="date"
        >
        <v-date-picker
            locale="ja"
            @input="onDateClicked"
            v-model="date"
            :input-props='{
                readonly: true,
            }'
        >
        </v-date-picker>
    </div>
</template>

<script>
    export default {
        props: ['dateTimeId'],
        data() {
            return {
                date: new Date(),
            }
        },
        mounted() {
            console.log('Date Picker mounted successfully.');
        },
        methods: {
            onDateClicked() {
                this.$emit('onDateChosen', {
                    id: this.dateTimeId,
                    date: this.date
                });
            }
        }
    }
</script>
