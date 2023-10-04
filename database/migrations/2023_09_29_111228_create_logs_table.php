<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requested_document_id'); // Foreign key
            $table->bigInteger('forwarded_to');//id of departments forwarded
            $table->bigInteger('current_location');
            $table->string('notes');
            $table->string('status');
            $table->timestamps();

             // Define a foreign key constraint
             $table->foreign('requested_document_id')
             ->references('id')
             ->on('requested_documents')
             ->onDelete('cascade'); // You can adjust the onDelete behavior as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
