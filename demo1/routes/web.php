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

Route::get("/db3", function () {
    $user = DB::table('users')->find(5);
    dump($user);
});

Route::get("/db4", function () {
    // lấy dữ liệu 1 cột
    $data = DB::table('users')->pluck('name');
    dump($data);
});

Route::get("/db5", function () {
    // đếm các bản ghi
    $count = DB::table('users')->count();
    dump($count);
});


Route::get("/db6", function () {
    // đếm các bản ghi
    $max = DB::table('users')->max("id");
    dump($max);
});

Route::get("/db7", function () {
    // đếm các bản ghi
    $max = DB::table('users')->max("id");
    dump($max);
});

Route::get("/db8", function () {
    $users = DB::table('users')
        ->select('name', 'email as user_email', 'is_admin')
        ->get();

    dump($users);
});

Route::get("/db9", function () {
    $users = DB::table('users')
        ->select(DB::raw('count(*) as user_count, status'))
        ->where('status', '<>', 1)
        ->groupBy('status')
        ->get();

    dump($users);
});

Route::get("/db10", function () {
    $users = DB::table('users')
        ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.*', 'contacts.phone', 'orders.price')
        ->get();

    dump($users);
});

Route::get("/db11", function () {
    $users = DB::table('users')
        ->where('votes', '=',100)
        ->where('age', '>', 35)
        ->get();

    dump($users);
});

Route::get("/db12", function () {
    $users = DB::table('users')
        ->where('votes', '=',100)
        ->orWhere('age', '>', 35)
        ->get();

    dump($users);
});

Route::get("/db13", function () {
    $users = DB::table('users1')
        ->whereIn('id', [1, 2, 3])
        ->get();

    dump($users);
});

// đọc thêm các vi dụ thêm , sửa , xóa ... trong https://laravel.com/docs/8.x/queries
use App\Models\Post;
Route::get("/orm1", function () {
    $posts1 = DB::table('posts')->get();
    dump($posts1);
    $posts = Post::all();
    dump($posts);

    foreach($posts as $post) {
        echo "<p>$post->name</p>";
    }
    dump($posts->toArray());
});

Route::get("/orm2", function () {

    $posts = Post::where("name", "Post 1")->get();
    dump($posts);

    foreach($posts as $post) {
        echo "<p>$post->name</p>";
    }
    dump($posts->toArray());
});

Route::get("/orm3", function () {

    $post = Post::findOrFail(3);
    dump($post);
    dump($post->name);
});

// https://laravel.com/docs/8.x/eloquent thêm , sửa , xóa ...

// https://www.itsolutionstuff.com/post/laravel-one-to-one-eloquent-relationship-tutorialexample.html
use App\Models\User;
use App\Models\Phone;
Route::get("/relation1", function () {

    $user = User::find(1);

    $phone = new Phone();
    $phone->phone = '9429343852';

    $user->phone()->save($phone);
});

Route::get("/relation2", function () {

    $user1 = User::find(1);
    $phone = $user1->phone;
    dump($phone);
    echo $phone->phone;
});
Route::get("/relation3", function () {

    // tìm người nào đang dùng số điện thoại có id là 1
    $phone1 = Phone::find(1);
    $user = $phone1->user;
    dump($user);
    echo $user->email;
});


