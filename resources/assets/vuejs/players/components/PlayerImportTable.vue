<script>
    import TablePlayerName from "../../components/helpers/TablePlayerName";
    export default {
        name: "PlayerImportTable",
        components: {TablePlayerName},
        data() {
            return {
                checked:[],
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                filter:"",
                minInput:2,
                readOnly: false,
                importFields: [
                    {key: "index", label: "#", sortable: false, class: "fit "},
                    {key: "name", label: "Navn", sortable: true, class: ""},
                    {key: "gender", label: "Køn", sortable: true, class: "kt-align-center"},
                    {key: "bp_club.team_name", label: "Klub", sortable: true, class: "kt-pr0-mobile fit"},
                    {key: "action", label: " ", sortable: false, class: "kt-align-right"},
                ]
            }
        },
        methods: {
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1
            },
            rowClass(item, type) {
                if (!item || !item.we_player) return
                if (item.we_player && item.we_player.id) return 'kt-bg-light-brand'
                else return
            },
        },
        computed: {
            bpPlayers() {
                let players = this.$store.getters["bpPlayers/getAllPlayers"];
                this.totalRows = players.length;
                return players;
            }
        },
        created() {
            this.$store.dispatch('bpPlayers/getAllPlayers');
        }
    }
</script>

<style scoped>
    >>> .kt-pagination .kt-pagination__links li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-right: 0.5rem;
        border-radius: 4px;
    }
    >>> .kt-pagination .kt-pagination__links li span.page-link {
        font-weight: 500;
        color: #74788d;
        font-size: 1rem;
        padding: 0 0.2rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        min-width: 30px;
        min-height: 30px;
        margin: 0;
        border-radius: 2px;
    }


    >>> .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #5867dd;
        border-color: #5867dd;
        width: 30px;
        height: 30px;
        border-radius: 2px;
    }
    >>> a.page-link {
        border-radius: 2px !important;
    }
    >>> .kt-checkbox {
        margin-bottom:0px;
    }
</style>

<template>
<div>
    <div class="kt-searchbar">
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
    <div class="kt-section">
        <div v-if="filter.length < minInput" class="kt-section__content kt-section__content--solid">
            Brug søgefeltet til at tilføje spillere til truppen. Du kan fx. søge på:
            <ul>
                <li>Navn</li>
                <li>Spiller id</li>
                <li>Fødselsdag (YYYY-MM-DD)</li>
                <li>BadmintonPlayer profil</li>
            </ul>
        </div>
    </div>
    <b-table
        :tbody-tr-class="rowClass"
        :fields="importFields"
        :items="bpPlayers"
        @filtered="onFiltered"
        :current-page="currentPage"
        :per-page="perPage"
        :filter="filter"
    >
        <template v-slot:cell(index)="data">
            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                <input :disabled="data.item.we_player" type="checkbox" v-model="checked" :value="data.item.id" class="kt-checkable" /><span></span>
            </label>
        </template>
        <template v-slot:cell(name)="data">
            <table-player-name :filter="filter" :data="data"></table-player-name>
        </template>
        <template v-slot:cell(action)="data">
            test
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
</div>
</template>
