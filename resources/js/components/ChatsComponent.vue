<template>
    <div class="row">
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Messages</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height: 300px; overflow-y: scroll">
                        <li class="p-2">
                            <strong>Harish</strong>
                            message text
                        </li>
                    </ul>
                </div>
                <input
                    type="text"
                    name="message"
                    placeholder="Enter your message"
                    class="form-control">
                <span class="text-">user is typing...</span>
            </div>
        </div>
        <div class="col-4">

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
