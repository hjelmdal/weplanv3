<script>
    export default {
        name: "stepActions",
        props: ["states","step"],
        methods: {
            next(step) {
                this.$emit("next",step);
            },
            prev(step) {
                this.$emit("prev",step);
            },
            submit() {
                this.$emit("submit");
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">

    <!--begin: Form Actions -->
    <div class="kt-form__actions">
        <div v-if="states.prev && states.prev.display" @click.prevent="prev(step.step - 1)" class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev" :style="{ display: states.prev.display }">
            Forrige
        </div>
        <button @click.prevent="submit" v-if="states.submit && states.submit.display" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit" :style="{ display: states.submit.display }" :disabled="states.submit.disabled == 1">
            Færdig
        </button>
        <button v-if="states.next && states.next.display" @click.prevent="next(step.step + 1)" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next" style="display: hidden" :style="{ display: states.next.display }" :disabled="states.next.disabled == 1">
           Næste
        </button>
    </div>
    <!--end: Form Actions -->
    </div>
</template>
