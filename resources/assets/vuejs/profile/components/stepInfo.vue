<template>
    <div class="kt-wizard-v1__nav-item-wrapper" data-ktwizard-type="step-info" :data-ktwizard-state="step.state">
        <div class="kt-wizard-v1__nav-item-title">{{ step.stepInfo.title }}
        </div>
        <div class="kt-wizard-v1__nav-item-desc"> {{ step.stepInfo.text}}

            <img :src="step.stepInfo.svg" alt="image" class="kt-wizard-v1__nav-image">
        </div>
    </div>
</template>

<script>
    export default {
        name: "stepInfo",
        props: ["step"],
    }
</script>

<style scoped>

</style>