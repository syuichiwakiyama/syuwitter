<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;
use App\Comment;
class Post extends Model
{
    public $fillable =[
        'user_id','category_id','title','content','image'
    ];
    // 別のモデルであるcategoryと紐付けをし、postのからむであるcategory_idを元にcategoryとの紐付けをした
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    //Postモデルのカラムであるuser_idを元に別のモデルであるUserモデルと紐付けをした
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id' ,'id');
    }
}
