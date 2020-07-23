<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable; // Traits

    protected $fillable = ['title','content','thumbnail','slug','user_id'];
    protected $dates = ['created_at']; // Format penulisan tanggal dengan carbon

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        // if($this->thumbnail) {
        //     return $this->thumbnail;
        // } else {
        //     return asset('no-thumbnail.jpg');
        // }
        //--------------------------------------
        // if(!$this->thumbnail) {
        //     return asset('no-thumbnail.jpg');
        // }
        // return $this->thumbnail;
        //--------------------------------------
        return !$this->thumbnail ? asset('no-thumbnail.jpg') : $this->thumbnail;
    }

    public function sluggable() // Slug config array for this model
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
