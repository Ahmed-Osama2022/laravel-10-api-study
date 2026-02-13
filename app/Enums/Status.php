<?php

namespace App\Enums;

enum Status: string
{
  case PENDING = 'pending';
  case ACTIVE = 'active';
  case INACTIVE = 'inactive';
  case COMPLETED = 'completed';

  public function label(): string
  {
    return match ($this) {
      self::PENDING => 'Pending',
      self::ACTIVE => 'Active',
      self::INACTIVE => 'Inactive',
      self::COMPLETED => 'Completed',
    };
  }

  // public function color(): string
  // {
  //   return match ($this) {
  //     self::PENDING => 'yellow',
  //     self::ACTIVE => 'green',
  //     self::INACTIVE => 'gray',
  //     self::COMPLETED => 'blue',
  //   };
  // }
}
