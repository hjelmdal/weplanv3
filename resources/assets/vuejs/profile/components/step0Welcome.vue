<script>
    import stepActions from "./stepActions";
    import Form from "../../Form"
    import Notification from "../../Notification";
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
            }



        },


    }
</script>

<style scoped>
</style>
<template>
    <div>
        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
        <div class="verify-device fade-in ">
            <div class="">
                <div class="row">
                    <div class="col-12">
                <h1 style="text-align: center;" tabindex="-1">
                    Velkommen til!
                </h1>
                        <div class="si-info">
                            <p>
                                Før du kan bruge WePlan, mangler vi nogle oplysninger fra dig, som du nu vil blive guidet igennem
                            </p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    <step-actions @next="next" :step="step" :states="states"></step-actions>
    </div>
    </div>
</template>