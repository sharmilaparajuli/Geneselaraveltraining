<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_desc',
        'price',
        'category_id',
        'image'
    ];
    protected $attributes = [
        'image' => '',
    ];
    protected $with = ['category'];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
    public function orderitem()
    { 
        return $this->hasMany(OrderItem::class);
    }

    // public function scopeSearch($query , array $terms){

    //     if($terms['search'] !== ''){
    //               $query->where('product_name' , 'like' , '%' . $terms['search'] . '%')
    //              ->orwhere('product_desc' , 'like' , '%' . $terms['search'] . '%');

    //             } ;
    //             return $query;
    // }





    public function scopeSearch($query, array $terms)
    {
        $search = $terms['search'];
        $category = $terms['category'];
        if ($search) {
            $query->where(function ($query) use ($search) {
                return $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_desc', 'like', '%' . $search . '%');
            });
            // $query->when($search, function($query , $search){
            //     return $query->where('product_name', 'like', '%'. $search .'%')
            //         ->orWhere('product_desc', 'like', '%'. $search .'%');



            //  , function($query){
            // return $query->where('id', '>', 0);
            // }


            $query->when($category, function ($query, $category) {
                return $query->whereCategoryId($category);
            });
        }
    }
}
