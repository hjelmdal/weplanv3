"use strict";var KTDatatableColumnRenderingDemo={init:function(){var t;t=$(".kt_datatable").KTDatatable({data:{type:"remote",source:{read:{url:"inc/api/datatables/demos/default.php"}},pageSize:10,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{theme:"default",class:"",scroll:!1,footer:!1},sortable:!0,pagination:!0,search:{input:$("#generalSearch"),delay:400},columns:[{field:"id",title:"#",sortable:"asc",width:30,type:"number",selector:!1,textAlign:"center"},{field:"employee_id",title:"Employee ID",template:function(t){var e=KTUtil.getRandomInt(1,14);return e>8?'<div class="kt-user-card-v2">\t\t\t\t\t\t\t\t<div class="kt-user-card-v2__pic">\t\t\t\t\t\t\t\t\t<img src="https://keenthemes.com/keen/themes/themes/keen/dist/preview/assets/media/users/100_'+e+'.jpg" alt="photo">\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t<div class="kt-user-card-v2__details">\t\t\t\t\t\t\t\t\t<span class="kt-user-card-v2__name">'+t.first_name+'</span>\t\t\t\t\t\t\t\t\t<a href="#" class="kt-user-card-v2__email kt-link">'+t.last_name+"</a>\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t</div>":'<div class="kt-user-card-v2">\t\t\t\t\t\t\t\t<div class="kt-user-card-v2__pic">\t\t\t\t\t\t\t\t\t<div class="kt-badge kt-badge--xl kt-badge--'+["success","brand","danger","accent","warning","metal","primary","info"][KTUtil.getRandomInt(0,7)]+'">'+t.first_name.substring(0,1)+'</div>\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t<div class="kt-user-card-v2__details">\t\t\t\t\t\t\t\t\t<span class="kt-user-card-v2__name">'+t.first_name+'</span>\t\t\t\t\t\t\t\t\t<a href="#" class="kt-user-card-v2__email kt-link">'+t.last_name+"</a>\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t</div>"}},{field:"name",title:"Name",template:function(t){return t.first_name+" "+t.last_name}},{field:"hire_date",title:"Hire Date",type:"date",format:"MM/DD/YYYY"},{field:"gender",title:"Gender"},{field:"status",title:"Status",template:function(t){var e={1:{title:"Pending",class:"kt-badge--brand"},2:{title:"Delivered",class:" kt-badge--metal"},3:{title:"Canceled",class:" kt-badge--primary"},4:{title:"Success",class:" kt-badge--success"},5:{title:"Info",class:" kt-badge--info"},6:{title:"Danger",class:" kt-badge--danger"},7:{title:"Warning",class:" kt-badge--warning"}};return'<span class="kt-badge '+e[t.status].class+' kt-badge--inline kt-badge--pill">'+e[t.status].title+"</span>"}},{field:"type",title:"Type",autoHide:!1,template:function(t){var e={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"accent"}};return'<span class="kt-badge kt-badge--'+e[t.type].state+' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-'+e[t.type].state+'">'+e[t.type].title+"</span>"}},{field:"Actions",title:"Actions",sortable:!1,width:110,overflow:"visible",autoHide:!1,template:function(){return'\t\t\t\t\t\t\t<div class="dropdown">\t\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\t                                <i class="la la-ellipsis-h"></i>\t                            </a>\t\t\t\t\t\t\t    <div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t\t    </div>\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\t\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t\t</a>\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\t\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t\t</a>\t\t\t\t\t\t'}}]}),$("#kt_form_status").on("change",function(){t.search($(this).val().toLowerCase(),"status")}),$("#kt_form_type").on("change",function(){t.search($(this).val().toLowerCase(),"type")}),$("#kt_form_status,#kt_form_type").selectpicker()}};jQuery(document).ready(function(){KTDatatableColumnRenderingDemo.init()});