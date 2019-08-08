"use strict";var KTDefaultDatatableDemo={init:function(){var t;t=$(".kt_datatable").KTDatatable({data:{type:"remote",source:{read:{url:"inc/api/datatables/demos/default.php"}},pageSize:20,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{theme:"default",class:"",scroll:!0,height:550,footer:!1},sortable:!0,filterable:!1,pagination:!0,search:{input:$("#generalSearch")},columns:[{field:"id",title:"#",sortable:!1,width:20,type:"number",selector:{class:"kt-checkbox--solid"},textAlign:"center"},{field:"employee_id",title:"Employee ID"},{field:"name",title:"Name",template:function(t){return t.first_name+" "+t.last_name}},{field:"email",width:150,title:"Email"},{field:"phone",title:"Phone"},{field:"hire_date",title:"Hire Date",type:"date",format:"MM/DD/YYYY"},{field:"gender",title:"Gender"},{field:"status",title:"Status",template:function(t){var e={1:{title:"Pending",class:"kt-badge--brand"},2:{title:"Delivered",class:" kt-badge--metal"},3:{title:"Canceled",class:" kt-badge--primary"},4:{title:"Success",class:" kt-badge--success"},5:{title:"Info",class:" kt-badge--info"},6:{title:"Danger",class:" kt-badge--danger"},7:{title:"Warning",class:" kt-badge--warning"}};return'<span class="kt-badge '+e[t.status].class+' kt-badge--inline kt-badge--pill">'+e[t.status].title+"</span>"}},{field:"type",title:"Type",autoHide:!1,template:function(t){var e={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"accent"}};return'<span class="kt-badge kt-badge--'+e[t.type].state+' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-'+e[t.type].state+'">'+e[t.type].title+"</span>"}},{field:"Actions",title:"Actions",sortable:!1,width:110,overflow:"visible",autoHide:!1,template:function(){return'\t\t\t\t\t\t\t<div class="dropdown">\t\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\t                                <i class="la la-ellipsis-h"></i>\t                            </a>\t\t\t\t\t\t\t    <div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t\t        <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t\t    </div>\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\t\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t\t</a>\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\t\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t\t</a>\t\t\t\t\t\t'}}]}),$("#kt_form_status").on("change",function(){t.search($(this).val().toLowerCase(),"status")}),$("#kt_form_type").on("change",function(){t.search($(this).val().toLowerCase(),"type")}),$("#kt_form_status,#kt_form_type").selectpicker()}};jQuery(document).ready(function(){KTDefaultDatatableDemo.init()});