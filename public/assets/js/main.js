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
        

        var $self = $(this);

        var $configItem     = $self.find('.config-item').first().clone();
        var $configParam    = $configItem.find('.parameter-item').first().clone();
        var incrementConfig = $self.find('.config-item').length;
        //Incremetador
        incrementConfig     = incrementConfig > 0 ? (incrementConfig - 1) : 0;

        $configItem.find('.parameter-item').remove();
        $configItem.find('input').val('');
        $configParam.find('.form-select option:selected').removeAttr('selected');

        var $btnAddConf         = $self.find('.btn-add-config');
        var $btnAddOpt          = $self.find('.btn-add-opt');
        var $productConfigList  = $self.find('.product-config-list');

        $btnAddConf.on('click' , function() {

            if ($btnAddConf.find('.config-item').length < 3) {

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

                // quando clicar para adicionar o parametro.
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
 
            if ($btnAddOpt.closest('.config-item')) {

                var $newParam = $configParam.clone();
    
                //Incrementa no parameters_options_{$k}[]
                $newParam.find('.form-select').attr('name', 'parameters_options_'+pos+'[]');
    
                $parentConfigItem.find('.config-parameters').append($newParam);
            };

        });

        var $btnRemoveConf = $self.find('.btn-remove-config');
        var $btnRemoveOpt  = $self.find('.btn-remove-parameter');

        $btnRemoveConf.on('click' , function() {

            //FIXME
            if ($(this).closest('.config-item').find('.table-responsive')) {

                $(this).closest('.config-item').remove();
                alert('Removido com sucesso');
            }

        });

        $btnRemoveOpt.on('click' , function() {

            //FIXME
            if ($(this).closest('.product-config-list').find('.config-parameters')) {

                $(this).closest('.parameter-item').remove();

            }

        });
    });


});//* {{ END }}
