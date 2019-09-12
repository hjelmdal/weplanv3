export default class Notification {
    constructor() {
        this.message = "";
        this.title = "";
        this.type = "";
    }


    send(type,message,title = false) {
            this.message = message;
            this.title = title;
            this.type = type;
            toastr.options.closeButton = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showMethod = "fadeIn";
            toastr.options.showDuration = 1000;
            toastr.options.extendedTimeOut = 100000;
            if(type == "info") {
                toastr.info(message,title);
            } else if(type == "error") {
                toastr.error(message,title);
            } else if(type == "success") {
                toastr.success(message,title);
            }
            //toastr.{{ Session::get('message-type','info') }}('{{ Session::get('message') . session('status') }}', '{{ Session::get('message-title',Session::get('title')) }}');
    }
}