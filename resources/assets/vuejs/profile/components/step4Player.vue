<script>
    import Form from "../../Form";
    import {TheMask} from "vue-the-mask";
    export default {
        name: "step4Player",
        components: {TheMask},
        props: ["step"],
        data: function() {
            return {
                player:"",
                radio: false,
                form: new Form({
                    resetOnSuccess:"false",
                    playerId:""
                })
            }
        },
        methods: {
            next() {
                this.$emit("next");
            },
            checkPlayer(event) {
                //event.target.classList.remove("is-valid", "is-invalid");
                if(this.form.playerId.length > 8) {
                    console.log("YES!");
                    this.form.post("/api/v1/BP/player/check")
                        .then(data => {
                                event.target.classList.add("is-valid");
                                //this.form.playerId = data.player.dbf_id;
                                this.player = data.player;

                            }
                        ).catch(e => {

                        event.target.classList.add("is-invalid");
                    })
                }
            }

        }
    }
</script>

<style scoped>

</style>

<template>
    <div>
    <!--begin: Form Wizard Step 3-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
        <div class="kt-heading kt-heading--md">Spilleropsætning</div>
        <div class="kt-separator kt-separator--height-xs"></div>
        <div class="form-group">
            <label>Large Input</label>
            <TheMask @keyup.native="checkPlayer($event)" mask="######-##" :masked="true" class="form-control form-control-lg" style="font-size: 2rem;" v-model="form.playerId" />
            <span class="form-text text-muted">Kender du ikke dit spiller id? Find det <a target="_blank" href="https://www.badmintonplayer.dk/DBF/Spiller/VisSpiller/">her</a> </span>
            <h2 v-show="player" v-text="player.name"></h2>
        </div>

        <div class="form-group form-group-marginless">
            <label>Er du spiller eller træner?:</label>
            <div class="row">
                <div class="col-md-6">
                    <label class="kt-option">
								<span class="kt-option__control">
								<span class="kt-radio kt-radio--check-bold kt-radio--success">
								<input v-model="radio" type="radio" name="m_option_1" value="1">
								<span></span>
								</span>
								</span>
                        <span class="kt-option__label">
								<span class="kt-option__head">
								<span class="kt-option__title">
								Jeg er spiller &-/eller spillende træner
								</span>
								<span class="kt-option__focus">
								&nbsp;
								</span>
								</span>
								<span class="kt-option__body">
								Jeg har et spiller-id ved Badminton Danmark
								</span>
								</span>
                    </label>

                </div>
                <div class="col-md-6">
                    <label class="kt-option">
								<span class="kt-option__control">
								<span class="kt-radio kt-radio--check-bold kt-radio--brand">
								<input v-model="radio" type="radio" name="m_option_1" value="2">
								<span></span>
								</span>
								</span>
                        <span class="kt-option__label">
								<span class="kt-option__head">
								<span class="kt-option__title">
								Jeg er udelukkende træner / leder
								</span>
								<span class="kt-option__focus">
								&nbsp;
								</span>
								</span>
								<span class="kt-option__body">
								Jeg har ikke et spiller-id ved Badminton Danmark
								</span>
								</span>
                    </label>
                </div>
            </div>
            <div v-show="radio === '1'">Test</div>
            <div v-show="radio === '2'">Test2</div>

        </div>
    </div>
        <div data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
            <!--begin: Form Actions -->
            <div class="kt-form__actions">
                <div class="btn btn-outline-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-prev">
                    Previous
                </div>
                <div class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-submit">
                    Submit
                </div>
                <div @click="next" class="btn btn-brand btn-md btn-tall btn-wide btn-bold btn-upper" data-ktwizard-type="action-next">
                    Færdig
                </div>
            </div>
            <!--end: Form Actions -->
        </div>
    <!--end: Form Wizard Step 3-->
    </div>
</template>