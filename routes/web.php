<?php



Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

// Route::group(['middleware' => ['auth','check_admin']], function () {
 Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    // Registration Routes...
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');




    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    

    Route::post('/viewUnapprovedQuestion', 'Admin\QuestionController@singleUnapprovedQuestion')->name('viewUnapprovedQuestion');

    
    
    // application side menu links
    Route::get('/unapprovedQuestions', 'Admin\SidemenuController@unapprovedQuestions')->name('unapprovedQuestions');
    Route::get('/approvedQuestions', 'Admin\SidemenuController@approvedQuestions')->name('approvedQuestions');
    Route::get('/rejectedQuestions', 'Admin\SidemenuController@rejectedQuestions')->name('rejectedQuestions');

    Route::get('/emailAccounts', 'EmailAccountController@index')->name('emailAccounts');
    Route::get('/smsMessages', 'SmsmessageController@index')->name('smsMessages');
    Route::get('/emailTemplates', 'NotificationTemplateController@index')->name('emailTemplates');
    Route::get('/adminUsers', 'UserController@index')->name('adminUsers');
    Route::get('/send-notification', 'Admin\NotificationController@index')->name('send-notification');

    // Admin users CRUD
    Route::post('/admin-user-create', 'EmailAccountController@store')->name('adminUsers.store');
    Route::POST('/admin-user-update', 'EmailAccountController@update')->name('adminUsers.update');
    Route::delete('/admin-user-delete', 'EmailAccountController@destroy')->name('adminUsers.delete');

    // Email account CRUD
    Route::post('/email-account-create', 'EmailAccountController@store')->name('emailAccount.store');
    Route::POST('/email-account-update', 'EmailAccountController@update')->name('emailAccount.update');
    Route::delete('/email-account-delete', 'EmailAccountController@destroy')->name('emailAccount.delete');

    Route::get('fetchEmailAccount', 'EmailAccountController@fetchEmailAccount')->name('fetchEmailAccount');

    // Email template CRUD
    Route::post('/email-template-create', 'NotificationTemplateController@store')->name('emailTemplate.store');
    Route::POST('/email-template-update', 'NotificationTemplateController@update')->name('emailTemplate.update');
    Route::delete('/email-template-delete', 'NotificationTemplateController@destroy')->name('emailTemplate.delete');

    // SMS message CRUD
    Route::post('/sms-message-create', 'SmsmessageController@store')->name('SMSmessage.store');
    Route::POST('/sms-message-update', 'SmsmessageController@update')->name('SMSmessage.update');
    Route::delete('/sms-message-delete', 'SmsmessageController@destroy')->name('SMSmessage.delete');

    // SMS message language CRUD
    Route::post('/sms-message-language-create', 'LanguageController@store')->name('SMSmessageLanguage.store');
    Route::POST('/sms-message-language-update', 'LanguageController@update')->name('SMSmessageLanguage.update');
    Route::delete('/sms-message-language-delete', 'LanguageController@destroy')->name('SMSmessageLanguage.delete');



    






    

    Route::get('/categorytag', 'Admin\SidemenuController@categoryTag')->name('categorytag');
    Route::get('/blogs', 'Admin\SidemenuController@blogs')->name('blogs');

    Route::put('/approve_question','Admin\QuestionController@approveQuestion')->name('question.approve');
    Route::put('/decline_question','Admin\QuestionController@declineQuestion')->name('question.decline');
    
    // datatable routes
    Route::get('/api/unapprovedquestions','Admin\QuestionController@unapprovedQuestions')->name('api.unapprovedquestions');
    Route::get('/api/approvedQuestions','Admin\QuestionController@approvedQuestions')->name('api.approvedQuestions');
    Route::get('/api/rejectedQuestions','Admin\QuestionController@rejectedQuestions')->name('api.rejectedQuestions');

    
    Route::get('/api/blogs','Admin\BlogController@blogs')->name('api.blogs');
    
    // blog CRUD Routes
    Route::post('/blog', 'Admin\BlogController@store')->name('blog.store');
    Route::put('/blog/{id}','Admin\BlogController@update');
    Route::delete('/blog/{id}','Admin\BlogController@destroy');
    
    // Question store by admin
    Route::post('/question', 'Admin\QuestionController@store')->name('question.store');
    
    // forum category CRUD
    Route::post('/category','Admin\CategoryController@store')->name('forumcategory.store');
    Route::put('/category/{id}','Admin\CategoryController@update');
    Route::delete('/category/{id}','Admin\CategoryController@destroy');
    
    // blog category CRUD
    Route::post('/blogCategory','Admin\BlogcategoryController@store')->name('blogcategory.store');
    Route::put('/blogCategory/{id}','Admin\BlogcategoryController@update');
    Route::delete('/blogCategory/{id}','Admin\BlogcategoryController@destroy');
    
    // tag CRUD
    Route::post('/tag','Admin\TagController@store')->name('tag.store');
    Route::put('/tag','Admin\TagController@update')->name('tag.edit');
    Route::delete('/tag','Admin\TagController@destroy')->name('tag.delete');
    
    // Reporting words CRUD
    Route::post('/reportword','Admin\ReportwordController@store')->name('reportword.store');
    Route::put('/reportword/{id}','Admin\ReportwordController@update');
    Route::delete('/reportword/{id}','Admin\ReportwordController@destroy');
    
    
    

});


















