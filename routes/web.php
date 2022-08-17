<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Common\SettingsController;
use App\Http\Controllers\Common\BlogController;
use App\Http\Controllers\Common\PodcastController;
use App\Http\Controllers\Common\CategoryController;
use App\Http\Controllers\Common\PagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SendNotification;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AmenitiesController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\ComponenetController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Common\EventController;
use App\Http\Controllers\Common\VendorController;
use App\Http\Controllers\Admin\VendorAdminController;
use App\Http\Controllers\Common\WishlistsController;
use App\Http\Controllers\Common\NewsletterController;
use App\Http\Controllers\Common\ContactController;
use App\Http\Controllers\Front\SubscriptionController;

use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\LoadController;

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


// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Email Verification
Route::get('/verification', [AuthController::class, 'verificationNotice'])->name('verification.notice')->middleware(['auth', 'shouldVerifyEmail']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/admin')->with(['msg' => 'Thanks for registration', 'msg_type' => 'success']);
})->middleware(['auth', 'signed', 'shouldVerifyEmail'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'A fresh verification link has been sent to your email address.');
})->middleware(['auth', 'throttle:6,1', 'shouldVerifyEmail'])->name('verification.send');

// Forogot Password
Route::get('/forgot-password', [AuthController::class, 'forgetPassword'])->middleware(['guest', 'shouldPasswordReset'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgetPasswordEmail'])->middleware(['guest', 'shouldPasswordReset'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPaassword'])->middleware(['guest', 'shouldPasswordReset'])->name('password.reset');
Route::post('/reset-password',[AuthController::class, 'paasswordUpdate'])->middleware(['guest', 'shouldPasswordReset'])->name('password.update');

// Registration
    Route::get('/register', [AuthController::class, 'signup'])->name('register')->middleware('guest');
    Route::get('/register/vendor', [AuthController::class, 'vendorsignup'])->name('vendor.register')->middleware('guest');
    Route::post('/user/register',[AuthController::class, 'register'])->name('register.user')->middleware('guest');

// File manager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Vendor category BA
    Route::get('/vendor/categories/filter', [VendorAdminController::class, 'VendorCategoryFilter'])->name('admin.categories.filter');

