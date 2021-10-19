<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Model de Produtos
 *
 * @author Bruno de Brito <bruno@sysout.com.br>
 * @since 06/10/2021
 * @version 1.0.0
 */
class Product extends Model
{

	/**
	 * Obtem a categoria do produto
	 *
	 * @return void
	 */
	public function category() {

		return $this->belongsTo(Category::class);
	}

	/**
	 * Otem os Paramentros
	 *
	 * @return void
	 */
	public function parameters() {

		return $this->belongsToMany(Parameter::class)
			->orderBy('id', 'asc');
	}

	/**
	 * Obtem os parametros Opcionais
	 *
	 * @return void
	 */
	public function parametersOptions() {

		return $this->belongsToMany(ParameterOption::class)
			->orderBy('id', 'asc');
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function productConfigs() {

		return $this->hasMany(ProductConfig::class)
			->orderBy('id', 'asc');
	}

	/**
	 * Pesquisa por produtos
	 *
	 * @param object $query
	 * @param Request $request
	 * @return object
	 */
	public function scopeSearch($query, $request) {

		$query->from('products as p')
			->join('categories as c', 'c.id', 'p.category_id')
			->where(function ($query) use ($request) {

				$query->where('p.name', 'ilike', '%' . $request->search . '%')
					->orWhere('p.descriptions', 'ilike', '%' . $request->search . '%')
					->orWhere('c.name', 'ilike', '%' . $request->search . '%');
			})->select('p.*', 'c.name as category_name');

		return $query;
	}
}
