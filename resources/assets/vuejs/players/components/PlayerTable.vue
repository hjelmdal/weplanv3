<script>
import TablePlayerName from "../../components/helpers/TablePlayerName";
import PlayerSetTeam from "./PlayerSetTeam";
export default {
    name: "PlayerTable",
    components: {PlayerSetTeam, TablePlayerName},
    props:["players","rows"],
    data() {
        return {
            playerFields: [
                {key: "index", label: "#", sortable: false, class: "fit d-none d-sm-table-cell"},
                {key: "name", label: "Navn", sortable: true, class: ""},
                {key: "gender", label: "Køn", sortable: true, class: "kt-align-center d-none d-sm-table-cell"},
                {key: "team.name", label: "Trup", sortable: true, class: "kt-pr0-mobile fit"},
                {key: "action", label: " ", sortable: false, class: "kt-align-right"},
                {key: "dbf_id", label: "", sortable:false, class:"width-full"}
            ],
            currentPage: 1,
            perPage: 20,
            filter:"",
            selected: "",
            teamSelect: {
                team: "",
                player:""
            }
        }
    },
    methods: {
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1
        },
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

        openTeamModal(player) {
            this.teamSelect.player = player;
            if(player && player.team) {
                this.teamSelect.team = player.team.id;
            }
        },


    },
    watch: {
        rows: {
            // the callback will be called immediately after the start of the observation
            immediate: true,
            handler(val, oldVal) {
                this.totalRows = this.rows;
            }
        }
    }
}
</script>

<style scoped>
    >>> .flex-row {
        align-self: center;
        line-height: 0.9rem;
    }

    >>> .width-full {
        width:100%;
    }
    .kt-option:hover {
        border: 1px solid #ddd;
    }
</style>

<template>
<div>
    <div class="kt-searchbar kt-p5-mobile">
        <div class="input-group input-group-lg kt-margin-b-10">
            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg></span></div>
            <input ref="search" autofocus type="search" class="form-control" placeholder="Søg spiller" aria-describedby="basic-addon1" v-model="filter">
        </div>
    </div>
    <b-table striped show-empty empty-text="Ingen spillere fundet" sort-icon-left small
             :fields="playerFields"
             :items="players"
             @filtered="onFiltered"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
    >
        <template v-slot:cell(index)="data">
            {{ data.index + 1 }}
        </template>
        <template v-slot:cell(name)="data">
            <table-player-name :filter="filter" :data="data"></table-player-name>
        </template>
        <template v-slot:cell(gender)="data">
            <i v-if="data.value == 'M'" class="fa fa-2x fa-male kt-font-brand"></i>
            <i v-if="data.value == 'K'" class="fa fa-2x fa-female kt-font-danger"></i>
        </template>
        <template v-slot:cell(team.name)="data">
            <span  v-if="data.value" v-b-tooltip.hover :title="data.value" class="badge badge-secondary badge-sm text-ellipsis ellipsis-team">{{ data.value }}</span>
            <span v-else v-b-tooltip.hover :title="'Sæt på trup'" class="badge badge-secondary badge-sm text-ellipsis ellipsis-team">- Ikke tilkyttet trup -</span>

        </template>
        <template v-slot:cell(action)="data">
            <div class="btn-group" role="group" aria-label="...">
                    <span>
                        <div class="btn-group" role="group" aria-label="Administration af spillere">
                            <button v-b-modal.setTeam @click="openTeamModal(data.item)" class="btn btn-sm btn-outline-brand btn-icon" role="button"><i class="la la-list-ol"></i></button>
                            <button class="btn btn-sm btn-outline-success btn-icon"  role="button"><i class="la la-search"></i></button>
                            <button class="btn btn-sm btn-outline-danger btn-icon"  role="button"><i class="la la-trash"></i></button>
                        </div>
                    </span>
            </div>
        </template>
        <template v-slot:cell(dbf_id)="data">

        </template>
    </b-table>
    <div class="kt-pagination kt-pagination--brand kt-pull-right">
        <b-pagination v-show="totalRows > perPage"
                      v-model="currentPage"
                      :total-rows="totalRows"
                      :per-page="perPage"
                      align="fill"
                      size="sm"
                      class="kt-pagination__links"
        >
            <template v-slot:first-text><i class="fa fa-angle-double-left kt-font-brand"></i></template>
            <template v-slot:prev-text><i class="fa fa-angle-left kt-font-brand"></i></template>
            <template v-slot:next-text><i class="fa fa-angle-right kt-font-brand"></i></template>
            <template v-slot:last-text><i class="fa fa-angle-double-right kt-font-brand"></i></template>

        </b-pagination>
    </div>

    <player-set-team :player="teamSelect.player"></player-set-team>

</div>
</template>
