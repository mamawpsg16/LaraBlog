<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class   User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public const IS_ADMIN = 1;

    protected $withCount = ['posts'];

    protected $with = ['profile','following'];
    
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function following(){
        return $this->belongsToMany(Profile::class);
    }

    public function liked(){
        return $this->belongsToMany(Post::class);
    }

    public function getIsAdmin()
    {
        // return $this->role_id == 2;
    }
     
    public function getFullNameAttribute()
    {
        return $this->name.','.$this->username;
    }


    // protected function password(): Attribute
    // {
    //     return Attribute::make(
    //         // get: fn ($value) => ucfirst($value),
    //         set: fn ($value) => Hash::make($value),
    //     );
    // }
}
