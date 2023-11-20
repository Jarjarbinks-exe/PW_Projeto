<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToPermissionsTable extends Migration
{
public function up()
{
// Add the 'type' column to the 'permissions' table
Schema::table('permissions', function (Blueprint $table) {
// Define the column name, data type, and whether it's nullable
$table->string('type', 255)->nullable();
});
}

public function down()
{
// Rollback the migration by removing the 'type' column
Schema::table('permissions', function (Blueprint $table) {
$table->dropColumn('type');
});
}
}
