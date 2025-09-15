<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TodoImportance;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->index()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->index()->references('id')->on('categories')->nullOnDelete();

            $table->string('todo_title', 150)->index();
            $table->text('todo_description')->nullable();
            $table->boolean('todo_completed')->default(0);
            $table->enum('todo_importance', array_map(function (TodoImportance $importance) {
                return $importance->value;
            }, TodoImportance::cases()));
            $table->date('todo_due_date')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
