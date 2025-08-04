
function Main()
{
    function init()
    {
        $('.js-open-collapse').on('click', menu_toggle);
        $('.mobile-menu').on('click', mobile_toggle);
        $('.mobile-close').on('click', mobile_toggle);
        csrf();
    }

    function menu_toggle(){
        $(this).parent().toggleClass('show');
    }

    function mobile_toggle()
    {
        $('.sidenav').toggleClass('active');
    }

    function csrf()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    return {
        init
    };
}


$(function(){
    var main = new Main();
    main.init();
});




