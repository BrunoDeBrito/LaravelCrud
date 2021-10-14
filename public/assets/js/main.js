'use strict';
$(function() {
    
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.btn-remove').on('click', function() {

        var $btn = $(this);
        var id = $btn.data('id');

        if (id) {

            var htmlForm = 
            `<form method="POST">
                <input type="hidden" name="id" value="${id}"/>
                <input type="hidden" name="_token" value="${csrfToken}"/>
                <input type="hidden" name="_method" value="DELETE"/>
            </form>`;

            var $form = $(htmlForm);
            $('body').append($form);

            $form.submit();

        }

    });

    $('main.parameters.create-edit').each(function() {

        var $self = $(this);

        var $btnAdd = $self.find('.btn-add');
        var $table = $self.find('.option-list');

        var $row = $table.find('tbody tr').eq(0).clone();
        $row.find('input').val('');

        $btnAdd.on('click', function() {

            
            if ($table.find('tbody tr').length < 10) {

                var $newRow = $row.clone();
                $table.find('tbody').append($newRow);

            }

        });

        $table.on('click', 'tr td .btn-remove-option', function() {

            if ($(this).closest('tbody').find('tr').length > 1) {
                $(this).closest('tr').remove();
            }

        });

    });

});
