<template>
    <div>
    <div id="wizzard_overlay">

    </div>

    <div class="container-fluid" id="wizzard_container">
        <div class="kt-portlet" id="portlet_block">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-grid--desktop-xl kt-grid--ver-desktop-xl kt-wizard-v1 kt-wizard-v1--extend" id="kt_wizard_v4" data-ktwizard-state="first">
                    <div class="kt-grid__item kt-wizard-v1__aside">

                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v1__nav">
                            <div class="kt-wizard-v1__nav-items">
                                <a v-for="step in steps" class="kt-wizard-v1__nav-item" href="#" data-ktwizard-type="step" :data-ktwizard-state="step.state" v-on:click="setStep(step.step)">
                                    <span v-if="step.state == 'done'" v-html="step.icon"></span>
                                    <span v-else v-text="step.step"></span>
                                </a>
                            </div>
                            <div class="kt-wizard-v1__nav-details">
                                <div class="kt-wizard-v1__nav-item-wrapper" data-ktwizard-type="step-info" :data-ktwizard-state="getStep(1)">
                                    <div class="kt-wizard-v1__nav-item-title">
                                        Setup Your Account
                                    </div>
                                    <div class="kt-wizard-v1__nav-item-desc">
                                        To start off, please enter your username, email address and password.
                                        <img src="/base/media/wizard/undraw_checklist_7q37.svg" alt="image" class="kt-wizard-v1__nav-image">
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item-wrapper" data-ktwizard-type="step-info" :data-ktwizard-state="getStep(2)">
                                    <div class="kt-wizard-v1__nav-item-title">
                                        Setup Your Profile
                                    </div>
                                    <div class="kt-wizard-v1__nav-item-desc">
                                        Please enter your name and contact number.Your mailing address is optional.
                                        <img src="/base/media/wizard/undraw_resume_folder_2_arse.svg" alt="image" class="kt-wizard-v1__nav-image">
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item-wrapper" data-ktwizard-type="step-info" :data-ktwizard-state="getStep(3)">
                                    <div class="kt-wizard-v1__nav-item-title">
                                        Setup Your Billing Details
                                    </div>
                                    <div class="kt-wizard-v1__nav-item-desc">
                                        Please ensure your billing details are up-to-date and accurate for us to server you better.
                                        <img src="/base/media/wizard/undraw_live_collaboration_2r4y.svg" alt="image" class="kt-wizard-v1__nav-image">
                                    </div>
                                </div>
                                <div class="kt-wizard-v1__nav-item-wrapper" data-ktwizard-type="step-info" :data-ktwizard-state="getStep(4)">
                                    <div class="kt-wizard-v1__nav-item-title">
                                        Confirm Your Settings
                                    </div>
                                    <div class="kt-wizard-v1__nav-item-desc">
                                        Please read our <a href="javascript:;">Terms and Conditions</a> and check to agree before you can complete your registration.
                                        <img src="/base/media/wizard/undraw_hiring_cyhs.svg" alt="image" class="kt-wizard-v1__nav-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Form Wizard Nav -->

                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                        <!--begin: Form Wizard Form-->
                        <form class="kt-form" id="kt_form" novalidate="novalidate">

                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="getStep(1)">
                                <div class="kt-heading kt-heading--md">Setup Your Account</div>
                                <div class="kt-separator kt-separator--height-xs"></div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" class="form-control" name="username" placeholder="Enter username" value="username">
                                        <span class="form-text text-muted">Please enter your username</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address:</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter email" value="username@email.com">
                                        <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter password" value="password123">
                                        <span class="form-text text-muted">Enter your password. Min 6 characters long.</span>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"  :data-ktwizard-state="getStep(2)">
                                <div class="kt-heading kt-heading--md">Setup Your Profile</div>
                                <div class="kt-separator kt-separator--height-sm"></div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter your name" value="Nick Strong">
                                                <span class="form-text text-muted">Please enter your full name</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contact:</label>
                                                <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" value="1-541-754-3010">
                                                <span class="form-text text-muted">Enter your contact number</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-heading kt-heading--md">Mailing Address</div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address Line 1:</label>
                                                <input type="text" class="form-control" name="address1" placeholder="" value="Headquarters 1120 N Street Sacramento 916-654-5266">
                                            </div>
                                            <div class="form-group">
                                                <label>City:</label>
                                                <input type="text" class="form-control" name="city" placeholder="" value="Polo Alto">
                                            </div>
                                            <div class="form-group">
                                                <label>State:</label>
                                                <input type="text" class="form-control" name="state" placeholder="" value="California">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address Line 2:</label>
                                                <input type="text" class="form-control" name="address2" placeholder="" value="P.O. Box 942873 Sacramento, CA 94273-0001">
                                            </div>
                                            <div class="form-group">
                                                <label>Zip Code:</label>
                                                <input type="number" class="form-control" name="zip" placeholder="" value="942873">
                                            </div>
                                            <div class="form-group">
                                                <label>Country:</label>
                                                <select name="country" class="form-control">
                                                    <option value="">Select</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 2-->

                            <!--begin: Form Wizard Step 3-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="getStep(3)">
                                <div class="kt-heading kt-heading--md">Setup Billing Account</div>
                                <div class="kt-separator kt-separator--height-xs"></div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Cardholder Name:</label>
                                                <input type="text" class="form-control" name="billing_card_name" placeholder="" value="Nick Stone">
                                                <span class="form-text text-muted">Please enter the cardholder name</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Card number:</label>
                                                <input type="number" class="form-control" name="billing_card_number" placeholder="" value="372955886840581">
                                                <span class="form-text text-muted">Enter the card number</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Exp Month:</label>
                                                <select class="form-control" name="billing_card_exp_month">
                                                    <option value="">Select</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04" selected="">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>Exp Year:</label>
                                                <select class="form-control" name="billing_card_exp_year">
                                                    <option value="">Select</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021" selected="">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label>CVV:</label>
                                                <input type="password" class="form-control" name="billing_card_cvv" placeholder="" value="450">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-heading kt-heading--md">Billing Address</div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address Line 1:</label>
                                                <input type="text" class="form-control" name="billing_address1" placeholder="" value="Headquarters 1120 N Street Sacramento 916-654-5266">
                                            </div>
                                            <div class="form-group">
                                                <label>City:</label>
                                                <input type="text" class="form-control" name="billing_city" placeholder="" value="Polo Alto">
                                            </div>
                                            <div class="form-group">
                                                <label>State:</label>
                                                <input type="text" class="form-control" name="billing_state" placeholder="" value="California">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address Line 2:</label>
                                                <input type="text" class="form-control" name="billing_address2" placeholder="" value="P.O. Box 942873 Sacramento, CA 94273-0001">
                                            </div>
                                            <div class="form-group">
                                                <label>Zip Code:</label>
                                                <input type="number" class="form-control" name="billing_zip" placeholder="" value="942873">
                                            </div>
                                            <div class="form-group">
                                                <label>Country:</label>
                                                <select name="billing_country" class="form-control">
                                                    <option value="">Select</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 3-->

                            <!--begin: Form Wizard Step 4-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="getStep(4)">
                                <div class="kt-heading kt-heading--md">Confirmation</div>
                                <div class="kt-separator kt-separator--height-sm"></div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="form-group">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="promotions" value="1"> Click here to receive our latest promotions and news
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="accept" value="1"> Click here to indicate that you have read and agree to the terms presented in the <a href="javascript:;">Terms and Conditions</a> agreement
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 4-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <div class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
                                    Previous
                                </div>
                                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
                                    Submit
                                </div>
                                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
                                    Next Step
                                </div>
                            </div>
                            <!--end: Form Actions -->
                        </form>
                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</template>

