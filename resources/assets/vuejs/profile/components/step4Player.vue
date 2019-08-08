<script>
    import Form from "../../Form";
    import {TheMask} from "vue-the-mask";
    import stepActions from "./stepActions";
    export default {
        name: "step4Player",
        components: {TheMask, stepActions},
        props: ["step"],
        data: function() {
            return {
                player:"",
                radio: false,
                form: new Form({
                    resetOnSuccess:"false",
                    playerId:"",
                    playerConfirm:""
                }),
                states: {
                    next: {
                        display:"block",
                        disabled:1
                    }
                }
            }

        },
        methods: {
            next() {
                this.saveID();
            },
            checkPlayer(event) {
                event.target.classList.remove("is-valid", "is-invalid");
                if(this.form.playerId.length > 8) {
                    console.log("YES!");
                    this.form.post("/api/v1/BP/player/check")
                        .then(data => {
                                event.target.classList.add("is-valid");
                                //this.form.playerId = data.player.dbf_id;
                                this.player = data.player;

                            }
                        ).catch(e => {
                        this.player = "";
                        event.target.classList.add("is-invalid");
                    })
                } else {
                    this.player = "";
                }
            },
            approve() {
                if(this.form.playerConfirm == "true") {
                    this.states.next.disabled = 0;
                }
            },
            saveID() {
                this.form.patch("/api/v1/user")
                    .then(data =>  {
                        console.log(data);
                        this.$emit("next");
                    })
                    .catch(e => {
                        // Do something
                        return false;
                    })
            }

        }
    }
</script>

<style scoped>
    .kt-widget-15 .kt-widget-15__body .kt-widget-15__author .kt-widget-15__photo {
        border-radius: 50%;
        overflow: hidden;
        width: 2.5rem;
        height: 2.5rem;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 5rem;
        flex: 0 0 2.5rem;
        margin-right: 1.25rem;
    }
</style>

<template>
    <div>
    <!--begin: Form Wizard Step 3-->
    <div class="kt-wizard-v1__content" data-ktwizard-type="step-content" :data-ktwizard-state="step.state">
        <div class="kt-heading kt-heading--md" style="margin: 0">Badminton ID:</div>
        <div class="kt-separator kt-separator--height-xs"></div>
        <div class="form-group">

            <TheMask @keyup.native="checkPlayer($event)" mask="######-##" :masked="true" class="form-control form-control-lg" style="font-size: 2rem;" v-model="form.playerId" />
            <span class="form-text text-muted">Kender du ikke dit spiller id? Find det <a target="_blank" href="https://www.badmintonplayer.dk/DBF/Spiller/VisSpiller/">her</a> </span>

            <div v-show="player" class="kt-widget-15 kt-option"  style="position: relative;">
                <div class="kt-widget-15__body">
                    <div class="kt-widget-15__author">
                        <div class="kt-widget-15__photo">
                            <a href="#"><img src="/img/profile.png" alt="" title=""></a>
                        </div>
                        <div class="kt-widget-15__detail float-left">
                            <a href="#" class="kt-widget-15__name" v-text="player.name"></a>
                            <div class="kt-widget-15__desc" v-if="player && player.bp_club" v-text="player.bp_club.name">



                            </div>

                        </div>
                        <div class="float-right" style="position: absolute; right: 10px; align-self: center;">
                            <label  class="kt-radio kt-radio--success" name="radio5" style="margin-bottom: 15px;">
                                <input @change="approve" type="radio" v-model="form.playerConfirm" value="true">
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <span v-show="player" class="form-text text-muted">Er det ikke dig? <a target="_blank" href="https://www.badmintonplayer.dk/DBF/Spiller/VisSpiller/">Klik her</a> </span>
        </div>

        <!--div class="form-group form-group-marginless">
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

        </div-->
    </div>
        <step-actions @next="next" :step="step" :states="states"></step-actions>

        <!--end: Form Wizard Step 3-->
    </div>
</template>