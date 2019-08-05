export default class Notification {
    constructor() {
        this.message = "";
        this.title = "";
        this.type = "";
    }


    send(type,message,title = false) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showMethod = "fadeIn";
            toastr.options.showDuration = 1000;
            toastr.options.extendedTimeOut = 100000;
            if(type == "info") {
                toastr.info(message,title);
            }
            //toastr.{{ Session::get('message-type','info') }}('{{ Session::get('message') . session('status') }}', '{{ Session::get('message-title',Session::get('title')) }}');
    }
}