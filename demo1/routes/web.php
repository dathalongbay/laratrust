<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

use Illuminate\Support\Facades\DB;
// https://github.com/barryvdh/laravel-debugbar
// https://laravel.com/docs/8.x/queries
Route::get('/db1', function () {

    // lấy ra data trong bảng users
    $users = DB::table('users')->get();

    foreach ($users as $user) {
        echo "<p>$user->email</p>";
    }
    dump($users);
    // chuyển collection sang mảng
    $users2 = $users->toArray();

    dump($users2);
});

Route::get("/db2", function () {
    // ->first() lấy ra 1 bản ghi đầu tiên và duy nhất
    $user = DB::table('users')->where('email', 'user@itsolutionstuff.com')->where('is_admin', 0)->first();
    dump($user);
});
