<script>
    import stepActions from "./stepActions";
    export default {
        components: {
          stepActions
        },
        name: "step0Welcome",
        props: ["step"],

        created() {
            Event.$on("next",(step) => { Event.$emit("successNext",step); console.log("yay");})
        }
    }
</script>

<style scoped>

</style>
<template>
    <step-actions :step="step"></step-actions>
</template>