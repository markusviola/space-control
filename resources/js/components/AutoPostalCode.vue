<template>
    <div>
        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">郵便番号</label>

            <div class="col-md-6">
                <input
                    @blur="getPostalCode"
                    v-model="postal_code"
                    type="text"
                    class="form-control"
                    name="address"
                    autofocus
                >
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">住所</label>

            <div class="col-md-6">
                <input v-model="address" type="text" class="form-control" required autofocus>
            </div>
        </div>
    </div>
</template>

<script>
const pCodeParser = require('japan-postal-code');

export default {
    data() {
        return {
            postal_code: '',
            address: '',
        }
    },
    mounted() {
        this.getPostalCode();
    },
    getPostalCode() {
        pCodeParser.get(this.postal_code, (address) => {
            this.address = `${address.prefecture}${address.city}${address.area}${address.street}`
        });
    }

}
</script>
