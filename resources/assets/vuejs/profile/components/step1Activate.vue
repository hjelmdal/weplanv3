<script>
    import stepActions from "./stepActions";
    import Form from "../../Form"
    import Notification from "../../Notification";
    export default {
        components: {
            stepActions
        },
        name: "step1Activate",
        props: ["step"],
        data: function () {
            return {
                notification: "",
                states:{
                    next:{
                        display: "block",
                        disabled: 1
                    }

                },
                form: new Form({
                    resetOnSuccess: false,
                    digits: [],
                    code: ""

                })
            }

        },
        methods: {
            next() {
                this.$emit("next");
            },
            submitForm(refs) {
                if(this.form.digits.length == 6) {
                    this.notification = new Notification();
                    this.states.next.disabled = 0;
                    this.form.code = "";
                    this.form.digits.forEach(item => {
                        this.form.code = this.form.code + item;
                    });
                    if(this.form.code.length == 6) {
                        this.form.post("/api/v1/user/activate")
                            .then(data => {
                                document.querySelector(".activation-wrapper").classList.add("success");
                                this.notification.send("success",data.message);
                                this.$emit("next");

                            })
                            .catch(e => {
                                if(e.data) {
                                    this.notification.send("error", e.data.errors.form);
                                }
                                this.form.digits = [];
                                //refs.digit1.focus();
                                document.querySelector(".activation-wrapper").classList.remove("success");
                                document.querySelector(".activation-wrapper").classList.add("failure");
                                refs["digit1"][0].focus();


                            })
                        setTimeout(function () {
                            document.querySelector(".activation-wrapper").classList.remove("success");
                            document.querySelector(".activation-wrapper").classList.remove("failure");
                        }, 4000);
                    }
                }
            },
            resendActivation() {
                this.form.post("/api/v1/user/activate/resend")
                    .then(data => {
                        //console.log(data);
                        this.notification = new Notification();
                        this.notification.send("info",data.message);
                    })
                    .catch(e => {
                        //console.log(e);
                    })
            },
            isNumber(event,refs,index) {

                let val = event.target.value;
                let trueIndex = (index - 1);
                let next = "digit" + (index + 1);
                // Index for key used if the input should go back
                let same = "digit" + (index);
                let prevent = false;
                let key = event.keyCode;
                // is input a number?
                if (key >= 48 && key <= 57) {
                        this.submitForm(refs);
                        //If last input, focus to first
                        if(index == 6) {
                            index = 1;
                            next = "digit" + (index + 1);
                            same = "digit" + (index);
                        }
                        //If value is empty - stay focus on same input
                        if(!this.form.digits[trueIndex]) {
                            //console.log("undef");
                            setTimeout(function () {
                                //console.log("same " + same);
                                refs[same][0].focus()
                            },10);
                        //If input is filled correct, set focus to next input
                        } else {
                            setTimeout(function () {
                                //console.log("next " + next);
                                refs[next][0].focus()
                            },10);
                        }

                        //console.log("form: " + this.form.digits[index-1] + " Input: " + val);
                        //event.target.focus()
                        //this.getRef(index);

                } else {
                    //If not integer, reset value of input and form object
                    event.target.value = "";
                    this.form.digits[trueIndex] = null;

                }

                if(event.shiftKey && event.keyCode == 9) {
                    //console.log("Back tab");//shift was down when tab was pressed
                    prevent = true;
                } else if(event.keyCode == 9) {
                    //console.log("Tab");
                    prevent = true;
                }

            },


        },

        mounted() {
            this.$set(this.states.next,'disabled',1);
            console.log(this.$refs);
        }
    }
</script>

<style scoped>
    .col-sm-1 input {
        width: 45px;
        height: 45px;
        font-size: 24px;
        padding: 0;
        text-align: center;
    }
    .activation-wrapper.success .form-control {
        border-color: #1dc9b7;
    }

    .activation-wrapper.failure .form-control {
        border-color: #fd397a;
    }
    @media (max-width: 575px) {
        .col-sm-1 {
            width: 14% !important;
        }
        .col-sm-1 input {
            width: 30px;
            height: 45px;
            font-size: 2rem;
            padding: 0;
            text-align: center;
        }
    }
</style>
<template>
    <div>
        <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
            <div class="verify-device fade-in ">
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <h1 style="text-align: center;" tabindex="-1">
                                Aktiveringskode
                            </h1>
                            <div class="si-info">
                                <p>
                                    Vi har sendt dig en email med en aktiveringskode. Find koden i emnefeltet samt teksten fra emailen.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="activation-wrapper">
                        <div class="row justify-content-center">
                            <template v-for="(n,index) in 6">
                                <div v-if="n == 4" class="col-sm-1" style="align-self: center; text-align: center; font-size: 2rem; font-weight: bold; padding-right: 0px;">-</div>

                                <div class="col-sm-1">

                                    <input autofocus @keyup="isNumber($event,$refs,n)" :ref="'digit' + n" maxlength="1" v-model="form.digits[index]" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false" type="tel" id="char0" class="form-control" aria-label="Please enter the verification digits" placeholder="">
                                </div>
                            </template>

                        </div>
                    </div>



                    <a @click="resendActivation" class="si-link ax-outline tk-subbody lite-theme-override" id="no-trstd-device-pop" href="#" aria-haspopup="true">
                        Har du ikke modtaget en aktiveringskode fra os? - klik her!
                    </a>
                    <div class="spinner-container verifying-code" id="verifying-code"></div>
                </div>


            </div>
            <step-actions @next="next" :step="step" :states="states"></step-actions>
        </div>
    </div>
</template>