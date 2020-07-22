<?php
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('index');
})->middleware('guest');


Route::group(['prefix' => 'ahliwaris', 'middleware' => ['auth:user']], function () {
    Route::get('/', 'AhliwarisController@index')->name('ahliwaris.index');

    // Create & Store Jenazah
    Route::get('/create', 'AhliwarisController@create')->name('ahliwaris.create');
    Route::post('/store', 'AhliwarisController@store')->name('ahliwaris.store');
    Route::post('/document/store/{jenazah_id}', 'AhliwarisController@documentStore')->name('ahliwaris.reupload');

    // detail
    Route::get('/detail/{jenazah_id}', 'AhliwarisController@detail')->name('ahliwaris.detail');

    // Profile
    Route::get('/profile', 'AhliwarisController@profile')->name('ahliwaris.profile');
    Route::post('/profile/edit', 'AhliwarisController@updateProfile')->name('ahliwaris.profile.update');

    // payment
    Route::post('/trx/{trx_id}/payment/store', 'AhliwarisController@paymentStore')->name('ahliwaris.payment.store');

    // schedule
    Route::get('/schedule/{jenazah_id}', 'AhliwarisController@checkSchedule')->name('ahliwaris.check.schedule');

});

Route::group(['prefix' => 'adminmakam', 'middleware' => ['auth:admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    // detail
    Route::get('/detail/{jenazah_id}', 'AdminController@jenazahDetail')->name('admin.jenazah.detail');

    // Gallery
    Route::get('/gallery', 'AdminController@gallery')->name('admin.gallery');
    Route::post('/gallery', 'AdminController@storeImage')->name('admin.gallery.store');
    Route::get('/gallery/{photoid}', 'AdminController@removeImage')->name('admin.gallery.remove');

    // Package
    Route::get('/package', 'AdminController@package')->name('admin.package');
    Route::get('/package/create', 'AdminController@packageCreate')->name('admin.package.create');
    Route::post('/package/store', 'AdminController@packageStore')->name('admin.package.store');
    Route::get('/package/{package_id}/remove', 'AdminController@packageRemove')->name('admin.package.remove');
    Route::get('/package/{package_id}/benefit', 'AdminController@packageBenefit')->name('admin.package.benefit');
    Route::get('/package/{package_id}/enable', 'AdminController@packageEnable')->name('admin.package.enable');
    Route::get('/package/{package_id}/disable', 'AdminController@packageDisable')->name('admin.package.disable');

    // Package detail
    Route::post('/package/{package_id}/package_detail/store', 'AdminController@packagedetailStore')->name('admin.packagedetail.store');
    Route::get('/packagedetail/{benefit_id}/remove', 'AdminController@packagedetailRemove')->name('admin.packagedetail.remove');

    // documents
    Route::get('/document', 'AdminController@documents')->name('admin.documents');
    Route::get('/document/reject/{jenazah_doc_id}', 'AdminController@documentsReject')->name('admin.documents.reject');
    Route::get('/document/accept/{jenazah_doc_id}', 'AdminController@documentsAccept')->name('admin.documents.accept');

    // payments
    Route::get('/payment', 'AdminController@payments')->name('admin.payments');
    Route::get('/payment/reject/{payment_id}', 'AdminController@paymentsReject')->name('admin.payments.reject');
    Route::get('/payment/accept/{payment_id}', 'AdminController@paymentsAccept')->name('admin.payments.accept');

});

route::get('/getseat/{sector_code}', 'AhliwarisController@getSeat');

// hanya untuk tamu yg belum auth
Route::get('/login', 'MultiloginController@getLogin')->middleware('guest');
Route::post('/login', 'MultiloginController@postLogin');
Route::post('/register', 'MultiloginController@registerUser');
Route::get('/logout', 'MultiloginController@logout')->name('logout');

// Example
Route::get('/example', function() {
    return view('example');
});
Route::post('/example', function(Request $request) {
    $request->validate([
        'doc' => 'required|mimes:pdf,xlx,csv|max:2048',
    ]);
    $fileName = time().'.'.$request->doc->extension();  
    $request->doc->move(public_path('death_documents'), $fileName);
    // return redirect()->back();
});

Route::get('/jam', function() {
    dd(date('h.i'));
});





















// Route::get('/admin', function() {
//   return view('admin');
// })->middleware('auth:admin');

// Route::get('/user', function() {
//   return view('user');
// })->middleware('auth:user');
