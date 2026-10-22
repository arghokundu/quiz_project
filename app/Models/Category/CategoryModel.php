<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Quiz\QuizModel;
use App\Models\Mcq\McqModel;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table='category';
    protected $primaryKey='cat_id';
    public $keyType='int';
    public $incrementing='true';
    public $timesstamps='false';

    public function quiz()
    {
        return $this->hasMany(QuizModel::class,'cat_id_fk','cat_id');
    }

    public function mcq()
    {
        return $this->hasMany(McqModel::class,'cat_id_fk','cat_id');
    }
}
