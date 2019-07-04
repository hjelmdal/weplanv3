<script>
    import AvatarCropper from "vue-avatar-cropper";
    export default {
        components: {
            AvatarCropper
        },
        name: "step2Content",
        props: ["step"],
        data() {
            return {
                message: "ready",
                user: {
                    id: 1,
                    nickname: "安正超",
                    username: "overtrue",
                    avatar: "https://avatars0.githubusercontent.com/u/1472352?s=460&v=4"
                }
            };
        },
        methods: {
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
            }

        }
    }
</script>

<style scoped>
    .vue-avatar-cropper-demo {
        max-width: 18em;
        margin: 0 auto;
    }
    .avatar {
        width: 160px;
        border-radius: 6px;
        display: block;
        margin: 20px auto;
    }
    .card-img-overlay {
        display: none;
        transition: all 0.5s;
        background: #fff;
    }
    .card-img-overlay button {
        margin-top: 20vh;
    }
    .card:hover .card-img-overlay {
        display: block;
    }

    .avatar-cropper .avatar-cropper-overlay {
        opacity: 0.8;
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
                <div class="card vue-avatar-cropper-demo text-center">
                    <div class="card-body">
                        <img :src="user.avatar" class="card-img avatar" />
                        <div class="card-img-overlay">
                            <button class="btn btn-primary btn-sm" id="pick-avatar">Select an new image</button>
                        </div>
                        <h5 class="card-title mb-0">{{ user.nickname }}</h5>
                        <div class="text-muted">{{ user.username }}</div>
                    </div>
                    <div class="card-footer text-muted" v-html="message"></div>
                    <avatar-cropper
                            @uploading="handleUploading"
                            @uploaded="handleUploaded"
                            @completed="handleCompleted"
                            @error="handlerError"
                            trigger="#pick-avatar"
                            upload-url="https://demo.overtrue.me/upload.php" />
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
