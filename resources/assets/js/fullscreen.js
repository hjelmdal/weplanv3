(function(document,navigator,standalone) {
    if ((standalone in navigator) && navigator[standalone]) {
        var insideApp = sessionStorage.getItem('insideApp'), location = window.location, stop = /^(a|html)$/i;
        if ( insideApp ) {
            localStorage.setItem('returnToPage', location);
        } else {
            var returnToPage = localStorage.getItem('returnToPage');
            if ( returnToPage ) {
                window.location = returnToPage;
            }
            sessionStorage.setItem('insideApp', true);
        }
        document.addEventListener('click', function(event) {
            var clickedLink = event.target;
            while (!(stop).test(clickedLink.nodeName)) {
                clickedLink = clickedLink.parentNode;
            }
            if('href' in clickedLink && ( clickedLink.href.indexOf('http') || ~clickedLink.href.indexOf(location.host) ) ) {
                event.preventDefault();
                location.href = clickedLink.href;
            }
        },false);
    }
})(document,window.navigator,'standalone');
