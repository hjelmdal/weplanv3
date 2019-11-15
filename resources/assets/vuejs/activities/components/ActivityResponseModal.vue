<script>
    export default {
        name: "ActivityResponseModal",
        props:["activity","type","id"],
    }
</script>

<style scoped>
.kt-widget17 {
    padding:5px;
    background:#f2f3f8;

}
.kt-widget17__stats {
    margin: 0;
    width: 100%;
}
@media (max-width: 575px) {
    modal-body {
        padding:5px;
        background-color: #f2f3f8;
    }
}

.we-flex {
    display:flex;
    flex-direction:row;
}
.we-flex-grow {
    flex-grow: 1;
    min-width:0;
}


.we-100 {
    width:100%;
}
.we-flex-row {
    display:flex;
    flex-direction:column;
}

.we-flex1 {
    display:flex;
}
.we-flex2 {
    display:flex;
}
.we-flex5 {
    display:flex;
    align-self:center;
}
.we-body {
    margin:10px;
}
.we-pill {
    border-radius: 1rem 0rem 0rem 1rem;
}
.btn-sm {

}
.title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.we-ellipsis {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.we-response {
    /*min-width:60px;*/
    align-self:center;
}
.kt-portlet {
    margin-bottom: 10px;
}

.p8-date {
    margin: 10px 10px 10px 0px;
}
@media(max-width:575px) {
    .p8-date {
        width:55px;
        margin: 10px 10px 10px 0px;
    }

}

@media (max-width: 1024px) {

}

.btn-xs [class*=" la-"], .btn [class^=la-] {
    font-size: 1.0rem;
}

.response-none {
    border-color: #ddd !important;
}
.response-missing {
    border-color: var(--warning) !important;
}
.response-confirmed {
    border-color: var(--success) !important;
}
.response-declined {
    border-color: var(--danger) !important;
}
.invitational {
    border-color: var(--blue) !important;
}
.not-invited {
    border-color: #ddd !important;
}
.we-btn-flex {
    display:flex;
    align-items:center;
}
.we-response-wrapper {
    display:flex;
    flex-direction:column;
}
.btn-xs {
    padding: 0.7rem 0.6rem;
    font-size:0.8rem;
}

</style>

<template>
    <b-modal v-if="activity" :title="'Tilmeld ' + activity.title" id="responseModal" size="md" body-class="kt-pl0-mobile kt-pr0-mobile">
        <div class="we-flex">
            <div class="we-flex-row kt-pl0">
                <div class="p8-date">
                    <div class="p8-date-mon">{{activity.start_date | formatDate("ddd")}}</div>
                    <div class="p8-date-num">{{activity.start_date | formatDate("DD")}}</div>
                    <div class="p8-date-day">{{activity.start_date | formatDate("MMM")}}</div>

                </div>
            </div>
            <div class="we-flex-row we-flex-grow kt-mt-10">
                <div class="we-flex1">
                    <div class="kt-portlet we-100 response-none" :class="{'response-missing':activity.response_missing, 'response-declined':activity.response_declined, 'response-confirmed':activity.response_confirmed, 'invitational': !activity.my_activity && activity.type && activity.type.signup && activity.response_timestamp > time}" style="border-left: 5px solid">
                        <div class="we-flex">
                            <div class="we-flex-row kt-m10 we-flex-grow">
                                <div class="title kt-font-lg kt-font-bold we-ellipsis">{{ activity.title }}</div>
                                <div class="time-span"> <i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }} <span v-if="activity.type">{{ activity.type.name }}</span> </div>
                            </div>
                            <div v-if="activity.type" class="we-flex-row kt-pr0 we-response">
                                <button @click="showActivity(activity.id)" v-if="activity.response_timestamp < time || !activity.my_activity && !activity.type.signup || (activity.response_confirmed || activity.response_declined)" type="button" class="btn btn-outline-hover-info btn-elevate btn-icon" style="align-self:flex-end">
                                    <span class="we-btn-flex"></span><i class="la la-chevron-right"></i>
                                </button>
                                <button @click="responseModal(activity,'signup')" v-if="!activity.my_activity && activity.type.signup && activity.response_timestamp > time" type="button" class="btn btn-xs btn-brand btn-elevate btn-pill we-pill"><span class="we-btn-flex"><i class="la la-plus"></i> Tilmeld</span></button>

                                <span class="we-response-wrapper" v-if="activity.response_timestamp > time && activity.response_missing">
                    <button v-if="activity.my_activity" type="button" class="btn btn-xs btn-success btn-elevate btn-pill we-pill kt-mb-5"><span class="we-btn-flex"><i class="la la-check"></i> Bekræft</span></button>
                    <button v-if="activity.my_activity" type="button" class="btn btn-xs btn-brand btn-elevate btn-pill we-pill"><span class="we-btn-flex"><i class="la la-close"></i> Afbud</span></button>
</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="kt-align-center kt-mb-20">
            <button type="button" class="btn btn-primary  btn-lg"><i class="fa fa-plus"></i> Tilmeld</button>
        </div>
        <div class="kt-widget17">
            <div class="kt-widget17__stats">
                <div class="kt-widget17__items">
                    <div class="kt-widget17__item">
						<span class="kt-widget17__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z" fill="#000000"/>
        <path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z" fill="#000000" opacity="0.3"/>
        <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
    </g>
</svg></span>
                        <span class="kt-widget17__subtitle">
							Tidspunkt
						</span>
                        <span class="kt-widget17__desc">
							<i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}
						</span>
                    </div>

                    <div class="kt-widget17__item">
						<span class="kt-widget17__icon">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--danger">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"/>
        <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
    </g>
</svg>						</span>
                        <span class="kt-widget17__subtitle">
							Lukker
						</span>
                        <span class="kt-widget17__desc">
							{{ activity.response_date + " " + activity.response_time | dateString("to") }}
						</span>
                    </div>
                </div>
                <div class="kt-widget17__items">



                    <div class="kt-widget17__item">
						<span class="kt-widget17__icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg>
													</span>
                        <span class="kt-widget17__subtitle">
							Sted
						</span>
                        <span class="kt-widget17__desc">
							Annexhallen, Aarhus N
						</span>
                    </div>
                    <div class="kt-widget17__item">
						<span class="kt-widget17__icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
    </g>
</svg>						</span>
                        <span class="kt-widget17__subtitle">
							Type
						</span>
                        <span class="kt-widget17__desc">
							{{ activity.type.name }}
						</span>
                    </div>
                </div>

            </div>
        </div>


        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal" @click="cancel">
                Fortryd
            </b-button>
        </template>
    </b-modal>
</template>
