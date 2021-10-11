'use strict';
$(function() {
    
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.btn-remove').on('click', function() {

        var $btn = $(this);
        var id = $btn.data('id');

        console.log(id);

        if (id) {

            var htmlForm = `<form method="POST">
                <input type="hidden" name="id" value="${id}"/>
                <input type="hidden" name="_token" value="${csrfToken}"/>
                <input type="hidden" name="_method" value="DELETE"/>
            </form>`;

            var $form = $(htmlForm);
            $('body').append($form);

            $form.submit();

        }

    });

});
