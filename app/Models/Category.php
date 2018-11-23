<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'title','icon'
    ];
    //关联文章
    public function article(){

        return $this->hasMany(Article::class);
    }
}
