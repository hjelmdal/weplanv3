<script>
    export default {
        name: "step2Content",
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
    <!--begin: Form Wizard Step 2-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"  :data-ktwizard-state="step.state">
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
    </div>
</template>
