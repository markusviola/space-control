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
                        v-on:change="onClientChosen"
                        v-model="client"
                        class="form-control"
                    >
                        <option
                            :value="filter_choices[0]"
                            :selected="client == filter_choices[0]"
                        >All</option>
                        <option
                            :value="filter_choices[1]"
                            :selected="client == filter_choices[1]"
                        >Individual</option>
                        <option
                            :value="filter_choices[2]"
                            :selected="client == filter_choices[2]"
                        >Corporate</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="payment-wrapper">
            <div class="text-center">
            </div>
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
            client: 'default',
            chosen_type: 2,
            filter_choices: ['default', 'true', 'false']
        }
    },
    mounted() {

    },
    methods: {
        onTypeChosen(id) {
            this.chosen_type = id;
        },
        onClientChosen() {
            console.log(this.client);
        }
    }
}
</script>
