<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postsController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\attributeController;
use App\Http\Controllers\productController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//home page
Route::get('/', [postsController::class, 'index'])->name('home');
Route::get('/projects', [projectController::class, 'home'])->name('project.home');
Route::get('/product', [productController::class, 'home'])->name('product.home');


//admin panel
Route::get('/dashboard', [postsController::class, "showAdmin"])
    ->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    //logout button
    Route::post('/logoout', function () {
        return view('welcome');
    });
    //artical page
    Route::prefix('/dashboard')->group(function () {
        Route::prefix('/articals')->group(function () {
            Route::get('/edit/{id}', [postsController::class, 'edit'])->name('index.edit');
            Route::post('/edited/{id}', [postsController::class, 'editpost'])->name('edit.post');
            Route::delete('/delete/{id}', [postsController::class, 'deletePost'])->name('deletePost');
            Route::get('/add', [postsController::class, 'addGet'])->name('addpost');
            Route::post('/addpost/post', [postsController::class, 'store'])->name('addedpost');
            Route::get('/search', [postsController::class, 'search'])->name('search.post');
        });
        //categories page
        Route::get('/category', [categoryController::class, 'index'])->name('category.index');
        Route::get('/category/add', [categoryController::class, "add"])->name('category.add');
        Route::post('/category/store', [categoryController::class, "store"])->name('category.added');
        Route::get('/catagory/{id}/edit', [categoryController::class, "edit"])->name('category.edit');
        Route::post('/category/{id}/edited', [categoryController::class, 'update'])->name('category.edited');
        Route::delete('/catagory/delete/{id}', [categoryController::class, "delete"])->name('category.delete');
        Route::get('/catagory/search', [categoryController::class, "search"])->name('search.category');

        //projects page
        Route::get('/projects', [projectController::class, 'index'])->name('projects.index');
        Route::get('/projects/{id}/edit', [projectController::class, 'edit'])->name('projects.edit');
        Route::get('/projects/add', [projectController::class, 'add'])->name('projects.add');
        Route::post('/projects/added', [projectController::class, 'store'])->name('project.added');
        Route::delete('/projects/{id}/deleted', [projectController::class, 'delete'])->name('projects.delete');
        Route::get('/projects/{id}/users', [projectController::class, 'getUser'])->name('projects.user');
        Route::get('/projects/{projectId}/users/edit/{userId}', [projectController::class, 'editUser'])->name('projects.user.edit');
        Route::post('/projects/{id}/users/delete', [projectController::class, 'deleteUser'])->name('projects.user.delete');
        Route::post('/projects/{projectId}/user/edited/{userId}', [projectController::class, 'updateUser'])->name('project.user.update');
        Route::get('/projects/{id}/user/add', [projectController::class, 'adduser'])->name('project.user.add');
        Route::get('/projects/search', [projectController::class, 'search'])->name('project.search');
        Route::post('/projects/{id}/user/added', [projectController::class, 'addeduser'])->name('project.user.added');
        //roles
        Route::get('/roles', [rolesController::class, 'index'])->name('roles.index');
        Route::get('/roles/add', [rolesController::class, "add"])->name('roles.add');
        Route::post('/roles/store', [rolesController::class, "store"])->name('roles.added');
        Route::get('/roles/id={id}', [rolesController::class, "edit"])->name('roles.edit');
        Route::post('roles/id={id}/edited', [rolesController::class, 'update'])->name('roles.edited');
        Route::delete('/roles/delete/{id}', [rolesController::class, "delete"])->name('roles.delete');
        Route::get('/roles/search', [rolesController::class, 'search'])->name('roles.search');

        //tasks
        Route::get('/projects/{id}/tasks', [taskController::class, 'index'])->name('projects.task');
        Route::get('/projects/{id}/tasks/add', [taskController::class, 'create'])->name('projects.task.add');
        Route::post('/projects/{id}/tasks/delete/{task_id}', [taskController::class, 'delete'])->name('projects.task.delete');
        Route::get('/projects/{project_id}/tasks/edit/{task_id}', [taskController::class, 'edit'])->name('projects.task.edit');
        Route::get('/projects/{project_id}/tasks/edit/{task_id}/users', [taskController::class, 'editUser'])->name('projects.task.user');
        route::post('/projects/{project_id}/tasks/edit/{task_id}/users/update', [taskController::class, 'updateUser'])->name('tast.user.update');
        Route::post('/projects/{project_id}/tasks/added', [taskController::class, 'store'])->name('project.task.store');
        //attritube

        Route::prefix('/attributes')->group(function () {
            Route::get('/', [attributeController::class, 'index'])->name('attributes.index');
            Route::post('/added', [attributeController::class, 'store'])->name('attributes.added');
            Route::get('/{id}/edit',  [attributeController::class, 'edit'])->name('attributes.edit');
            Route::post('{id}/edited',  [attributeController::class, 'update'])->name('attributes.edited');
            Route::post('/{id}/delete/',  [attributeController::class, 'delete'])->name('attributes.delete');
            Route::get('/search',  [attributeController::class, 'search'])->name('attributes.search');
        });
        route::prefix('/products')->group(function () {
            Route::get('/', [productController::class, 'index'])->name('products.index');
            Route::get('/add', [productController::class, 'add'])->name('products.add');
            Route::post('/added', [productController::class, 'store'])->name('products.store');
            Route::get('/{id}/edit', [productController::class, 'edit'])->name('products.edit');
            Route::post('/{id}/edited', [productController::class, 'update'])->name('products.edited');
            Route::post('/{id}/delete', [productController::class, 'delete'])->name('products.delete');
            Route::get('/search', [productController::class, 'search'])->name('products.search');
            route::prefix('{productId}/attribute')->group(function () {
                route::get('/', [productController::class, 'attributeIndex'])->name('products.attribute');
                route::get('/add', [productController::class, 'attributeAdd'])->name('products.attribute.add');
                route::post('/added', [productController::class, 'attributeStore'])->name('products.attribute.added');
                route::get('/{attributeId}/edit', [productController::class, 'attributeEdit'])->name('products.attribute.edit');
                route::post('/attributeId}/edited', [productController::class, 'attributeUpdate'])->name('products.attribute.edited');
                route::post('/{attributeId}/delete', [productController::class, 'attributeDelete'])->name('products.attribute.delete');
            });
        });
    });
});

require __DIR__ . '/auth.php';
