<template>
    <div>
        <input
            type="hidden"
            name="birthday"
            :value="birthday"
        >
        <v-date-picker
            locale="ja"
            v-model="birthday"
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
                birthday: new Date(),
                isDisabled: true,
            }
        },
        mounted() {
            console.log('DatePicker (JP) component running successfully.');
        },
    }
</script>
