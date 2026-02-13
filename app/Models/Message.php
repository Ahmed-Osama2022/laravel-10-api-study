<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  use HasFactory;


  // name, email, phone, message, status, Timestamps
  protected $fillable = [
    'name',
    'email',
    'phone',
    'message',
    'status'
  ];

  protected $casts = [
    'status' => Status::class,
  ];
}
