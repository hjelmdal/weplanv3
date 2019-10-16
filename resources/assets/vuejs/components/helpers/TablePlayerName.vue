<script>
    export default {
        name: "TablePlayerName",
        props:["data","filter"],
        methods: {
            getInitials(name) {
                if(name) {
                    let nameSplit = name.split(" ");
                    let final = "";
                    nameSplit.forEach(function(i, idx, array){
                        i = i.substr(0,1);
                        if(idx == 0) {
                            final = final + i;
                        }
                        if (idx === array.length - 1 && i.substr(0,1) != '(') {
                            final = final + i;
                        } else if(idx === array.length - 1 && array.length > 2) {
                            final = final + array[idx - 1].substr(0,1);

                        }
                    });


                    return final.toUpperCase();
                }
            },
            highlight(string) {
                const pattern = this.filter;
                if(this.filter && this.filter.length > 0) {
                    const re = new RegExp(pattern, "gi");
                    return string.replace(re, "<strong>$&</strong>");
                }
                return string;
            }
        },
    }
</script>

<style scoped>
    .flex-row {
        align-self: center;
        line-height: 0.9rem;
    }
</style>

<template>
    <div class="d-flex">
        <div class="flex-row">
            <div :class="{ 'kt-media--danger' : data.item.gender == 'K'}" class="kt-media kt-media--brand kt-media--sm kt-media--circle">
                <span>{{ getInitials(data.value) }}</span>
            </div>
        </div>
        <div class="flex-row kt-pl10">
            <div class="flex-column">
                <span class=" text-ellipsis ellipsis-name" v-html="highlight(data.value)"></span> <i v-if="data.item.user" class="flaticon2-correct kt-font-brand"></i><a v-if="data.item.bp_player && data.item.bp_player.bp_id" target="_blank" :href="'https://www.badmintonplayer.dk/DBF/Spiller/VisSpiller/#'+data.item.bp_player.bp_id"><span class="kt-badge kt-badge--success kt-badge--sm">BD</span></a>
                <a v-if="data.item.bp_id" target="_blank" :href="'https://www.badmintonplayer.dk/DBF/Spiller/VisSpiller/#'+data.item.bp_id"><span class="kt-badge kt-badge--success kt-badge--sm">BD</span></a>
            </div>
            <div class="flex-column">
                <span class="small text-muted" v-html="highlight(data.item.dbf_id)"></span>
            </div>
        </div>
    </div>
</template>
