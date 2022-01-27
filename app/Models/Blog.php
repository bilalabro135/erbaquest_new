<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    // use SoftDeletes;
    protected $table='blogs';
    // protected $softDelete = true;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'featured_image',
        'description',
        'short_description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'user_id',
    ];
    use HasFactory;
    public function author(){
        return $this->hasOne(User::class,'id', 'user_id' );
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blogs_cats', 'blog_id', 'cat_id');
    }
}
