<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Page;
use App\Models\Role;
use App\Models\UserSocialLogin;
use App\Models\HomeownerInformation;
use App\Models\Ticket;
use App\Models\Feedback;
use App\Models\ContactUs;
use App\Models\Product;
use App\Models\MarkettingUser;
use App\Models\Story;
use App\Models\PaymentTransaction;
use App\Models\Order;
use Carbon\Carbon;
use Auth;
use Hash;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class AdminController extends Controller
{
	/**
	 * This function is used to Show Admin Dashboard
	 */

	public function dashboard(Request $request)
	{

	
		$champion = HomeownerInformation::with('userImages')->where('status', '1')->orderBy('id', 'desc')->get()->sortByDesc('avg_rate')->take(1);

		return view('dashboard', compact('champion'));
	}


	public function champSms(Request $request)
	{
		//dd($request->toArray());
		$receiverNumber = '+1' . $request->phone_no;
		//$receiverNumber = '+918219631147';    

		//$message =   " Congratulations,".$request->first_name."! Your nominated home in %ADDRESS% is the champion for this year's Holiday Home Hunt. We will contact you shortly to inform you of how to claim your rewards. Thank you for joining Atlanta's Holiday Home Hunt!";


		try {
			$account_sid = getenv("TWILIO_SID");
			$auth_token = getenv("TWILIO_TOKEN");
			$twilio_number = getenv("TWILIO_FROM");

			$client = new Client($account_sid, $auth_token);
			$client->messages->create($receiverNumber, [
				'from' => $twilio_number,
				'body' => $request->send_smss
			]);
		} catch (\Exception $e) {
			// dd("Error: ". $e->getMessage());
		}
		return back()->with('success', 'SMS Send Successfully!');
	}


	/**
	 * This function is used to Show Admin Profile
	 */
	public function adminProfile(Request $request)
	{
		$userDetails = Admin::findOrFail(Auth::id());
		return view('admin_profile')->with('userDetails', $userDetails);
	}

	/**
	 * This function is used to Update Admin Profile
	 */
	public function updateProfile(Request $request)
	{

		$validatedData = $request->validate([
			'name' => 'required',
		], [
			'name.required' => 'Name is required',
		]);
		$updateProfile = Admin::where('id', $request->id)->update(['name' => $request->name]);
		if ($updateProfile) {
			return back()->with('success', 'Profile Updated Successfully!');
		} else {
			return back()->with('error', 'Something went wrong! Please try again later.');
		}
	}

	public function checkPassword(Request $request)
	{
		$passwordType = $request['password_type'];
		$admin = Admin::find(Auth::id());
		if ($passwordType == 'old') {
			if (Hash::check($request->password, $admin->password) == false) {
				return true;
			} else if (Hash::check($request->password, $admin->password) == true) {
				return false;
			}
		} else if ($passwordType == 'new') {
			if (Hash::check($request->password, $admin->password) == false) {
				return false;
			} else {
				return true;
			}
		}
	}

	/**
	 * This function is used to Change Admin Password
	 */
	public function changePassword(Request $request)
	{
		$changePassword = Admin::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);
		if ($changePassword) {
			return back()->with('success', 'Password Updated Successfully!');
		} else {
			return back()->with('error', 'Something went wrong! Please try again later.');
		}
	}
}
