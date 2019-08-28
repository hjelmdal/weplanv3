<script>
    export default {
        name: "playerTable",
        props:["user","players","title","type"],

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


                    return final;
                }
            },
            associate(playerId) {
                this.$emit("associate",playerId);

            },
            dissociate(playerId) {
                this.$emit("dissociate",playerId);
            }
        },
        computed: {
            getButtonText() {
                if(this.type == "BD") {
                    return '<i class="la la-plus"></i>&nbsp;Opret';
                } else if(this.type == "weplan") {
                    return '<i class="la la-chain"></i>&nbsp;Tilknyt';
                }
            }
        }

    }
</script>

<style scoped>

</style>

<template>
    <div>
    <h4 v-show="players">{{ title }}</h4>
    <table class="table table-striped m-table">
        <thead>
        <tr>
            <th width="20">#</th>
            <th>Navn</th>
            <th>Klub</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="players && players.length > 0" v-for="weplanPlayer in players">
            <th scope="row"><div class="kt-widget kt-widget--general-1">
                <div :class="{ 'kt-media--danger' : weplanPlayer.gender == 'K'}" class="kt-media kt-media--brand kt-media--sm kt-media--circle">
                    <span>{{ getInitials(weplanPlayer.name) }}</span>
                </div>

            </div></th>
            <td class="td-ellipsis">{{ weplanPlayer.name }}</td>
            <td>
                <span v-if="weplanPlayer.bp_player">{{ weplanPlayer.bp_player.bp_club.team_name }}</span>
                <span v-if="weplanPlayer.bp_club">{{ weplanPlayer.bp_club.team_name }}</span>
            </td>

            <td>
                <button v-if="!weplanPlayer.user && !weplanPlayer.we_player" type="button" @click="associate(weplanPlayer.id)" class="btn btn-outline-brand btn-elevate btn-sm" v-html="getButtonText"></button>
                <button v-else type="button" class="btn btn-outline-success btn-elevate btn-sm"><i class="la la-user"></i>&nbsp;Profil</button>
            </td>
        </tr>

        <tr v-if="!players || players.length < 1">
            <td colspan="4">Ingen spillere fundet!</td>
        </tr>
        </tbody>
    </table>
    </div>
</template>