// Admin
Route::middleware(['auth', 'verified', 'CanAccessDashboard'])->prefix('admin')->group( function () {
    // Dashboard
    Route::get('/', [AuthController::class, 'dashboard'])->name('admin');

    // Settings
    Route::get('/settings/{type}', [SettingsController::class, 'index'])->name('settings')->middleware('role:accessSettings');
    Route::post('/settings/save', [SettingsController::class, 'save'])->name('settings.save')->middleware('role:accessSettings');
    // Components
    Route::get('/components/{type}', [ComponenetController::class, 'index'])->name('components')->middleware('role:editPageComponents');
    Route::post('/components/save', [ComponenetController::class, 'save'])->name('components.save')->middleware('role:editPageComponents');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('role:viewUsers');
    Route::get('/users/get', [UserController::class, 'getUsers'])->name('users.get')->middleware('role:viewUsers');
    Route::get('/users/add', [UserController::class, 'addUsers'])->name('users.add')->middleware('role:addUsers');
    Route::post('/users/store', [UserController::class, 'storeUser'])->name('users.store')->middleware('role:addUsers');
    Route::get('/users/{user:id}/edit', [UserController::class, 'editUsers'])->name('users.edit')->middleware('role:updateUsers,editItself');
    Route::post('/users/update', [UserController::class, 'updateUsers'])->name('users.update')->middleware('role:updateUsers,editItself');
    Route::get('/users/{id}/delete', [UserController::class, 'deleteuser'])->name('users.delete')->middleware('role:deleteUsers');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('role:viewRoles');
    Route::get('/roles/get', [RoleController::class, 'getRoles'])->name('roles.get')->middleware('role:viewRoles');
    Route::get('/roles/add', [RoleController::class, 'create'])->name('roles.add')->middleware('role:addRoles');
    Route::post('/roles/add', [RoleController::class, 'store'])->name('roles.store')->middleware('role:addRoles');
    Route::get('/roles/{id}/edit/', [RoleController::class, 'edit'])->name('roles.edit')->middleware('role:updateRoles');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('role:updateRoles');
    Route::get('/roles/{id}/delete', [RoleController::class, 'destroy'])->name('roles.delete')->middleware('role:deleteRoles');

    // Pages
    Route::get('/pages', [PagesController::class, 'index'])->name('pages')->middleware('role:viewPages');
    Route::get('/pages/get', [PagesController::class, 'getPages'])->name('pages.get')->middleware('role:viewPages');
    Route::get('/pages/add', [PagesController::class, 'create'])->name('pages.add')->middleware('role:addPages');
    Route::post('/pages/add', [PagesController::class, 'store'])->name('pages.store')->middleware('role:addPages');
    Route::get('/pages/{pages:id}/edit/', [PagesController::class, 'edit'])->name('pages.edit')->middleware('role:updatePages');
    Route::post('/pages/{pages:id}/update/', [PagesController::class, 'update'])->name('pages.update')->middleware('role:updatePages');
    Route::get('/pages/{pages:id}/delete', [PagesController::class, 'destroy'])->name('pages.delete')->middleware('role:deletePages');

    // Menus
    Route::get('/menus/{type}', [MenuController::class, 'index'])->name('menus')->middleware('role:viewMenus');
    Route::post('/menus/add', [MenuController::class, 'store'])->name('menus.store')->middleware('role:addMenus');

    // Blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs')->middleware('role:viewBlogs');
    Route::get('/blogs/get', [BlogController::class, 'getBlogs'])->name('blogs.get')->middleware('role:viewBlogs');
    Route::get('/blogs/add', [BlogController::class, 'create'])->name('blogs.add')->middleware('role:addBlogs');
    Route::post('/blogs/add', [BlogController::class, 'store'])->name('blogs.store')->middleware('role:addBlogs');
    Route::get('/blogs/{blog:id}/edit/', [BlogController::class, 'edit'])->name('blogs.edit')->middleware('role:updateBlogs');
    Route::post('/blogs/{blog:id}/update/', [BlogController::class, 'update'])->name('blogs.update')->middleware('role:updateBlogs');
    Route::get('/blogs/{blog:id}/delete', [BlogController::class, 'destroy'])->name('blogs.delete')->middleware('role:deleteBlogs');

    // Podcast
    Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts');
    Route::get('/podcasts/get', [PodcastController::class, 'getPodcasts'])->name('podcasts.get');
    Route::get('/podcasts/add', [PodcastController::class, 'create'])->name('podcasts.add');
    Route::post('/podcasts/add', [PodcastController::class, 'store'])->name('podcasts.store');
    Route::get('/podcasts/{podcast:id}/edit/', [PodcastController::class, 'edit'])->name('podcasts.edit');
    Route::post('/podcasts/{podcast:id}/update/', [PodcastController::class, 'update'])->name('podcasts.update');
    Route::get('/podcasts/{podcast:id}/delete', [PodcastController::class, 'destroy'])->name('podcasts.delete');

    // Categories podcast
    Route::get('/podcasts/categories', [CategoryController::class, 'index'])->name('podcast.categories');
    Route::get('/podcasts/categories/get', [CategoryController::class, 'getPodcastCategory'])->name('podcast.categories.get');
    Route::post('/podcasts/categories/add', [CategoryController::class, 'store'])->name('podcast.categories.store');
    Route::get('/podcasts/categories/{category:id}/edit/', [CategoryController::class, 'edit'])->name('podcast.categories.edit');
    Route::post('/podcasts/categories/{category:id}/update/', [CategoryController::class, 'update'])->name('podcast.categories.update');
    Route::get('/podcasts/categories/{category:id}/delete', [CategoryController::class, 'destroy'])->name('podcast.categories.delete');
    Route::get('/podcasts/categories/{category:id}/delete', [CategoryController::class, 'destroy'])->name('podcast.categories.delete');


    // Categories
    Route::get('/blogs/categories', [CategoryController::class, 'blogIndex'])->name('categories')->middleware('role:viewCategories');
    Route::get('/blogs/categories/get', [CategoryController::class, 'getCategory'])->name('categories.get')->middleware('role:viewCategories');

    Route::post('/blogs/categories/add', [CategoryController::class, 'blogStore'])->name('categories.store')->middleware('role:addCategories');

    Route::get('/blogs/categories/{category:id}/edit/', [CategoryController::class, 'blogEdit'])->name('categories.edit')->middleware('role:updateCategories');

    Route::post('/blogs/categories/{category:id}/update/', [CategoryController::class, 'blogsUpdate'])->name('categories.update')->middleware('role:updateCategories');

    Route::get('/blogs/categories/{category:id}/delete', [CategoryController::class, 'blogsDestroy'])->name('categories.delete')->middleware('role:deleteCategories');

    Route::get('/blogs/categories/{category:id}/delete', [CategoryController::class, 'blogsDestroy'])->name('categories.delete')->middleware('role:deleteCategories');


    //Notification
    Route::get('/notification/', [SendNotification::class, 'index'])->name('notification')->middleware('role:allowNotifications');
    Route::post('/notification/send', [SendNotification::class, 'send'])->name('notification.send')->middleware('role:allowNotifications');

    // Areas
    Route::get('/areas', [AreaController::class, 'index'])->name('areas')->middleware('role:viewAreas');
    Route::get('/areas/get', [AreaController::class, 'getAreas'])->name('areas.get')->middleware('role:viewAreas');
    Route::get('/areas/add', [AreaController::class, 'create'])->name('areas.add')->middleware('role:addAreas');
    Route::post('/areas/add', [AreaController::class, 'store'])->name('areas.store')->middleware('role:addAreas');
    Route::get('/areas/{area:id}/edit/', [AreaController::class, 'edit'])->name('areas.edit')->middleware('role:updateAreas');
    Route::post('/areas/{area:id}/update/', [AreaController::class, 'update'])->name('areas.update')->middleware('role:updateAreas');
    Route::get('/areas/{area:id}/delete', [AreaController::class, 'destroy'])->name('areas.delete')->middleware('role:deleteAreas');

    // Newsletter
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter');
    Route::get('/newsletter/get', [NewsletterController::class, 'getNewsletter'])->name('newsletter.get');
    Route::get('/newsletter/{newsletter:id}/delete', [NewsletterController::class, 'destroy'])->name('newsletter.delete');



    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact');
    Route::get('/contact/get', [ContactController::class, 'getContact'])->name('contact.get');
    Route::get('/contact/{contact:id}/delete', [ContactController::class, 'destroy'])->name('contact.delete');

    //admin order
    Route::get('payment', [UserController::class, 'getPayment'])->name('admin.payment');
    Route::get('paymentList', [UserController::class, 'getPaymentList'])->name('admin.paymentList');
    Route::get('payment/{order:id}', [UserController::class, 'paymentView'])->name('admin.payemnt.view');

    // Amenities
    Route::get('/amenities', [AmenitiesController::class, 'index'])->name('amenities')->middleware('role:viewAmenities');
    Route::get('/amenities/get', [AmenitiesController::class, 'getAmenities'])->name('amenities.get')->middleware('role:viewAmenities');
    Route::get('/amenities/add', [AmenitiesController::class, 'create'])->name('amenities.add')->middleware('role:addAmenities');
    Route::post('/amenities/add', [AmenitiesController::class, 'store'])->name('amenities.store')->middleware('role:addAmenities');
    Route::get('/amenities/{amenity:id}/edit/', [AmenitiesController::class, 'edit'])->name('amenities.edit')->middleware('role:updateAmenities');
    Route::post('/amenities/{amenity:id}/update/', [AmenitiesController::class, 'update'])->name('amenities.update')->middleware('role:updateAmenities');
    Route::get('/amenities/{amenity:id}/delete', [AmenitiesController::class, 'destroy'])->name('amenities.delete')->middleware('role:deleteAmenities');

    // Packages
    Route::get('/packages', [PackagesController::class, 'index'])->name('packages')->middleware('role:viewPackages');
    Route::get('/packages/get', [PackagesController::class, 'getPackages'])->name('packages.get')->middleware('role:viewPackages');
    Route::get('/packages/add', [PackagesController::class, 'create'])->name('packages.add')->middleware('role:addPackages');
    Route::post('/packages/add', [PackagesController::class, 'store'])->name('packages.store')->middleware('role:addPackages');
    Route::get('/packages/{package:id}/edit/', [PackagesController::class, 'edit'])->name('packages.edit')->middleware('role:updatePackages');
    Route::post('/packages/{package:id}/update/', [PackagesController::class, 'update'])->name('packages.update')->middleware('role:updatePackages');
    Route::get('/packages/{package:id}/delete', [PackagesController::class, 'destroy'])->name('packages.delete')->middleware('role:deletePackages');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('events')->middleware('role:viewEvents');
    Route::get('/events/get', [EventController::class, 'getEvents'])->name('events.get')->middleware('role:viewEvents');
    Route::get('/events/add', [EventController::class, 'create'])->name('events.add')->middleware('role:addEvents');
    Route::post('/events/add', [EventController::class, 'store'])->name('events.store')->middleware('role:addEvents');
    Route::get('/events/{event:id}/edit/', [EventController::class, 'edit'])->name('events.edit')->middleware('role:updateEvents');
    Route::post('/events/{event:id}/update/', [EventController::class, 'update'])->name('events.update')->middleware('role:updateEvents');
    Route::get('/events/{event:id}/delete', [EventController::class, 'destroy'])->name('events.delete')->middleware('role:deleteEvents');
    // Type Event
    Route::get('/events/type-event', [EventController::class, 'typeeventindex'])->name('event.type')->middleware('role:viewEvents');
    Route::get('/events/type-event/get', [EventController::class, 'geteventtype'])->name('event.type.get')->middleware('role:viewEvents');
    Route::post('/events/type-event/add', [EventController::class, 'storeeventtype'])->name('event.type.store')->middleware('role:addAreas');
    Route::get('/events/{eventtype:id}/eventedit', [EventController::class, 'editeventtype'])->name('event.type.edit');
    Route::get('/events/{eventtype:id}/eventdelete', [EventController::class, 'destroyeeventtype'])->name('event.type.delete');
    Route::post('/events/eventtypeupdate', [EventController::class, 'updateeventtype'])->name('event.type.update');

    // Sponsors
    Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors')->middleware('role:viewSponsors');
    Route::get('/getsponsors/get', [SponsorController::class, 'getsponsors'])->name('sponsors.get')->middleware('role:viewSponsors');
    Route::get('/sponsors/add', [SponsorController::class, 'create'])->name('sponsors.add')->middleware('role:addSponsors');
    Route::post('/sponsors/add', [SponsorController::class, 'store'])->name('sponsors.store')->middleware('role:addSponsors');
    Route::get('/sponsors/{sponsor:id}/edit/', [SponsorController::class, 'edit'])->name('sponsors.edit')->middleware('role:updateSponsors');
    Route::post('/sponsors/{sponsor:id}/update/', [SponsorController::class, 'update'])->name('sponsors.update')->middleware('role:updateSponsors');
    Route::get('/sponsors/{sponsor:id}/delete', [SponsorController::class, 'destroy'])->name('sponsors.delete')->middleware('role:deleteSponsors');

    //admin comment

    Route::post('user/review/delete', [UserController::class, 'deleteComment'])->name('comment.delete');
    Route::post('user/review/submit', [UserController::class, 'submitComment'])->name('comment.submit');

    // Admin Vendor BA
    Route::get('/vendor', [VendorAdminController::class, 'index'])->name('admin.vendor');
    Route::get('/vendor/get', [VendorAdminController::class, 'getUsers'])->name('admin.vendor.get');
    Route::post('/vendor/delete',[VendorAdminController::class, 'deleteuser'])->name('admin.vendor.delete');
    Route::get('/vendor/add',[VendorAdminController::class, 'addUsers'])->name('admin.vendor.add');
    Route::post('/vendor/store',[VendorAdminController::class, 'storeUser'])->name('admin.vendor.store');
    Route::get('/vendor/delete/{adminDelete:id}',[VendorAdminController::class, 'deleteVendor'])->name('admin.vendor.delete.id');
    Route::get('/vendor/edit/{adminEdit:id}',[VendorAdminController::class, 'editUsers'])->name('admin.vendor.edit.id');
    Route::post('/vendor/update/{id}',[VendorAdminController::class, 'updateUser'])->name('admin.vendor.update.id');

    // Vendor category BA
    Route::get('/vendor/categories', [VendorAdminController::class, 'Vendorindex'])->name('admin.vendor.categories');
    Route::get('/vendor/categories/get', [VendorAdminController::class, 'GetVendorCategory'])->name('admin.vendor.category.get');
    Route::get('/vendor/category/add',[VendorAdminController::class, 'AddVendorCategory'])->name('admin.vendor.category.add');
    Route::get('/vendor/category/delete/{categoryDelete:id}',[VendorAdminController::class, 'deleteVendorCategory'])->name('admin.vendor.category.delete.id');
    Route::post('/vendor/category/store',[VendorAdminController::class, 'storeCategoryUser'])->name('admin.vendor.category.store');
    Route::get('/vendor/category/edit/{categoryEdit:id}',[VendorAdminController::class, 'editCategoryUsers'])->name('admin.vendor.category.edit.id');
    Route::post('/vendor/category/update/{categoryEdit:id}',[VendorAdminController::class, 'updateCategoryUsers'])->name('admin.vendor.category.update.id');

    // Admin Category Vendor
    // Route::get('/vendor', [VendorAdminController::class, 'index'])->name('admin.vendor');
    // Route::get('/vendor/get', [VendorAdminController::class, 'getUsers'])->name('admin.vendor.get');
    // Route::post('/vendor/delete',[VendorAdminController::class, 'deleteuser'])->name('admin.vendor.delete');
    // Route::get('/vendor/add',[VendorAdminController::class, 'addUsers'])->name('admin.vendor.add');
    // Route::post('/vendor/store',[VendorAdminController::class, 'storeUser'])->name('admin.vendor.store');
    // Route::get('/vendor/delete/{adminDelete:id}',[VendorAdminController::class, 'deleteVendor'])->name('admin.vendor.delete.id');
    // Route::get('/vendor/edit/{adminEdit:id}',[VendorAdminController::class, 'editUsers'])->name('admin.vendor.edit.id');
    // Route::post('/vendor/update/{id}',[VendorAdminController::class, 'updateUser'])->name('admin.vendor.update.id');
});



