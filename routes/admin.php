<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//grupo para añadir admin en la ruta. ejemplo api/admin/user
Route::prefix('admin')->group(function () {

	//todas las rutas de este grupo requieren session iniciada
	Route::middleware(["auth:sanctum"])->group(function(){

		//ruta para cuando se refresque la pagina
		Route::get('/user', function (Request $request) {
			$request->user()->getRoleNames();
			return $request->user();
		});

		//ciudades y estados
		Route::get('/states', [App\Http\Controllers\StateController::class, 'index']);
		Route::get('/towns/{state_id}', [App\Http\Controllers\TownController::class, 'index']);
		
		//menu
		Route::get('/menu', [App\Http\Controllers\MenusController::class, 'index']);

		//usuarios
		Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
		Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show']);
		Route::post('/user', [App\Http\Controllers\UserController::class, 'store']);
		Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'update']);
		Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
		Route::delete('/users', [App\Http\Controllers\UserController::class, 'destroyMultiple']);
        Route::post('/profile', [App\Http\Controllers\UserController::class, 'profile']);

		//Edicion de roles
		Route::get('/permissions', [App\Http\Controllers\RolesController::class, 'permissions']);
		Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index']);
		Route::get('/role/{id}', [App\Http\Controllers\RolesController::class, 'show']);
		Route::post('/role', [App\Http\Controllers\RolesController::class, 'store']);
		Route::post('/role/{id}', [App\Http\Controllers\RolesController::class, 'update']);
		Route::delete('/role/{id}', [App\Http\Controllers\RolesController::class, 'destroy']);

		//Extras
		Route::get('/terminos', [App\Http\Controllers\ExtrasController::class, 'getTerminos']);
		Route::post('/terminos', [App\Http\Controllers\ExtrasController::class, 'updateTerminos']);
		Route::get('/privacidad', [App\Http\Controllers\ExtrasController::class, 'getPrivacidad']);
		Route::post('/privacidad', [App\Http\Controllers\ExtrasController::class, 'updatePrivacidad']);
		Route::get('/redes', [App\Http\Controllers\ExtrasController::class, 'getRedes']);
		Route::post('/redes', [App\Http\Controllers\ExtrasController::class, 'updateRedes']);
		Route::get('/faqs', [App\Http\Controllers\ExtrasController::class, 'getFaq']);
		Route::post('/faqs', [App\Http\Controllers\ExtrasController::class, 'updateFaq']);

		//Clientes
		Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index']);
		Route::get('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'show']);
		Route::post('/customers', [App\Http\Controllers\CustomerController::class, 'store']);
		Route::post('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'update']);
		Route::delete('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'destroy']);
		Route::delete('/customers', [App\Http\Controllers\CustomerController::class, 'destroyMultiple']);
		Route::get('/customersOpcs', [App\Http\Controllers\CustomerController::class, 'indexOpcs']);
		
		//pedidos
		Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index']);
		Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show']);
		Route::post('/order/{id}', [App\Http\Controllers\OrderController::class, 'setStatus']);
		Route::post('/ordersFilter', [App\Http\Controllers\OrderController::class, 'Filter']);

		//productos
		Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
		Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show']);
		Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']);
		Route::post('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
		Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
		Route::delete('/products', [App\Http\Controllers\ProductController::class, 'destroyMultiple']);
		//importar
		Route::post('/importProducts', [App\Http\Controllers\ProductController::class, 'import']);
		Route::post('/dropzone/productsImage/{id}', [App\Http\Controllers\ProductController::class, 'uploadImage']);
        Route::delete('/dropzone/productsImage/{id}', [App\Http\Controllers\ProductController::class, 'deleteImage']);

		//categorias
		Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
		Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'show']);
		Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store']);
		Route::post('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
		Route::delete('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
		Route::delete('/categories', [App\Http\Controllers\CategoryController::class, 'destroyMultiple']);

		//subcategorias
		Route::get('/subcategories', [App\Http\Controllers\SubcategoryController::class, 'index']);
		Route::get('/subcategories/{id}', [App\Http\Controllers\SubcategoryController::class, 'show']);
		Route::post('/subcategories', [App\Http\Controllers\SubcategoryController::class, 'store']);
		Route::post('/subcategories/{id}', [App\Http\Controllers\SubcategoryController::class, 'update']);
		Route::delete('/subcategories/{id}', [App\Http\Controllers\SubcategoryController::class, 'destroy']);
		Route::delete('/subcategories', [App\Http\Controllers\SubcategoryController::class, 'destroyMultiple']);
		Route::get('/getSubcategories/{id}', [App\Http\Controllers\SubcategoryController::class, 'getSubcategories']);

		//blogs
		Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index']);
		Route::get('/blogs/{id}', [App\Http\Controllers\BlogController::class, 'show']);
		Route::post('/blogs', [App\Http\Controllers\BlogController::class, 'store']);
		Route::post('/blogs/{id}', [App\Http\Controllers\BlogController::class, 'update']);
		Route::delete('/blogs/{id}', [App\Http\Controllers\BlogController::class, 'destroy']);
		Route::delete('/blogs', [App\Http\Controllers\BlogController::class, 'destroyMultiple']);

		//ciudades y estados
		Route::get('/states', [App\Http\Controllers\StateController::class, 'index']);
		Route::get('/towns/{state_id}', [App\Http\Controllers\TownController::class, 'index']);

        //banners
        Route::get('/banners', [App\Http\Controllers\BannersController::class, 'index']);
		Route::get('/banners/{id}', [App\Http\Controllers\BannersController::class, 'show']);
		Route::post('/banners', [App\Http\Controllers\BannersController::class, 'store']);
		Route::post('/banners/{id}', [App\Http\Controllers\BannersController::class, 'update']);
		Route::delete('/banners/{id}', [App\Http\Controllers\BannersController::class, 'destroy']);
		Route::delete('/banners', [App\Http\Controllers\BannersController::class, 'destroyMultiple']);


		//materiales
        Route::get('/materials', [App\Http\Controllers\MaterialController::class, 'index']);
		Route::get('/materials/{id}', [App\Http\Controllers\MaterialController::class, 'show']);
		Route::post('/materials', [App\Http\Controllers\MaterialController::class, 'store']);
		Route::post('/materials/{id}', [App\Http\Controllers\MaterialController::class, 'update']);
		Route::delete('/materials/{id}', [App\Http\Controllers\MaterialController::class, 'destroy']);
		Route::delete('/materials', [App\Http\Controllers\MaterialController::class, 'destroyMultiple']);
		
		// Antireflectives
        Route::get('/antireflectives', [App\Http\Controllers\AntireflectiveController::class, 'index']);
		Route::get('/antireflectives/{id}', [App\Http\Controllers\AntireflectiveController::class, 'show']);
		Route::post('/antireflectives', [App\Http\Controllers\AntireflectiveController::class, 'store']);
		Route::post('/antireflectives/{id}', [App\Http\Controllers\AntireflectiveController::class, 'update']);
		Route::delete('/antireflectives/{id}', [App\Http\Controllers\AntireflectiveController::class, 'destroy']);
		Route::delete('/antireflectives', [App\Http\Controllers\AntireflectiveController::class, 'destroyMultiple']);

		//recubrimientos
        Route::get('/coverings', [App\Http\Controllers\CoveringController::class, 'index']);
		Route::get('/coverings/{id}', [App\Http\Controllers\CoveringController::class, 'show']);
		Route::post('/coverings', [App\Http\Controllers\CoveringController::class, 'store']);
		Route::post('/coverings/{id}', [App\Http\Controllers\CoveringController::class, 'update']);
		Route::delete('/coverings/{id}', [App\Http\Controllers\CoveringController::class, 'destroy']);
		Route::delete('/coverings', [App\Http\Controllers\CoveringController::class, 'destroyMultiple']);


		//paquetes
        Route::get('/packages', [App\Http\Controllers\PackageController::class, 'index']);
		Route::get('/packages/{id}', [App\Http\Controllers\PackageController::class, 'show']);
		Route::post('/packages', [App\Http\Controllers\PackageController::class, 'store']);
		Route::post('/packages/{id}', [App\Http\Controllers\PackageController::class, 'update']);
		Route::delete('/packages/{id}', [App\Http\Controllers\PackageController::class, 'destroy']);
		Route::delete('/packages', [App\Http\Controllers\PackageController::class, 'destroyMultiple']);

		//armazones
       /* Route::get('/frames', [App\Http\Controllers\FrameController::class, 'index']);
		Route::get('/frames/{id}', [App\Http\Controllers\FrameController::class, 'show']);
		Route::post('/frames', [App\Http\Controllers\FrameController::class, 'store']);
		Route::post('/frames/{id}', [App\Http\Controllers\FrameController::class, 'update']);
		Route::delete('/frames/{id}', [App\Http\Controllers\FrameController::class, 'destroy']);
		Route::delete('/frames', [App\Http\Controllers\FrameController::class, 'destroyMultiple']);

		Route::post('/dropzone/framesImage/{id}', [App\Http\Controllers\FrameController::class, 'uploadImage']);
        Route::delete('/dropzone/framesImage/{id}', [App\Http\Controllers\FrameController::class, 'deleteImage']);*/

		//opticas
        Route::get('/opticians', [App\Http\Controllers\OpticianController::class, 'index']);
		Route::get('/opticians/{id}', [App\Http\Controllers\OpticianController::class, 'show']);
		Route::post('/opticians', [App\Http\Controllers\OpticianController::class, 'store']);
		Route::post('/opticians/{id}', [App\Http\Controllers\OpticianController::class, 'update']);
		Route::delete('/opticians/{id}', [App\Http\Controllers\OpticianController::class, 'destroy']);
		Route::delete('/opticians', [App\Http\Controllers\OpticianController::class, 'destroyMultiple']);

		//examenes
        Route::get('/exams', [App\Http\Controllers\ExamController::class, 'index']);
		Route::get('/exams/{id}', [App\Http\Controllers\ExamController::class, 'show']);
		Route::post('/exams', [App\Http\Controllers\ExamController::class, 'store']);
		Route::post('/exams/{id}', [App\Http\Controllers\ExamController::class, 'update']);
		Route::delete('/exams/{id}', [App\Http\Controllers\ExamController::class, 'destroy']);
		Route::delete('/exams', [App\Http\Controllers\ExamController::class, 'destroyMultiple']);

		Route::get('/newsletters', [App\Http\Controllers\NewsletterController::class, 'index']);
		Route::get('/newsletters/{id}', [App\Http\Controllers\NewsletterController::class, 'show']);
		Route::post('/newsletters', [App\Http\Controllers\NewsletterController::class, 'store']);
		Route::post('/newsletters/{id}', [App\Http\Controllers\NewsletterController::class, 'update']);
		Route::delete('/newsletters/{id}', [App\Http\Controllers\NewsletterController::class, 'destroy']);
		Route::delete('/newsletters', [App\Http\Controllers\NewsletterController::class, 'destroyMultiple']);
		Route::post('/newsletters', [App\Http\Controllers\NewsletterController::class, 'store']);
		
	});//sanctum

	Route::get('/ordersExport', [App\Http\Controllers\OrderController::class, 'exportExcel']);
});



