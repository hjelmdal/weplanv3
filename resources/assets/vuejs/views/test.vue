<template>
    <div>
        <ul class="kt-nav">
            <li v-for="route in routes" class="kt-nav__item">
                <router-link :to="route.path" class="kt-nav__link">
                    <i v-if="route.meta.icon" class="kt-nav__link-icon"></i>
                    <span class="kt-nav__link-text">{{ route.name }}</span>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "test",
        data() {
            return {
                routes: this.$router.options.routes
            }
        }
    }
</script>

<style scoped>

</style>
