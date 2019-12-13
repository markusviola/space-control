<template>
    <div>
        <hr>
        <div class="row mb-2 mt-3">
            <div class="col-2 offset-7 text-right px-0 pt-2">
                <strong class="text-muted">フィルタ</strong>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select
                        v-model="chosen_filter"
                        class="form-control"
                    >
                        <option
                            :value="filter_choices[0]"
                            :selected="chosen_filter == filter_choices[0]"
                        >全て</option>
                        <option
                            :value="filter_choices[1]"
                            :selected="chosen_filter == filter_choices[1]"
                        >個人</option>
                        <option
                            :value="filter_choices[2]"
                            :selected="chosen_filter == filter_choices[2]"
                        >法人</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="payment-wrapper">
            <records-table
                :filter="chosen_filter"
            ></records-table>
        </div>
        <hr class="mt-0 mb-3">
        <div class="text-center font-weight-bold">
            <a
                class="anti-neutral"
                :href="`/reservations`"
            ><h5 class="m-0">予約管理に戻る</h5></a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            chosen_filter: 'default',
            filter_choices: ['default', 'true', 'false']
        }
    },
}
</script>
