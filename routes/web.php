<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postsController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\attributeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\PdfController;
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
Route::get('/product', [productController::class, 'home'])->name('product.home');
Route::get('/product/{id}/details', [productController::class, 'details'])->name('product.details');
Route::post('/product/{id}/details/cart', [productController::class, 'shoppingCart'])->name('product.cart');
route::get('/cart', [orderController::class, 'cart'])->name('cart');
route::post('/cart/update', [orderController::class, 'update'])->name('cart.update');
route::post('/cart/remove', [orderController::class, 'remove'])->name('cart.remove');
route::get('/cart/checkout', [orderController::class, 'checkout'])->name('cart.checkout');
route::post('/cart/checkout/store', [orderController::class, 'store'])->name('cart.store');
route::get('/cart/checkout/overview', [orderController::class, 'overview'])->name('cart.overview');
route::post('/cart/checkout/overview/store', [orderController::class, 'storeOrder'])->name('cart.storeOrder');
route::post('/cart/checkout/overview/store/email', [orderController::class, 'storeOrderMail'])->name('cart.storeOrderMail');
route::get('/cart/checkout/succes', [orderController::class, 'storeSucces'])->name('cart.storeSucces');
route::get('/cart/checkout/succes/{order}download', [PdfController::class, 'orderPDF'])->name('cart.download');



//admin panel
Route::get('/dashboard', [postsController::class, "showAdmin"])
    ->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    //logout button
    Route::post('/logoout', function () {
        return view('welcome');
    });
    route::prefix('/user')->group(function () {
        Route::prefix('/projects')->group(function () {
            Route::get('/', [projectController::class, 'home'])->name('project.home');
            Route::get('/{project}/details', [projectController::class, 'details'])->name('project.details');
            route::post('/{project}/details/task', [projectController::class, 'taskFinish'])->name('task.finish');
        });
        Route::prefix('/orders')->group(function () {
            Route::get('/', [orderController::class, 'home'])->name('order.home');
            Route::get('/{order}/details', [orderController::class, 'details'])->name('order.details');
            Route::get('/{order}/details/pdf', [PdfController::class, 'generatePDF'])->name('pdf.download');
        });
    });
    //artical page
    Route::prefix('/dashboard')->group(function () {
        Route::prefix('/articals')->group(function () {
            Route::get('/edit/{id}', [postsController::class, 'edit'])->name('index.edit');
            Route::post('/edited/{id}', [postsController::class, 'editpost'])->name('edit.post');
            Route::post('/delete/{id}', [postsController::class, 'deletePost'])->name('deletePost');
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
        Route::post('/catagory/delete/{id}', [categoryController::class, "delete"])->name('category.delete');
        Route::get('/catagory/search', [categoryController::class, "search"])->name('search.category');

        //projects page
        Route::prefix('/projects')->group(function () {
            Route::get('/', [projectController::class, 'index'])->name('projects.index');
            Route::get('/{id}/edit', [projectController::class, 'edit'])->name('projects.edit');
            Route::post('/{id}/edited', [projectController::class, 'update'])->name('projects.update');
            Route::get('/add', [projectController::class, 'add'])->name('projects.add');
            Route::post('/added', [projectController::class, 'store'])->name('project.added');
            Route::post('/{id}/deleted', [projectController::class, 'delete'])->name('projects.delete');
            Route::get('/{id}/users', [projectController::class, 'getUser'])->name('projects.user');
            Route::get('/{projectId}/users/edit/{userId}', [projectController::class, 'editUser'])->name('projects.user.edit');
            Route::post('/{id}/users/delete', [projectController::class, 'deleteUser'])->name('projects.user.delete');
            Route::post('/{projectId}/user/edited/{userId}', [projectController::class, 'updateUser'])->name('project.user.update');
            Route::get('/{id}/user/add', [projectController::class, 'adduser'])->name('project.user.add');
            Route::get('/search', [projectController::class, 'search'])->name('project.search');
            Route::post('/{id}/user/added', [projectController::class, 'addeduser'])->name('project.user.added');
        });
        //roles
        Route::get('/roles', [rolesController::class, 'index'])->name('roles.index');
        Route::get('/roles/add', [rolesController::class, "add"])->name('roles.add');
        Route::post('/roles/store', [rolesController::class, "store"])->name('roles.added');
        Route::get('/roles/id={id}', [rolesController::class, "edit"])->name('roles.edit');
        Route::post('roles/id={id}/edited', [rolesController::class, 'update'])->name('roles.edited');
        Route::post('/roles/delete/{id}', [rolesController::class, "delete"])->name('roles.delete');
        Route::get('/roles/search', [rolesController::class, 'search'])->name('roles.search');

        //tasks
        Route::get('/projects/{id}/tasks', [taskController::class, 'index'])->name('projects.task');
        Route::get('/projects/{id}/tasks/add', [taskController::class, 'create'])->name('projects.task.add');
        Route::post('/projects/{id}/tasks/delete/{task_id}', [taskController::class, 'delete'])->name('projects.task.delete');
        Route::get('/projects/{project_id}/tasks/edit/{task_id}', [taskController::class, 'edit'])->name('projects.task.edit');
        //update route
        Route::post('/projects/{project_id}/tasks/edited/{task_id}', [taskController::class, 'update'])->name('projects.task.edited');
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
        route::prefix('/orders')->group(function () {
            route::get('/', [orderController::class, 'index'])->name('orders.index');
            route::prefix('/{order}')->group(function () {
                route::get('/show', [orderController::class, 'show'])->name('orders.show');
                route::prefix('/edit')->group(function () {
                    route::get('/', [orderController::class, 'edit'])->name('orders.edit');
                    route::prefix('/product')->group(function () {
                        route::get('/', [orderController::class, 'editProduct'])->name('orders.editProduct');
                        route::post('/update', [orderController::class, 'addproduct'])->name('orders.addproduct');
                        route::post('/delete', [orderController::class, 'deleteProduct'])->name('orders.deleteproduct');
                    });
                    route::prefix('/address')->group(function () {
                        route::get('/', [orderController::class, 'editaddress'])->name('orders.editAdress');
                        route::post('/update_0', [orderController::class, 'updateaddress_0'])->name('orders.updateAdress_0');
                        route::post('/update_1', [orderController::class, 'updateaddress_1'])->name('orders.updateAdress_1');
                    });
                });
                route::delete('/delete', [orderController::class, 'delete'])->name('orders.delete');
                route::post('/edited', [orderController::class, 'orderInfo'])->name('orders.edited');
            });
            route::get('/search', [orderController::class, 'search'])->name('orders.search');
        });
    });
});

require __DIR__ . '/auth.php';
