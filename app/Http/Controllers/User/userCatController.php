<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;

class userCatController extends Controller
{
    public function userCatAllList()
    {
        $categories=CategoryModel::select('cat_id','category_name')->get();
        return view('User.userCategory.userCatList',compact('categories'));
    }
}
