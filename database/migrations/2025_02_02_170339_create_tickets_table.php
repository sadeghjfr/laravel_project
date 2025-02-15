<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description');
            $table->enum('status', ['new', 'open', 'close', 'answer'])->default('new');
            $table->foreignId('reference_id')->nullable()->constrained('ticket_admins')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('ticket_categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('priority_id')->nullable()->constrained('ticket_priorities')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
