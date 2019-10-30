<template>
    <div class="mt-3">
        <space-post-create :user="user"></space-post-create>
        <hr>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {

        }
    }
}
</script>
