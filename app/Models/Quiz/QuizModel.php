<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category\CategoryModel;

class QuizModel extends Model
{
    use HasFactory;

    protected $table='quizs';
    protected $primaryKey='quiz_id';
    public $incrementing=true;
    public $keyType='int';
    public $timesstamps=false;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class,'cat_id_fk','cat_id');
    }
}
