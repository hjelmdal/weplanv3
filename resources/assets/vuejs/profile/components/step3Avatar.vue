<script>
    import AvatarCropper from "vue-avatar-cropper";
    import axios from "axios";
    export default {
        components: {
            AvatarCropper
        },
        name: "step3Avatar",
        props: ["step"],
        data() {
            return {
                message: "Upload",
                user: [],
                requestType: "POST",
                authHeaders: { Authorization: apiToken },
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
                            <button class="btn btn-primary btn-sm" id="pick-avatar">Select an new image</button>
                        </div>
                        <h5 class="card-title mb-0">{{ user.name }}</h5>
                        <div class="text-muted">{{ user.email }}</div>
                    </div>
                    <div class="card-footer text-muted" v-html="message"></div>
                    <avatar-cropper
                            v-bind:requestMethod="requestType"
                            v-bind:uploadHeaders="authHeaders"
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
        <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
            <!--begin: Form Actions -->
            <div class="kt-form__actions">
                <div @click="prev" style="display: block;" class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
                    Previous
                </div>
                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
                    Submit
                </div>
                <div @click="next" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
                    Next Step
                </div>
            </div>
            <!--end: Form Actions -->
        </div>
    </div>
</template>
