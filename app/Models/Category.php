<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // use SoftDeletes;
    protected $table='categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'featured_image',
        'parent_id'
    ];
    // protected $softDelete = true;
    use HasFactory;
    public function blogs()
    {
        return $this->belongsToMany('App\Models\BLog' , 'blogs_cats', 'cat_id', 'blog_id');
    }
    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

}
