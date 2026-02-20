<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DomainStatuses;

class Domain extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'status',
  ];
  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'status' => DomainStatuses::class,
  ];

  ##--------------------------------- RELATIONSHIPS
  public function ads()
  {
    return $this->hasMany(Ad::class);
  }
}
