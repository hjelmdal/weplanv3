<script>
    import Form from "../../../resources/assets/vuejs/Form"
    export default {
        name: "step1Content",
        props: ["step"],
        data: function() {
            return {
                form: new Form({
                    checkbox: ''
                })
            };
        },
        methods: {
            next() {
                this.$emit("next");
            },
            submitForm() {
                this.form.post("/api/v1/test").then(response => console.log(response));
            }
        },
        mounted() {
            //this.onSubmit();
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
            <p>For at kunne benytte WePlan, har vi behov for at behandle visse personlige data fra dig. Udover navn og email adresse, vil der i WePlan også benyttes data omkring administration af afbud til træninger, deltagelse på træninger samt kampstatistikker, alt sammen for at din træner kan tilrettelægge den bedst mulige badmintonoplevelse for dig. Vi beder dig derfor bekræfte at vi må registrere og behandle disse data om dig, så længe du har en tilknytning til klubben. Så snart du stopper med at spille badminton eller skifter klub, vil dine personlige data efterfølgende blive slettet fra vores system, samt data til statistik vil blive anonymiseret. </p>
            <div class="form-group">
                <label class="kt-checkbox kt-checkbox--success">
                    <input @change="submitForm" v-model="form.checkbox" type="checkbox" value="1"> Jeg giver hermed mit samtykke til, at WePlan må opbevare og behandle data om mig i henhold til ovenstående formål.
                    <br> Klik her for at læse mere om vores <a href="#">privatlivspolitik</a>.
                    <span></span>
                </label>
            </div>

        </div>
    </div>
    <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
        <!--begin: Form Actions -->
        <div class="kt-form__actions">
            <div class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
                Previous
            </div>
            <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
                Submit
            </div>
            <div @click="next" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
                Next Step
            </div>
        </div>
        <!--end: Form Actions -->
    </div>
    <!--end: Form Wizard Step 1-->

    </div>
</template>
