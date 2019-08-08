<script>
    import Form from "../../Form";
    import stepActions from "./stepActions";
    export default {
        components: {
            stepActions
        },
        name: "step1Password",
        props: ["step"],
        data: function() {
            return {
                form: new Form({
                    password: '',
                    password_confirmation: ''
                }),
                states:{
                    next: {
                        display:"block",
                        disabled:1,
                    }
                }

            };
        },
        methods: {
            next() {
                // Calls parent component's next method
                this.$emit("next");
            },
            submitForm() {
                this.form.patch("/api/v1/user")
                    .then(data => {
                        this.next()
                        }
                    ).catch(e => {

                    //TODO: add message flash
                })

            },
            checkChars() {
                this.form.errors.clear();
                if(this.form.password.length > 5 && this.form.password_confirmation === this.form.password) {
                    this.states.next.disabled = 0;
                } else {
                    this.states.next.disabled = 1;
                }
            }
        }
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
                    <input type="password" class="form-control" :class="{'is-invalid': (form.errors && form.errors.has('password'))}" id="password" placeholder="Adgangskode" v-model="form.password" @keyup="checkChars" autocomplete="new-password"><br>
                    <input type="password" class="form-control" :class="{'is-invalid': (form.errors && form.errors.has('password'))}" id="password_confirm" placeholder="Bekræft adgangskode" v-model="form.password_confirmation" @keyup="checkChars" autocomplete="new-password">
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
        <step-actions @next="submitForm" :step="step" :states="states"></step-actions>
        <!--end: Form Wizard Step 1-->

    </div>
</template>