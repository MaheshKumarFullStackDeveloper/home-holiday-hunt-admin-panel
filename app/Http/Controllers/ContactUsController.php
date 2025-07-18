<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Feedback;
use App\Models\ContactUs;
use Auth;
use Mail;

class ContactUsController extends Controller {
	public function list(Request $request) {
		if (Auth::user()->can('view_contact_us')) {
		$contactUsMessagesList = ContactUs::orderByDesc('id')->get();
			return view('contact_us.list', [ 'contactUsMessagesList' => $contactUsMessagesList ]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}

	}

	public function view($id) {
		 if (Auth::user()->can('view_contact_us')) {
			 $contactUsMessage = ContactUs::with('user')->find($id);
			// dd($contactUsMessage);
			 return view('contact_us.view', [ 'contactUsMessage' => $contactUsMessage ]);
			}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	public function statusUpdate(Request $request) {
		 
		$contactUs = ContactUs::find($request->id);
		$contactUs['status'] = $request->status;
		$contactUs->save();
    
		if($contactUs) {
			return response()->json(['success' => true]);
		}
		else {
			return response()->json(['success' => false]);
		}
	}
}
