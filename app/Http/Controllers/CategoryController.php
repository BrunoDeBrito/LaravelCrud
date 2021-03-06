<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 *ANCHOR Controller de Categorias
 *
 * @author Bruno de Brito <bruno@sysout.com.br>
 * @since 06/10/2021
 * @version 1.0.0
 */
class CategoryController extends Controller
{

	/**
	 *ANCHOR Apresenta a listagem de categorias
	 *
	 * @return void
	 */
	public function index(Request $request) {

		$categories = Category::search($request)
		->get();

		return view('categories.index', [ 'categories' => $categories ]);
	}

	/**
	 *ANCHOR Apresenta o formulario de criação
	 *
	 * @param Category $categories
	 * @return void
	 */
	public function create(Request $request) {

		return $this->form($request, new Category());
				
	}

	/**
	 *ANCHOR Criação das Categorias
	 *
	 * @param Request $request
	 * @return response
	 */
	public function insert(Request $request) {

		try{

			//NOTE Realiza a validação dos dados enviados pelo formulário
			$validator = $this->validator($request);
	
			if (!$validator->fails()) {
	
				$category = new Category();
				$this->save($request, $category);
		
				return redirect('categorias')
				->withSuccess('Categoria cadastrada com sucesso!');
	
			} else {
	
				return back()->withErrors($validator->errors()->first());
	
			}
		} catch (Exception $e) {
			return back()->withInput()->whithErrors('Não e possivel inserir a categeoria:'.$e->getMessage().'.');
		}

		
	}

	/**
	 *ANCHOR Apresenta formulario de atualização das Categorias
	 *
	 * @param Category $categories
	 * @param interger $id
	 * @return void
	 */
	public function edit(Request $request, $id) {

		$category = Category::find($id);

		if ($category) {

			return $this->form($request, $category);

		} else {

			return redirect('categorias')->withErrors('Categoria inválida!');
		}

	}

	/**
	 *ANCHOR Altera os dados de uma categoria
	 *
	 * @param Request $request
	 * @param Category $categories
	 * @param interger $id
	 * @return void
	 */
	public function update(Request $request) {

		try{

			$validator = $this->validator($request);
	
			if (!$validator->fails()) {
	
				$category = Category::find($request->id);
	
				if ($category) {
	
					$this->save($request, $category);
	
					return redirect('categorias')
					->withSuccess('Categoria alterada com sucesso!');
	
				} else {
	
					return back()->withErrors('Categoria inválida!');
				}
	
			} else {
	
				return back()->withErrors($validator->errors()->first());
	
			}

		} catch (Exception $e) {
			return back()->withInput()->whithErrors('Não e possivel alterar a categeoria:'.$e->getMessage().'.');
		}


	}

	/**
	 *ANCHOR Carrega as informações para apresentação do formulário
	 *
	 * @return void
	 */
	private function form($request, $category) {

		return view('categories.create-edit', [ 'category' => $category ]);
	}


	/**
	 *ANCHOR Grava os dados da categoria
	 *
	 * @return void
	 */
	private function save($request, $category) {

		try {

			DB::beginTransaction();

			$category->name = $request->name;
			$category->save();

			DB::commit();

		} catch (Exception $e) {

			DB::rollback();
			throw $e;
		}


	}

	/**
	 *ANCHOR Valida as informações da categoria
	 *
	 * @param [type] $request
	 * @return object
	 */
	private function validator($request) {

		$validator = Validator::make($request->all(), [
			'id' => 'nullable|numeric|required_if:_method,PUT',
			'name' => 'required|string|max:100|unique:categories,name'
			.($request->id?(','.$request->id):''),
		]);

		return $validator;

	}

	/**
	 *ANCHOR Remove uma categoria
	 *
	 * @param Request $request
	 * @return void
	 */
	public function delete(Request $request) {

		try {
			
			$category = Category::find($request->id);
	
			if ($category) {
	
				$category->delete();
				return back()->withSuccess('Categoria removida com sucesso!');
			}
	
			return back()->withErrors('Não foi possível remover a categoria. Dados inválidos!');

		} catch (Exception $e) {

            return back()->withInput()->withErrors('Não foi possível remover a categoria: '.$e->getMessage().'.');
		}
	}
}
