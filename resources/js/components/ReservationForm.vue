<template>
    <div class="mt-2">
        <div class="text-right mr-2">
            <h5 v-if="user" class="text-dark my-0">ユーザーモード</h5>
            <h5 v-else class="text-dark my-0">ゲストモード</h5>
        </div>
        <hr class="mt-2">
        <form id="space-form-submit" class="pt-2" action="/forms" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="post_id" :value="post.id">
            <input v-if="user" type="hidden" name="user_id" :value="user.id">
            <form-guest v-else></form-guest>
            <space-form></space-form>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            default: null,
        },
        user: {
            type: [Object, Number],
            default: 0,
        }
    },
    data() {
        return {
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    }
}
</script>
