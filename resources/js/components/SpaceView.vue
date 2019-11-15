<template>
    <div>
        <div v-if="post.post_image">
            <img
                class="w-100"
                :src="`storage/${post.post_image}`"
            />
            <hr>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">場所のタイトル</strong>
            </div>
            <div class="col-md-8">{{ post.title }}</div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">場所住所</strong>
            </div>
            <div class="col-md-8">{{ post.address || 'なし' }}</div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">営業時間</strong>
            </div>
            <div class="col-md-8 preserve-breaks">{{ post.business_hours || 'なし' }}</div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">使用料金 | 1時間</strong>
            </div>
            <div class="col-md-8">{{ post.per_hour || 0 }} 円</div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 text-md-right border-right">
                <strong class="text-muted">ノート</strong>
            </div>
            <div class="col-md-8 preserve-breaks">{{ post.notes || 'なし' }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            default: null,
        }
    }
}
</script>
