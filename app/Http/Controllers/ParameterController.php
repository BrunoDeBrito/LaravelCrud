<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterOption;

use Illuminate\Http\Request;
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

        $validator = $this->validator($request);

        if (!$validator->fails()) {

            $parameter = new Parameter();
            $this->save($request, $parameter);

            return redirect('parametros')->withSuccess('Parâmetro Criado com sucesso');

        } else {

           return back()->withErrors($validator->errors()->first());
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

        $valitador = $this->validator($request);

        if (!$valitador->fails()) {

            $parameter = Parameter::find($request->id);

            if ($parameter) {

                $this->save($request, $parameter);

                return redirect('parametros')->withSuccess('Parâmetro Alterado com Sucesso');

            } else {

                return back()->withErrors('Alteração inválida');
            }

        } else {

            return back()->withErrors($valitador->erros()->first());
        }
    }

    private function form($request, $parameter) {

        $parametersOptions = $parameter->paramenterOption;
        return view('parameters.create-edit', [ 'parameter' => $parameter, 'parametersOptions' => $parametersOptions ]);
    }

    /**
     * Grava os dados do Parametro
     *
     * @param [type] $request
     * @param [type] $parameter
     * @return void
     */
    private function save($request, $parameter) {
        
        $parameter->name         = $request->name;
        $parameter->save();
        
        foreach($request->option as $item) {

            $parameterOption = new ParameterOption();
            $parameterOption->parameter_id = $parameter->id;
            $parameterOption->name = $parameter->name;
            $parameterOption->save();
        }
        
        $parameterOption->name = $item;
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

            $parameter->delete();
            return redirect('parametros')->withSuccess('Parâmetro Removido com sucesso');

        } else {
            
            return back()->withErrors('Parâmetro Invalido');
        }
    }
}
