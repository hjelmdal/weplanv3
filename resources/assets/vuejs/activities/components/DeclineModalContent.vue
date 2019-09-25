<script>
    export default {
        name: "DeclineModalContent",
        props:["activity","calendar"],
        methods: {
            decline(event) {
                //console.log(this.activity);
                this.respond = true;
                this.$root.$emit("declineActivity",{'event': event,'formData':this.activity})

            },
        }

    }
</script>

<style scoped>

</style>

<template>
    <button @click="decline($event)" type="button" class="btn btn-danger kt-margin-10"><i class="fa fa-door-open"></i> Afbud</button>
</template>
