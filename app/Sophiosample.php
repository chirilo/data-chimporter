<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sophiosample extends Model {

	// specify table
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sophiosample';
    protected $fillable = ['linecode', 'sku', 'descript', 'cost', 'coreprice','minqty','qtyavail'];	
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
