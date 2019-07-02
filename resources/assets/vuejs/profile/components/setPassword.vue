<script>
    import Form from "../../Form";
    export default {
        name: "setPassword",
        props: ["step"],
        data: function() {
            return {
                form: new Form({
                    password: '',
                    password_confirmation: ''
                }),

            };
        },
        methods: {
            next() {
                this.$emit("next");
            },
            submitForm() {
                this.form.post("/api/v1/test");
            }
        },
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
                <p>Tillykke med din nye konto hos os. For at kunne logge ind på vores site uden om Facebook / Google, skal du sætte et personligt password.</p>
                <div class="form-group">
                    <label for="password">Dit nye password</label>
                    <input type="password" class="form-control" :class="{'is-invalid': (form.errors.has('password'))}" id="password" placeholder="Password" v-model="form.password" @keyup="form.errors.clear()" autocomplete="new-password">
                    <div v-if="form.errors.has('password')" class="invalid-feedback" v-text="form.errors.get('password')"></div>
                    <input type="password" class="form-control" :class="{'is-invalid': (form.errors.has('password'))}" id="password_confirm" placeholder="Password" v-model="form.password_confirmation">
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
                <div @click="submitForm" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
                    Næste
                </div>
            </div>
            <!--end: Form Actions -->
        </div>
        <!--end: Form Wizard Step 1-->

    </div>
</template>