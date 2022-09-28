<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','category_id','excerpt','body','user_id','image'];

    protected $with = ['category','author'];

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function scopeFilter($query,array $filters){
        // dd($filters);
        // $query->when($filters['search'] ?? false, fn($query,$search) => 
        //     $query->where(fn($query) => 
        //         $query->where('title', 'like' , '%'.$search .'%')            
        //         ->orWhere('body', 'like' , '%'.$search .'%')            
        //     )
        // );
        $query->when($filters['search'] ?? false, function($query, $search){
            $query->where(function($query) use ($search){
                $query->where('title', 'like' , '%'.$search .'%')            
                    ->orWhere('body', 'like' , '%'.$search .'%');
            });
        });
        $query->when($filters['category'] ?? false, function($query,$category){
            $query->whereHas('category',function($query) use ($category){
                $query->whereSlug($category);
            });
        })
        ->when($filters['author'] ?? false, function($query,$author){
            $query->whereHas('author',function($query) use ($author){
                $query->whereUsername($author);
            });
        });
        // $query->when($filters['search'] ?? false,function($query,$search){
        //     $query->where(fn($query) =>
        //         $query->where('title', 'like', '%'.$search .'%')
        //         ->orWhere('body', 'like', '%'.$search .'%')
        //     );
        // });
    }
}
