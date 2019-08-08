<template>
    <div>
        <input
            type="hidden"
            name="chosenDate"
            :value="date"
        >
        <v-date-picker
            locale="ja"
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
        data() {
            return {
                date: new Date(),
            }
        },
        mounted() {
            console.log('DatePicker (JP) component running successfully.');
        },
    }
</script>
