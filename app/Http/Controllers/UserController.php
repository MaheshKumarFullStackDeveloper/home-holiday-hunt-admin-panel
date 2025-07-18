<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Destination;
use App\Models\Ethnicity;
use App\Models\Interest;
use App\Models\UserInterest;
use App\Models\UserSuspension;
use App\Models\UserSuspensionHistory;
use App\Models\UserDestination;
use App\Models\InterestCategory;
use App\Models\HomeownerInformation;
use App\Models\HomeownerInformationPics;
use App\Models\Country;
use App\Models\SubscriptionPlan;
use App\Models\Subscriber;
use App\Models\MdDropdowns;
use App\Models\HomeKey;
use App\Models\Page;
use Twilio\Rest\Client;
use App\Models\Notification as Notifications;
use App\Notifications\SendConfirmationMail;
use Carbon\Carbon;
use Image;
use Auth, Session, DB, Log, Hash, Notification;;
class UserController extends Controller
{
    //Send custom sms
    public function setYear($searchqueryyear = null)
    {
        Session::put('years_data', $searchqueryyear);
        return redirect()->back()->with('success', 'Year set successfully');
    }
    public function sendCustomSms(Request $request)
    {
        if ($request->home_owner) {
            if ($request->custom_sms_number_homeowner == '') {
                return redirect()->back()->with('error', 'Homeowner Phone Nubmer Not Available');
            } else {
                //$custom_sms_number_homeowner = '+13475279814';
                $custom_sms_number_homeowner = '+1' . $request->custom_sms_number_homeowner;
                $only_custom_sms_homeowner =   $request->only_custom_sms_homeowner;
                if ($request->file('profile_picture')) {
                    $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/sms_images/';
                    $profile = $request->file('profile_picture');
                    $fileName = time() . '.' . $profile->getClientOriginalExtension();
                    $profile->move($folderPath, $fileName);
                    $final_url = env('ADMIN_URL') . "sms_images/" . $fileName;
                    //dd($final_url);
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $message = $client->messages->create($custom_sms_number_homeowner, [
                            'from' => $twilio_number,
                            'body' => $only_custom_sms_homeowner,
                            'mediaUrl' => $final_url
                        ]);
                    } catch (\Exception $e) {
                        // dd("Error: ". $e->getMessage());
                    }
                } else {
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $message = $client->messages->create($custom_sms_number_homeowner, [
                            'from' => $twilio_number,
                            'body' => $only_custom_sms_homeowner
                        ]);
                    } catch (\Exception $e) {
                        //dd("Error: ". $e->getMessage());
                    }
                }

                // dd($message);
                return redirect()->back()->with('success', 'Message send successfully');
            }
        }
        $custom_sms_number = '+1' . $request->custom_sms_number;
        //$custom_sms_number = '+13475279814';  
        $only_custom_sms =   $request->only_custom_sms;
        if ($request->file('profile_picture_owner')) {
            $folderPath_owner = $_SERVER['DOCUMENT_ROOT'] . '/sms_images/';
            $profile_owner = $request->file('profile_picture_owner');
            $fileName_owner = time() . '.' . $profile_owner->getClientOriginalExtension();
            $profile_owner->move($folderPath_owner, $fileName_owner);
            $final_url_owner = env('ADMIN_URL') . "sms_images/" . $fileName_owner;
            try {
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_TOKEN");
                $twilio_number = getenv("TWILIO_FROM");
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($custom_sms_number, [
                    'from' => $twilio_number,
                    'body' => $only_custom_sms,
                    'mediaUrl' => $final_url_owner
                ]);
            } catch (\Exception $e) {
                // dd("Error: ". $e->getMessage());
            }
        } else {
            try {
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_TOKEN");
                $twilio_number = getenv("TWILIO_FROM");
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($custom_sms_number, [
                    'from' => $twilio_number,
                    'body' => $only_custom_sms
                ]);
            } catch (\Exception $e) {
                //dd("Error: ". $e->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Message send successfully');
    }
    //Users List
    public function usersList($searchquery = null, $searchqueryyear = null)
    {
        // dd($searchquery);
        if (Auth::user()->can('view_user')) {
            //$usersList = User::whereNull('user_type')->whereNull('is_nominated')->orderBy('id', 'desc')->get();
            /* if($searchqueryyear == null){
            $searchqueryyear = Carbon::now()->format('Y');
        } */
            if (Session::get('years_data') == '') {
                $searchqueryyear = Carbon::now()->format('Y');
            } else {
                $searchqueryyear = Session::get('years_data');
            }
            if ($searchquery == 1 || $searchquery == 2) {
                $usersList = HomeownerInformation::where('homeowner', $searchquery)->orderBy('id', 'desc')->whereYear('created_at', $searchqueryyear)
                    ->when(($searchqueryyear == 2023), function ($query) use ($searchquery) {
                        $query->orWhere(function ($query) use ($searchquery) {
                            $query->whereYear('created_at', 2022)->where('homeowner', $searchquery)->whereNotNull('approved_at');
                        });
                    })
                    ->get();
                return view('users/list', compact('usersList', 'searchquery', 'searchqueryyear'));
            } else {
                $usersList = HomeownerInformation::orderBy('id', 'desc')
                    ->whereYear('created_at', $searchqueryyear)
                    ->when(($searchqueryyear == 2023), function ($query) {
                        $query->orWhere(function ($query) {
                            $query->whereYear('created_at', 2022)->whereNotNull('approved_at');
                        });
                    })
                    ->get();

                return view('users/list', compact('usersList', 'searchqueryyear'));
            }
            // dd($usersList);
            // $usersList = User::where([['user_type', '!=', null],['is_nominated', '=', null]])->orderBy('id', 'desc')->get();
        } else {
            return redirect()->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }
    //User Delete
    public function deleteUser(Request $request)
    {
        //  dd('test');
        $user = HomeownerInformation::find($request->id);
        if ($user->home_key) {
            $updatea_home_key = HomeKey::find($user->home_key);
            $updatea_home_key->is_assigned = null;
            $updatea_home_key->save();
        }
        if ($user->delete()) {
            return "success";
        } else {
            return "failure";
        }
    }
    //User Ban
    public function banUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user_suspension_history = new UserSuspensionHistory;
            $user_suspension_history->user_id = $request->id;
            $user_suspension_history->suspended_at = Carbon::now()->toDateTimeString();
            $user_suspension_history->created_at = Carbon::now()->toDateTimeString();
            $user_suspension_history->save();
            $user = User::find($request->id);
            $user->user_locked = 1;
            $user->user_locked_at =  Carbon::now()->toDateTimeString();
            $user->save();
            Log::info($user);
            return response()
                ->json(['status' => 'true', 'success' => 1]);
        } else {
            return response()
                ->json(['status' => 'false', 'success' => 0]);
        }
    }
    public function deleteProfileImage(Request $request)
    {
        $user = User::where('id', $request->user_id)
            ->first();
        if ($user) {
            $user->profile_picture = null;
            if ($user->save()) {
                return response()
                    ->json(['status' => 'true', 'success' => 1]);
            } else {
                return response()
                    ->json(['status' => 'true', 'success' => 0]);
            }
        } else {
            return response()
                ->json(['status' => 'true', 'success' => 0]);
        }
    }
    //Add user
    public function addUser()
    {
        $destination = Country::with('city')->get();
        $ethnicity = Ethnicity::get();
        $subscription_plan = SubscriptionPlan::where('plan_status', '1')->get();
        // $interests = Interest::get(); 
        $interestcategory = InterestCategory::with('interest')->get();
        return view('users/add', compact('destination', 'ethnicity', 'interestcategory', 'subscription_plan'));
    }
    public function InterestCategoryType(Request $request)
    {
        $id = $request->id;
        $interests = Interest::where('interest_category_id', $id)->get();
        return json_encode($interests);
    }
    //User Email check
    public function checkUserEmail(Request $request)
    {
        $email = User::where('email', $request->email)->get();
        if (count($email) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }
    }
    //Save User  
    public function saveUser(Request $request)
    {
        //print_r($request->toArray()); die();
        if ($request->hasFile('profile_picture')) {
            $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/' . env('API_END_PROJECT_NAME') . "/public/user_profile_images/";
            $profile = $request->file('profile_picture');
            $fileName = time() . '.' . $profile->getClientOriginalExtension();
            $profile->move($folderPath, $fileName);
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->country_code = $request->country_code;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->preferred_lang = $request->preferred_lang;
        $user->ethinicity = $request->ethinicity;
        $user->sexual_orientation = $request->sexual_orientation;
        $user->bio = $request->bio;
        $user->password = Hash::make($request->password);
        $user->profile_updated_from = '0';
        $user->is_email_verified = '1';
        $user->email_verified_at = Carbon::now();
        if ($request->hasFile('profile_picture')) {
            $user->profile_picture = $fileName;
        } else {
            $user->profile_picture = null;
        }
        $user->save();
        $user->id;
        if ($request->interest) {
            foreach ($request->interest as $interests) {
                $interest =  new UserInterest;
                $interest->user_id = $user->id;
                $interest->interest_id = $interests;
                $interest->save();
            }
        }
        if ($request->destination) {
            foreach ($request->destination as $destinations) {
                $interest =  new UserDestination;
                $interest->user_id = $user->id;
                $interest->dest_id = $destinations;
                $interest->save();
            }
        }
        if ($request->subscription_plan) {
            $subscription_plan = SubscriptionPlan::where('id', $request->subscription_plan)->first();
            $plan_duration = $subscription_plan->plan_duration;
            $add_days = $plan_duration * '30';
            $plan_end_date = Carbon::now()->addDays($add_days);
            $subscriber =  new Subscriber;
            $subscriber->plan_id = $request->subscription_plan;
            $subscriber->user_id = $user->id;
            $subscriber->plan_start_date = Carbon::now();
            $subscriber->plan_end_date = $plan_end_date;
            $subscriber->status = '1';
            $subscriber->save();
        }
        // Log::info($this->saveInterest($request->interest,$user->id));
        Session::put('current_user_id', $user->id);
        return "success";
        return redirect()
            ->route('user_list')
            ->with('success', 'User Added  successfully');
    }
    // public function saveInterest($interests,$user_id){
    //     foreach($interests as $interest){
    //         $interest =  new UserInterest;
    //         $interest->user_id = $user_id;
    //         $interest->interest_id = $interest;
    //         $interest->save();
    //     }
    // }
    //store Image
    public function storeImage(Request $request)
    {
        $proimages = $request->file('file');
        //dd($proimages);
        //dd(count($proimages));
        // dd(Session::get('current_user_id'));
        for ($i = 0; $i < count($proimages); $i++) {
            $image_path = $proimages[$i]->getClientOriginalName();
            $proimages[$i]->move(public_path('user_ten_images'), $image_path);
            $UserImage = UserImage::create([
                'user_id' => Session::get('current_user_id'),
                'image_name' => $image_path,
                'image_updated_from' => '1',
            ]);
        }
    }
    // View User
    public function viewUser($id)
    {
        if (Auth::user()->can('view_user')) {
            //$users = User::with('userImages','child','reviews' , 'reviews.voter','reviews.voter_images')->find($id);
            $users = HomeownerInformation::with('userImages')->find($id);
            $md_dropdown = MdDropdowns::where('slug', 'home_status')->get();
            // dd($users);
            return view('users/view', compact('users', 'md_dropdown'));
        } else {
            return redirect()->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }
    //edit User
    public function editUser($id)
    {
        if (Auth::user()->can('edit_user')) {
            $users = HomeownerInformation::with('userImages')->find($id);
            $md_dropdown = MdDropdowns::where('slug', 'home_status')->get();
            $home_key = HomeKey::where('is_assigned', null)->get();
            return view('users/edit', compact('users', 'md_dropdown', 'home_key'));
        } else {
            return redirect()->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }
    //update User
    public function updateUser(Request $request)
    {
        //  dd($request->old_images_name);
        if (Auth::user()->can('edit_user')) {
            // dd($request->all());
            if ($request->custom_decline_sms != null && $request->status == '2') {
                if ($request->homeowner_type == "2") {
                    $owner_phone = $request->nominator_phone;
                }
                if ($request->homeowner_type == "1") {
                    $owner_phone = $request->homeowner_phone;
                }
                $receiverNumber = '+1' . $owner_phone;
                $message =   $request->custom_decline_sms;
                try {
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message
                    ]);
                } catch (\Exception $e) {
                    //dd("Error: ". $e->getMessage());
                }
            }
            Log::info($request->all());
            $user = HomeownerInformation::find($request->user_id);
            $final_key = $user->home_key;
            $find_key = HomeKey::find($user->home_key);
            if ($find_key->keyword != $request->home_key_val) {
                $find_key->is_assigned = null;
                $find_key->save();
                $find_key_req = HomeKey::where('keyword', $request->home_key_val)->first();
                $find_key_req->is_assigned = '1';
                $find_key_req->save();
                $final_key = $find_key_req->id;
            }
            if ($request->status == '1' && $user->status != '1') {
                if ($request->homeowner_type == "2") {
                    $owner_name = $request->nominator_first_name;
                    $owner_email = $request->nominator_email;
                    $owner_phone = $request->nominator_phone;
                }
                if ($request->homeowner_type == "1") {
                    $owner_name = $request->homeowner_first_name;
                    $owner_email = $request->homeowner_email;
                    $owner_phone = $request->homeowner_phone;
                }
                $store_aprroved = HomeownerInformation::find($request->user_id);
                $store_aprroved->approved_at = date("Y-m-d H:i:s");
                $store_aprroved->save();
                //send Confirmation email                 
                $userName =  strtoupper($owner_name);
                $mailSubject = strtoupper($owner_name) . ' , your nominated home has been approved!';
                $text = env("APP_URL") . "single-entry/" . base64_encode($request->user_id);
                $mailSent = Notification::route('mail', $owner_email)->notify(new SendConfirmationMail(
                    $mailSubject,
                    $text,
                    $userName
                ));
                //send congirmation sms
                $receiverNumber = '+1' . $owner_phone;
                //$message = $request->path;
                $message =   "Hey, " . $owner_name . "! Your nominated home " . $request->home_key_val . " has been approved to join the Holiday Home Hunt. Tap on this link to view your entry: " . env("APP_URL") . "single-entry/" . base64_encode($request->user_id);
                //$message = "Hi ".$request->first_name."..!\nYour home entry is confirmed by the administrator!\nLink to your home entry: ".env("APP_URL")."single-entry/".base64_encode($request->user_id);
                try {
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message
                    ]);
                    //    dd('SMS Sent Successfully.');
                } catch (\Exception $e) {
                    //dd("Error: ". $e->getMessage());
                }
                //2nd sms 
                $message2 = "Don't forget to share this amazing holiday home " . $request->home_key_val . " to your friends on Instagram and Facebook. Tap here to share now: " . env("APP_URL") . "single-entry/" . base64_encode($request->user_id) . "?popup=share";
                try {
                    $account_sid1 = getenv("TWILIO_SID");
                    $auth_token1 = getenv("TWILIO_TOKEN");
                    $twilio_number1 = getenv("TWILIO_FROM");
                    $client1 = new Client($account_sid1, $auth_token1);
                    $client1->messages->create($receiverNumber, [
                        'from' => $twilio_number1,
                        'body' => $message2
                    ]);
                    //    dd('SMS Sent Successfully.');
                } catch (\Exception $e1) {
                    //dd("Error: ". $e1->getMessage());
                }
            }
            Session::put('current_user_id', $request->user_id);
            $userImage = HomeownerInformationPics::where(
                'user_id',
                $request->user_id
            )->forceDelete();
            $old_images_old = explode("--", $request->old_images_name);
            foreach ($old_images_old as $olddd) {
                $aaaaa =  substr($olddd, 40);
                //print_r($aaaaa);
                if ($aaaaa != 0) {
                    $userImage = HomeownerInformationPics::create([
                        'user_id' => $request->user_id,
                        'image' => $aaaaa,
                    ]);
                }
            }
            /* 
            for (
                $i = 0;
                $i < count(explode("--", $request->old_images_name)) - 1;
                $i++
            ) {
                $userImage = HomeownerInformationPics::create([
                    'user_id' => $request->user_id,
                    'image' => $old_images_old[$i],
                ]);
            } */
            if ($request->homeowner_type == "2") {
                $user->nominator_first_name = $request->nominator_first_name;
                $user->nominator_last_name = $request->nominator_last_name;
                $user->nominator_email = $request->nominator_email;
                $user->homeowner_first_name = $request->homeowner_first_name;
                $user->homeowner_last_name = $request->homeowner_last_name;
                $user->homeowner_email = $request->homeowner_email;
                $user->homeowner_phone = $request->homeowner_phone;
                $user->nominator_phone = $request->nominator_phone;
                $user->nominator_location = $request->nominator_location;
                $user->status = $request->status;
                $user->home_key = $final_key;
                $user->notes = $request->notes;
            }
            if ($request->homeowner_type == "1") {
                $user->homeowner_first_name = $request->homeowner_first_name;
                $user->homeowner_last_name = $request->homeowner_last_name;
                $user->homeowner_email = $request->homeowner_email;
                $user->homeowner_location = $request->homeowner_location;
                $user->homeowner_phone = $request->homeowner_phone;
                $user->status = $request->status;
                $user->home_key = $final_key;
                $user->notes = $request->notes;
            }
            if ($user->save()) {
                if ($request->status == '2') {
                    $find_key->is_assigned = null;
                    $find_key->save();
                    $user->home_key = null;
                    $user->save();
                }
                return  "success";
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }
    //update User
    public function updateUser_old(Request $request)
    {
        if (Auth::user()->can('edit_user')) {
            Log::info($request->all());
            $user = HomeownerInformation::find($request->user_id);
            $user->status = $request->status;
            if ($user->save()) {
                if ($request->status == '1') {
                    //send Confirmation email
                    $userName =  strtoupper($request->first_name);
                    $mailSubject = strtoupper($request->first_name) . ' , your nominated home has been approved!';
                    $text = env("APP_URL") . "single-entry/" . base64_encode($request->user_id);
                    $mailSent = Notification::route('mail', $request->email)->notify(new SendConfirmationMail(
                        $mailSubject,
                        $text,
                        $userName
                    ));
                    //send congirmation sms
                    $receiverNumber = '+1' . $request->phone;
                    //$message = $request->path;
                    $message =   "Hey, " . $request->first_name . "! Your nominated home " . $request->home_key_val . " has been approved to join the Holiday Home Hunt. Tap on this link to view your entry: " . env("APP_URL") . "single-entry/" . base64_encode($request->user_id);
                    //$message = "Hi ".$request->first_name."..!\nYour home entry is confirmed by the administrator!\nLink to your home entry: ".env("APP_URL")."single-entry/".base64_encode($request->user_id);
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number,
                            'body' => $message
                        ]);
                        //    dd('SMS Sent Successfully.');
                    } catch (\Exception $e) {
                        //dd("Error: ". $e->getMessage());
                    }
                    //2nd sms 
                    $message2 = "Don't forget to share this amazing holiday home " . $request->home_key_val . " to your friends on Instagram and Facebook. Tap here to share now: " . env("APP_URL") . "single-entry/" . base64_encode($request->user_id) . "?popup=share";
                    try {
                        $account_sid1 = getenv("TWILIO_SID");
                        $auth_token1 = getenv("TWILIO_TOKEN");
                        $twilio_number1 = getenv("TWILIO_FROM");
                        $client1 = new Client($account_sid1, $auth_token1);
                        $client1->messages->create($receiverNumber, [
                            'from' => $twilio_number1,
                            'body' => $message2
                        ]);
                        //    dd('SMS Sent Successfully.');
                    } catch (\Exception $e1) {
                        //dd("Error: ". $e1->getMessage());
                    }
                }
                Session::put('current_user_id', $request->user_id);
                return  "success";
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }
    public function updateImage(Request $request)
    {
        /*  $proimages = $request->file('file');
            $folderPAth =  '/srv/www/public_html/web/public/home_images/';
            for ($i = 0; $i < count($proimages); $i++) {
                $image_path = $proimages[$i]->getClientOriginalName();
                $proimages[$i]->move($folderPAth, $image_path);
                $UserImage = HomeownerInformationPics::create([
                    'user_id' => Session::get('current_user_id'),
                    'image' => $image_path,
                ]); 
            } */
        $proimages = $request->file('file');
        for ($i = 0; $i < count($proimages); $i++) {
            $input['imagename'] = time() . '_' . $proimages[$i]->getClientOriginalName();
            \Log::info($input['imagename']);
            $destinationPath = '/srv/www/public_html/web/public/home_images';
            $img = Image::make($proimages[$i]->getRealPath());
            $img->orientate();
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            \Log::info($destinationPath . '/' . $input['imagename']);
            $destinationPath = '/srv/www/public_html/web/public/home_images_compress';
            $proimages[$i]->move($destinationPath, $input['imagename']);
            $UserImage = HomeownerInformationPics::create([
                'user_id' => Session::get('current_user_id'),
                'image' => $input['imagename'],
            ]);
        }
    }
    //deletedUsersList
    public function deletedUsersList()
    {
        if (Auth::user()
            ->can('view_deleted_users')
        ) {
            $usersList = HomeownerInformation::onlyTrashed()->get();
            //dd($usersList);
            return view('users/deleted_users_list', compact('usersList'));
        } else {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }
    //Restore User
    public function restoreUser(Request $request)
    {
        $usersList = HomeownerInformation::withTrashed()->find($request->id)
            ->restore();
        return "success";
    }
    //Permanent Delete User
    public function permanentDeleteUser(Request $request)
    {
        $usersList = HomeownerInformation::onlyTrashed()->find($request->id)
            ->forceDelete();
        return "success";
    }
    //Approve or decline user  
    public function changeUserStatus(Request $request)
    {
        //dd($request->status_value);
        if ($request->status_value == 'active') {
            $status = Page::where('id', $request->id)->first();
            $status->status = 'active';
            $status->save();
            return response()->json(['status' => 'user_locked', 'message' => "User Disabled"]);
            $user->user_locked = isset($request->status) ? '0' : '1';
        } else {
            $status = Page::where('id', $request->id)->first();
            //dd($status);
            $status->status = 'inactive';
            $status->save();
            return response()->json(['status' => 'user_unlocked', 'message' => "User Enabled"]);
        }
    }
    //Cancel subscription
    public function cancelSubscription(Request $request)
    {
        $subscriber = Subscriber::where('user_id', $request->id)->latest()->first();
        $subscriber->status = '0';
        $subscriber->cancel_at =  Carbon::now();
        if ($subscriber->update()) {
            return "success";
        } else {
            return "failure";
        }
    }
}
