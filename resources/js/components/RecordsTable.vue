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
             axios.get(`/payments/type/${this.type_id}/individual/${this.filter}`)
            .then(response => {
                console.log(response.data);
            })
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
            handler() {
                this.changeTable();
            }
        }
    }
}
</script>
