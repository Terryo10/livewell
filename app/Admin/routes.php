<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    
        $router->get('/', 'HomeController@index')->name('home');
        
        $router->resource('blog-categories', BlogCategoryController::class);
        $router->resource('posts', PostController::class);
        $router->resource('post-comments', PostCommentController::class);
});