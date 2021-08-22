<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
	'title', 'slug', 'body', 'category_id'
    ];
    
    public function sluggable(): array{
	return [
	    'slug' => [
		'source' => 'title'
	    ]
	];
    }

    public function file()
    {
	return $this->morphOne(File::class, 'fileable');
    }

    public function category()
    {
	return $this->belongsTo(Category::class);
    }
}
