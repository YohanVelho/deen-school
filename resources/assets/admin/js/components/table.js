function Table()
{
    function init()
    {
        $('.table-add').on('click', add);
        $('table').on('click', '.table-delete', remove);
    }

    function add(){
        const parent = $(this).parent().parent();
        const index = parent.children('table').children('tbody').children('tr').length;
        let template = parent.children('template').html();
        template = template.split('{index}').join(index);
        parent.children('table').children('tbody').append(template);

        const lang = $('[data-select-lang].active').attr('data-select-lang');
        $('[data-lang]').removeClass('active');
        $('[data-lang="'+lang+'"]').addClass('active');
    }

    function remove(){
        $(this).parent().parent().hide();
        $(this).parent().children('input').val(1);
    }

    return {
        init: init
    };
}

$(function(){
    var table = new Table();
    table.init();
});
