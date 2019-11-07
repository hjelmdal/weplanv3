<script>
    export default {
        name: "EmptyRouterView"
    }
</script>

<style scoped>

</style>
<template>
    <div>
    <router-view isSpa="true"></router-view>
        <router-view name="back"></router-view>
    </div>

</template>
