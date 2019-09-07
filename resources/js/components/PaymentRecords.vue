<template>
    <div>
        <hr>
        <ul class="nav nav-tabs mt-2 text-secondary">
            <li v-for="(type, index) in types" :key="index" class="nav-item">
                <div
                    @click="onTypeChosen(type.id)"
                    :class="`nav-link clickable ${ type.id == chosen_type ? 'active' : '' }`"
                >{{ type.name }}</div>
            </li>
        </ul>
        <div class="row mb-2 mt-3">
            <div class="col-md-2 offset-md-7 text-right px-0 pt-2">
                <strong class="text-muted">Filter</strong>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select
                        v-model="chosen_filter"
                        class="form-control"
                    >
                        <option
                            :value="filter_choices[0]"
                            :selected="chosen_filter == filter_choices[0]"
                        >All</option>
                        <option
                            :value="filter_choices[1]"
                            :selected="chosen_filter == filter_choices[1]"
                        >Individual</option>
                        <option
                            :value="filter_choices[2]"
                            :selected="chosen_filter == filter_choices[2]"
                        >Corporate</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="payment-wrapper">
            <records-table
                :type_id="chosen_type"
                :filter="chosen_filter"
            ></records-table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        types: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            chosen_filter: 'default',
            chosen_type: 2,
            filter_choices: ['default', 'true', 'false']
        }
    },
    methods: {
        onTypeChosen(id) {
            this.chosen_type = id;
        },
    }
}
</script>
