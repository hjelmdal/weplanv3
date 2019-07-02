<script>
    export default {
        name: "step3Content",
        props: ["step"],
        methods: {
            next() {
                this.$emit("next");
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <div>
    <!--begin: Form Wizard Step 3-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
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
    <!--end: Form Wizard Step 3-->
    </div>
</template>