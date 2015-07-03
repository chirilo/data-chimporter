<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text("linecode"); 
			$table->text("sku"); 
			$table->text("descript"); 
			$table->decimal("cost", 5, 2);
			$table->decimal("coreprice", 5, 2); 
			$table->smallInteger("minqty")->unsigned();
			$table->integer("qtyavail")->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventories');
	}

}
