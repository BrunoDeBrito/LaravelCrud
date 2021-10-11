<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterOption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParamenterController extends Controller
{
    /**
     * Tela de 
     *
     * @return \Illuminate\Http\Response´
     */
    public function index(Request $request) {

        $parameters = Parameter::all();

        return view('parameters.index', [ 'parameters' => $parameters ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        return $this->form($request, new Parameter());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        $parameterOption = ParameterOption::all();

        $parameter->name = $request->name;
        $parameter->save();
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
     * Remove the specified resource from storage.
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
