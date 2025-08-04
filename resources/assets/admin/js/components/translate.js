
function Translate()
{
    function init()
    {
        change();
        $('[data-select-lang]').on('click', select_lang);
    }

    function select_lang(){
        $('[data-select-lang]').removeClass('active');
        $(this).addClass('active');
        change();
    }

    function change(){
        const lang = $('[data-select-lang].active').attr('data-select-lang');
        $('[data-lang]').removeClass('active');
        $('[data-lang="'+lang+'"]').addClass('active');
    }

    return {
        init
    };
}


$(function(){
    var translate = new Translate();
    translate.init();
});
