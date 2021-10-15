<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ParameterController extends Controller
{
    /**
     * Tela de parametro
     *
     * @return \Illuminate\Http\Response´
     */
    public function index(Request $request) {

        $parameters = Parameter::orderBy('name', 'asc')
		->get();

        return view('parameters.index', [ 'parameters' => $parameters ]);
    }

    /**
     * Apresentação o formulario de criação
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {

        return $this->form($request, new Parameter());
    }

    /**
     * Criação dos Pametros
     *
     * @param Request $request
     * @return void
     */
    public function insert(Request $request) {

        try {

            $validator = $this->validator($request);

            if (!$validator->fails()) {

                $parameter = new Parameter();
                $this->save($request, $parameter);

                return redirect('parametros')->withSuccess('Parâmetro Criado com sucesso');

            } else {

                return back()->withInput()->withErrors($validator->errors()->first());
            }

        } catch (Exception $e) {
            return back()->withInput()->withErrors('Não foi possível inserir o parâmetro: '.$e->getMessage().'.');
        }

    }

    /**
     * Apresenta fomulario de atualização 
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function edit(Request $request, $id) {

        $parameter = Parameter::find($id);

        if ($parameter) {
            
            return $this->form($request, $parameter);

        } else {
            return redirect('parametros')->withErrors('Parâmetro invalido');
        }
        
    }

    /**
     * Altera os dados do Parametro
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request) {

        try {

            $valitador = $this->validator($request);

            if (!$valitador->fails()) {

                $parameter = Parameter::find($request->id);

                if ($parameter) {

                    $this->save($request, $parameter);

                    return redirect('parametros')->withSuccess('Parâmetro Alterado com Sucesso');

                } else {
                    return back()->withInput()->withErrors('Alteração inválida');
                }

            } else {
                return back()->withInput()->withErrors($valitador->errors()->first());
            }

        } catch (Exception $e) {
            return back()->withInput()->withErrors('Não foi possível alterar o parâmetro: '.$e->getMessage().'.');
        }
    }

    /**
     * Carrega o formulário para edição de um parâmetro
     *
     * @param [type] $parameter
     * @return void
     */
    private function form($request, $parameter) {
        return view('parameters.create-edit', [ 'parameter' => $parameter ]);
    }

    /**
     * Grava os dados do Parametro
     *
     * @param [type] $request
     * @param [type] $parameter
     * @return void
     */
    private function save($request, $parameter) {

        try {

            DB::beginTransaction();

            $parameter->name = $request->name;
            $parameter->save();

            $optionIds = [];

            // Cria e atualiza cada opções do parametro
            foreach($request->option_name as $k => $optionName) {

                $optionId = $request->option_id[$k] ?? null;

                if ($optionId) {

                    $option = ParameterOption::find($optionId);
               
                } else {
                    $option = new ParameterOption();
                    $option->parameter_id = $parameter->id;

                }
                $option->name = $optionName;
                $option->save();
                
                array_push($optionIds, $option->id);

            }

            if (count($optionIds) > 0) {

                //Exclui opções
                ParameterOption::where('parameter_id', $parameter->id)->whereNotIn('id', $optionIds)->delete();

            }

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();
            throw $e;

        }
        
    }

    /**
     * Validação das informações
     *
     * @param  $request
     * @return object
     */
    private function validator($request) {

        $validator = Validator::make($request->all(), [

            'id'    => 'nullable|nullable|required_if:_method,PUT',
            'name'  => 'required|string|max:100|unique:products,name'.($request->id?(','.$request->id):''),
            'option_name' => 'required|array|min:1',
            'option_name.*' => 'required|string|max:30'
        ], [
            'option_name' => 'É preciso cadastrar pelo menos uma opção para o parâmetro',
        ]);

        return $validator;
    }

    /**
     * Remove um Parametro
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request) {

        $parameter = Parameter::find($request->id);

        if ($parameter) {

            //Remove o parâmetro
            $parameter->delete();

            return redirect('parametros')->withSuccess('Parâmetro Removido com sucesso');

        } else {
            return back()->withErrors('Parâmetro Invalido');
        }
    }
}
