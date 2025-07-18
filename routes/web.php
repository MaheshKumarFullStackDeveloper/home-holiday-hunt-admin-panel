<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarkettingUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\ChampionController;
 
 
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\MessagesController; 

use App\Http\Controllers\PaymentTransactionController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\DeliveryAgentController;
use App\Http\Controllers\NotificationsController;
 
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController; 
use App\Http\Controllers\InterestController;  
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EthnicityController;                     
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\SMSController;

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
  // php artisan view:clear
  \Artisan::call('view:clear');
  return redirect()->route('login');
  // return view('welcome');
})->name('admin_home');


Route::post('/storeimgae', [UserController::class, 'storeImage'])->name('save_images');
Route::post('/updateimgae', [UserController::class, 'updateImage'])->name('update_images');

Route::middleware(['auth:admin'])->group(function () {
 



  
  // Admin Panel
  Route::group(['prefix' => 'admin_panel'], function () {

        //Contestent Management
    Route::get('/year/{searchqueryyear?}', [UserController::class, 'setYear'])->name('set_year');

    Route::get('/superadmin/change-password', [AdminsController::class, 'changepassword'])->name('superadmin.changepassword');
    Route::post('/superadmin/update-password', [AdminsController::class, 'updatePassword'])->name('superadmin.updatePassword');



    Route::group(['prefix' => 'users'], function () {
    
    Route::get('/list/{searchquery?}/{searchqueryyear?}', [UserController::class, 'usersList'])->name('user_list');
    Route::get('/view/{id}', [UserController::class, 'viewUser'])->name('view_user');
    Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('edit_user');
    Route::post('/update', [UserController::class, 'updateUser'])->name('update_user');
    Route::post('/send_custom_sms', [UserController::class, 'sendCustomSms'])->name('custom_sms');
    Route::get('/add', [UserController::class, 'addUser'])->name('add_user');
    Route::post('/save', [UserController::class, 'saveUser'])->name('save_user');
    Route::post('/check_email', [UserController::class, 'checkUserEmail'])->name('check_user_email');
    Route::post('/delete', [UserController::class, 'deleteUser'])->name('delete_user_u');
    Route::post('/ban', [UserController::class, 'banUser'])->name('ban_user');
    Route::get('/deleted', [UserController::class, 'deletedUsersList'])->name('deleted_users_list');
    Route::post('/restore_user', [UserController::class, 'restoreUser'])->name('restore_user_u');
    Route::post('/permanent_delete', [UserController::class, 'permanentDeleteUser'])->name('permanent_delete_user_u');
    Route::post('/delete-profile-image', [UserController::class, 'deleteProfileImage'])->name('users.delete.profileImage'); 
    Route::post('interest_category_type', [UserController::class, 'InterestCategoryType'])->name('interest_category_type');
    Route::post('/user_status', [UserController::class, 'changeUserStatus'])->name('change.user.status'); 
    Route::post('/cancel_subscription', [UserController::class, 'cancelSubscription'])->name('cancel_Subscription'); 
    });

    Route::group(['prefix' => 'champion'], function () {
      Route::get('/list/{search?}', [ChampionController::class, 'championList'])->name('champion.list');
      Route::get('/view/{id}', [ChampionController::class, 'viewUser'])->name('view_chamions_review');
     
    });
    Route::group(['prefix' => 'sms'], function () {
      Route::get('/list', [SMSController::class, 'SMSList'])->name('SMS.list');
      Route::post('/sendsms', [SMSController::class, 'SendSmsAll'])->name('sendsms.list');
    
    });
    Route::group(['prefix' => 'report'], function () {
      Route::get('/list/{search?}', [ChampionController::class, 'reportList'])->name('report.list');
      Route::get('/issuereport', [ChampionController::class, 'issueReport'])->name('issue.report');
      Route::post('/changeissuereport', [ChampionController::class, 'changeIssueReport'])->name('change.issue.status');
      Route::post('/deletereport', [ChampionController::class, 'deleteReport'])->name('delete_reports');
      Route::post('/deleteissuereport', [ChampionController::class, 'deleteIssueReport'])->name('delete_issue_reports');
      Route::get('/issuedetail/{id}', [ChampionController::class, 'issueDetail'])->name('issue.detail');
      
    });

      //voters
    Route::group(['prefix' => 'voter'], function () { 
      Route::post('/restore_user', [VoterController::class, 'restoreUser'])->name('restore_userv');
      Route::post('/permanent_delete', [VoterController::class, 'permanentDeleteUser'])->name('permanent_delete_userv');
      Route::get('/deleted', [VoterController::class, 'deletedUsersList'])->name('deleted_users_listv');
      Route::post('/delete', [VoterController::class, 'deleteUser'])->name('delete_userv');
      Route::get('/view/{id}', [VoterController::class, 'viewUser'])->name('view_userv');
      Route::get('/list/{search?}', [VoterController::class, 'usersList'])->name('user_list_voter');
      });
     

       
       //Admins Management

       Route::group(['prefix' => 'admins'],function(){
          Route::get('/list', [AdminsController::class, 'adminsList'])->name('admins_list');
          Route::get('/view/{id}', [AdminsController::class, 'viewAdmin'])->name('view_admin');
          Route::get('/edit/{id}', [AdminsController::class, 'editAdmin'])->name('edit_admin');
          Route::post('/update', [AdminsController::class, 'updateAdmin'])->name('update_admin');
          Route::post('/delete', [AdminsController::class, 'deleteAdmin'])->name('delete_admin');
          Route::get('/add', [AdminsController::class, 'addAdmin'])->name('add_admin');
          Route::post('/save', [AdminsController::class, 'saveAdmin'])->name('save_admin');
          Route::get('/check_email', [AdminsController::class, 'checkAdminEmail'])->name('check_admin_email');
          Route::get('/deleted', [AdminsController::class, 'deletedAdminsList'])->name('deleted_admins_list');
          Route::post('/restore_admin', [AdminsController::class, 'restoreAdmin'])->name('restore_admin');
          Route::post('/permanent_delete', [AdminsController::class, 'permanentDeleteAdmin'])->name('permanent_delete_admin'); 
        });

      


    













      Route::group(['prefix' => 'content'], function () {
      Route::group(['prefix' => 'website'], function () {
            Route::get('/list', [ContentController::class, 'mobilePagesList'])->name('content.mobilePage.list');
            Route::get('/view/{id}', [ContentController::class, 'viewMobilePage'])->name('content.mobilePage.view');
            Route::get('/edit/{id}', [ContentController::class, 'editMobilePage'])->name('content.mobilePage.edit');
            Route::post('/update', [ContentController::class, 'updateMobilePage'])->name('content.mobilePage.update');
          });
        });

  





     //Roles
    Route::group(['prefix' => 'role'], function () {
      Route::get('/list', [RolesController::class, 'list'])->name('role.list');
      Route::get('/add', [RolesController::class, 'add'])->name('role.add');
      Route::post('/save', [RolesController::class, 'save'])->name('role.save');
      Route::get('/edit/{id}', [RolesController::class, 'edit'])->name('role.edit');
      Route::post('/update', [RolesController::class, 'update'])->name('role.update');
      Route::post('/role-permissions', [RolesController::class, 'getRolePermissions'])->name('role.permissions');
      Route::get('/permissions', [RolesController::class, 'permissions'])->name('permissions');
      Route::post('/save-permissions', [RolesController::class, 'savePermissions'])->name('role.savePermissions');
      Route::post('/delete', [RolesController::class, 'deleteRole'])->name('role.delete');
      Route::get('/deleted', [RolesController::class, 'deletedRoles'])->name('deletedRole.list');
      Route::post('/permanent-delete', [RolesController::class, 'permanentDeleteRole'])->name('role.permanentDelete');
      Route::post('/restore', [RolesController::class, 'restoreRole'])->name('restore_role');
    });


             //Payment Transaction
             Route::group(['prefix' => 'payment_transactions'], function () {
              Route::get('/list', [PaymentTransactionController::class, 'transactionList'])->name('payment_transactions.list');
        
               Route::get('/view/{id}', [PaymentTransactionController::class, 'viewTransaction'])->name('payment_transactions.view');
        
               Route::post('/payment_filter', [PaymentTransactionController::class, 'filterTransaction'])->name('filter_transactions');
        
               Route::post('/reset', [PaymentTransactionController::class, 'reset'])->name('payment_transactions_reset');
            });

  

     



    
    // Common
     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
     Route::post('/champ_sms', [AdminController::class, 'champSms'])->name('champ_sms');
     

  });

});

Auth::routes([
  //'register' => false,
  'reset' => false,
  'verify' => false,
]);


 
