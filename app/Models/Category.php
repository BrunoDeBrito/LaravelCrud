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
	public $dates = [
		'created_at', 'updated_at'
	];

	/**
	 * Relação com tabela de produtores
	 *
	 * @return void
	 */
	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