<script>
    export default {
        name: "Wizzard",
        data: function () {
            return {
                steps: [
                    {step: 1, state: "current", icon: "", detailComponent: 'step1-component'},
                    {step: 2, state: "pending", icon: "", detailComponent: 'step2-component'},
                    {step: 3, state: "pending", icon: "", detailComponent: 'step3-component'},
                    {step: 4, state: "pending", icon: "", detailComponent: 'step4-component'}
                ]
            }
            
        },
        methods: {
            getStep(index = 2) {
                if(typeof this.steps[index-1] != 'undefined') {
                    return this.steps[index-1].state;
                } else {
                    return false;
                }
            },
            setStep(index = false) {
                console.log(index);
                if(typeof this.steps[index-1] != 'undefined') {
                    this.steps.forEach(step => {
                        step.state = "pending";
                        step.icon = "";
                       if(step.step < index) {
                           step.state = "done";
                           step.icon = '<i class="la la-check kt-font-success"></i>';
                       } else if(step.step == index) {
                           step.state = "current";
                       }
                       console.log("step:" + step.state);
                    });

                }
            }
        }
    }
</script>

<style scoped>
#portlet_block {
    z-index: 1010;
    opacity: 1;
    filter: alpha(opacity=100); /* For IE8 and earlier */
    margin:20px;
}
#wizzard_overlay {
    position: fixed;
    top:0px;
    left: 0px;
    width:100%;
    height:100%;
    background:#000;
    opacity:0.7;
    filter: alpha(opacity=80); /* For IE8 and earlier */
    z-index: 100;
}
#wizzard_container {
    position: fixed;
    margin:40px;
    top:0px;
    left: 0px;
    width: calc(100vw - 80px);
    height: calc(100vh - 80px);
    overflow-y: scroll;
    z-index: 1000;
    background: #fff;
}
@media (max-width: 575px) {
    #wizzard_container {
        margin:10px;
        width: calc(100vw - 20px);
        height: calc(100vh - 20px);
    }
    #portlet_block {
        margin:10px;
    }
}
</style>