Route::post('/review/submit', [VendorController::class, 'submitReviwes'])->middleware('auth', 'verified')->name('review.submit');
Route::post('/review/event/submit', [EventController::class, 'submitReviwes'])->middleware('auth', 'verified')->name('review.submit.events');

Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');

// Front Events
Route::get('/events/create', [EventController::class, 'frontcreate'])->name('events.create')->middleware('auth', 'verified');
Route::post('/events/add', [EventController::class, 'frontstore'])->name('front.events.store')->middleware('auth', 'verified');
Route::get('/events/clone/{event:id}', [EventController::class, 'clone'])->name('events.clone')->middleware('auth', 'verified');
Route::get('/events/edit/', [EventController::class, 'frontedit'])->name('edit.event')->middleware('role:updateEvents');
Route::get('/events/my-event/', [EventController::class, 'myevents'])->name('my.event')->middleware('role:updateEvents');
Route::get('/events/{event:id}/edit/', [EventController::class, 'updateevent'])->name('front.events.update')->middleware('role:updateEvents');
Route::post('/events/frontupdate/{event:id}',[EventController::class,'frontupdate'])->name('front.events.frontupdate')->middleware('role:updateEvents');
Route::get('/events/delete/{event:id}', [EventController::class, 'frontdestroy'])->name('front.events.delete')->middleware('role:deleteEvents');
Route::get('/events-draft/delete/{event:id}', [EventController::class, 'frontDraftDestroy'])->name('front.events-draft.delete')->middleware('role:deleteEvents');

