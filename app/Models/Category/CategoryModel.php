<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table='category';
    protected $primaryKey='cat_id';
    public $keyType='int';
    public $incrementing='true';
    public $timesstamps='false';
}