// BELOW ARE ROUTES FROM DASHBOARD ITSELF
Route::group(['prefix' => 'basic-ui'], function(){
    Route::get('accordions', function () { return view('pages.basic-ui.accordions'); });
    Route::get('buttons', function () { return view('pages.basic-ui.buttons'); });
    Route::get('badges', function () { return view('pages.basic-ui.badges'); });
    Route::get('breadcrumbs', function () { return view('pages.basic-ui.breadcrumbs'); });
    Route::get('dropdowns', function () { return view('pages.basic-ui.dropdowns'); });
    Route::get('modals', function () { return view('pages.basic-ui.modals'); });
    Route::get('progress-bar', function () { return view('pages.basic-ui.progress-bar'); });
    Route::get('pagination', function () { return view('pages.basic-ui.pagination'); });
    Route::get('tabs', function () { return view('pages.basic-ui.tabs'); });
    Route::get('typography', function () { return view('pages.basic-ui.typography'); });
    Route::get('tooltips', function () { return view('pages.basic-ui.tooltips'); });
});

Route::group(['prefix' => 'advanced-ui'], function(){
    Route::get('dragula', function () { return view('pages.advanced-ui.dragula'); });
    Route::get('clipboard', function () { return view('pages.advanced-ui.clipboard'); });
    Route::get('context-menu', function () { return view('pages.advanced-ui.context-menu'); });
    Route::get('popups', function () { return view('pages.advanced-ui.popups'); });
    Route::get('sliders', function () { return view('pages.advanced-ui.sliders'); });
    Route::get('carousel', function () { return view('pages.advanced-ui.carousel'); });
    Route::get('loaders', function () { return view('pages.advanced-ui.loaders'); });
    Route::get('tree-view', function () { return view('pages.advanced-ui.tree-view'); });
});

Route::group(['prefix' => 'forms'], function(){
    Route::get('basic-elements', function () { return view('pages.forms.basic-elements'); });
    Route::get('advanced-elements', function () { return view('pages.forms.advanced-elements'); });
    Route::get('dropify', function () { return view('pages.forms.dropify'); });
    Route::get('form-validation', function () { return view('pages.forms.form-validation'); });
    Route::get('step-wizard', function () { return view('pages.forms.step-wizard'); });
    Route::get('wizard', function () { return view('pages.forms.wizard'); });
});

Route::group(['prefix' => 'editors'], function(){
    Route::get('text-editor', function () { return view('pages.editors.text-editor'); });
    Route::get('code-editor', function () { return view('pages.editors.code-editor'); });
});

