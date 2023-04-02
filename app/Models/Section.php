<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public static function sections(){
        $getSection = Section::with('categories')->where('status', 1)->get()->toArray();
        return $getSection;

    }

    public function categories(){
        return $this->hasMany(Category::class, 'section_id')->where(['parent_id'=>0, 'status'=>1])->with('subcategories');

    }
}
