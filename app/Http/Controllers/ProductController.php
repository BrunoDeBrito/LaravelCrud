<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controller de Produtos
 *
 * @author Bruno de Brito <bruno@sysout.com.br>
 * @since 06/10/2021
 * @version 1.0.0
 */
class ProductController extends Controller
{

	/**
	 ** Apresenta a listagem de produtos
	 *
	 * @return void
	 */
	public function index(Request $request) {

		$products = Product::search($request)
		->orderBy('name', 'asc')
		->get();
		
		return view('products.index', [ 'products' => $products ]);

	}

	/**
	 ** Apresenta o formulario de criação
	 *
	 * @param Product $products
	 * @return void
	 */
	public function create(Request $request) {

		return $this->form($request, new Product());
		
	}

	/**
	 * Criação dos Produtos
	 *
	 * @param Request $request
	 * @return response
	 */
	public function insert(Request $request) {

		//Realiza a validação dos dados enviados pelo formulário
		$validator = $this->validator($request);

		if (!$validator->fails()) {

			$product = new Product();
			$this->save($request, $product);
	
			return redirect('produtos')->withSuccess('Produto cadastrado com sucesso!');

		} else {

			return back()->withErrors($validator->errors()->first());

		}

	}

	/**
	 ** Apresenta formulario de atualização dos Produtos
	 *compact('products')
	 */
	public function edit(Request $request, $id) {

		$product = Product::find($id);

		if ($product) {

			return $this->form($request, $product);

		} else {

			return redirect('produtos')->withErrors('Produto inválido!');
		}

	}

	/**
	 ** Altera os dados de um produto
	 *
	 * @param Request $request
	 * @param Product $products
	 * @param interger $id
	 * @return void
	 */
	public function update(Request $request) {

		$validator = $this->validator($request);

		if (!$validator->fails()) {

			$product = Product::find($request->id);

			if ($product) {

				$this->save($request, $product);

				return redirect('produtos')->withSuccess('Produto alterado com sucesso!');

			} else {

				return back()->withErrors('Produto inválido!');
				
			}

		} else {

			return back()->withErrors($validator->errors()->first());

		}

	}

	/**
	 * Carrega as informações para apresentação do formulário
	 *
	 * @return void
	 */
	private function form($request, $product) {

		//Obtem a lista de categorias
		$categories = Category::orderBy('name', 'asc')->get();

		return view('products.create-edit', [ 'product' => $product, 'categories' => $categories ]);
	}

	/**
	 * Grava os dados da produto
	 *
	 * @return void
	 */
	private function save($request, $product) {

		$product->name = $request->name;
		$product->price = $request->price;
		$product->descriptions = $request->descriptions;
		$product->category_id = $request->category_id;
		
		$product->save();
	}

	/**
	 * Valida as informações da produto
	 *
	 * @param [type] $request
	 * @return object
	 */
	private function validator($request) {

		$validator = Validator::make($request->all(), [

			'id' 	      => 'nullable|nullable|required_if:_method,PUT',
			'name' 	      => 'required|string|max:100|unique:products,name'.($request->id?(','.$request->id):''),
			'price' 	  => 'numeric|required',
			'description' => 'nullable|max:1000',
			'category_id' => 'required|numeric|exists:categories,id',

		]);

		return $validator;
	}

	/**
	 ** Remove um produto
	 *
	 * @param interger $id
	 * @return void
	 */
	public function delete(Request $request) {

		$product = Product::find($request->id);

		if ($product) {

			$product->delete();
			return redirect('produtos')->withSuccess('Produto removido com sucesso!');

		}

		return back()->withErrors('Produto inválido!');				
	}

}