Route::group(['prefix' => 'charts'], function(){
    Route::get('chartjs', function () { return view('pages.charts.chartjs'); });
    Route::get('morris', function () { return view('pages.charts.morris'); });
    Route::get('flot', function () { return view('pages.charts.flot'); });
    Route::get('google-charts', function () { return view('pages.charts.google-charts'); });
    Route::get('sparklinejs', function () { return view('pages.charts.sparklinejs'); });
    Route::get('c3-charts', function () { return view('pages.charts.c3-charts'); });
    Route::get('chartist', function () { return view('pages.charts.chartist'); });
    Route::get('justgage', function () { return view('pages.charts.justgage'); });
});

Route::group(['prefix' => 'tables'], function(){
    Route::get('basic-table', function () { return view('pages.tables.basic-table'); });
    Route::get('data-table', function () { return view('pages.tables.data-table'); });
    Route::get('js-grid', function () { return view('pages.tables.js-grid'); });
    Route::get('sortable-table', function () { return view('pages.tables.sortable-table'); });
});

Route::get('notifications', function () {
    return view('pages.notifications.index');
});

Route::group(['prefix' => 'icons'], function(){
    Route::get('material', function () { return view('pages.icons.material'); });
    Route::get('flag-icons', function () { return view('pages.icons.flag-icons'); });
    Route::get('font-awesome', function () { return view('pages.icons.font-awesome'); });
    Route::get('simple-line-icons', function () { return view('pages.icons.simple-line-icons'); });
    Route::get('themify', function () { return view('pages.icons.themify'); });
});

Route::group(['prefix' => 'maps'], function(){
    Route::get('vector-map', function () { return view('pages.maps.vector-map'); });
    Route::get('mapael', function () { return view('pages.maps.mapael'); });
    Route::get('google-maps', function () { return view('pages.maps.google-maps'); });
});

Route::group(['prefix' => 'user-pages'], function(){
    Route::get('login', function () { return view('pages.user-pages.login'); });
    Route::get('login-2', function () { return view('pages.user-pages.login-2'); });
    Route::get('multi-step-login', function () { return view('pages.user-pages.multi-step-login'); });
    Route::get('register', function () { return view('pages.user-pages.register'); });
    Route::get('register-2', function () { return view('pages.user-pages.register-2'); });
    Route::get('lock-screen', function () { return view('pages.user-pages.lock-screen'); });
});

Route::group(['prefix' => 'error-pages'], function(){
    Route::get('error-404', function () { return view('pages.error-pages.error-404'); });
    Route::get('error-500', function () { return view('pages.error-pages.error-500'); });
});

Route::group(['prefix' => 'general-pages'], function(){
    Route::get('blank-page', function () { return view('pages.general-pages.blank-page'); });
    Route::get('landing-page', function () { return view('pages.general-pages.landing-page'); });
    Route::get('profile', function () { return view('pages.general-pages.profile'); });
    Route::get('email-templates', function () { return view('pages.general-pages.email-templates'); });
    Route::get('faq', function () { return view('pages.general-pages.faq'); });
    Route::get('faq-2', function () { return view('pages.general-pages.faq-2'); });
    Route::get('news-grid', function () { return view('pages.general-pages.news-grid'); });
    Route::get('timeline', function () { return view('pages.general-pages.timeline'); });
    Route::get('search-results', function () { return view('pages.general-pages.search-results'); });
    Route::get('portfolio', function () { return view('pages.general-pages.portfolio'); });
    Route::get('user-listing', function () { return view('pages.general-pages.user-listing'); });
});

Route::group(['prefix' => 'ecommerce'], function(){
    Route::get('invoice', function () { return view('pages.ecommerce.invoice'); });
    Route::get('invoice-2', function () { return view('pages.ecommerce.invoice-2'); });
    Route::get('pricing', function () { return view('pages.ecommerce.pricing'); });
    Route::get('product-catalogue', function () { return view('pages.ecommerce.product-catalogue'); });
    Route::get('project-list', function () { return view('pages.ecommerce.project-list'); });
    Route::get('orders', function () { return view('pages.ecommerce.orders'); });
});

// For Clear cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error-pages.error-404');
})->where('page','.*');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
