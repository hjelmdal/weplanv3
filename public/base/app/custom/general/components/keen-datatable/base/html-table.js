"use strict";var DatatableHtmlTableDemo={init:function(){var e;e=$(".k-datatable").KDatatable({data:{saveState:{cookie:!1}},search:{input:$("#generalSearch")},columns:[{field:"DepositPaid",type:"number"},{field:"OrderDate",type:"date",format:"YYYY-MM-DD"},{field:"Status",title:"Status",autoHide:!1,template:function(e){var t={1:{title:"Pending",class:"k-badge--brand"},2:{title:"Delivered",class:" k-badge--metal"},3:{title:"Canceled",class:" k-badge--primary"},4:{title:"Success",class:" k-badge--success"},5:{title:"Info",class:" k-badge--info"},6:{title:"Danger",class:" k-badge--danger"},7:{title:"Warning",class:" k-badge--warning"}};return'<span class="k-badge '+t[e.Status].class+' k-badge--inline k-badge--pill">'+t[e.Status].title+"</span>"}},{field:"Type",title:"Type",autoHide:!1,template:function(e){var t={1:{title:"Online",state:"danger"},2:{title:"Retail",state:"primary"},3:{title:"Direct",state:"accent"}};return'<span class="k-badge k-badge--'+t[e.Type].state+' k-badge--dot"></span>&nbsp;<span class="k-font-bold k-font-'+t[e.Type].state+'">'+t[e.Type].title+"</span>"}}]}),$("#k_form_status").on("change",function(){e.search($(this).val().toLowerCase(),"status")}),$("#k_form_type").on("change",function(){e.search($(this).val().toLowerCase(),"type")}),$("#k_form_status,#k_form_type").selectpicker()}};jQuery(document).ready(function(){DatatableHtmlTableDemo.init()});