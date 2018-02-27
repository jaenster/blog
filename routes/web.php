<?php



/*
Route::get('/', function () {
    return view('welcome');
});


*/
Auth::routes();


Route::get('/',function (){
    return redirect('/blog');
});
Route::resource('/blog','BlogController');
Route::get('/blog/{blog}/delete','BlogController@destroy')->name('blog_delete');