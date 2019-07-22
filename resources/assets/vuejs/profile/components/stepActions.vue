<script>
    export default {
        name: "stepActions",
        props: ["states","step"],
        methods: {
            next(step) {
                Event.$emit("next",step);
            },
            prev(step) {
                Event.$emit("prev",step);
            },
        }
    }
</script>

<style scoped>

</style>
<template>
    <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">

    <!--begin: Form Actions -->
    <div class="kt-form__actions">
        <div @click="prev(step.step - 1)" style="display: block;" class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
            Forrige
        </div>
        <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
            Færdig
        </div>
        <div @click="next(step.step + 1)" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
           Næste
        </div>
    </div>
    <!--end: Form Actions -->
    </div>
</template>
