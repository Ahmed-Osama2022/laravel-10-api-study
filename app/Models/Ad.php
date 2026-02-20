<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ad extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'slug',
    'text',
    'phone',
    'status',
    'user_id',
    'domain_id',
  ];

  // Create a function to generate slug from title
  public static function boot()
  {
    parent::boot();

    static::creating(function ($ad) {
      $ad->slug = Str::slug($ad->title);
    });
  }

  /**
   * RELATIONSHIPS
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function domain()
  {
    return $this->belongsTo(Domain::class);
  }
}
