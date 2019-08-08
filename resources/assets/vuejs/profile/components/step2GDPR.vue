<script>
    import Form from "../../Form"
    import stepActions from "./stepActions";
    export default {
        components: {
            stepActions
        },
        name: "step2GDPR",
        props: ["step",],
        data: function() {
            return {
                form: new Form({
                    gdpr: ''
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
                this.$emit("next");
            },
            submitForm() {
                if(this.form.gdpr) {
                    this.form.patch("/api/v1/user")
                        .then(data => {
                                this.next()
                            }
                        ).catch(e => {

                        //I don't care about this
                    })
                }
            },
            change() {
                if(this.form.gdpr) {
                    this.states.next.disabled = 0;
                } else {
                    this.states.next.disabled = 1;
                }
            }
        },
    }
</script>

<style scoped>
    .kt-checkbox {
        font-size: 1.6rem;
        padding-left:3rem;
    }
    .kt-checkbox>span {
        border-radius: 3px;
        background: none;
        position: absolute;
        top: 1px;
        left: 0;
        height: 30px;
        width: 30px;
    }
    .kt-checkbox>span:after {
        content: '';
        position: absolute;
        display: none;
        top: 50%;
        left: 50%;
        margin-left: -4px;
        margin-top: -11px;
        width: 10px;
        height: 20px;
        border-width: 0 2px 2px 0/*rtl:ignore*/ !important;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg)/*rtl:ignore*/;
    }
</style>

<template>
    <div>
    <!--begin: Form Wizard Step 1-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
        <div class="kt-heading kt-heading--md">Vi har brug for dit samtykke!</div>
        <div class="kt-separator kt-separator--height-xs"></div>
        <div class="kt-form__section kt-form__section--first">
            <p>For at kunne benytte WePlan, har vi behov for at behandle visse personlige data om dig. Udover navn, email adresse og et billede af dig, vil der i WePlan også benyttes data omkring administration af afbud til træninger, deltagelse på træninger samt kampstatistikker, alt sammen for at din træner kan tilrettelægge den bedst mulige badmintonoplevelse for dig. Vi beder dig derfor bekræfte at vi må registrere og behandle disse data om dig, så længe du har en tilknytning til klubben. Så snart du stopper med at spille badminton eller skifter klub, vil dine personlige data efterfølgende blive slettet fra vores system, samt data til statistik vil blive anonymiseret. </p>
            <div class="form-group">
                <label class="kt-checkbox kt-checkbox--success">
                    <input @change="change" v-model="form.gdpr" type="checkbox" value="1"> Jeg giver hermed mit samtykke til, at WePlan må opbevare og behandle data om mig i henhold til ovenstående formål.

                    <span></span>
                </label>
                <br> Klik her for at læse mere om vores <a href="#">privatlivspolitik</a>.
            </div>

        </div>
    </div>
        <step-actions @next="submitForm" :step="step" :states="states"></step-actions>
    <!--end: Form Wizard Step 1-->

    </div>
</template>
