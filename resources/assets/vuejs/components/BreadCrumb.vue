<script>
    export default {
        name: "BreadCrumb",
        computed: {
            mode() {
                return this.$router.options.mode == 'history' ? '' : '#';


            },
            route() {
                let array = this.$route.path.split("/");
                let final = [];
                array.shift();
                array.forEach(breadcrumb => {
                    let string = final[final.length - 1]
                        ? final[final.length - 1].to + "/" + breadcrumb
                        : "/" + breadcrumb;
                    let routeObj = this.$router.resolve(string).route;
                    final.push({
                        to: string,
                        route: routeObj,
                        text: routeObj.meta && routeObj.meta.title ? routeObj.meta.title : breadcrumb,
                        hidden: routeObj.meta && routeObj.meta.hidden ? routeObj.meta.hidden : false
                    });
                })
                return final;
            },
            crumbs() {
                let pathArray = this.$route.path.split("/")
                pathArray.shift()
                let breadcrumbs = pathArray
                    .reduce((breadcrumbArray, path, idx) => {
                        console.log("Br");
                        console.log(pathArray);
                        let breadcrumbPath = breadcrumbArray[idx - 1]
                            ? "#/" + breadcrumbArray[idx - 1].path + "/" + path
                            : "#/" + path;
                        console.log(breadcrumbPath);
                        let txt;
                        if(this.$router.resolve(breadcrumbPath).meta && this.$router.resolve(breadcrumbPath).meta.title) {
                            txt = this.$router.resolve(breadcrumbPath).meta.title;
                        }
                        breadcrumbArray.push({
                            path: path,
                            to: breadcrumbPath,
                            text: txt || path,
                        });
                        return breadcrumbArray;
                    }, []);
                return breadcrumbs;
            }
        },

    }
</script>

<style scoped>

</style>

<template>
    <div class="kt-subheader__breadcrumbs">
        <router-link :to="{ name: 'Home'}" v-slot="{ href, route, navigate}">
            <a @click="navigate" :href="href" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        </router-link>
        <div v-for="crumb in route" style="display: flex">
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a :href="mode + crumb.to" class="kt-subheader__breadcrumbs-link">
                {{ crumb.text }}
            </a>
        </div>

        <!--router-link v-if="route.path != '/'" :to="route.path" v-slot="{ href, route, navigate}">
            <div style="display: flex">
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a @click="navigate" :href="route.href" class="kt-subheader__breadcrumbs-link">
                    {{ route.meta.title }}
                </a>
            </div>
            </router-link-->

    </div>
</template>
