var KTWizardDemo=function(){var e,r,i;return{init:function(){var t;KTUtil.get("kt_wizard_v4"),e=$("#kt_form"),(i=new KTWizard("kt_wizard_v4",{startStep:1})).on("beforeNext",function(e){!0!==r.form()&&e.stop()}),i.on("beforePrev",function(e){!0!==r.form()&&e.stop()}),i.on("change",function(e){KTUtil.scrollTop()}),r=e.validate({ignore:":hidden",rules:{username:{required:!0},email:{required:!0,email:!0},password:{required:!0},name:{required:!0},contact:{required:!0},billing_card_name:{required:!0},billing_card_number:{required:!0,creditcard:!0},billing_card_exp_month:{required:!0},billing_card_exp_year:{required:!0},billing_card_cvv:{required:!0,minlength:2,maxlength:3},accept:{required:!0}},messages:{accept:{required:"You must accept the Terms and Conditions agreement!"}},invalidHandler:function(e,r){KTUtil.scrollTop(),swal.fire({title:"",text:"There are some errors in your submission. Please correct them.",type:"error",confirmButtonClass:"btn btn-secondary m-btn m-btn--wide"})},submitHandler:function(e){}}),(t=e.find('[data-ktwizard-action="action-submit"]')).on("click",function(i){i.preventDefault(),r.form()&&(KTApp.progress(t),e.ajaxSubmit({success:function(){KTApp.unprogress(t),swal.fire({title:"",text:"The application has been successfully submitted!",type:"success",confirmButtonClass:"btn btn-secondary"})}}))})}}}();jQuery(document).ready(function(){KTWizardDemo.init()});