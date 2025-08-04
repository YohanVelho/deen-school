function Gallery()
{
    function init()
    {
        $('.gallery-add').on('click', add);
        $('.gallery').on('click', '.gallery-delete', remove);
        empty();
    }

    function add(){
        const parent = $(this).parent().parent();
        const index = parent.children('.gallery').children('.gallery-item').length;
        let template = parent.children('template').html();
        template = template.split('{index}').join(index);
        parent.children('.gallery').append(template);
        empty();
    }

    function remove(){
        $(this).parents('.gallery-item').hide();
        $(this).parent().children('input').val(1);
        empty();
    }

    function empty(){
        $('.gallery').each(function(){
            if($(this).children('.gallery-item').length == 0){
                $(this).parent().find('.gallery-empty').show();
            }else{
                $(this).parent().find('.gallery-empty').hide();
            }
        });
    }

    return {
        init: init
    };
}

$(function(){
    var gallery = new Gallery();
    gallery.init();
});
