<?php

use App\Enums\AdStatus;
use App\Models\Domain;
use App\Models\User;
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
    Schema::create('ads', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('slug')->nullable();
      $table->text('text')->nullable();
      $table->string('phone')->nullable();

      $table->tinyInteger('status')->default(AdStatus::REVIEW->value);

      $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(Domain::class)->constrained()->cascadeOnDelete();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('ads');
  }
};
