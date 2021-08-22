<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
	'client', 'slug', 'description'
    ];

    public function files()
    {
	return $this->morphMany(File::class, 'fileable');
    }

    public function sluggable(): array{
	return [
	    'slug' => [
		'source' => 'client'
	    ]
	];
    }

    public static function getFile($work)
    {
	return $work->files->pluck('file')->first();
    }
}
