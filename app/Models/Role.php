<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];
    public const IS_ADMIN = 1;
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