Route::post('/events/ticket/add', [EventController::class, 'ticketStore'])->name('front.events.ticket.store');
Route::post('/events/ticket/update', [EventController::class, 'ticketUpdate'])->name('front.events.ticket.update');
Route::get('/events/ticket/get', [EventController::class, 'getTicketData'])->name('front.events.ticket.get');

Route::get('/events/publish/{event:id}', [EventController::class, 'publishDraft'])->name('front.events.publist');
Route::view('contact', 'tempview.contact')->name('contact');
Route::view('account', 'tempview.account')->middleware('auth', 'isOrganizer', 'verified')->name('organizer.account');

// Vendors
Route::get('/account/public-profile', [VendorController::class, 'view'])->middleware('auth', 'verified')->name('public.profile');
Route::post('/account/public-profile/store', [VendorController::class, 'update'])->middleware('auth', 'verified')->name('public.profile.update');



Route::get('/account/payment-option',[UserController::class, 'paymentOption'])->name('payment.option')->middleware('auth','verified');
Route::post('/account/payment-update',[UserController::class, 'UpdatepaymentOption'])->name('payment.update')->middleware('auth','verified');
Route::get('/account/payment-list',[UserController::class, 'paymentList'])->name('payment.list')->middleware('auth','verified');

//
Route::get('/account', [AccountController::class, 'redirect'])->name('redirect.account.edit')->middleware('auth', 'verified');
Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit')->middleware('auth', 'verified');
Route::post('/account/update', [AccountController::class, 'update'])->name('account.update')->middleware('auth', 'verified');

