<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Leq
    Route::delete('leqs/destroy', 'LeqController@massDestroy')->name('leqs.massDestroy');
    Route::resource('leqs', 'LeqController');

    // Lijna
    Route::delete('lijnas/destroy', 'LijnaController@massDestroy')->name('lijnas.massDestroy');
    Route::resource('lijnas', 'LijnaController');

    // Rekxraw
    Route::delete('rekxraws/destroy', 'RekxrawController@massDestroy')->name('rekxraws.massDestroy');
    Route::resource('rekxraws', 'RekxrawController');

    // Bingeh
    Route::delete('bingehs/destroy', 'BingehController@massDestroy')->name('bingehs.massDestroy');
    Route::resource('bingehs', 'BingehController');

    // Westgeh
    Route::delete('westgehs/destroy', 'WestgehController@massDestroy')->name('westgehs.massDestroy');
    Route::resource('westgehs', 'WestgehController');

    // Layenetsiyasi
    Route::delete('layenetsiyasis/destroy', 'LayenetsiyasiController@massDestroy')->name('layenetsiyasis.massDestroy');
    Route::post('layenetsiyasis/media', 'LayenetsiyasiController@storeMedia')->name('layenetsiyasis.storeMedia');
    Route::post('layenetsiyasis/ckmedia', 'LayenetsiyasiController@storeCKEditorImages')->name('layenetsiyasis.storeCKEditorImages');
    Route::resource('layenetsiyasis', 'LayenetsiyasiController');

    // Kandid
    Route::delete('kandids/destroy', 'KandidController@massDestroy')->name('kandids.massDestroy');
    Route::post('kandids/media', 'KandidController@storeMedia')->name('kandids.storeMedia');
    Route::post('kandids/ckmedia', 'KandidController@storeCKEditorImages')->name('kandids.storeCKEditorImages');
    Route::resource('kandids', 'KandidController');

    // Dengen Layenetsiyasi
    Route::delete('dengen-layenetsiyasis/destroy', 'DengenLayenetsiyasiController@massDestroy')->name('dengen-layenetsiyasis.massDestroy');
    Route::post('dengen-layenetsiyasis/media', 'DengenLayenetsiyasiController@storeMedia')->name('dengen-layenetsiyasis.storeMedia');
    Route::post('dengen-layenetsiyasis/ckmedia', 'DengenLayenetsiyasiController@storeCKEditorImages')->name('dengen-layenetsiyasis.storeCKEditorImages');
    Route::resource('dengen-layenetsiyasis', 'DengenLayenetsiyasiController');

    // Daxlkrna Dengen Kandida
    Route::delete('daxlkrna-dengen-kandidas/destroy', 'DaxlkrnaDengenKandidaController@massDestroy')->name('daxlkrna-dengen-kandidas.massDestroy');
    Route::post('daxlkrna-dengen-kandidas/media', 'DaxlkrnaDengenKandidaController@storeMedia')->name('daxlkrna-dengen-kandidas.storeMedia');
    Route::post('daxlkrna-dengen-kandidas/ckmedia', 'DaxlkrnaDengenKandidaController@storeCKEditorImages')->name('daxlkrna-dengen-kandidas.storeCKEditorImages');
    Route::resource('daxlkrna-dengen-kandidas', 'DaxlkrnaDengenKandidaController');

    // Reja Beshdarboyan
    Route::delete('reja-beshdarboyans/destroy', 'RejaBeshdarboyanController@massDestroy')->name('reja-beshdarboyans.massDestroy');
    Route::resource('reja-beshdarboyans', 'RejaBeshdarboyanController');

    // Hnartna Dengan
    Route::delete('hnartna-dengans/destroy', 'HnartnaDenganController@massDestroy')->name('hnartna-dengans.massDestroy');
    Route::post('hnartna-dengans/media', 'HnartnaDenganController@storeMedia')->name('hnartna-dengans.storeMedia');
    Route::post('hnartna-dengans/ckmedia', 'HnartnaDenganController@storeCKEditorImages')->name('hnartna-dengans.storeCKEditorImages');
    Route::resource('hnartna-dengans', 'HnartnaDenganController');

    // Hnartna Reja Beshdarboyan
    Route::delete('hnartna-reja-beshdarboyans/destroy', 'HnartnaRejaBeshdarboyanController@massDestroy')->name('hnartna-reja-beshdarboyans.massDestroy');
    Route::post('hnartna-reja-beshdarboyans/media', 'HnartnaRejaBeshdarboyanController@storeMedia')->name('hnartna-reja-beshdarboyans.storeMedia');
    Route::post('hnartna-reja-beshdarboyans/ckmedia', 'HnartnaRejaBeshdarboyanController@storeCKEditorImages')->name('hnartna-reja-beshdarboyans.storeCKEditorImages');
    Route::resource('hnartna-reja-beshdarboyans', 'HnartnaRejaBeshdarboyanController');

    // Encamen Destpeke
    Route::delete('encamen-destpekes/destroy', 'EncamenDestpekeController@massDestroy')->name('encamen-destpekes.massDestroy');
    Route::resource('encamen-destpekes', 'EncamenDestpekeController');

    // Derencamen Destpeke
    Route::delete('derencamen-destpekes/destroy', 'DerencamenDestpekeController@massDestroy')->name('derencamen-destpekes.massDestroy');
    Route::resource('derencamen-destpekes', 'DerencamenDestpekeController');

    // Derencamen Destpeke Bngeh
    Route::delete('derencamen-destpeke-bngehs/destroy', 'DerencamenDestpekeBngehController@massDestroy')->name('derencamen-destpeke-bngehs.massDestroy');
    Route::resource('derencamen-destpeke-bngehs', 'DerencamenDestpekeBngehController');

    // Derencamen Destpekewistgeh
    Route::delete('derencamen-destpekewistgehs/destroy', 'DerencamenDestpekewistgehController@massDestroy')->name('derencamen-destpekewistgehs.massDestroy');
    Route::resource('derencamen-destpekewistgehs', 'DerencamenDestpekewistgehController');

    // Derencamen Rejabeshdarboyan
    Route::delete('derencamen-rejabeshdarboyans/destroy', 'DerencamenRejabeshdarboyanController@massDestroy')->name('derencamen-rejabeshdarboyans.massDestroy');
    Route::resource('derencamen-rejabeshdarboyans', 'DerencamenRejabeshdarboyanController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Type
    Route::delete('user-types/destroy', 'UserTypeController@massDestroy')->name('user-types.massDestroy');
    Route::resource('user-types', 'UserTypeController');

    // Time
    Route::delete('times/destroy', 'TimeController@massDestroy')->name('times.massDestroy');
    Route::resource('times', 'TimeController');

    //Export Derencamen Rejabeshdarboyan
    Route::post('derencamen-rejabeshdarboyans/export', 'DerencamenRejabeshdarboyanController@export')->name('export.rejabeshdarboyans');
    // Web Site View
    Route::delete('web-site-views/destroy', 'WebSiteViewController@massDestroy')->name('web-site-views.massDestroy');
    Route::resource('web-site-views', 'WebSiteViewController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
