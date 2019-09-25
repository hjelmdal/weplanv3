"use strict";var KTUppy=function(){const e=Uppy.Tus,t=Uppy.ProgressBar,i=Uppy.StatusBar,a=Uppy.FileInput,p=Uppy.Informer,s=Uppy.Dashboard,n=Uppy.Dropbox,o=Uppy.GoogleDrive,r=Uppy.Instagram,u=Uppy.Webcam;return{init:function(){var l,d,m,c;l={proudlyDisplayPoweredByUppy:!1,target:"#kt_uppy_1",inline:!0,replaceTargetContent:!0,showProgressDetails:!0,note:"No filetype restrictions.",height:470,metaFields:[{id:"name",name:"Name",placeholder:"file name"},{id:"caption",name:"Caption",placeholder:"describe what the image is about"}],browserBackButtonClose:!0},(d=Uppy.Core({autoProceed:!0,restrictions:{maxFileSize:1e6,maxNumberOfFiles:5,minNumberOfFiles:1}})).use(s,l),d.use(e,{endpoint:"https://master.tus.io/files/"}),d.use(o,{target:s,companionUrl:"https://companion.uppy.io"}),d.use(n,{target:s,companionUrl:"https://companion.uppy.io"}),d.use(r,{target:s,companionUrl:"https://companion.uppy.io"}),d.use(u,{target:s}),function(){var t={proudlyDisplayPoweredByUppy:!1,target:"#kt_uppy_2",inline:!0,replaceTargetContent:!0,showProgressDetails:!0,note:"Images and video only, 2–3 files, up to 1 MB",height:470,metaFields:[{id:"name",name:"Name",placeholder:"file name"},{id:"caption",name:"Caption",placeholder:"describe what the image is about"}],browserBackButtonClose:!0},i=Uppy.Core({autoProceed:!0,restrictions:{maxFileSize:1e6,maxNumberOfFiles:5,minNumberOfFiles:1,allowedFileTypes:["image/*","video/*"]}});i.use(s,t),i.use(e,{endpoint:"https://master.tus.io/files/"})}(),m="#kt_uppy_3",(c=Uppy.Core({autoProceed:!0,restrictions:{maxFileSize:1e6,maxNumberOfFiles:5,minNumberOfFiles:1,allowedFileTypes:["image/*","video/*"]}})).use(Uppy.DragDrop,{target:m+" .kt-uppy__drag"}),c.use(t,{target:m+" .kt-uppy__progress",hideUploadButton:!1,hideAfterFinish:!1}),c.use(p,{target:m+" .kt-uppy__informer"}),c.use(e,{endpoint:"https://master.tus.io/files/"}),c.on("complete",function(e){var t="";$.each(e.successful,function(e,i){var a="";/image/.test(i.type)&&(a='<div class="kt-uppy__thumbnail"><img src="'+i.uploadURL+'"/></div>');var p="bytes",s=i.size;s>1024&&(p="kb",(s/=1024)>1024&&(s/=1024,p="MB")),t+='<div class="kt-uppy__thumbnail-container" data-id="'+i.id+'">'+a+' <span class="kt-uppy__thumbnail-label">'+i.name+" ("+Math.round(s,2)+" "+p+')</span><span data-id="'+i.id+'" class="kt-uppy__remove-thumbnail"><i class="flaticon2-cancel-music"></i></span></div>'}),$(m+" .kt-uppy__thumbnails").append(t)}),$(document).on("click",m+" .kt-uppy__thumbnails .kt-uppy__remove-thumbnail",function(){var e=$(this).attr("data-id");c.removeFile(e),$(m+' .kt-uppy__thumbnail-container[data-id="'+e+'"').remove()}),function(){var i="#kt_uppy_4",a=Uppy.Core({autoProceed:!1,restrictions:{maxFileSize:1e6,maxNumberOfFiles:5,minNumberOfFiles:1}});a.use(Uppy.DragDrop,{target:i+" .kt-uppy__drag"}),a.use(t,{target:i+" .kt-uppy__progress"}),a.use(p,{target:i+" .kt-uppy__informer"}),a.use(e,{endpoint:"https://master.tus.io/files/"}),a.on("complete",function(e){var t="";$.each(e.successful,function(e,i){var a="";/image/.test(i.type)&&(a='<div class="kt-uppy__thumbnail"><img src="'+i.uploadURL+'"/></div>');var p="bytes",s=i.size;s>1024&&(p="kb",(s/=1024)>1024&&(s/=1024,p="MB")),t+='<div class="kt-uppy__thumbnail-container" data-id="'+i.id+'">'+a+' <span class="kt-uppy__thumbnail-label">'+i.name+" ("+Math.round(s,2)+" "+p+')</span><span data-id="'+i.id+'" class="kt-uppy__remove-thumbnail"><i class="flaticon2-cancel-music"></i></span></div>'}),$(i+" .kt-uppy__thumbnails").append(t)}),$(i+" .kt-uppy__btn").click(function(){a.upload()}),$(document).on("click",i+" .kt-uppy__thumbnails .kt-uppy__remove-thumbnail",function(){var e=$(this).attr("data-id");a.removeFile(e),$(i+' .kt-uppy__thumbnail-container[data-id="'+e+'"').remove()})}(),function(){var t,s="#kt_uppy_5",n=$(s+" .kt-uppy__status"),o=$(s+" .kt-uppy__list"),r=Uppy.Core({debug:!0,autoProceed:!0,showProgressDetails:!0,restrictions:{maxFileSize:1e6,maxNumberOfFiles:5,minNumberOfFiles:1}});r.use(a,{target:s+" .kt-uppy__wrapper",pretty:!1}),r.use(p,{target:s+" .kt-uppy__informer"}),r.use(e,{endpoint:"https://master.tus.io/files/"}),r.use(i,{target:s+" .kt-uppy__status",hideUploadButton:!0,hideAfterFinish:!1}),$(s+" .uppy-FileInput-input").addClass("kt-uppy__input-control").attr("id","kt_uppy_5_input_control"),$(s+" .uppy-FileInput-container").append('<label class="kt-uppy__input-label btn btn-label-brand btn-bold btn-font-sm" for="kt_uppy_5_input_control">Attach files</label>');var u=$(s+" .kt-uppy__input-label");r.on("upload",function(e){u.text("Uploading..."),n.addClass("kt-uppy__status--ongoing"),n.removeClass("kt-uppy__status--hidden"),clearTimeout(t)}),r.on("complete",function(e){$.each(e.successful,function(e,t){var i="bytes",a=t.size;a>1024&&(i="kb",(a/=1024)>1024&&(a/=1024,i="MB"));var p='<div class="kt-uppy__list-item" data-id="'+t.id+'"><div class="kt-uppy__list-label">'+t.name+" ("+Math.round(a,2)+" "+i+')</div><span class="kt-uppy__list-remove" data-id="'+t.id+'"><i class="flaticon2-cancel-music"></i></span></div>';o.append(p)}),u.text("Add more files"),t=window.setTimeout(function(){n.addClass("kt-uppy__status--hidden"),n.removeClass("kt-uppy__status--ongoing")},5e3)}),$(document).on("click",s+" .kt-uppy__list .kt-uppy__list-remove",function(){var e=$(this).attr("data-id");r.removeFile(e),$(s+' .kt-uppy__list-item[data-id="'+e+'"').remove()})}(),function(){var t="#kt_uppy_6",i={proudlyDisplayPoweredByUppy:!1,target:t+" .kt-uppy__dashboard",inline:!1,replaceTargetContent:!0,showProgressDetails:!0,note:"No filetype restrictions.",height:470,metaFields:[{id:"name",name:"Name",placeholder:"file name"},{id:"caption",name:"Caption",placeholder:"describe what the image is about"}],browserBackButtonClose:!0,trigger:t+" .kt-uppy__btn"},a=Uppy.Core({autoProceed:!0,restrictions:{maxFileSize:1e6,maxNumberOfFiles:5,minNumberOfFiles:1}});a.use(s,i),a.use(e,{endpoint:"https://master.tus.io/files/"}),a.use(o,{target:s,companionUrl:"https://companion.uppy.io"}),a.use(n,{target:s,companionUrl:"https://companion.uppy.io"}),a.use(r,{target:s,companionUrl:"https://companion.uppy.io"}),a.use(u,{target:s})}(),swal.fire({title:"Notice",html:"Uppy demos uses <b>https://master.tus.io/files/</b> URL for resumable upload examples and your uploaded files will be temporarely stored in <b>tus.io</b> servers.",type:"info",buttonsStyling:!1,confirmButtonClass:"btn btn-brand kt-btn kt-btn--wide",confirmButtonText:"Ok, I understand",onClose:function(e){console.log("on close event fired!")}})}}}();KTUtil.ready(function(){KTUppy.init()});