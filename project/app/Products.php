<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
//   public function getCategory()
//   {
//       $category = Category::where('id', $this->category_id)->first();
//       return $category;
//   }
    protected $fillable = ['code', 'name', 'description', 'category_id', 'pricee', 'image', 'hit', 'new', 'recommend'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount($count)
    {
        return $this->pricee * $count;
    }

    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value){
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value){
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    public function isHit(){
        return $this->hit === 1;
    }

    public function isNew(){
        return $this->new === 1;
    }

    public function isRecommend(){
        return $this->recommend === 1;
    }
}
