<?php
// Post
Breadcrumbs::for('indexPost', function ($trail) {
     $trail->push('Trang chủ', route('indexPost'));
});

Breadcrumbs::for('createPost', function ($trail) {
    $trail->parent('indexPost');
    $trail->push('Tạo Bài',route('createPost'));
});

Breadcrumbs::for('editPost', function ($trail) {
    $trail->parent('indexPost');
    $trail->push('Bài viết', route('indexPost'));
    $trail->push('Sửa bài viết',route('editPost'));
});
Breadcrumbs::for('filterPost', function ($trail,$key) {
    $trail->parent('indexPost');
    if($key == true)
    {
        $trail->push('Tìm bài viết',route('filterPost'));
    }
});
Breadcrumbs::for('searchPost', function ($trail,$key) {
    $trail->parent('indexPost');
    if($key == true)
    {
        $trail->push('Tìm bài viết',route('searchPost'));
    }
});

//Banner
Breadcrumbs::for('indexBanner', function ($trail) {
     $trail->push('Trang chủ', route('indexBanner'));
});
Breadcrumbs::for('createBanner', function ($trail) {
    $trail->parent('indexBanner');
    $trail->push('Tạo Banner',route('createBanner'));
});
Breadcrumbs::for('editBanner', function ($trail) {
    $trail->parent('indexBanner');
    $trail->push('Banner', route('indexBanner'));
    $trail->push('Sửa Banner',route('editBanner'));
});
Breadcrumbs::for('filterBanner', function ($trail,$key) {
    $trail->parent('indexBanner');
    if($key == true)
    {
        $trail->push('Tìm Banner',route('filterBanner'));
    }
});
// Muc tin
Breadcrumbs::for('indexCategory', function ($trail) {
     $trail->push('Trang chủ', route('indexCategory'));
});
Breadcrumbs::for('createCategory', function ($trail) {
    $trail->parent('indexCategory');
    $trail->push('Tạo mục tin',route('createCategory'));
});
Breadcrumbs::for('editCategory', function ($trail) {
    $trail->parent('indexCategory');
    $trail->push('Mục tin', route('indexCategory'));
    $trail->push('Sửa mục tin',route('editCategory'));
});
Breadcrumbs::for('filterCategory', function ($trail,$key) {
    $trail->parent('indexCategory');
    if($key == true)
    {
        $trail->push('Tìm mục tin',route('filterCategory'));
    }
});
// User
Breadcrumbs::for('indexUser', function ($trail) {
     $trail->push('Trang chủ', route('indexUser'));
});
Breadcrumbs::for('createUser', function ($trail) {
    $trail->parent('indexCategory');
    $trail->push('Tạo mục tin',route('createUser'));
});
Breadcrumbs::for('editUser', function ($trail) {
    $trail->parent('indexUser');
    $trail->push('User', route('indexUser'));
    $trail->push('Sửa thông tin User',route('editUser'));
});
Breadcrumbs::for('change_passwordUser', function ($trail) {
    $trail->parent('indexUser');
    $trail->push('User', route('indexUser'));
    $trail->push('Đổi mật khẩu',route('change_passwordUser'));
});
Breadcrumbs::for('filterUser', function ($trail,$key) {
    $trail->parent('indexUser');
    if($key == true)
    {
        $trail->push('Tìm User',route('filterUser'));
    }
});