<script>
    import Form from "../../Form";
    export default {
        name: "step1Password",
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
                this.form.patch("/api/v1/user")
                    .then(data => {
                        this.next()
                        }
                    ).catch(e => {

                    //I don't care about this
                })

            }
        },
    }

</script>

<style scoped>
 .cap1::first-letter {
     text-transform: uppercase;
 }
</style>

<template>
    <div>
        <!--begin: Form Wizard Step 1-->
        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
            <div class="kt-heading kt-heading--md">Sæt din nye adgangskode</div>
            <div class="kt-separator kt-separator--height-xs"></div>
            <div class="kt-form__section kt-form__section--first">
                <p>Tillykke med din nye konto hos os. For at kunne logge ind på vores site uden om Facebook / Google, skal du sætte et personligt password.</p>
                <div class="form-group">
                    <label for="password">Dit nye password</label>
                    <input type="password" class="form-control" :class="{'is-invalid': (form.errors && form.errors.has('password'))}" id="password" placeholder="Adgangskode" v-model="form.password" @keyup="form.errors.clear()" autocomplete="new-password"><br>
                    <input type="password" class="form-control" :class="{'is-invalid': (form.errors && form.errors.has('password'))}" id="password_confirm" placeholder="Bekræft adgangskode" v-model="form.password_confirmation" autocomplete="new-password">
                    <div class="kt-section__content kt-section__content--border" v-if="form.errors && (form.errors.has('password') || form.errors.has('form'))">
                        <hr />
                        <div class="alert alert-secondary" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                            <div class="alert-text">
                                <ul>


                                    <li class="cap1" v-for="error in form.errors.get('password',true)" v-text="error"></li>
                                    <li class="cap1" v-for="error in form.errors.get('form',true)" v-text="error"></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
            <!--begin: Form Actions -->
            <div class="kt-form__actions">
                <div class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
                    Forrige
                </div>
                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
                    Færdig
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