<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	*/
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	*/
	public function boot() {
		$this->registerPolicies();
        
   
 

		/*  Users */
		Gate::define('manage_user_action', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_user' || 
					 $permissions[$i]->slug == 'view_user' || 
					 $permissions[$i]->slug == 'edit_user' || 
					 $permissions[$i]->slug == 'delete_user' 
				) {
					return true;
				}
			}
		});

		Gate::define('edit_user', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'edit_user') {
					return true;
				}
			}
		});

		Gate::define('add_user', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_user') {
					return true;
				}
			}
		});		
		
		Gate::define('view_user', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_user') {
					return true;
				}
			}
		});	
 
		Gate::define('delete_user', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'delete_user') {
					return true;
				}
			}
		});	

		/*  Admins */
		
		Gate::define('manage_admin_action', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_admin' || 
					 $permissions[$i]->slug == 'view_admin' || 
					 $permissions[$i]->slug == 'edit_admin' || 
					 $permissions[$i]->slug == 'delete_admin' 
				) {
					return true;
				}
			}
			
		});

		Gate::define('edit_admin', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'edit_admin') {
					return true;
				}
			}
		});

		Gate::define('add_admin', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			 
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_admin') {
					return true;
				}
			}
		});		
		
		Gate::define('view_admin', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_admin') {
					return true;
				}
			}
		});	

		Gate::define('delete_admin', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'delete_admin') {
					return true;
				}
			}
		});	

	
	
		/*  Voters */
		
		Gate::define('manage_voter_action', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_voter' || 
					 $permissions[$i]->slug == 'view_voter' || 
					 $permissions[$i]->slug == 'edit_voter' || 
					 $permissions[$i]->slug == 'delete_voter' 
				) {
					return true;
				}
			}
			
		});

		Gate::define('view_voter', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_voter') {
					
					return true;
				}
			}
		});	

		Gate::define('delete_voter', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'delete_voter') {
					return true;
				}
			}
		});	
		

		/* Champion   */
		Gate::define('view_champion', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_champion') {
					return true;
				}
			}
		});	
		


		/*  Contents */

		Gate::define('manage_content_action', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_mobile_content' || 
					 $permissions[$i]->slug == 'edit_mobile_content' 
				) {
					return true;
				}
			}
			
		});


		Gate::define('view_mobile_content', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_mobile_content') {
					return true;
				}
			}
		});	

		Gate::define('edit_mobile_content', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'edit_mobile_content') {
					return true;
				}
			}
		});	

	

		/*  Contact Us */

		Gate::define('manage_contact_us_action', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_contact_us' || 
					 $permissions[$i]->slug == 'reply_contact_us' 
				) {
					return true;
				}
			}
			
		});


		Gate::define('manage_contact_us_review_action', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_contact_us' || 
					 $permissions[$i]->slug == 'view_reviews' 
				) {
					return true;
				}
			}
			
		});

		Gate::define('view_contact_us', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			//dd($permissions);
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_contact_us') {
					return true;
				}
			}
		});	

		Gate::define('reply_contact_us', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'reply_contact_us') {
					return true;
				}
			}
		});	


		

			Gate::define('view_reviews', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_reviews') {
					return true;
				}
			}
		});	

		/*  Misc Data */

		Gate::define('manage_misc_data_action', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_misc' || 
					 $permissions[$i]->slug == 'add_misc' || 
					 $permissions[$i]->slug == 'edit_misc' || 
					 $permissions[$i]->slug == 'delete_misc' 
				) {
					return true;
				}
			}
			
		});
 
		// Gate::define('view_misc', function ($user) {
			
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) { 
		// 		if($permissions[$i]->slug == 'view_misc') {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('add_misc', function ($user) {
			
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) { 
		// 		if($permissions[$i]->slug == 'add_misc') {
		// 			return true;
		// 		}
		// 	}
		// });	


		// Gate::define('edit_misc', function ($user) {
			
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) { 
		// 		if($permissions[$i]->slug == 'edit_misc') {
		// 			return true;
		// 		}
		// 	}
		// });	


		// Gate::define('delete_misc', function ($user) {
			
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) { 
		// 		if($permissions[$i]->slug == 'delete_misc') {
		// 			return true;
		// 		}
		// 	}
		// });



    	/* Misc Data Management [ SUBSCRIPTION PLANS ] */


        Gate::define('manage_subscription_plans_action', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_subscription_plans' || 
					 $permissions[$i]->slug == 'edit_subscription_plans' || 
					 $permissions[$i]->slug == 'delete_subscription_plans' || 
					 $permissions[$i]->slug == 'add_subscription_plans' 
				) {
					return true;
				}
			}
			
		});

		Gate::define('edit_subscription_plans', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'edit_subscription_plans') {
					return true;
				}
			}
		});

		Gate::define('add_subscription_plans', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			 
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_subscription_plans') {
					return true;
				}
			}
		});		
		
		Gate::define('view_subscription_plans', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_subscription_plans') {
					return true;
				}
			}
		});	

		Gate::define('delete_subscription_plans', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'delete_subscription_plans') {
					return true;
				}
			}
		});	
         




    



		/*  Roles */

		Gate::define('manage_roles_action', function ($user) {
		//	return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_role' || 
					 $permissions[$i]->slug == 'add_role' || 
					 $permissions[$i]->slug == 'edit_role' || 
					 $permissions[$i]->slug == 'delete_role' 
				) {
					return true;
				}
			}
			
		});

		Gate::define('view_role', function ($user) {
		//	return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;

			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_role') {
					return true;
				}
			}
		});

		Gate::define('add_role', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'add_role') {
					return true;
				}
			}
		});	


		Gate::define('edit_role', function ($user) {
		//	return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'edit_role') {
					return true;
				}
			}
		});	


		Gate::define('delete_role', function ($user) {
		//	return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'delete_role') {
					return true;
				}
			}
		});	

		/*  Permissions */


		Gate::define('manage_permissions_action', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_permission' || 
					 $permissions[$i]->slug == 'edit_permission') {
					return true;
				}
			}
			
		});

		Gate::define('view_permission', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_permission') {
					return true;
				}
			}
		});	

		Gate::define('edit_permission', function ($user) {
			
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'edit_permission') {
					return true;
				}
			}
		});	


		/*Payment Transaction */
       
		Gate::define('view_payment_transaction', function ($user) {
			//return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_payment_transaction') {
					return true;
				}
			}
		});
		/*  Recycle Bin Action*/

		Gate::define('manage_recyclebin_action', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			//dd($permissions);
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_users' ||
					 $permissions[$i]->slug == 'view_deleted_admin' || 
					 $permissions[$i]->slug == 'view_deleted_marketing_user' || 
					 $permissions[$i]->slug == 'view_deleted_currency' || 
					 $permissions[$i]->slug == 'view_deleted_role' ||
					 $permissions[$i]->slug =='view_deleted_products') {
					return true;
				}
			}	
		});

		Gate::define('manage_recycle_bin_users', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_user' || 
					 $permissions[$i]->slug == 'restore_user'|| 
					 $permissions[$i]->slug == 'permanent_delete_user') {
					return true;
				}
			}	
		});



		
		Gate::define('view_deleted_users', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			 
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_users') {
					return true;
				}
			}
		});	

		Gate::define('restore_user', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'restore_user') {
					return true;
				}
			}
		});	

		Gate::define('permanent_delete_user', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'permanent_deleted_user') {
					return true;
				}
			}
		});









		Gate::define('manage_recycle_bin_roles', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_role' || 
					 $permissions[$i]->slug == 'restore_role' || 
					 $permissions[$i]->slug == 'permanent_delete_role') {
					return true;
				}
			}	
		});


		Gate::define('view_deleted_role', function ($user) {
		return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_role') {
					return true;
				}
			}
		});	

		Gate::define('restore_role', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			//dd($permissions);
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'restore_role') {
					return true;
				}
			}
		});	

		Gate::define('permanent_delete_role', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'permanent_deleted_role') {
					return true;
				}
			}
		});

		

		Gate::define('manage_recycle_bin_admins', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_admin' || 
					 $permissions[$i]->slug == 'restore_admin'|| 
					 $permissions[$i]->slug == 'permanent_deleted_admin') {
					return true;
				}
			}	
		});


		Gate::define('view_deleted_admin', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'view_deleted_admin') {
					return true;
				}
			}
		});	

		Gate::define('restore_admin', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'restore_admin') {
					return true;
				}
			}
		});	

		Gate::define('permanent_deleted_admin', function ($user) {
			return true;
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) { 
				if($permissions[$i]->slug == 'permanent_deleted_admin') {
					return true;
				}
			}
		});















	}
}
