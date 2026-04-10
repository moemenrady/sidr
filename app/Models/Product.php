<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'name', 'image', 'hover_image', 'sold_out',
    'collection_id', 'price', 
  ];

  public function collection()
  {
    return $this->belongsTo(Collection::class, 'collection_id'); // ← foreign key في جدول bannar_items
  }

  public function images()
  {
    return $this->hasMany(ProductImage::class);
  }
}
