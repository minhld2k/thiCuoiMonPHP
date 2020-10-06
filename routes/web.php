<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

Route::get('/sum/{n}', function ($n) {
    echo "tong la: " . ($n + 1)*n/2;
});

Route::get('/sum/{a}/{b}', function ($a,$b) {
    echo "canh huyen: " . sqrt($a*$a + $b*$b);
});

Route::get('/sum/{a}/{b}/{c}', function ($a,$b,$c) {
    $delta = $b*$b - 4*$a*$c;
    echo "pt bac 2: x1= " . (-$b + sqrt($delta))/2 . "x2= ". (-$b - sqrt($delta))/2;
});

Route::get('/update/{id}/{ten}', function ($id,$ten) {
    echo "thuc hiencap nhat";
})->where(['id'=>'[0-9]+','ten'=>'[a-zA-Z0-9]+']); //regular expression

Route::get('/update/{id}/{ten}', function ($id,$ten) {
    echo route("capnhatnguoidung");
})->where(['id'=>'[0-9]+','ten'=>'[a-zA-Z0-9]+'])->name("hienthicapnhat");

Route::post('/update', function () {
    echo "thuc hiencap nhat";
})->name("capnhatnguoidung");

Route::get('/blabla',function(){
    echo route("hienthicapnhat",['id'=>1,'ten'=>'abcs']);
});

Route::get('/view',function(){
    $db = new PDO("pgsql:dbname=demo;host=localhost","postgres","12345");
    $sth = $db->prepare("select * from phongban");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            
    return view("blabla",['result'=>$result]);
})->name("viewUser");

Route::get('/manhinhthemmoi',function(){
    return view("manhinhthemmoi");
})->name("add");

Route::get('/manhinhedit/{id}',function($id){
    $db = new PDO("pgsql:dbname=demo;host=localhost","postgres","12345");
    $sth = $db->prepare("select * from phongban where id = ?");
    $sth->execute([$id]);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return view("manhinhthemmoi",['result'=>$result]);
})->name("sua");

// Route::post('/luudulieu',function(Request $request){
//     $id = $request->request->get("id");
//     $ten = $request->request->get("ten");
//     if ($id == "") {
//         $id = rand(0,9999999999999);
//         $db = new PDO("pgsql:dbname=demo;host=localhost","postgres","12345");
//         $sth = $db->prepare("insert into phongban (id,ten) values(?,?)");
//         $sth->execute([$id,$ten]);
//         return redirect()->route('viewUser');
//     }else{
//         $db = new PDO("pgsql:dbname=demo;host=localhost","postgres","12345");
//         $sth = $db->prepare("update phongban set ten=? where id = ?");
//         $sth->execute([$ten,$id]);
//         return redirect()->route('viewUser');
//     }
    
// })->name("luudulieu");

Route::get('/xoa/{id}',function($id){
    $db = new PDO("pgsql:dbname=demo;host=localhost","postgres","12345");
    $sth = $db->prepare("delete from phongban where id = ?");
    $sth->execute([$id]);
    return redirect()->route('viewUser');
})->name("xoa");

//Route::redirect('/luudulieu', '/view')->name("redirect");
/*
Route::post('/update', function () {
    echo "thuc hiencap nhat";
});

Route::post('/', function () {
    return view('welcome');
});

Route::any('/', function () {
    return view('welcome');
});*/

//Route::redirect('/sum', '/add');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//middleware
// Route::get('/manhinhthemmoi',function(){
//     echo "helllo";
// })->middleware("ghilog")->name("add");

Route::get('/kocoquyen',function(){
    echo "kocoquyen";
})->name("kocoquyen");

Route::get('/manhinhthemmoi',function(){
    //lấy toàn bộ danh sách
    $userArr = DB::table("users")->get();
    //lấy dong đầu tiên của dữ liệu
    $user = DB::table("users")->first();
    //lấy có where
    $user = DB::table("users")
    ->where("email","=","admin@gmail.com")
    ->where("id",1000)
    ->first();
    // phần điều kiện <,>,<>,=,like,@@

    //lấy một dữ liệu theo cột(thường dùng khi cần lấy cấu hình, check quyền)
    $name = DB::table("users")
        ->where("email","=","admin@gmail.com")
        ->where("id",1000)
        ->value("name");

    // lấy dữ liệu theo id
    $user = DB::table("users")
        ->find(1000);

    // lấy mảng dữ liệu theo cột
    $userIdAr = DB::table("users")
        ->pluck("id");

    // lấy mảng dữ liệu theo cột có key va value để đổ combobox
    $userIdNameAr = DB::table("users")
        ->pluck("name","id"); // value,key
    //Viết màn hình cập nhật user (phân vào chức danh và phòng ban)

    dd($userIdNameAr);
})
->middleware("authencation");
//->name("kiemtra");

Route::get('/capnhatuser/{id}',function(Request $request,$id){

    $phongban = DB::table("phongbans")
    ->pluck("name","id");

    $chucdanh = DB::table("chucdanhs")
    ->pluck("name","id");

    $user = DB::table("users")
        ->find($id);
    
    return view("showmanhinh",
        compact([
            "user"
            ,"phongban"
            ,"chucdanh"
        ])
    );

})
//->middleware("authencation")
->name("edituser");

Route::get('/viewuser',function(){

    $phongban = DB::table("phongbans")
    ->pluck("name","id");

    $chucdanh = DB::table("chucdanhs")
    ->pluck("name","id");

    $user = DB::table("users")->get();        
    return view("viewuser",
        compact([
            "user"
            ,"phongban"
            ,"chucdanh"
        ])
    );
})->name("viewUser");

Route::post('/save',function(Request $request){
    $id = $request->request->get("id");
    $name = $request->request->get("name");
    $chucdanh = $request->request->get("chucdanh");
    $phongban = $request->request->get("phongban");

    $db = new PDO("pgsql:dbname=demo;host=localhost","postgres","12345");
    $sth = $db->prepare("update users set name=?,chucdanhid=?,phongbanid=? where id = ?");
    $sth->execute([$name,$chucdanh,$phongban,$id]);
    return redirect()->route('viewUser');

})->name("save");

//bổ sung entity nhomnguoidung, nguoidung_nhom, nhom_chucnang
// 1 người dùng thuộc nhiều nhóm
// 1 nhóm có nhiều chức năng
// kiểm tra quyền : gồm quyền ở bảng chucnang_users và nhom_chucnang
