<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Product;
use App\Models\Category;
use App\Models\Parameter;
use App\Models\ProductConfig;
use App\Models\ParameterOption;
use App\Models\ProductConfigOption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
			->orderBy('id', 'asc')
			->get();

		return view('products.index', ['products' => $products]);
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

		try {

			//Realiza a validação dos dados enviados pelo formulário
			$validator = $this->validator($request);

			// return back()->withSuccess('testando')->withInput();

			if (!$validator->fails()) {

				$product = new Product();
				$this->save($request, $product);

				return redirect('produtos')->withSuccess('Produto cadastrado com sucesso!');
			} else {

				return back()->withErrors($validator->errors()->first());
			}
		} catch (Exception $e) {

			return back()->withInput()->withErrors('Não foi possível inserir o Produto: ' . $e->getMessage() . '.');
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

		try {

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
		} catch (Exception $e) {

			return back()->withInput()->withErrors('Não foi possível alterar o produto: ' . $e->getMessage() . '.');
		}
	}

	/**
	 * Carrega as informações para apresentação do formulário
	 *
	 * @return void
	 */
	private function form($request, $product) { 

		// Obtem a lista de categorias
		$categories = Category::orderBy('id', 'asc')->get();

		// Obtem os parametros
		$paramenters = Parameter::orderBy('id', 'asc')->get();

		// Obtem os parametros Opcionais
		$paramentersOptions = ParameterOption::orderBy('id', 'asc')->get();

		return view('products.create-edit', [

			'product' 			 => $product,
			'categories' 		 => $categories,
			'paramenters' 		 => $paramenters,
			'paramentersOptions' => $paramentersOptions

		]);
	}

	/**
	 *ANCHOR Grava os dados da produto
	 *
	 * @return void
	 */
	private function save($request, $product) { 

		try {

			DB::beginTransaction();

			//Cria e Atualiza os Produtos
			$product->name         	  = $request->name;
			$product->descriptions 	  = $request->descriptions;
			$product->category_id  	  = $request->category_id;
			$product->save();

			// Cria e Atualiza as configurações dos produtos
			$parameterOptionsIds = [];



			foreach ($request->price as $k => $priceProduct) {

				//Obtém id das config_products quando é uma edição.
				if (isset($request->pricesIds[$k])) {

					$configProd = ProductConfig::find($request->pricesIds[$k]);

				} else {

					$configProd = new ProductConfig();
					$configProd->product_id = $product->id;
				}

				$configProd->price = $priceProduct;		

				$configProd->save();

				//Pega os Options e compara cons os Id's  0 : 1 / 1:3 -> exemplo
				$parameterOptionsIds = $request->input("parameters_options_" . $k) ?? null;
				$productConfigOption = $configProd->parametersOptions;

				//NOTE salva todos os parametro optin relacionados a config do produto
				$productConfigOptionIds = array_column($productConfigOption->toArray(), 'id');

				//Obtém os parametros que serão removidos.
				$productConfigsToRemove = array_diff($productConfigOptionIds, $parameterOptionsIds);

				//Obtém os parametros que serão inseridos.
				$productConfigsToInsert = array_diff($parameterOptionsIds, $productConfigOptionIds);


				if (count($productConfigsToInsert)) {
					$configProd->parametersOptions()->attach($productConfigsToInsert);
				}

				if (count($productConfigsToRemove)) {
					$configProd->parametersOptions()->detach($productConfigsToRemove);
				}

			}

			DB::commit();

		} catch (Exception $e) {

			DB::rollback();
			throw $e;
		}
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
			'name' 	      => 'required|string|max:100|unique:products,name' . ($request->id ? (',' . $request->id) : ''),
			// 'price[]' 	  => 'numeric|required',
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

		try {

			$product = Product::find($request->id);

			if ($product) {

				$product->delete();
				return redirect('produtos')->withSuccess('Produto removido com sucesso!');
			}

			return back()->withErrors('Produto inválido!');
		} catch (Exception $e) {

			return back()->withInput()->withErrors('Não foi possível remover o Produto: ' . $e->getMessage() . '.');
		}
	}
}
