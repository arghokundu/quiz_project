<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;


class categoryController extends Controller
{
    public function showAllCate()
    {
        return view('Category.showAllCat');
    }
    public function addCat()
    {
        return view('Category.addCat');
    }
}
