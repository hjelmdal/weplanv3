<script>
    export default {
        name: "test",
        props: ["id"],
        data() {
            return {
                //routes: this.$router.options.routes
            }
        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        {{ id }}
        Tester!

        {{ $route.params.id }}
    </div>
</template>


