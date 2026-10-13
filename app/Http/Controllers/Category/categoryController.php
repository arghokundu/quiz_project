<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use App\Http\Requests\Category\catRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class categoryController extends Controller
{
    public function showAllCate(Request $r)
    {
        $categoryData=CategoryModel::select('cat_id','category_name','creater');
        if($r->filled('searchCat'))
        {
            $categoryData->where('category_name','ilike','%'.$r->searchCat.'%');
        }
        $categoryData=$categoryData->paginate(5)->withQueryString();
        return view('Category.showAllCat',compact('categoryData'));
    }
    public function addCat()
    {
        return view('Category.addCat');
    }
    public function storeCat(catRequest $catr)
    {
        DB::beginTransaction();
        try
        {
            $cat=new CategoryModel();
            $cat->category_name=strtoUpper($catr->categoryName);
            $cat->creater=session('adminName');
            $saveCategory=$cat->save();
            if($saveCategory)
            {
                DB::commit();
                return redirect('/showAllCategory');
            }
            else
            {
                DB::rollback();
                return back()->with('error','something went wrong');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }
    public function viewCat($catId)
    {
        $catId=Crypt::decrypt($catId);
        $viewCate=CategoryModel::select('cat_id','category_name','creater')->findOrFail($catId);
        return view('Category.viewCat',compact('viewCate'));
    }
}
