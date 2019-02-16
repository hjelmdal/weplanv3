"use strict";var DefaultDatatableDemo=function(){var t=function(t){var a=$("#k_datatable_console").append(t+"\t\n");$(a).scrollTop(a[0].scrollHeight-$(a).height())};return{init:function(){var a;a=$(".k_datatable").KDatatable({data:{type:"remote",source:{read:{url:"inc/api/datatables/demos/default.php"}},pageSize:5,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{theme:"default",class:"",scroll:!0,height:"auto",footer:!1},sortable:!0,toolbar:{placement:["bottom"],items:{pagination:{pageSizeSelect:[5,10,20,30,50]}}},search:{input:$("#generalSearch")},columns:[{field:"id",title:"#",sortable:"asc",width:30,type:"number",selector:!1,textAlign:"center"},{field:"employee_id",title:"Employee ID"},{field:"name",title:"Name",template:function(t){return t.first_name+" "+t.last_name}},{field:"hire_date",title:"Hire Date",type:"date",format:"MM/DD/YYYY"},{field:"gender",title:"Gender"},{field:"status",title:"Status",template:function(t){var a={1:{title:"Pending",class:"k-badge--brand"},2:{title:"Delivered",class:" k-badge--metal"},3:{title:"Canceled",class:" k-badge--primary"},4:{title:"Success",class:" k-badge--success"},5:{title:"Info",class:" k-badge--info"},6:{title:"Danger",class:" k-badge--danger"},7:{title:"Warning",class:" k-badge--warning"}};return'<span class="k-badge '+a[t.status].class+' k-badge--inline k-badge--pill">'+a[t.status].title+"</span>"}},{field:"type",title:"Type",autoHide:!1,template:function(t){var a={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"accent"}};return'<span class="k-badge k-badge--'+a[t.type].state+' k-badge--dot"></span>&nbsp;<span class="k-font-bold k-font-'+a[t.type].state+'">'+a[t.type].title+"</span>"}},{field:"Actions",title:"Actions",sortable:!1,width:110,overflow:"visible",autoHide:!1,template:function(){return'\t\t\t\t\t\t<div class="dropdown">\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'}}]}),$("#k_datatable_clear").on("click",function(){$("#k_datatable_console").html("")}),$("#k_datatable_reload").on("click",function(){a.reload()}),$("#k_form_status").on("change",function(){a.search($(this).val().toLowerCase(),"status")}),$("#k_form_type").on("change",function(){a.search($(this).val().toLowerCase(),"type")}),$("#k_form_status,#k_form_type").selectpicker(),$(".k_datatable").on("k-datatable--on-init",function(){t("Datatable init")}).on("k-datatable--on-layout-updated",function(){t("Layout render updated")}).on("k-datatable--on-ajax-done",function(){t("Ajax data successfully updated")}).on("k-datatable--on-ajax-fail",function(a,e){t("Ajax error")}).on("k-datatable--on-goto-page",function(a,e){t("Goto to pagination: "+e.page)}).on("k-datatable--on-update-perpage",function(a,e){t("Update page size: "+e.perpage)}).on("k-datatable--on-reloaded",function(a){t("Datatable reloaded")}).on("k-datatable--on-check",function(a,e){t("Checkbox active: "+e.toString())}).on("k-datatable--on-uncheck",function(a,e){t("Checkbox inactive: "+e.toString())}).on("k-datatable--on-sort",function(a,e){t("Datatable sorted by "+e.field+" "+e.sort)})}}}();jQuery(document).ready(function(){DefaultDatatableDemo.init()});