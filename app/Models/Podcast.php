<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    // use SoftDeletes;
    protected $table='podcasts';
    // protected $softDelete = true;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'featured_image',
        'description',
        'short_description',
        'gallery',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'itune',
        'spotify',
        'google_music',
        'stitcher_link',
        'youtube_link',
        'sub_heading',
        'patreon_message',
    ];
    use HasFactory;
    public function author(){
        return $this->hasOne(User::class,'id', 'user_id' );
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'podcasts_cats', 'podcast_id', 'cat_id');
    }
}
