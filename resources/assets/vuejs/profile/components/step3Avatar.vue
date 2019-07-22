<script>
    import AvatarCropper from "vue-avatar-cropper";
    import axios from "axios";
    import stepActions from "./stepActions";
    export default {
        components: {
            AvatarCropper,
            stepActions
        },
        name: "step3Avatar",
        props: ["step"],
        data() {
            return {
                message: "Upload",
                user: [],
                requestType: "POST",
                authHeaders: { Authorization: apiToken },
                labels: { submit: "Gem", cancel: "Fortryd"},
                states: {
                    next: {
                        display:"block",
                        disabled:1
                    }
                }
            };
        },
        methods: {
            getUser() {
                axios({
                    method: 'get',
                    url: getUserUrl,
                    headers: { Authorization: apiToken },
                }).catch(error => {
                    if(error.response) {
                        console.log("Error code: " + error.response.status);
                        if(error.response.status == 401) {
                            //location.reload();
                        }
                    }
                }).then((response) => {
                    this.user = response.data.user;
                });
            },
            next() {
                this.$emit("next");
            },
            prev() {
                this.$emit("prev");
            },
            handleUploading(form, xhr) {
                this.message = "uploading...";


            },
            handleUploaded(response) {
                if (response.status == "success") {
                    this.user.avatar = response.url;
                    // Maybe you need call vuex action to
                    // update user avatar, for example:
                    // this.$dispatch('updateUser', {avatar: response.url})
                    this.message = "user avatar updated.";
                }
            },
            handleCompleted(response, form, xhr) {
                this.message = "upload completed.";
                this.states.next.disabled = 0;

            },
            handlerError(message, type, xhr) {
                this.message = "Oops! Something went wrong...";

            },
            getApiToken() {
                var header = { Authorization: apiToken };
                console.log("fired!");
                return header;
            }

        },
        mounted() {
            this.getUser();
        }
    }
</script>

<style scoped>
    .vue-avatar-cropper {
        max-width: 18em;
        margin: 0 auto;
        background-color: #fff;
        transition: background-color 0.5s ease;
    }
    .avatar {
        width: 160px;
        border-radius: 6px;
        display: block;
        margin: 20px auto;
    }
    .card-img-overlay {
        display:block;
        background-color: rgba(0, 0, 0, 0.5);
        transition: opacity 0.5s ease;
        -webkit-transition: opacity 0.5s ease;
        -moz-transition: opacity 0.5s ease;
        -o-transition: opacity 0.5s ease;
        opacity:0;
    }
    .card:hover .card-img-overlay {
        opacity:1;
    }
    .card-img-overlay button {
        position: absolute;
        bottom: 8px;
        width: calc(100% - 20px);
        margin: 0px;
        left: 10px;
    }



</style>
<style>
    .avatar-cropper .avatar-cropper-overlay {
        background: rgba(0,0,0,0.7);
    }
</style>
<template>
    <div>
    <!--begin: Form Wizard Step 2-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"  :data-ktwizard-state="step.state">
        <div class="kt-heading kt-heading--md">Setup Your Profile</div>
        <div class="kt-separator kt-separator--height-sm"></div>
        <div class="kt-form__section kt-form__section--first">
            <div class="row">
                <div class="card vue-avatar-cropper text-center">
                    <div class="card-body">
                        <img :src="user.avatar" class="card-img avatar" />
                        <div class="card-img-overlay">
                            <button class="btn btn-primary btn-sm" id="pick-avatar">Vælg nyt billede</button>
                        </div>
                        <h5 class="card-title mb-0">{{ user.name }}</h5>
                        <div class="text-muted">{{ user.email }}</div>
                    </div>
                    <div class="card-footer text-muted" v-html="message"></div>
                    <avatar-cropper
                            v-bind:requestMethod="requestType"
                            v-bind:uploadHeaders="authHeaders"
                            v-bind:labels="labels"
                            @uploading="handleUploading"
                            @uploaded="handleUploaded"
                            @completed="handleCompleted"
                            @error="handlerError"
                            trigger="#pick-avatar"
                            upload-url="/api/v1/user"
                    />
                </div>
            </div>
        </div>
    </div>
    <!--end: Form Wizard Step 2-->
        <step-actions @next="next" :step="step" :states="states"></step-actions>
    </div>
</template>
