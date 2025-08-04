
function Action()
{
    function init()
    {
        $('[data-action-link]').on('click', go);
    }

    function go(){
        const link = $(this).attr('data-action-link');
        $('#form').append('<input type="hidden" name="redirect" value="'+link+'" />');
        $('#form').submit();
    }

    return {
        init
    };
}


$(function(){
    var action = new Action();
    action.init();
});
