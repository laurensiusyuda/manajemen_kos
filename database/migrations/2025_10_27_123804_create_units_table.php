<?php

use App\UnitStatus;
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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('propertis')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->enum('status', [UnitStatus::AVAILABLE, UnitStatus::OCCUPIED])->default(UnitStatus::AVAILABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
