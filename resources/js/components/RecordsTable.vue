<template>
    <div>
        <!-- <table v-if="type_id == 2" class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">使用日-年-月</th>
                    <th scope="col">請求金額</th>
                    <th scope="col">教室 A</th>
                    <th scope="col">教室 B</th>
                    <th scope="col">音楽室</th>
                    <th scope="col">屋上</th>
                    <th scope="col">昇降口</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(record, index) in sortRecords" :key="index">
                    <th scope="row">{{ `${record.year}-${record.month}月` }}</th>
                    <td>{{ record.total }}</td>
                    <td>{{ record.space1 || 0 }}</td>
                    <td>{{ record.space2 || 0 }}</td>
                    <td>{{ record.space3 || 0 }}</td>
                    <td>{{ record.space4 || 0 }}</td>
                    <td>{{ record.space5 || 0 }}</td>
                </tr>
            </tbody>
        </table> -->
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">使用日-年-月</th>
                    <th scope="col">請求金額</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(record, index) in sortRecords" :key="index">
                    <th scope="row">{{ `${record.year}-${record.month}月` }}</th>
                    <td>{{ record.total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        filter: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            records: [],
        }
    },
    methods: {
        changeTable() {
             axios.get(`/payments/individual/${this.filter}`)
            .then(response => {
                this.records = response.data;
            })
        }
    },
    computed: {
        sortRecords() {
            return this.records.sort((a, b) => {
                return `${b.year}${b.month}` - `${a.year}${a.month}`;
            });
        }
    },
    watch: {
        filter: {
            immediate: true,
            handler() {
                this.changeTable();
            }
        }
    }
}
</script>
