<script>
    import stepActions from "./stepActions";
    export default {
        components: {
          stepActions
        },
        name: "step0Welcome",
        props: ["step"],
        data: function () {
            return {
                states:{
                    next:{
                        display: "block",
                        disabled: 0
                    }

                }
            }

        },
        methods: {
            next() {
                this.$emit("next");
            },

        },
        mounted() {
            this.$set(this.states.next,'disabled',0)
        }
    }
</script>

<style scoped>

</style>
<template>
    <step-actions @next="next" :step="step" :states="states"></step-actions>
</template>