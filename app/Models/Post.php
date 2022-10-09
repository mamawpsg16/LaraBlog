<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','category_id','excerpt','body','user_id','image','published_at'];

    protected $with = ['category','author','author','likers'];

    public const IS_ADMIN = 1;

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    } 

    public function likers(){
        return $this->belongsToMany(User::class);
    }

    public function scopeFilterPosts($query,$published = null)
    {
        // $status = $published === 'approved' ? 1 : null;
        if(!in_array(self::IS_ADMIN,auth()->user()->roles->pluck('id')->toArray()) || empty(auth()->user()->roles->toArray())){
            $query->where('user_id',auth()->id());
        }
        
        $query->when($published ?? false, function($query,$published){
            if($published == 'approved'){
                $query->whereNotNull('published_at');
            }else{
                $query->whereNull('published_at');
            }
        });
        
    }
   
    public function scopeFilter($query,array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            $query->where(function($query) use ($search){
                $query->where('title', 'like' , '%'.$search .'%')            
                    ->orWhere('body', 'like' , '%'.$search .'%');
            });
        })->when($filters['category'] ?? false, function($query,$category){
            $query->whereHas('category',function($query) use ($category){
                $query->whereSlug($category);
            });
        })->whereNotNull('published_at');
    }
}
