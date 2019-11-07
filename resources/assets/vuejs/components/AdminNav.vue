<script>
    export default {
        name: "AdminNav",
        data() {
            return {
                routes: this.$router.options.routes
            }
        }

    }
</script>

<style scoped>

</style>
<template>
    <ul class="kt-menu__nav">
        <li class="kt-menu__section "><h4 class="kt-menu__section-text">Admin sider</h4> <i class="kt-menu__section-icon flaticon-more-v2"></i></li>
        <template v-for="route in routes">
            <router-link :to="route.path" v-slot="{ href, route, navigate, isActive, isExactActive }">

                <li v-if="route.meta && route.meta.title" class="kt-menu__item"
                    :class="[isActive && !isExactActive && route.path!= '/' && 'kt-menu__item--active', isExactActive && 'kt-menu__item--active']"
                    aria-haspopup="true">
                    <a class="kt-menu__link" :href="href" @click="navigate">
                        <i class="kt-menu__link-icon" :class="route.meta.icon"></i>
                        <span class="kt-menu__link-text">{{ route.meta.title }}</span>
                    </a>
                </li>
            </router-link>
        </template>
    </ul>

</template>
