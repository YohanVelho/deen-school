
function Translatable()
{
    function init()
    {
        $('.translate').editable({
            mode: 'inline',
            params: function(params) {
                params.code = $(this).editable().data('code');
                return params;
            }
        });

        $('body').on('click', '.remove-key', remove);
    }

    function remove()
    {
        var cObj = $(this);
        if (confirm("Tem certeza que deseja remover esse item?")) {
            $.ajax({
                url: cObj.data('action'),
                method: 'DELETE',
                success: function(data) {
                    cObj.parents("tr").remove();
                }
            });
        }
    }

    return {
        init
    };
}


$(function(){
    var translatable = new Translatable();
    translatable.init();
});
