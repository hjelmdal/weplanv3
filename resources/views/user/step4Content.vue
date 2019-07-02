<script>
    export default {
        name: "step4Content",
        props: ["step"],

    }
</script>

<style scoped>

</style>

<template>
    <div>
    <!--begin: Form Wizard Step 4-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
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
        <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
            <!--begin: Form Actions -->
            <div class="kt-form__actions">
                <div class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-state="between" data-ktwizard-type="action-prev">
                    Previous
                </div>
                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit" data-ktwizard-state="last">
                    Submit
                </div>
                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
                    Next Step
                </div>
            </div>
            <!--end: Form Actions -->
        </div>
    <!--end: Form Wizard Step 4-->
    </div>
</template>
