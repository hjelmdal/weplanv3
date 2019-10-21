<script>
    export default {
        name: "PageTitle",
        data() {
            return {
                title:""
            }
        },
        computed: {
            routeTitle() {
                if(this.$route && this.$route.meta && this.$route.meta.title)
                return this.$route.meta.title;
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <h3 class="kt-subheader__title">
    {{ routeTitle }}
    </h3>
</template>
