<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\adminController;
use App\Http\Middleware\Admin\adminLogOrNot;
use App\Http\Controllers\Category\categoryController;
use App\Http\Controllers\Quiz\quizController;
use App\Http\Controllers\Mcq\mcqController;
use App\Http\Controllers\Dashboard\dashboardController;
use App\Http\Controllers\User\userController;
use App\Http\Controllers\User\userCatController;


Route::get('/',[userController::class,'dashBoard']);

Route::get('/admin/dashboard', [dashboardController::class, 'dashboard']);

Route::get('/login',[adminController::class,'loginPage']);
Route::post('/loginEntry',[adminController::class,'loginAdmin']);



Route::middleware(['adminAuth'])->group(function()
{
    Route::post('/logout',[adminController::class,'logoutAdmin']);
    // ===========category=============
    Route::get('/showAllCategory',[categoryController::class,'showAllCate']);
    Route::get('/categoryAdd',[categoryController::class,'addCat']);
    Route::post('/storecategory',[categoryController::class,'storeCat']);
    Route::get('/viewcatagory/{id}',[categoryController::class,'viewCat']);
    Route::get('/editCate/{id}',[categoryController::class,'editCategory']);
    Route::post('/updateCate/{id}',[categoryController::class,'updateCategory']);

    // ====================Quiz===============
    Route::get('/showAllQuiz',[quizController::class,'quizAllShow']);
    Route::get('/add/Quiz',[quizController::class,'quizAdd']);
    Route::post('/store/quiz',[quizController::class,'storeQuiz']);
    Route::get('/edit/quiz/{quizid}',[quizController::class,'quizEdit']);
    Route::post('/update/quiz/{id}',[quizController::class,'quizUpdate']);
    Route::get('/viewspecific/quiz/{quizid}',[quizController::class,'specificViewQuiz']);

    // ======================MCQ=================================
    Route::get('/showAllQuiz/mcq',[mcqController::class,'quizAllShowList']);
    Route::get('/showAll/mcq/{quizId}',[mcqController::class,'mcqAllShowList']);
    Route::get('/mcq/add/{quizid}',[mcqController::class,'mcqAddForm']);
    Route::post('/mcq/store/{quizid}',[mcqController::class,'storeMcqQuestions']);
    Route::get('/mcq/edit/{mcqId}',[mcqController::class,'mcqEditForm']);
    Route::post('/mcq/update/{mcqId}',[mcqController::class,'updateMcqForm']);
    Route::get('/mcq/view/{mcqId}',[mcqController::class,'mcqViewForm']);
    Route::get('/delete/mcq/{mcqId}',[mcqController::class,'deleteMcq']); 
});

// ==========================user here========================
Route::get('/user/cat/list',[userCatController::class,'userCatAllList']);