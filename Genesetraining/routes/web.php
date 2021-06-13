 <?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SearchController;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [ProductsController::class, 'index']);
Route::get('/checkout' , [ProductsController::class , 'checkout']);
Route::get('/shop-grid' , [ProductsController::class , 'shop']);
Route::get('/contact' , [ProductsController::class , 'contact']);


Route::get('/categories/{category}', function(category $category) {
    // $products = Product::whereCategoryId($category->id)->get();
    $products = $category->products;
    $category = category::all();
    return view('categories', ['products' => $products, 'cat' => $category]);
});

// Route::get('/all', function () {
//     $products = product::all();
//     return view('home', ['products' => $products] );
// });
Route::get('/products/{prod}', function (Product $prod  , $id) {  
    $product = Product::find($id);
    return view('product', ['product' => $prod] );
});

//authetication ko lagi
Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [App\Http\Controllers\Admin\dashboardcontroller::class, 'index'])
    ->name('dashboard');
    
    // product ko lagi
     Route::get('admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products_list');;
    Route::get('admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('create_product');;
     Route::post('admin/products/store', [App\Http\Controllers\Admin\ProductController::class, 'store']);
     Route::get('admin/products/edit/{product}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
     Route::get('admin/products/update/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
     Route::get('admin/products/destroy/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy']);





    //  category ko lagi
    Route::get('admin/category',[App\Http\Controllers\Admin\CategoryController::class , 'index']);
    Route::get('admin/category/create',[App\Http\Controllers\Admin\CategoryController::class , 'create']);
    Route::post('admin/category/store',[App\Http\Controllers\Admin\CategoryController::class , 'store']);
    Route::get('admin/category/edit/{product}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::get('admin/category/destroy/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);



});

//search................
Route::get('/search' , [App\Http\Controllers\SearchController::class , 'search'])->name('search');
//cart.............
Route::post('/cart/store' , [App\Http\Controllers\OrderItemsController::class , 'store'])->middleware('auth');
Route::put('/cart/update/{id}' , [App\Http\Controllers\OrderItemsController::class , 'update']);
Route::delete('/cart/destroy/{id}' , [App\Http\Controllers\OrderItemsController::class , 'destroy']);



Route::get('/order' ,[App\Http\Controllers\OrderController::class , 'index']);