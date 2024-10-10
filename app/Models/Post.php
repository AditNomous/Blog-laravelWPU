<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Post extends Model

{
    use HasFactory;
    protected $fillable = ['title','author','slug','body','cover'];

    protected $with =['category','author','likes','comments'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

public function likedBy(?User $user)
{
    if (is_null($user)){
        return false;
    }
    // Menggunakan where dan first() untuk cek apakah user sudah like
    return $this->likes()->where('user_id', $user->id)->exists();
}


    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
            
        );

        $query->when(
        $filters['category'] ?? false,
        fn ($query, $category) =>
        $query->whereHas('category', fn ($query)=>
         $query->where('slug', $category))
        );

        $query->when(
        $filters['author'] ?? false,
        fn ($query, $author) =>
        $query->whereHas('author', fn ($query)=>
         $query->where('username', $author))
        );
}
}
