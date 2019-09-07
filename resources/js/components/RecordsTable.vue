<template>
    <div>
        what
    </div>
</template>

<script>
export default {
    props: {
        type_id: {
            type: Number,
            required: true,
        },
        filter: {
            type: String,
            required: true,
        }
    },
    data() {
        return {

        }
    },
    methods: {
        changeTable() {

        }
    },
    watch: {
        type_id: {
            immediate: true,
            handler() {
                this.changeTable();
            }
        },
        filter: {
            immediate: true,
            handler() {
                this.changeTable();
            }
        }
    }
}
</script>
