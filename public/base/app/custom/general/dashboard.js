var KTDashboard={init:function(){KTLib.initMediumChart("kt_widget_mini_chart_1",[20,45,20,10,20,35,20,25,10,10],70,KTApp.getStateColor("brand")),KTLib.initMediumChart("kt_widget_mini_chart_2",[10,15,25,45,15,30,10,40,15,25],70,KTApp.getStateColor("danger")),KTLib.initMediumChart("kt_widget_mini_chart_3",[22,15,40,10,35,20,30,50,15,10],70,KTApp.getBaseColor("shape",4)),KTLib.initMiniChart($("#kt_widget_latest_products_chart_1"),[6,12,9,18,15,9,11,8],KTApp.getStateColor("info"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_latest_products_chart_2"),[8,6,13,16,9,6,11,14],KTApp.getStateColor("warning"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_latest_products_chart_3"),[8,6,13,16,9,6,11,14],KTApp.getStateColor("warning"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_latest_products_chart_4"),[3,9,9,18,15,9,11,8],KTApp.getStateColor("success"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_latest_products_chart_5"),[5,7,9,18,15,9,11,8],KTApp.getStateColor("brand"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_latest_products_chart_6"),[3,9,5,18,15,7,11,6],KTApp.getStateColor("danger"),2,!1,!1),function(){if(0!=$("#kt_dashboard_daterangepicker").length){var t=$("#kt_dashboard_daterangepicker"),e=moment(),a=moment();t.daterangepicker({direction:KTUtil.isRTL(),startDate:e,endDate:a,opens:"left",applyClass:"btn btn-sm btn-primary",cancelClass:"btn btn-sm btn-secondary",ranges:{Today:[moment(),moment()],Yesterday:[moment().subtract(1,"days"),moment().subtract(1,"days")],"Last 7 Days":[moment().subtract(6,"days"),moment()],"Last 30 Days":[moment().subtract(29,"days"),moment()],"This Month":[moment().startOf("month"),moment().endOf("month")],"Last Month":[moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]}},o),o(e,a,"")}function o(e,a,o){var r="",i="";a-e<100||"Today"==o?(r="Today:",i=e.format("MMM D")):"Yesterday"==o?(r="Yesterday:",i=e.format("MMM D")):i=e.format("MMM D")+" - "+a.format("MMM D"),t.find("#kt_dashboard_daterangepicker_date").html(i),t.find("#kt_dashboard_daterangepicker_title").html(r)}}(),function(){if(KTLib.initMiniChart($("#kt_widget_general_statistics_chart_1"),[6,8,3,18,15,7,11,7],KTApp.getStateColor("warning"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_general_statistics_chart_2"),[8,6,9,18,15,7,11,16],KTApp.getStateColor("brand"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_general_statistics_chart_3"),[4,12,9,18,15,7,11,12],KTApp.getStateColor("danger"),2,!1,!1),KTLib.initMiniChart($("#kt_widget_general_statistics_chart_4"),[3,14,5,12,15,8,14,16],KTApp.getStateColor("success"),2,!1,!1),document.getElementById("kt_widget_general_statistics_chart_main")){var t=document.getElementById("kt_widget_general_statistics_chart_main").getContext("2d"),e=t.createLinearGradient(0,0,0,350);e.addColorStop(0,Chart.helpers.color(KTApp.getStateColor("brand")).alpha(.3).rgbString()),e.addColorStop(1,Chart.helpers.color(KTApp.getStateColor("brand")).alpha(0).rgbString());var a=t.createLinearGradient(0,0,0,350);a.addColorStop(0,Chart.helpers.color(KTApp.getStateColor("danger")).alpha(.3).rgbString()),a.addColorStop(1,Chart.helpers.color(KTApp.getStateColor("danger")).alpha(0).rgbString());var o={type:"line",data:{labels:["January","February","March","April","May","June","July","August","September","October"],datasets:[{label:"Sales",borderColor:KTApp.getStateColor("brand"),borderWidth:2,backgroundColor:e,pointBackgroundColor:KTApp.getStateColor("brand"),data:[30,60,25,7,5,15,30,20,15,10]},{label:"Orders",borderWidth:1,borderColor:KTApp.getStateColor("danger"),backgroundColor:a,pointBackgroundColor:KTApp.getStateColor("danger"),data:[10,15,25,35,15,30,55,40,65,40]}]},options:{responsive:!0,maintainAspectRatio:!1,title:{display:!1,text:""},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0},legend:{display:!1,labels:{usePointStyle:!1}},hover:{mode:"index"},scales:{xAxes:[{display:!1,scaleLabel:{display:!1,labelString:"Month"},ticks:{display:!1,beginAtZero:!0}}],yAxes:[{display:!0,stacked:!1,scaleLabel:{display:!1,labelString:"Value"},gridLines:{color:"#eef2f9",drawBorder:!1,offsetGridLines:!0,drawTicks:!1},ticks:{display:!1,beginAtZero:!0}}]},elements:{point:{radius:0,borderWidth:0,hoverRadius:0,hoverBorderWidth:0}},layout:{padding:{left:0,right:0,top:0,bottom:0}}}},r=new Chart(t,o);KTUtil.addResizeHandler(function(){r.update()})}}(),function(){if(0!==$("#kt_recent_orders").length){var t=$("#kt_recent_orders").KTDatatable({data:{type:"remote",source:{read:{url:"inc/api/datatables/demos/default.php"}},pageSize:10,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{scroll:!0,footer:!1,height:430},sortable:!0,pagination:!0,search:{input:$("#generalSearch")},columns:[{field:"id",title:"#",sortable:!1,width:20,type:"number",selector:{class:"kt-checkbox--solid"},textAlign:"center"},{field:"employee_id",title:"Order ID",template:function(t){return'<span class="kt-label-font-color-3 kt-font-bold">'+t.employee_id+"</span>"}},{field:"name",title:"Customer",width:130,template:function(t){return'<span class="kt-label-font-color-3 kt-font-bold">'+t.first_name+" "+t.last_name+"</span>"}},{field:"hire_date",title:"Date",type:"date",format:"MM/DD/YYYY"},{field:"status",title:"Status",autoHide:!1,template:function(t){var e={1:{title:"Pending",class:"brand"},2:{title:"Delivered",class:"focus"},3:{title:"Canceled",class:"primary"},4:{title:"Success",class:"success"},5:{title:"Info",class:"info"},6:{title:"Danger",class:"danger"},7:{title:"Warning",class:"warning"}};return'<span class="kt-badge kt-badge--'+e[t.status].class+' kt-badge--dot kt-badge--md"></span>&nbsp;&nbsp;<span class="kt-label-font-color-2 kt-font-bold">'+e[t.type].title+"</span>"}},{field:"Actions",title:"Actions",sortable:!1,width:80,overflow:"visible",textAlign:"center",autoHide:!1,template:function(){return'                        <div class="dropdown" >                            <a href="#" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>                            <div class="dropdown-menu dropdown-menu-right">                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>                            </div>                        </div>                        <a href="#" class="btn btn-clean btn-icon btn-sm btn-icon-md" title="Edit details">                            <i class="la la-edit"></i>                        </a>                    '}}]});$("#kt_form_status").on("change",function(){t.search($(this).val().toLowerCase(),"status")}),$("#kt_form_type").on("change",function(){t.search($(this).val().toLowerCase(),"type")}),$("#kt_form_status,#kt_form_type").selectpicker(),KTLayout.getAsideSecondaryToggler&&KTLayout.getAsideSecondaryToggler()&&KTLayout.getAsideSecondaryToggler().on("toggle",function(){t.redraw()}),t.closest(".kt-content__body").find('[data-toggle="tab"]').on("shown.bs.tab",function(e){t.redraw()})}}(),function(){if(0!=$("#kt_widget_technologies_chart").length){var t={type:"doughnut",data:{datasets:[{data:[35,30,35],backgroundColor:[KTApp.getBaseColor("shape",3),KTApp.getBaseColor("shape",4),KTApp.getStateColor("brand")]}],labels:["Angular","CSS","HTML"]},options:{cutoutPercentage:75,responsive:!0,maintainAspectRatio:!1,legend:{display:!1,position:"top"},title:{display:!1,text:"Technology"},animation:{animateScale:!0,animateRotate:!0},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0}}},e=document.getElementById("kt_widget_technologies_chart").getContext("2d");new Chart(e,t)}}(),function(){if(0!=$("#kt_widget_technologies_chart_2").length){var t={type:"doughnut",data:{datasets:[{data:[35,30,35],backgroundColor:[KTApp.getStateColor("warning"),KTApp.getStateColor("brand"),KTApp.getStateColor("success")]}],labels:["CSS","Angular","HTML"]},options:{cutoutPercentage:75,responsive:!0,maintainAspectRatio:!1,legend:{display:!1,position:"top"},title:{display:!1,text:"Technology"},animation:{animateScale:!0,animateRotate:!0},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0}}},e=document.getElementById("kt_widget_technologies_chart_2").getContext("2d");new Chart(e,t)}}(),function(){if(document.getElementById("kt_widget_total_orders_chart")){var t=KTApp.getStateColor("brand"),e=document.getElementById("kt_widget_total_orders_chart").getContext("2d"),a=e.createLinearGradient(0,0,0,120);a.addColorStop(0,Chart.helpers.color(t).alpha(.3).rgbString()),a.addColorStop(1,Chart.helpers.color(t).alpha(0).rgbString());var o={type:"line",data:{labels:["January","February","March","April","May","June","July","August","September","October"],datasets:[{label:"Orders",borderColor:t,borderWidth:3,backgroundColor:a,pointBackgroundColor:KTApp.getStateColor("brand"),data:[30,35,45,65,35,50,40,60,35,45]}]},options:{responsive:!0,maintainAspectRatio:!0,title:{display:!1,text:"Stacked Area"},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0},legend:{display:!1,labels:{usePointStyle:!1}},hover:{mode:"index"},scales:{xAxes:[{display:!1,scaleLabel:{display:!1,labelString:"Month"},ticks:{display:!1,beginAtZero:!0}}],yAxes:[{display:!1,scaleLabel:{display:!1,labelString:"Value"},gridLines:{color:"#eef2f9",drawBorder:!1,offsetGridLines:!0,drawTicks:!1},ticks:{max:80,display:!1,beginAtZero:!0}}]},elements:{point:{radius:0,borderWidth:0,hoverRadius:0,hoverBorderWidth:0}},layout:{padding:{left:0,right:0,top:0,bottom:0}}}},r=new Chart(e,o);KTUtil.addResizeHandler(function(){r.update()})}}(),function(){if(document.getElementById("kt_widget_total_orders_chart_2")){var t=KTApp.getStateColor("danger"),e=document.getElementById("kt_widget_total_orders_chart_2").getContext("2d"),a=e.createLinearGradient(0,0,0,120);a.addColorStop(0,Chart.helpers.color(t).alpha(.3).rgbString()),a.addColorStop(1,Chart.helpers.color(t).alpha(0).rgbString());var o={type:"line",data:{labels:["January","February","March","April","May","June","July","August","September","October"],datasets:[{label:"Orders",borderColor:t,borderWidth:3,backgroundColor:a,pointBackgroundColor:KTApp.getStateColor("brand"),data:[30,35,45,65,35,50,40,60,35,45]}]},options:{responsive:!0,maintainAspectRatio:!0,title:{display:!1,text:"Stacked Area"},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0},legend:{display:!1,labels:{usePointStyle:!1}},hover:{mode:"index"},scales:{xAxes:[{display:!1,scaleLabel:{display:!1,labelString:"Month"},ticks:{display:!1,beginAtZero:!0}}],yAxes:[{display:!1,scaleLabel:{display:!1,labelString:"Value"},gridLines:{color:"#eef2f9",drawBorder:!1,offsetGridLines:!0,drawTicks:!1},ticks:{max:80,display:!1,beginAtZero:!0}}]},elements:{point:{radius:0,borderWidth:0,hoverRadius:0,hoverBorderWidth:0}},layout:{padding:{left:0,right:0,top:0,bottom:0}}}},r=new Chart(e,o);KTUtil.addResizeHandler(function(){r.update()})}}(),function(){if(document.getElementById("kt_chart_sales_statistics")){var t=Chart.helpers.color,e={labels:["1 Aug","2 Aug","3 Aug","4 Aug","5 Aug","6 Aug","7 Aug"],datasets:[{label:"Sales",backgroundColor:t(KTApp.getStateColor("brand")).alpha(1).rgbString(),borderWidth:0,data:[20,30,40,35,45,55,45]},{label:"Orders",backgroundColor:t(KTApp.getBaseColor("shape",1)).alpha(1).rgbString(),borderWidth:0,data:[25,35,45,40,50,60,50]}]},a=document.getElementById("kt_chart_sales_statistics").getContext("2d");new Chart(a,{type:"bar",data:e,options:{responsive:!0,maintainAspectRatio:!1,legend:!1,scales:{xAxes:[{categoryPercentage:.35,barPercentage:.7,display:!0,scaleLabel:{display:!1,labelString:"Month"},gridLines:!1,ticks:{display:!0,beginAtZero:!0,fontColor:KTApp.getBaseColor("shape",3),fontSize:13,padding:10}}],yAxes:[{categoryPercentage:.35,barPercentage:.7,display:!0,scaleLabel:{display:!1,labelString:"Value"},gridLines:{color:KTApp.getBaseColor("shape",2),drawBorder:!1,offsetGridLines:!1,drawTicks:!1,borderDash:[3,4],zeroLineWidth:1,zeroLineColor:KTApp.getBaseColor("shape",2),zeroLineBorderDash:[3,4]},ticks:{max:70,stepSize:10,display:!0,beginAtZero:!0,fontColor:KTApp.getBaseColor("shape",3),fontSize:13,padding:10}}]},title:{display:!1},hover:{mode:"index"},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0},layout:{padding:{left:0,right:0,top:5,bottom:5}}}})}}(),function(){if(document.getElementById("kt_chart_revenue_growth")){var t=Chart.helpers.color,e={labels:["1 Aug","2 Aug","3 Aug","4 Aug","5 Aug","6 Aug","7 Aug","8 Aug","9 Aug","10 Aug","11 Aug","12 Aug"],datasets:[{label:"Sales",backgroundColor:t(KTApp.getStateColor("brand")).alpha(1).rgbString(),borderWidth:0,data:[10,40,20,40,40,60,40,80,40,70,40,70],borderColor:KTApp.getStateColor("brand"),borderWidth:3,backgroundColor:t(KTApp.getStateColor("brand")).alpha(.07).rgbString(),fill:!0}]},a=document.getElementById("kt_chart_revenue_growth").getContext("2d");new Chart(a,{type:"line",data:e,options:{responsive:!0,maintainAspectRatio:!1,legend:!1,scales:{xAxes:[{categoryPercentage:.35,barPercentage:.7,display:!0,scaleLabel:{display:!1,labelString:"Month"},gridLines:!1,ticks:{display:!0,beginAtZero:!0,fontColor:KTApp.getBaseColor("shape",3),fontSize:13,padding:10}}],yAxes:[{categoryPercentage:.35,barPercentage:.7,display:!0,scaleLabel:{display:!1,labelString:"Value"},gridLines:{color:KTApp.getBaseColor("shape",2),drawBorder:!1,offsetGridLines:!1,drawTicks:!1,borderDash:[3,4],zeroLineWidth:1,zeroLineColor:KTApp.getBaseColor("shape",2),zeroLineBorderDash:[3,4]},ticks:{max:100,stepSize:20,display:!0,beginAtZero:!0,fontColor:KTApp.getBaseColor("shape",3),fontSize:13,padding:10}}]},title:{display:!1},hover:{mode:"index"},elements:{line:{tension:.5},point:{radius:0}},tooltips:{enabled:!0,intersect:!1,mode:"nearest",bodySpacing:5,yPadding:10,xPadding:10,caretPadding:0,displayColors:!1,backgroundColor:KTApp.getStateColor("brand"),titleFontColor:"#ffffff",cornerRadius:4,footerSpacing:0,titleSpacing:0},layout:{padding:{left:0,right:0,top:5,bottom:5}}}})}}()}};jQuery(document).ready(function(){KTDashboard.init()});
