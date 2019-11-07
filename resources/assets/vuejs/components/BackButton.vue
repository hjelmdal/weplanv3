<script>
    export default {
        name: "BackButton",
        computed: {
            crumbs: function() {
                let pathArray = this.$route.path.split("/")
                pathArray.shift()
                let breadcrumbs = pathArray.reduce((breadcrumbArray, path, idx) => {
                    let txt;
                    if(this.$route.matched[idx]) {
                        txt = this.$route.matched[idx].meta.title || path;
                    } else {
                        txt = path;
                    }
                    breadcrumbArray.push({
                        path: path,
                        to: breadcrumbArray[idx - 1]
                            ? "#/" + breadcrumbArray[idx - 1].path + "/" + path
                            : "#/" + path,
                        text: txt
                    });
                    return breadcrumbArray;
                }, [])
                return breadcrumbs;
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <button @click="$router.go(-1)" type="button" class="btn btn-outline-brand"><i class="fa fa-chevron-left"></i> Tilbage</button>
</template>
