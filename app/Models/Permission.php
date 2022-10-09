<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public const IS_ADMIN = 1;
    
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }

}
