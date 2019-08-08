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
            <p>For at kunne benytte WePlan, har vi behov for at behandle visse personlige data om dig. Udover navn, email adresse og et billede af dig, vil der i WePlan også benyttes data omkring administration af afbud til træninger, deltagelse på træninger samt kampstatistikker, alt sammen for at din træner kan tilrettelægge den bedst mulige badmintonoplevelse for dig. Vi beder dig derfor bekræfte at vi må registrere og behandle disse data om dig, så længe du har en tilknytning til klubben. Så snart du stopper med at spille badminton eller skifter klub, vil dine personlige data efterfølgende blive slettet fra vores system, samt data til statistik vil blive anonymiseret. </p>


        </div>
    </div>
        <step-actions @submit="next" :step="step" :states="states"></step-actions>
    <!--end: Form Wizard Step 1-->

    </div>
</template>
