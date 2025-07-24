<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudySessionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('study_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable(); 
            $table->integer('total_focus_minutes')->default(0); 
            $table->integer('total_distraction_minutes')->default(0); 
            $table->json('distraction_log')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_sessions');
    }
}