Route::post('/searchEvent',[EventController::class, 'search'])->name('search.event');

Route::post('/addWishlist',[WishlistsController::class, 'store'])->name('add.wishlist');
Route::post('/removeWishlist',[WishlistsController::class, 'remove'])->name('remove.wishlist')->middleware('auth','verified')->middleware('auth', 'verified');
Route::get('/account/wishlist',[WishlistsController::class, 'view'])->name('wishlist')->middleware('auth', 'verified');
Route::get('/eventReminder',[WishlistsController::class, 'reminder'])->name('reminder.wishlist');
Route::get('/redirectEvent',[WishlistsController::class, 'redirect'])->name('redirect.wishlist');

Route::get('/account/upcoming-event',[EventController::class, 'upcomingEvent'])->name('upcomming.account')->middleware('auth','verified');
Route::get('/account/draft-events',[EventController::class, 'draftEvent'])->name('draft.account')->middleware('auth','verified');
Route::get('/account/past-events',[EventController::class, 'pastEvent'])->name('past.account')->middleware('auth','verified');

Route::get('/podcast/{id}', [PodcastController::class, 'show'])->name('podcast.show');

// Contact Form
Route::get('/contact', [ContactController::class, 'contactForm'])->name('contact-form');
Route::post('/contact-form', [ContactController::class, 'sendEmail'])->name('contact-form.store');

Route::group(['front'],  function () {
    Route::post('/notification/store', [SendNotification::class, 'store'])->name('notification.store')->middleware('auth');
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('/eventsloadmore', [EventController::class, 'loadmore'])->name('events.loadmore');
    Route::get('/{pages:slug}', [PagesController::class, 'show'])->name('pages.show');
    Route::get('/{pages:slug}/{id}', [LoadController::class, 'index'])->name('posts.show');
    Route::post('/subscription/create/', [SubscriptionController::class, 'create'])->name('subscription.create');
});



