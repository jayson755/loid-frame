<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemSupportMoudleTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_support_moudle', function (Blueprint $table) {
            $table->increments('moudle_id')->comment('自增列');
            $table->string('moudle_sign', 50)->comment('模块标签');
            $table->string('moudle_description', 100)->comment('模块描述');
            $table->string('moudle_namespace', 100)->comment('模块命名空间');
            $table->string('view_namespace', 50)->comment('视图命名空间');
            $table->string('moudle_version', 10)->comment('模块版本');
            $table->string('moudle_status', 3)->comment('模块状态:on/off');
            $table->timestamps();
            $table->softDeletes();
            $table->index('moudle_sign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_support_moudle');
    }
}
