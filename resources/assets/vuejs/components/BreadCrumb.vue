<script>
    export default {
        name: "BreadCrumb",
        computed: {
            route() {
                    return this.$route;
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="kt-subheader__breadcrumbs">
        <router-link :to="{ name: 'Home'}" v-slot="{ href, route, navigate}">
            <a @click="navigate" :href="href" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        </router-link>
        <router-link v-if="route.path != '/'" :to="route.path" v-slot="{ href, route, navigate}">
            <div style="display: flex">
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a @click="navigate" :href="route.href" class="kt-subheader__breadcrumbs-link">
                    {{ route.meta.title }}
                </a>
            </div>
            </router-link>
    </div>
</template>
