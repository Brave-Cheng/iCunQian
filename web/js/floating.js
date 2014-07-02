if (!navigator.appVersion.match('MSIE 6.')) {
    var header, header_offset, header_copy;
    var editName = $('#name').val();
    $(window).bind('load',function(){
        createTopButtonToolbarToggle();
    });
    $(window).bind('scroll resize',function(){
        floatingTopButtonToolbarToggle();
    });

    function createTopButtonToolbarToggle()
    {
        header = $('.content-header')[0];
        //header_copy = $('.content-header-floating')[0];
        if (!header) {
            return;
        }
        header_offset = $(header).offset().top;

        header_copy = document.createElement('div');
        header_copy.appendChild(header.cloneNode(true));
        document.body.insertBefore(header_copy, document.body.lastChild);
        $(header_copy).addClass('content-header-floating');
        if(editName != ""){
            $(header_copy).find('h2').html(editName);
        }
    }

    function updateTopButtonToolbarToggle()
    {
        if (header_copy) {
            header_copy.remove();
        }
        createTopButtonToolbarToggle();
        floatingTopButtonToolbarToggle();
    }

    function floatingTopButtonToolbarToggle() {
        if (!header) {
            return;
        }
        var s;
        // scrolling offset
        if (self.pageYOffset){
            s = self.pageYOffset;
        }else if (document.documentElement && document.documentElement.scrollTop) {
            s = document.documentElement.scrollTop;
        }else if (document.body) {
            s = document.body.scrollTop;
        }

        if (s > header_offset) {
            //header.style.visibility = 'hidden';
            header_copy.style.display = 'block';
        } else {
            header.style.visibility = 'visible';
            header_copy.style.display = 'none';

        }
    }
}