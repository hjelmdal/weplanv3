<script>
    import Form from "../../Form";
    export default {
        name: "associateUser",
        props:["formData","id"],
        data: function(){
            return {
                weplanUsers: null,
                bpUsers:null,
                user: this.formData.user,
                form: new Form(),
                input: ""
            }
        },
        methods: {
            submit() {
                if(this.input && this.input.length > 5) {
                    this.getWePlanPlayer();
                    this.getBpPlayer();

                } else {
                    this.weplanUsers = null;
                    this.bpUsers = null;
                }
            },
            getWePlanPlayer() {
                this.form.get("/api/v1/players/find/" + this.input)
                    .then(data => {
                        this.weplanUsers = data;
                    })
                    .catch(errors => {
                        this.weplanUsers = null;
                        //console.log(errors);
                    })
            },
            getBpPlayer() {
                if(this.weplanUsers == null) {
                    this.form.get("/api/v1/BP/players/find/" + this.input)
                        .then(data => {
                            this.bpUsers = data;
                            //console.log(data);
                        })
                        .catch(errors => {
                            this.bpUsers = null;
                            //console.log(errors);
                        })
                }
            },
            setInput() {
                this.input = this.formData.user.suggested_player;
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
            }
        },
        watch: {
            id: {
                // the callback will be called immediately after the start of the observation
                immediate: true,
                handler (val, oldVal) {
                    this.input = this.id;
                    this.user = this.formData.user;
                    this.submit();
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
            <input v-model="input" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1" @keyup="submit">
        </div>
    </div>
    <div class="kt-portlet kt-widget kt-widget--general-3">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-widget__top">
                <div class="kt-media kt-media--lg kt-media--circle">
                    <img v-show="user.avatar" :src="user.avatar" :alt="user.name">
                    <img v-if="!user.avatar" src="/img/profile.png" :alt="user.name">
                </div>
                <div class="kt-widget__wrapper">
                    <div class="kt-widget__label">
                        <a href="#" class="kt-widget__title">
                            {{ user.name }}
                        </a>
                        <span class="kt-widget__desc">
                                    <i class="flaticon2-send  kt-font-success"></i> <a target="_blank" :href="'mailto:' +user.email">{{ user.email }} <i v-if="user.email_verified_at != null" class="flaticon2-correct kt-font-success"></i></a>

                                </span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr />
    <h4 v-show="weplanUsers">Matchende spiller(e) i WePlan</h4>
    <table class="table table-striped m-table">
        <thead>
        <tr>
            <th width="20">#</th>
            <th>Navn</th>
            <th>Køn</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="weplanUsers && weplanUsers.length > 0" v-for="weplanUser in weplanUsers">
            <th scope="row"><div class="kt-widget kt-widget--general-1">
                <div :class="{ 'kt-media--danger' : weplanUser.gender == 'K'}" class="kt-media kt-media--brand kt-media--sm kt-media--circle">
                    <span>{{ getInitials(weplanUser.name) }}</span>
                </div>

            </div></th>
            <td>{{ weplanUser.name }}</td>
            <td valign="middle">{{ weplanUser.gender }}</td>
            <td>
                <button v-if="!weplanUser.user" type="button" class="btn btn-outline-brand btn-elevate btn-sm"><i class="la la-chain"></i>&nbsp;Tilknyt</button>
                <button v-else type="button" class="btn btn-outline-success btn-elevate btn-sm"><i class="la la-user"></i>&nbsp;Se Profil</button>
            </td>
        </tr>

        <tr v-if="!weplanUsers || weplanUsers.length < 1">
            <td colspan="4">Ingen spillere fundet!</td>
        </tr>
        </tbody>
    </table>

    <hr />

    <div v-show="bpUsers && (!weplanUsers || weplanUsers.length == 0)">
        <h4>Matchende spiller(e) hos Badminton DK</h4>

        <table class="table table-striped m-table">
            <thead>
            <tr>
                <th width="20">#</th>
                <th>Navn</th>
                <th>Køn</th>
                <th>Klub</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="bpUsers" v-for="bpUser in bpUsers">
                <th scope="row"><div class="kt-widget kt-widget--general-1">
                    <div :class="{ 'kt-media--danger' : bpUser.gender == 'K'}" class="kt-media kt-media--brand kt-media--sm kt-media--circle">
                        <span>{{ getInitials(bpUser.name) }}</span>
                    </div>

                </div></th>
                <td>{{ bpUser.name }}<br /><span class="text-muted">{{ bpUser.dbf_id }}</span> </td>
                <td valign="middle">{{ bpUser.gender }}</td>
                <td>{{ bpUser.bp_club.team_name }}</td>
                <td><button type="button" class="btn btn-outline-success btn-elevate btn-sm"><i class="la la-plus"></i>&nbsp;Opret og tilknyt</button></td>
            </tr>

            <tr v-else>
                <td colspan="4">Ingen spillere fundet!</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</template>
