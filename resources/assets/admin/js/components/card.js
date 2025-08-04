function Card()
{

    function init(){
        $('.switch-card').each(switch_bg);
        $('.switch-card').on('click', switch_bg);
    }


    function switch_bg(){
        if(!$(this).find('input[type=checkbox]').prop('checked')){
            $(this).parent().parent().parent().addClass('desactivated');
        }else{
            $(this).parent().parent().parent().removeClass('desactivated');
        }
    }


    return {
        init
    };

}

$(function(){
    var card = new Card();
    card.init();
});
