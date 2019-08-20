<script>
    export default {
        name: "modal",
        props: ["modalData","title","modalClass"],
        data: function() {
            return {
                test: "yay"
            }
        },
        methods: {
            modalSubmit() {
                this.$root.$emit('modalSubmit');
            }
        }

    }
</script>

<style scoped>

</style>

<template>
    <div class="modal fade" :id="modalData.id" tabindex="-1" role="dialog" :aria-labelledby="title" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" :class="modalClass" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="min-height: 100px;"><slot></slot></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
                <button @click="modalSubmit" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
    </div>

</template>
