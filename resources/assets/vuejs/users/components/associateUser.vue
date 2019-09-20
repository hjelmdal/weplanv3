<script>
    import Form from "../../Form";
    import playerTable from "./playerTable";
    export default {
        components: {
            playerTable
        },

        name: "associateUser",
        props:["formData","id","now"],
        data: function(){
            return {
                weplanPlayers: null,
                bpPlayers:null,
                user: this.formData.user,
                form: new Form({
                    playerId: "",
                    userId: "",
                }),
                input: "",
                readOnly: false,
            }
        },
        methods: {
            submit() {
                if(this.input && this.input.length > 5) {
                    console.log("yer");
                    this.getWePlanPlayer();
                    this.getBpPlayer();

                } else {
                    this.weplanPlayers = null;
                    this.bpPlayers = null;
                }
            },
            associate(playerId) {
                console.log("also done");
                this.form.playerId = playerId;
                this.form.userId = this.user.id;
                this.form.post("/api/v1/user/associate")
                    .then(data => {
                        console.log(data);
                        this.input = data.we_player.dbf_id;
                        this.user = data;
                        this.submit();
                        this.setReadOnly();
                        this.$root.$emit('refreshUsers');
                    })
                    .catch(e => {
                        // nothing now
                    })
            },

            dissociate(playerId) {
                this.form.playerId = playerId;
                this.form.userId = this.user.id;
                this.form.post("/api/v1/user/dissociate")
                    .then(data => {
                        console.log(data);
                        this.input = null;
                        this.user = data;
                        this.input = this.user.suggested_player;
                        this.submit();
                        this.setReadOnly();
                        this.$root.$emit('refreshUsers');


                    })
                    .catch(e => {
                        // nothing now
                    })
            },

            createWeplanPlayer(playerId) {
                console.log("also here");
                this.form.playerId = [];
                this.form.playerId.push(playerId);
                this.form.post("/api/v1/BP/players/store")
                    .then(data => {
                        console.log(data.message);
                        this.getWePlanPlayer();
                    })
                    .catch(e => {
                        //nothing
                    })
            },
            getWePlanPlayer() {
                this.form.get("/api/v1/players/find/" + this.input)
                    .then(data => {
                        this.weplanPlayers = data;
                    })
                    .catch(errors => {
                        this.weplanPlayers = null;
                        //console.log(errors);
                    })
            },
            getBpPlayer() {
                    this.form.get("/api/v1/BP/players/find/" + this.input)
                        .then(data => {
                            this.bpPlayers = data;
                            //console.log(data);
                        })
                        .catch(errors => {
                            this.bpPlayers = null;
                            //console.log(errors);
                        })

            },
            setInput() {
                this.input = this.formData.user.suggested_player;
            },

            setReadOnly() {
                console.log("has run");
                if(this.user.we_player) {
                    this.readOnly = true;
                    console.log("is set");
                } else {
                    this.readOnly = false;
                }
            }

        },
        watch: {
            now: {
                // the callback will be called immediately after the start of the observation
                immediate: true,
                handler (val, oldVal) {
                    this.input = this.id;
                    if(this.id == 0) {
                        this.input = null;
                    }
                    this.user = this.formData.user;
                    this.submit();
                    this.setReadOnly();
                    console.log('Prop changed: ', val, ' | was: ', oldVal)
                }
            }
        },
        mounted() {
            this.$root.$on('modalSubmit', data => {
                this.submit();
            });

        }
    }
</script>

<style scoped>
    @media (max-width: 1024px) {
        .input-group-lg>.custom-select, .input-group-lg>.form-control, .input-group-lg>.input-group-append>.btn, .input-group-lg>.input-group-append>.input-group-text, .input-group-lg>.input-group-prepend>.btn, .input-group-lg>.input-group-prepend>.input-group-text {
            padding: 1.1rem 1.65rem;
        }
    }
    .kt-svg-icon g [fill] {
        fill: #5d78ff;
    }
    .table td, .table th {
        vertical-align:middle;
    }
</style>

<template>
<div>
    <div class="kt-searchbar">
        <div class="input-group input-group-lg">
            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg></span></div>
            <input v-model="input" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1" @keyup="submit" :disabled="readOnly">
        </div>
    </div>
    <div class="kt-portlet kt-widget kt-widget--general-3">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-widget__top" style="padding-left: 10px; padding-right: 10px">
                <div class="kt-media kt-media--lg kt-media--circle">
                    <img v-show="user.avatar" :src="user.avatar" :alt="user.name">
                    <img v-if="!user.avatar" src="/img/profile.png" :alt="user.name">
                </div>
                <div class="kt-widget__wrapper">
                    <div class="kt-widget__label" style="flex-grow: 0;">
                        <a href="#" class="kt-widget__title">
                            {{ user.name }}
                        </a>
                        <span class="kt-widget__desc">
                                    <i class="flaticon2-send  kt-font-success"></i> <a target="_blank" :href="'mailto:' +user.email">{{ user.email }} <i v-if="user.email_verified_at != null" class="flaticon2-correct kt-font-success"></i></a>

                                </span>
                        <span v-if="user.we_player" class="kt-widget__desc">
                            <span class="fixed-ellipsis" style="max-width: 120px;"><i class="la la-chain"></i> {{ user.we_player.name }},</span>
                            <span style="display: inline-block;">
                            <i class="la la-home"></i> {{ user.we_player.bp_player.bp_club.team_name }}
                            </span>
                        </span>

                    </div>
                    <div class="kt-widget__label" style="flex-direction: row-reverse; margin-right: 0rem">
                        <button @click="dissociate(user.player_id)" v-if="user.we_player" class="btn btn-sm btn-outline-warning"><i class="la la-chain-broken"></i>&nbsp;Ophæv</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <hr />

    <player-table @dissociate="dissociate" @associate="associate" :user="user" :players="weplanPlayers" :type="'weplan'" :title="'Matchende spiller(e) i WePlan'"></player-table @dissociate="dissociate">

    <hr />

    <div v-show="bpPlayers && (!weplanPlayers || weplanPlayers.length == 0 || input.length < 9)">
        <player-table  @associate="createWeplanPlayer" :user="user" :players="bpPlayers" :type="'BD'" :title="'Matchende spiller(e) hos Badminton DK'"></player-table>

    </div>
</div>
</template>
