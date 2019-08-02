<script>
    import stepActions from "./stepActions";
    import Form from "../../Form"
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
            submitForm(refs) {
              if(this.form.digits.length == 6) {
                  this.states.next.disabled = 0;
                  this.form.code = "";
                  this.form.digits.forEach(item => {
                      this.form.code = this.form.code + item;
                  });
                  this.form.post("/api/v1/user/activate")
                      .then(data => {
                        document.querySelector(".activation-wrapper").classList.add("success");
                      })
                      .catch(e => {

                          this.form.digits = [];
                          //refs.digit1.focus();
                          document.querySelector(".activation-wrapper").classList.remove("success");
                          document.querySelector(".activation-wrapper").classList.add("failure");
                      })
                  setTimeout(function() {
                      document.querySelector(".activation-wrapper").classList.remove("success");
                      document.querySelector(".activation-wrapper").classList.remove("failure");
                  },2000);

              }
            },
            isNumber(event,refs,index) {
                event = (event) ? event : window.event;
                var charCode = (event.which) ? event.which : event.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    event.preventDefault();
                    console.log("NOPE!")
                } else {
                    this.submitForm(refs);
                    if(index == 6) {
                        index = 0;
                    }
                    let str = "digit" + (index + 1);
                    this.$refs[str][0].focus();
                    //event.target.focus()
                    //this.getRef(index);
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

                                                <input autofocus @keyup="isNumber($event,$refs,n)" :ref="'digit' + n" v-model="form.digits[index]" maxlength="1" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false" type="tel" id="char0" class="form-control" aria-label="Please enter the verification digits Digit 1" placeholder="">
                                            </div>
                                        </template>

                                    </div>
                                </div>



                <a class="si-link ax-outline tk-subbody lite-theme-override" id="no-trstd-device-pop" href="#" aria-haspopup="true">
                    Har du ikke modtaget en aktiveringskode fra os?
                </a>
                <div class="spinner-container verifying-code" id="verifying-code"></div>
            </div>


        </div>
    <step-actions @next="submitForm" :step="step" :states="states"></step-actions>
    </div>
    </div>
</template>