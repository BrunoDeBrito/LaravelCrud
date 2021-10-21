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

    $('main.products.create-edit').each(function() {

        //REVIEW Quando clicar para adicionar uma uma configuração. clonar a ja existente.
        //REVIEW e quando clicar para adicionar um novo parametro clonar o parametro existente.

        //TODO Criar Coluna dos preço  => coluna
        //TODO Criar Coluna das opções => linha
        var $self = $(this);

        var $configItem = $self.find('.config-item').first().clone();
        var $configParam = $configItem.find('.parameter-item').first().clone();
        var incrementConfig = $self.find('.config-item').length;

        console.log(incrementConfig);

        incrementConfig = incrementConfig > 0 ? (incrementConfig - 1) : 0;

        console.log(incrementConfig);


        $configItem.find('.parameter-item').remove();
        $configItem.find('input[name="price[]"]').val('');
        $configParam.find('.form-select option:selected').removeAttr('selected');

        // $configItem.find('.config-parameters').append($configParam);

        var $btnAddConf = $self.find('.btn-add-config');
        var $btnAddOpt  = $self.find('.btn-add-opt');
        var $productConfigList = $self.find('.product-config-list');

        $btnAddConf.find('input').val('');
        
        $btnAddConf.on('click' , function() {

            if ($btnAddConf.find('.config-item').length < 6) {
                
                incrementConfig++;

                //Obtém a nova configuração. 
                var $item = $configItem.clone();
                $item.attr('data-pos', incrementConfig);
                var $newParam = $configParam.clone();

                //Incrementa no parameters_options_{$k}[]
                $newParam.find('.form-select').attr('name', 'parameters_options_'+incrementConfig+'[]');

                $item.find('.config-parameters').append($newParam);
                
                //Adiciona a nova configuração.
                $productConfigList.append($item);

                //todo quando clicar para adicionar o parametro.
                $item.find('.btn-add-opt').on('click', function () {
                    var $paramClean = $newParam.clone();
                    $paramClean.find('.form-select option:selected').removeAttr('selected');
                    $item.find('.config-parameters').append($paramClean);
                });

            }

        });
        
        $btnAddOpt.on('click' , function() {

            var $elem = $(this);
            var $parentConfigItem = $elem.closest('.config-item');
            var pos = $parentConfigItem.attr('data-pos');

            var $newParam = $configParam.clone();

            //Incrementa no parameters_options_{$k}[]
            $newParam.find('.form-select').attr('name', 'parameters_options_'+pos+'[]');

            $parentConfigItem.find('.config-parameters').append($newParam);

        });

        //TODO Remover Itens da coluna => Preço
        //TODO Remover Itens da linha  => Opções
        var $btnRemoveConf = $self.find('.btn-remove-config');
        var $btnRemoveOpt  = $self.find('.btn-remove-parameter');

        $btnRemoveConf.on('click' , function() {
            alert('Removeu a coluna');
        });

        $btnRemoveOpt.on('click' , function() {
            alert('Removeu na linha');
        });
    });

});//* {{ END }}
