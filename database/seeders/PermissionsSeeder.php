<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('permission_role')->truncate();

		\DB::table('permissions')->truncate();

		
		\DB::table('permissions')->insert([
			
			//Users Manegement
			[
				'name' => 'View',
				'slug' => 'view_user',
				'module_name' => 'View',
				'module_slug' => 'manage_user',
				'description' => 'Users',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_user',
				'module_name' => 'Edit',
				'module_slug' => 'manage_user',
				'description' => 'Users',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_user',
				'module_name' => 'Delete',
				'module_slug' => 'manage_user',
				'description' => 'Users',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_user',
				'module_name' => 'Add',
				'module_slug' => 'manage_user',
				'description' => 'Users',
				'status' => 1
			],


			//Admins Manegement
			[
				'name' => 'View',
				'slug' => 'view_admin',
				'module_name' => 'View',
				'module_slug' => 'manage_admin',
				'description' => 'Admins Management',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_admin',
				'module_name' => 'Edit',
				'module_slug' => 'manage_admin',
				'description' => 'Admins Management',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_admin',
				'module_name' => 'Delete',
				'module_slug' => 'manage_admin',
				'description' => 'Admins Management',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_admin',
				'module_name' => 'Add',
				'module_slug' => 'manage_admin',
				'description' => 'Admins Management',
				'status' => 1
			],

			//Marketing User Manegement

			[
				'name' => 'View',
				'slug' => 'view_marketing_user',
				'module_name' => 'View',
				'module_slug' => 'manage_marketing_user',
				'description' => 'Marketing User Manegement',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_marketing_user',
				'module_name' => 'Edit',
				'module_slug' => 'manage_marketing_user',
				'description' => 'Marketing User Manegement',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_marketing_user',
				'module_name' => 'Delete',
				'module_slug' => 'manage_marketing_user',
				'description' => 'Marketing User Manegement',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_marketing_user',
				'module_name' => 'Add',
				'module_slug' => 'manage_marketing_user',
				'description' => 'Marketing User Manegement',
				'status' => 1
			],


			//Product Manegement

			[
				'name' => 'View',
				'slug' => 'view_product',
				'module_name' => 'View',
				'module_slug' => 'manage_product',
				'description' => 'Products Management',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_product',
				'module_name' => 'Edit',
				'module_slug' => 'manage_product',
				'description' => 'Product Management',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_product',
				'module_name' => 'Delete',
				'module_slug' => 'manage_product',
				'description' => 'Product Management',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_product',
				'module_name' => 'Add',
				'module_slug' => 'manage_product',
				'description' => 'Product Management',
				'status' => 1
			],

			//Order Management

			[
				'name' => 'View',
				'slug' => 'view_order',
				'module_name' => 'View',
				'module_slug' => 'manage_order',
				'description' => 'Order Management',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_order',
				'module_name' => 'Edit',
				'module_slug' => 'manage_order',
				'description' => 'Order Management',
				'status' => 1
			],

			//Payment Transaction
              
              	[
				'name' => 'View',
				'slug' => 'view_payment_transaction',
				'module_name' => 'View',
				'module_slug' => 'payment_transaction',
				'description' => 'Payment Transaction',
				'status' => 1
			    ],

			
			// Mobile Content management
			[
				'name' => 'View',
				'slug' => 'view_mobile_content',
				'module_name' => 'View',
				'module_slug' => 'manage_mobile_content',
				'description' => 'Mobile Content',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_mobile_content',
				'module_name' => 'Edit',
				'module_slug' => 'manage_mobile_content',
				'description' => 'Mobile Content',
				'status' => 1
			],

			// Contact Us management
			[
				'name' => 'View',
				'slug' => 'view_contact_us',
				'module_name' => 'View',
				'module_slug' => 'manage_contact_us',
				'description' => 'Manage Contact Us',
				'status' => 1
			],
			[
				'name' => 'Reply',
				'slug' => 'reply_contact_us',
				'module_name' => 'Reply',
				'module_slug' => 'manage_contact_us',
				'description' => 'Manage Contact Us',
				'status' => 1
			],


				//Review
              
              	[
				'name' => 'View',
				'slug' => 'view_reviews',
				'module_name' => 'View',
				'module_slug' => 'manage_review',
				'description' => 'Manage Review',
				'status' => 1
			    ],


			// Currencies management
			[
				'name' => 'View',
				'slug' => 'view_misc',
				'module_name' => 'View',
				'module_slug' => 'manage_currencies',
				'description' => 'Currency Management',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_misc',
				'module_name' => 'Edit',
				'module_slug' => 'manage_currencies',
				'description' => 'Currency Management',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_misc',
				'module_name' => 'Delete',
				'module_slug' => 'manage_currencies',
				'description' => 'Currency Management',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_misc',
				'module_name' => 'View',
				'module_slug' => 'manage_currencies',
				'description' => 'Currency Management',
				'status' => 1
			],


           //Subscription Plans
		     
		     [
				'name' => 'View',
				'slug' => 'view_subscription_plans',
				'module_name' => 'View',
				'module_slug' => 'manage_plans',
				'description' => 'Subscription plans',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_subscription_plans',
				'module_name' => 'Edit',
				'module_slug' => 'manage_plans',
				'description' => 'Subscription plans',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_subscription_plans',
				'module_name' => 'Delete',
				'module_slug' => 'manage_plans',
				'description' => 'Subscription plans',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_subscription_plans',
				'module_name' => 'Add',
				'module_slug' => 'manage_plans',
				'description' => 'Subscription plans',
				'status' => 1
			],
             
		   //Interests
		     
		     		     [
				'name' => 'View',
				'slug' => 'view_interests',
				'module_name' => 'View',
				'module_slug' => 'manage_interests',
				'description' => 'Interests',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_interests',
				'module_name' => 'Edit',
				'module_slug' => 'manage_interests',
				'description' => 'Interests',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_interests',
				'module_name' => 'Delete',
				'module_slug' => 'manage_interests',
				'description' => 'Interests',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_interests',
				'module_name' => 'Add',
				'module_slug' => 'manage_interests',
				'description' => 'Interests',
				'status' => 1
			],
            
		   //Destinations
		    
		    		     [
				'name' => 'View',
				'slug' => 'view_destinations',
				'module_name' => 'View',
				'module_slug' => 'manage_destinations',
				'description' => 'Destinations',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_destinations',
				'module_name' => 'Edit',
				'module_slug' => 'manage_destinations',
				'description' => 'Destinations',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_destinations',
				'module_name' => 'Delete',
				'module_slug' => 'manage_destinations',
				'description' => 'Destinations',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_destinations',
				'module_name' => 'Add',
				'module_slug' => 'manage_destinations',
				'description' => 'Destinations',
				'status' => 1
			],


		   //Ethinicity	


					     [
				'name' => 'View',
				'slug' => 'view_ethinicity',
				'module_name' => 'View',
				'module_slug' => 'manage_ethinicity',
				'description' => 'Ethinicity',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_ethinicity',
				'module_name' => 'Edit',
				'module_slug' => 'manage_ethinicity',
				'description' => 'Ethinicity',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_ethinicity',
				'module_name' => 'Delete',
				'module_slug' => 'manage_ethinicity',
				'description' => 'Ethinicity',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_ethinicity',
				'module_name' => 'Add',
				'module_slug' => 'manage_ethinicity',
				'description' => 'Ethinicity',
				'status' => 1
			],








//Roles
			[
				'name' => 'View',
				'slug' => 'view_role',
				'module_name' => 'View Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_role',
				'module_name' => 'Edit Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_role',
				'module_name' => 'Delete Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			[
				'name' => 'Add',
				'slug' => 'add_role',
				'module_name' => 'Add Role',
				'module_slug' => 'manage_roles',
				'description' => 'Roles',
				'status' => 1
			],
			

//Permissions
			[
				'name' => 'View',
				'slug' => 'view_permission',
				'module_name' => 'View Permission',
				'module_slug' => 'manage_permission',
				'description' => 'Permissions',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_permission',
				'module_name' => 'Edit Permission',
				'module_slug' => 'manage_permission',
				'description' => 'Permissions',
				'status' => 1
			],
//Recyclebin

			[
				'name' => 'View Deleted Users',
				'slug' => 'view_deleted_users',
				'module_name' => 'View Deleted User',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Users',
				'status' => 1
			],
			[
				'name' => 'Restore User',
				'slug' => 'restore_user',
				'module_name' => 'Restore User',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Users',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete User',
				'slug' => 'permanent_deleted_user',
				'module_name' => 'Permanent Delete User',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Users',
				'status' => 1
			],
			[
				'name' => 'View Deleted Admin',
				'slug' => 'view_deleted_admin',
				'module_name' => 'View Deleted Admin',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Admins',
				'status' => 1
			],
			[
				'name' => 'Restore Admin',
				'slug' => 'restore_admin',
				'module_name' => 'Restore Admin',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Admins',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Admin',
				'slug' => 'permanent_deleted_admin',
				'module_name' => 'Permanent Delete Admin',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Admin',
				'status' => 1
			],

			[
				'name' => 'View Deleted Marketing User',
				'slug' => 'view_deleted_marketing_user',
				'module_name' => 'View Deleted Marketing User',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Marketing User',
				'status' => 1
			],
			[ 
				'name' => 'Restore Marketing User',
				'slug' => 'restore_marketing_user',
				'module_name' => 'Restore Marketing User',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Marketing User',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Marketing User',
				'slug' => 'permanent_deleted_marketing_user',
				'module_name' => 'Permanent Delete Marketing User',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Marketing User',
				'status' => 1
			],


			[
				'name' => 'View Deleted Role',
				'slug' => 'view_deleted_role',
				'module_name' => 'View Deleted Role',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Roles',
				'status' => 1
			],
			[
				'name' => 'Restore Role',
				'slug' => 'restore_role',
				'module_name' => 'Restore Role',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Roles',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Role',
				'slug' => 'permanent_deleted_role',
				'module_name' => 'Permanent Delete Role',
				'module_slug' => 'recycle_bin',
				'description' => 'Delete Roles',
				'status' => 1
			],

			 
			[
				'name' => 'View Deleted Plans',
				'slug' => 'view_deleted_plans',
				'module_name' => 'View Deleted Plans',
				'module_slug' => 'recycle_bin',
				'description' => ' View Delete Plans',
				'status' => 1
			],
			[
				'name' => 'Restore Plans',
				'slug' => 'restore_plans',
				'module_name' => 'Restore Plans',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Plans',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Plans',
				'slug' => 'permanent_deleted_plans',
				'module_name' => 'Permanent Delete Plans',
				'module_slug' => 'recycle_bin',
				'description' => 'Permanent Delete Plans',
				'status' => 1
			],
			[
				'name' => 'View Deleted Interests',
				'slug' => 'view_deleted_interests',
				'module_name' => 'View Deleted Interests',
				'module_slug' => 'recycle_bin',
				'description' => ' View Delete Interests',
				'status' => 1
			],
			[
				'name' => 'Restore Interests',
				'slug' => 'restore_interests',
				'module_name' => 'Restore Interests',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Interests',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Interests',
				'slug' => 'permanent_deleted_interests',
				'module_name' => 'Permanent Delete Interests',
				'module_slug' => 'recycle_bin',
				'description' => 'Permanent Delete Interests',
				'status' => 1
			],
			[
				'name' => 'View Deleted Destinations',
				'slug' => 'view_deleted_destinations',
				'module_name' => 'View Deleted Destinations',
				'module_slug' => 'recycle_bin',
				'description' => ' View Delete Destinations',
				'status' => 1
			],
			[
				'name' => 'Restore Destinations',
				'slug' => 'restore_destinations',
				'module_name' => 'Restore Destinations',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Destinations',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Destinations',
				'slug' => 'permanent_deleted_destinations',
				'module_name' => 'Permanent Delete Destinations',
				'module_slug' => 'recycle_bin',
				'description' => 'Permanent Delete Destinations',
				'status' => 1
			],
			[
				'name' => 'View Deleted Ethinicity',
				'slug' => 'view_deleted_ethinicity',
				'module_name' => 'View Deleted Ethinicity',
				'module_slug' => 'recycle_bin',
				'description' => ' View Delete Ethinicity',
				'status' => 1
			],
			[
				'name' => 'Restore Ethinicity',
				'slug' => 'restore_ethinicity',
				'module_name' => 'Restore Ethinicity',
				'module_slug' => 'recycle_bin',
				'description' => 'Restore Ethinicity',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Ethinicity',
				'slug' => 'permanent_deleted_ethinicity',
				'module_name' => 'Permanent Delete Ethinicity',
				'module_slug' => 'recycle_bin',
				'description' => 'Permanent Delete Ethinicity',
				'status' => 1
			]

		]);
		
		$allPermissions = \DB::table('permissions')->get();
		for($i=0; $i < count($allPermissions); $i++) {
			$permission = $allPermissions[$i];
			\DB::table('permission_role')->insert([
				'permission_id' => $permission->id,
				'role_id' => 1
			]);
		}

		// $allAdminPermissions = \DB::table('permissions')->where('module_slug', '!=', 'roles')->where('module_slug', '!=', 'permissions')->get();
		// for($i=0; $i < count($allAdminPermissions); $i++) {
		// 	$permission = $allAdminPermissions[$i];
		// 	\DB::table('permission_role')->insert([
		// 		'permission_id' => $permission->id,
		// 		'role_id' => 2
		// 	]);
		// }

		// $allViewerPermissions = \DB::table('permissions')->where('name', 'View')->get();
		// for($i=0; $i < count($allViewerPermissions); $i++) {
		// 	$permission = $allViewerPermissions[$i];
		// 	\DB::table('permission_role')->insert([
		// 		'permission_id' => $permission->id,
		// 		'role_id' => 3
		// 	]);
		// }

	}
}
