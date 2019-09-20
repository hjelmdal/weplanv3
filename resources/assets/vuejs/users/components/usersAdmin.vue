<script>
    import Form from "./../../Form";
    import modal from "./modal";
    import associateUser from "./associateUser";

    export default {
        name: "usersAdmin",
        components: {
            modal,
            associateUser
        },
        data: function() {
            return {
                view: "table",
                search:"",
                test: "yay",
                users: [],
                usersGet: new Form(),
                modalData: {
                    id: "modal3",
                    user: "",
                    suggested_id:""
                }
            }
        },
        methods: {
          associateModal(user,id) {
              console.log("somebody touched me!");
              this.modalData.user = user;
              if(user.we_player) {
                  console.log("Er tilknyttet: " + user.we_player.dbf_id);
                  this.modalData.suggested_id = user.we_player.dbf_id;
              } else {
                  this.modalData.suggested_id = user.suggested_player;
              }
          },
            getAllUsers() {
                this.usersGet.get("/api/v1/users")
                    .then((response) =>  {
                        this.users = response;
                    })
            },
            getFilteredUsers(filter) {
              let param = null;

                switch(filter) {
                    case "activated":
                        param = "activated"
                        break;
                    case "all":
                        this.getAllUsers();
                        break;
                    case "incomplete":
                        param = "incomplete"
                        break;
                    case "dissociated":
                        param = "dissociated"
                        break;
                    default:
                    // code block
                }
              if(param) {
                  this.usersGet.get("/api/v1/users/filter/" + param)
                      .then((data) => {
                          this.users = data;
                      })
              }
            },
            filterUsers(event,filter) {
              let elems = document.querySelectorAll("#usersNav .kt-nav__item");
                [].forEach.call(elems, function(el) {
                    el.classList.remove("active");
                });
                document.querySelectorAll("#usersNav .kt-nav__item .kt-nav__link").forEach(e => { e.classList.remove("active") });
                event.currentTarget.parentElement.classList.add("active");

                this.getFilteredUsers(filter);

            },
            refresh() {
                document.querySelector(".kt-nav__item .active").click();
                console.log("refreshed!");
            },
            toggleView(view) {
                this.view = view;
            }
        },
        mounted() {
            this.getAllUsers();
            this.$root.$on('modalClose', data => {
                this.refresh();
            });
            this.$root.$on('refreshUsers', data => {
                this.refresh();
            });
        },
        computed: {
            filteredUsers() {
                return this.users.filter((user) => {
                    return user.name.toLowerCase().includes(this.search.toLowerCase()) || user.email.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },
    }

</script>

<style scoped>
    @media (max-width: 1024px) {
        .input-group-lg>.custom-select, .input-group-lg>.form-control, .input-group-lg>.input-group-append>.btn, .input-group-lg>.input-group-append>.input-group-text, .input-group-lg>.input-group-prepend>.btn, .input-group-lg>.input-group-prepend>.input-group-text {
            padding: 1.1rem 1.65rem;
        }
    }

.fa svg {
    width: 2rem;
    height: 2rem;
    fill: #fff;
}
.kt-svg-icon g [fill] {
    fill: #5d78ff;
}
</style>

<template>
    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" style="width: 100%;">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_users_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Aside-->
        <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--sm kt-app__aside--fit" id="kt_users_aside">
            <div class="kt-portlet">


                <div class="kt-portlet__separator"></div>

                <div class="kt-portlet__body">
                    <ul class="kt-nav kt-nav--bolder kt-nav--fit-ver kt-nav--v4" role="tablist" id="usersNav">
                        <li class="kt-nav__item active">
                            <a @click="filterUsers($event,'all')" class="kt-nav__link active" data-toggle="tab" href="#kt_profile_tab_personal_information" role="tab">
                                <span class="kt-nav__link-icon"><i class="flaticon2-user"></i></span>
                                <span class="kt-nav__link-text">Alle brugere</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a @click="filterUsers($event,'activated')" class="kt-nav__link" data-toggle="tab" href="#kt_profile_tab_account_information" role="tab">
                                <span class="kt-nav__link-icon"><i class="flaticon-feed"></i></span>
                                <span class="kt-nav__link-text">Aktiverede</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a @click="filterUsers($event,'incomplete')" class="kt-nav__link" data-toggle="tab" href="#kt_profile_change_password" role="tab">
                                <span class="kt-nav__link-icon"><i class="flaticon2-settings"></i></span>
                                <span class="kt-nav__link-text">Brugere i aktiveringsflow</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a @click="filterUsers($event,'dissociated')" class="kt-nav__link" data-toggle="tab" href="#kt_profile_email_settings" role="tab">
                                <span class="kt-nav__link-icon"><i class="flaticon2-chart2"></i></span>
                                <span class="kt-nav__link-text">Brugere uden tilknytning</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
        <!--End:: App Aside-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="input-group input-group-lg kt-margin-b-10">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg></span></div>
                <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1" v-model="search">
            </div>

            <div class="btn-group btn-group-sm kt-margin-b-10 float-right" role="group" aria-label="Small group">
                <button @click="toggleView('table')" type="button" :class="{'active' : view == 'table'}" class="btn btn-success"><i class="fa flaticon2-indent-dots"></i> </button>
                <button @click="toggleView('grid')" type="button" :class="{'active' : view == 'grid'}" class="btn btn-success"><i class="fa flaticon2-layers"></i> </button>
            </div>
            <div class="clearfix"></div>
            <div v-if="view == 'table'" class="kt-portlet"><div class="kt-portlet__body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                <th></th>
                <th>Bruger</th>
                <th width="75">Status</th>
                <th width="60" class="d-none d-sm-table-cell">Spiller</th>
                <th width="155">#</th>
                </thead>
                <tbody>
                <tr v-for="(user,index) in filteredUsers">
                    <td style="padding:0.75rem 5px;">

                            <div class="kt-media kt-media--md kt-media--circle">
                                <img v-show="user.avatar" :src="user.avatar" :alt="user.name"  style="width: 45px; border: 1px solid #ddd; padding:1px">
                                <img v-if="!user.avatar" src="/img/profile.png" :alt="user.name"  style="width: 45px; border: 1px solid #ddd; padding:1px">
                            </div>
                    </td>
                    <td class="td-ellipsis" style="max-width: 30%">
                            {{ user.name }}<br>
                            <span class="kt-widget__desc">
                                <i class="flaticon2-send  kt-font-success"></i> <a target="_blank" :href="'mailto:' +user.email">{{ user.email }} <i v-if="user.email_verified_at != null" class="flaticon2-correct kt-font-success"></i></a>
                                <br />
                            <span v-for="role in user.roles"  class="badge badge-secondary badge-sm">{{ role.name }}</span>
                           </span>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" :class="{ 'btn-outline-brand' : user.complete, 'btn-warning' : !user.complete }" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i v-if="user.complete" class="fa fa-check"></i>
                                <i v-else class="fa fa-clock fa-inverse"></i>

                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a v-if="user.email_verified_at" class="text-success dropdown-item text-capitalize" href="#"><i class="fa fa-check text-success"></i> Email</a>
                                <a v-else class="dropdown-item text-capitalize" href="#"><i class="fa fa-clock"></i> Email</a>
                                <a v-for="(status,key) in user.user_status" :class="{ 'text-success' : status.confirmed_at, 'text-muted' : !status.confirmed_at }" class="dropdown-item text-capitalize" href="#"><i v-if="status.confirmed_at" :class="{ 'text-success' : status.confirmed_at, 'text-muted' : !status.confirmed_at }" class="fa fa-check"></i><i v-else class="fa fa-clock"></i> {{ status.type }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle d-none d-sm-table-cell">
                        <span v-if="user.we_player">
                            <span class="float-left fa fa-stack fa-lg"> <i class="fa fa-certificate fa-stack-1x kt-font-brand"></i> <i class="fa fa-check fa-stack-1x fa-sm fa-inverse"></i>
                            </span>
                        </span>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="First group">
                            <button type="button" class="btn btn-sm btn-primary"><i class="la la-pencil-square-o"></i></button>
                            <button data-toggle="modal" data-target="#modal3" v-if="user.player_id" @click="associateModal(user,0)" type="button" class="btn btn-sm btn-metal"><i class="la la-chain-broken"></i></button>
                            <button data-toggle="modal" data-target="#modal3" v-if="!user.player_id"  @click="associateModal(user,0)" type="button" class="btn btn-sm btn-success"><i class="la la-chain"></i></button>
                            <button type="button" class="btn btn-sm btn-danger"><i class="la la-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <tr v-if="filteredUsers.length < 1"><td colspan="5" class="text-center">Ingen brugere blev fundet.</td> </tr>
                </tbody>
            </table>
            </div> </div>

            <!--begin::Portlet-->
            <div v-if="view == 'grid'" v-for="(user,index) in filteredUsers" class="kt-portlet kt-widget kt-widget--general-3">
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
                                <span class="kt-widget__desc">
                                    <span v-for="role in user.roles"  class="badge badge-secondary badge-sm">{{ role.name }}</span>
                                </span>
                                <span v-if="user.roles.length == 0" class="kt-widget__desc">
                                    << None >>
                                </span>
                            </div>
                            <div class="kt-widget__progress">
                                <div class="kt-widget__cont">
                                    <div class="btn-group" role="group">
                                        <button type="button" :class="{ 'btn-success' : user.complete, 'btn-warning' : !user.complete }" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Status
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a v-if="user.email_verified_at" class="text-success dropdown-item text-capitalize" href="#"><i class="fa fa-check text-success"></i> Email</a>
                                            <a v-else class="dropdown-item text-capitalize" href="#"><i class="fa fa-clock"></i> Email</a>
                                            <a v-for="(status,key) in user.user_status" :class="{ 'text-success' : status.confirmed_at, 'text-muted' : !status.confirmed_at }" class="dropdown-item text-capitalize" href="#"><i v-if="status.confirmed_at" :class="{ 'text-success' : status.confirmed_at, 'text-muted' : !status.confirmed_at }" class="fa fa-check"></i><i v-else class="fa fa-clock"></i> {{ status.type }}</a>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="kt-widget__stats">
                                <template  v-for="status in user.user_status" v-if="status.type == 'player'">
                                    <button data-toggle="modal" data-target="#modal3" v-if="status.data && !user.player_id"  @click="associateModal(user,status.data)" type="button" class="btn btn-primary btn-sm"><i class="fa">

                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             width="487.811px" height="487.81px" viewBox="0 0 487.811 487.81" style="enable-background:new 0 0 487.811 487.81;"
                                             xml:space="preserve">
<g>
	<g id="_x33_6_24_">
		<g>
			<path d="M150.463,109.521h150.512c3.955,0,7.16-3.206,7.16-7.161c0-3.955-3.205-7.161-7.16-7.161H150.463
				c-3.955,0-7.161,3.206-7.161,7.161C143.302,106.315,146.508,109.521,150.463,109.521z"/>
            <path d="M15.853,179.537h150.511c3.955,0,7.161-3.206,7.161-7.161s-3.206-7.16-7.161-7.16H15.853
				c-3.955,0-7.161,3.205-7.161,7.16S11.898,179.537,15.853,179.537z"/>
            <path d="M56.258,253.214c0,3.955,3.206,7.162,7.161,7.162H213.93c3.955,0,7.161-3.207,7.161-7.162s-3.206-7.16-7.161-7.16H63.419
				C59.464,246.054,56.258,249.259,56.258,253.214z"/>
            <path d="M142.396,336.44H7.161C3.206,336.44,0,339.645,0,343.6s3.206,7.161,7.161,7.161h135.235c3.955,0,7.161-3.206,7.161-7.161
				S146.351,336.44,142.396,336.44z"/>
            <path d="M385.729,154.418c21.6,0,39.111-17.513,39.111-39.114s-17.512-39.113-39.111-39.113
				c-21.605,0-39.119,17.513-39.119,39.113C346.609,136.905,364.123,154.418,385.729,154.418z"/>
            <path d="M450.066,143.155c-22.459,31.459-52.533,35.102-84.895,15.89c-2.203-1.306-11.977-6.691-14.141-7.977
				c-52.061-30.906-104.061-18.786-138.934,30.05c-14.819,20.771,19.455,40.459,34.108,19.93
				c18.018-25.232,40.929-32.533,65.986-24.541c-12.83,22.27-24.047,44.405-39.875,75.853
				c-15.832,31.448-50.787,56.562-84.374,36.92c-24.235-14.165-46.09,20.651-21.928,34.772
				c45.854,26.799,99.619,10.343,127.066-24.493c0.952,0.509,1.958,0.968,3.062,1.354c22.422,7.812,51.814,28.61,60.77,35.981
				c8.953,7.371,24.336,44.921,33.471,63.788c11.082,22.893,46.871,6.219,35.748-16.771c-10.355-21.406-27.736-64.129-41.293-74.938
				c-10.875-8.669-31.988-24.803-49.895-33.956c12.115-23.466,24.729-46.679,38.008-69.491
				c42.328,12.969,82.561-2.308,111.215-42.446C498.996,142.312,464.73,122.624,450.066,143.155z"/>
		</g>
	</g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
                                            <g>
</g>
</svg>
                                    </i> Opret spiller</button>

                                </template>
                                <button v-if="user.player_id" type="button" class="btn btn-outline-success btn-elevate btn-sm"><i class="la la-user"></i>&nbsp;Se Profil</button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget__bottom">
                        <div class="kt-widget__summary">
                            <div class="kt-widget__item">
                                <span class="btn btn-label-brand btn-sm btn-bold btn-upper">{{ user.created_at | formatDate("DD-MMM")}}</span>&nbsp;
                                <span class="kt-widget__hint">Joined Date</span>
                            </div>
                        </div>
                        <div class="kt-widget__toolbar">
                            <a href="#" class="btn btn-icon btn-circle btn-label-facebook">
                                <i class="socicon-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-circle btn-label-twitter">
                                <i class="socicon-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-circle btn-label-linkedin">
                                <i class="socicon-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->

            <!--begin: Pagination-->
            <!--div class="kt-pagination kt-pagination--brand kt-margin-t-10">
                <ul class="kt-pagination__links">
                    <li class="kt-pagination__link--first">
                        <a href="#"><i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="kt-pagination__link--next">
                        <a href="#"><i class="fa fa-angle-left"></i></a>
                    </li>

                    <li>
                        <a href="#">...</a>
                    </li>
                    <li>
                        <a href="#">29</a>
                    </li>
                    <li>
                        <a href="#">30</a>
                    </li>
                    <li class="kt-pagination__link--active">
                        <a href="#">32</a>
                    </li>
                    <li>
                        <a href="#">34</a>
                    </li>
                    <li>
                        <a href="#">...</a>
                    </li>

                    <li class="kt-pagination__link--prev">
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="kt-pagination__link--last">
                        <a href="#"><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                <div class="kt-pagination__toolbar">
                    <select class="form-control" style="width: 60px;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="pagination__desc">
                    10 of 230
                </span>
                </div>
            </div-->
            <!--end: Pagination-->
        </div>
        <!--End:: App Content-->
        <modal :modal-data="modalData" :title="modalData.user.name">
            <associate-user :now="modalData.user" :form-data="modalData" :id="modalData.suggested_id"></associate-user>
        </modal>

    </div>
    <!--End::App-->
</template>
