<script>
    import Form from "../../Form"
    import stepActions from "./stepActions";
    export default {
        components: {
            stepActions
        },
        name: "stepsCompleted",
        props: ["step",],
        data: function() {
            return {
                states:{
                    submit: {
                        display:"block",
                        disabled:1,
                    }
                },
                form: new Form({
                    completed: true
                })
            };
        },
        methods: {
            next() {
                //this.$emit("next");
                location.reload();
            },

        },
        watch: {
            step: {
                handler(newVal) {
                    if(newVal.state) {
                        this.form.post("/api/v1/user/complete")
                            .then(data => {
                                this.states.submit.disabled = 0;
                            })
                            .catch(e => {
                                console.log(e);

                                this.states.submit.disabled = 0;
                            })
                    }
                },
                deep: true
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <div>
    <!--begin: Form Wizard Step 1-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
        <div class="kt-heading kt-heading--md">Vi har brug for dit samtykke!</div>
        <div class="kt-separator kt-separator--height-xs"></div>
        <div class="kt-form__section kt-form__section--first">
            <p>TBD </p>


        </div>
    </div>
        <step-actions @submit="next" :step="step" :states="states"></step-actions>
    <!--end: Form Wizard Step 1-->

    </div>
</template>
