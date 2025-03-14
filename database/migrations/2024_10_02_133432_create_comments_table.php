<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
			$table->foreignId('post_id')->references('id')->on('posts')->cascadeOnDelete();
			$table->text('body');
			$table->string('attachment_url')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('comments');
	}
};
