<script>
    import stepInfo from "./stepInfo";
    import setPassword from "./setPassword";
    import step1Content from "./step1Content";
    import step2Content from "./step2Content";
    import step3Content from "./step3Content";
    import step4Content from "./step4Content";
    import {stepData} from "./stepData";
    export default {
        name: "Wizard",
        components: {
            stepInfo,
            setPassword,
            step1Content,
            step2Content,
            step3Content,
            step4Content
        },
        data: function () {
            return {
                steps: stepData
            }
            
        },
        methods: {
            setStep(index = false) {
                console.log(index);
                if (typeof this.steps[index - 1] != 'undefined') {
                    this.steps.forEach(step => {
                        step.state = "pending";
                        step.icon = "";
                        if (step.step < index) {
                            step.state = "done";
                            step.icon = '<i class="la la-check kt-font-success"></i>';
                        } else if (step.step == index) {
                            step.state = "current";
                        }
                        console.log("step:" + step.state);
                    });

                }
            }
        }
    }
</script>

<style scoped>
#portlet_block {
    z-index: 1010;
    opacity: 1;
    filter: alpha(opacity=100); /* For IE8 and earlier */
    margin:20px;
    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
    -moz-animation: fadein 1s; /* Firefox < 16 */
    -ms-animation: fadein 1s; /* Internet Explorer */
    -o-animation: fadein 1s; /* Opera < 12.1 */
    animation: fadein 1s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }

}
#wizzard_overlay {
    position: fixed;
    top:0px;
    left: 0px;
    width:100%;
    height:100%;
    background:#000;
    opacity:0.7;
    filter: alpha(opacity=70); /* For IE8 and earlier */
    z-index: 100;
    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
    -moz-animation: fadein 1s; /* Firefox < 16 */
    -ms-animation: fadein 1s; /* Internet Explorer */
    -o-animation: fadein 1s; /* Opera < 12.1 */
    animation: fadein 1s;
}
#wizzard_container {
    position: fixed;
    margin:40px;
    top:0px;
    left: 0px;
    width: calc(100vw - 80px);
    height: calc(100vh - 80px);
    overflow-y: scroll;
    z-index: 1000;
    background: #fff;
}
@media (max-width: 575px) {
    #wizzard_container {
        margin:10px;
        width: calc(100vw - 20px);
        height: calc(100vh - 20px);
    }
    #portlet_block {
        margin:10px;
    }
}
</style>
<template>
    <div>
        <div id="wizzard_overlay">

        </div>

        <div class="container-fluid" id="wizzard_container">
            <div class="kt-portlet" id="portlet_block">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid kt-grid--desktop-xl kt-grid--ver-desktop-xl kt-wizard-v1 kt-wizard-v1--extend" id="kt_wizard_v4" data-ktwizard-state="first">
                        <div class="kt-grid__item kt-wizard-v1__aside">

                            <!--begin: Form Wizard Nav -->
                            <div class="kt-wizard-v1__nav">
                                <div class="kt-wizard-v1__nav-items">
                                    <template v-for="step in steps">
                                    <a class="kt-wizard-v1__nav-item" href="javascript:;" data-ktwizard-type="step" :data-ktwizard-state="step.state" v-on:click="step.state != 'current' ? setStep(step.step): false">
                                        <span v-if="step.state == 'done'" v-html="step.icon"></span>
                                        <span v-else v-text="step.step"></span>
                                    </a>
                                    </template>
                                </div>
                                <div class="kt-wizard-v1__nav-details">
                                    <template v-for="step in steps">
                                        <step-info :step="step"></step-info>
                                    </template>
                                </div>

                            </div>
                            <!--end: Form Wizard Nav -->

                        </div>
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">
                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form" novalidate="novalidate">

                                <template v-for="step in steps">
                                    <component @next="setStep(step.step + 1)" @prev="setStep(step.step - 1)" :is="step.contentComponent" :step="step"></component>
                                </template>


                            </form>
                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>