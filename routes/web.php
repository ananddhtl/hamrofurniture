<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemGroupController;
use App\Http\Controllers\ItemSubGroupController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('vendor-login', [CustomAuthController::class, 'vendorLogin'])->name('vendor.login');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('vendor-registration', [CustomAuthController::class, 'vendorRegisteration'])->name('vendor.register');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::middleware(['auth'])->group(function () {

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/item', [InventoryController::class, 'item']);

    Route::get('/additemdetails', [InventoryController::class, 'additemdetails']);
    Route::get('/additemunitdetails/{id}', [InventoryController::class, 'additemunitdetails']);
    Route::post('/itemsDetailsStore', [InventoryController::class, 'itemsdetailsStore']);
    Route::get('/itemsDetailsEdit/{id}', [InventoryController::class, 'itemsDetailsEdit']);

    //for inventory setting unit details  
    Route::post('/inventorysettingStore', [InventoryController::class, 'inventorysettingStore']);
    //Route::get('/searchunititemdetails',[InventoryController::class,'searchunititemdetails']);

    Route::get('/searchitemsetting', [InventoryController::class, 'searchitemsetting']);

    Route::get('/delete-itemsDetails/{id}', [InventoryController::class, 'deleteitemsDetails']);


    Route::get('/group', [ItemGroupController::class, 'addGroupIteam']);
    Route::post('/Gitemstore', [ItemGroupController::class, 'groupitemstore']);
    Route::get('/edit-groupitem/{id}', [ItemGroupController::class, 'groupitemedit']);
    Route::post('/update-groupitem', [ItemGroupController::class, 'UpdateGroup'])->name('groupitem.update');
    Route::get('/delete-groupitem/{id}', [ItemGroupController::class, 'DeleteGroup']);
    Route::get('/SearchGroupReturnInView', [ItemGroupController::class, 'SearchGroupReturnInView']);
    Route::get('/searchgroup', [ItemGroupController::class, 'searchgroup']);

    Route::get('/subgroup', [ItemSubGroupController::class, 'addsubgroup'])->name('subgroup');
    Route::get('/subgroup/{id}', [ItemSubGroupController::class, 'subgroupitemedit']);
    Route::post('/subgroup/subgroupstore', [ItemSubGroupController::class, 'subgroupstore']);

    Route::post('/update-subgroupitem', [ItemSubGroupController::class, 'UpdateSubGroup'])->name('subgroupitem.update');
    Route::get('/delete-subgroupitem/{id}', [ItemSubGroupController::class, 'DeleteSubGroup']);
    Route::get('/searchsubgroup', [ItemSubGroupController::class, 'SearchSubGroup']);
    Route::get('/selectgroupitem/{id}', [ItemSubGroupController::class, 'selectgroupitem']);
    Route::post('/searchsubgroupitems', [ItemSubGroupController::class, 'SearchsubGroupitem']);


    Route::get('/Company', [CompanyController::class, 'addcompany']);
    Route::post('/Companystore', [CompanyController::class, 'companystore']);
    Route::get('/edit-Company/{id}', [CompanyController::class, 'companyedit']);
    Route::post('/update-Company', [CompanyController::class, 'UpdateCompany'])->name('company.update');
    Route::get('/delete-Company/{id}', [CompanyController::class, 'DeleteCompany']);
    Route::get('/searchcompany', [CompanyController::class, 'Searchcompany']);

});