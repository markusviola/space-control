<template>
    <div class="modal fade" id="confirmDeletePostModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeletePostModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-admin" id="confirmDeletePostModal"><strong>確認</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-muted">
                このスペースを削除するつもりですか？
            </div>
                <div class="modal-footer">
                    <button
                        @click="onDeletePostClicked"
                        type="button"
                        class="btn-trans text-admin"
                        data-dismiss="modal"
                    >
                        <strong>はい</strong>
                    </button>
                    <button type="button" class="btn-trans text-admin" data-dismiss="modal">
                        <strong>いいえ</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            default: null,
        },
    },
    methods: {
        onDeletePostClicked() {
            axios.delete(`posts/${this.post.id}`)
            .then(() => {
                notifyUser('Space deleted successfully!');
                this.$emit('onPostDeleted', this.post.id);
            })
            .catch(err => {
                const res = err.response;
                if (res.status == 422) {
                    notifyUser('Please re-check your fields!');
                } else notifyUser('Something went wrong.');
                console.log(res);
            })
        }
    }
}
</script>
