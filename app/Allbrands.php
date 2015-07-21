<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Allbrands extends Model {

	// specify table
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allbrands';
 //   protected $fillable = ['linecode', 'sku', 'descript', 'cost', 'coreprice','minqty','qtyavail'];	
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
