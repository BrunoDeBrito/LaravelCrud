<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model de categorias
 *
 * @author Bruno de Brito <bruno@sysout.com.br>
 * @since 06/10/2021
 * @version 1.0.0
 */
class Category extends Model
{

	protected $table = 'categories';

	/**
	 * Relação com tabela de produtores
	 *
	 * @return void
	 */
	public function products() {

		return $this->hasMany(Product::class);
	}

	/**
	 * Pesquisa por Categorias
	 *
	 * @param [type] $query
	 * @param Request $request
	 * @return object
	 */
	public function scopeSearch($query, $request) {

		$query->from('categories as c')
		->where(function($query) use ($request) {

			$query->where('c.name', 'ilike', '%'.$request->search.'%');
			
		});

		return $query;
	}
}
