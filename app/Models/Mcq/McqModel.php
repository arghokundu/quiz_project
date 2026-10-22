<?php

namespace App\Models\Mcq;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\AdminModel;
use App\Models\Quiz\QuizModel;
use App\Models\Category\CategoryModel;

class McqModel extends Model
{
    use HasFactory;
    protected $table='mcq';
    protected $primaryKey='mcq_id';
    public $keyType='int';
    public $incrementing='true';
    public $timesstamps='false';

    public function admin()
    {
        return $this->belongsTo(AdminModel::class,'admin_id_fk','admin_id');
    }

    public function quiz()
    {
        return $this->belongsTo(QuizModel::class,'quiz_id_fk','quiz_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryModel::class,'cat_id_fk','cat_id');
    }
}
