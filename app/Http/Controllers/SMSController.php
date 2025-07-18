<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client; 
use App\Models\User;
use App\Models\VoterReview;

use App\Models\HomeownerInformation;
class SMSController extends Controller
{
    public function SMSList()
    { 
        return view('champion/smslist');
    }

    public function SendSmsAll(Request $request)
    { 
         if($request->all_users){
            $message_f_name = $request->all_users_sms;
            $jobs = User::where('phone_number' ,'!=' ,null)->groupBy('phone_number')->get();
            if($request->file('profile_all_user')){
                $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/sms_images/';
                $profile = $request->file('profile_all_user');
                $fileName = time() . '.' . $profile->getClientOriginalExtension();
                $profile->move($folderPath, $fileName);
                $final_url = env('ADMIN_URL') . "sms_images/".$fileName;
                foreach($jobs as $winner ){    
                    $first_name_users =  str_replace("first_name_users",$winner->first_name,$message_f_name);
                    $last_name_users =  str_replace("last_name_users",$winner->last_name,$first_name_users);
                    $receiverNumber = '+1'.$winner->phone_number;          
                    //$receiverNumber = '+918219631147';  
                     try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number, 
                            'body' => $last_name_users,
                            'mediaUrl' => $final_url  
                        ]);
                    } catch (\Exception $e) {
                        \Log::info("Send_SMS_to_ALL_useres: ". $e->getMessage());
                    }
                    \Log::info($receiverNumber);
                    \Log::info($last_name_users); 
                }
            } else {
                foreach($jobs as $winner ){    
                    $first_name_users =  str_replace("first_name_users",$winner->first_name,$message_f_name);
                    $last_name_users =  str_replace("last_name_users",$winner->last_name,$first_name_users);
                    $receiverNumber = '+1'.$winner->phone_number;          
                    //$receiverNumber = '+918219631147';   
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number, 
                            'body' => $last_name_users]);
                    } catch (\Exception $e) {
                        \Log::info("Send_SMS_to_ALL_useres: ". $e->getMessage());
                    }
                    \Log::info($receiverNumber);
                    \Log::info($last_name_users);
                } 
            }
            
            return back()->with('success', 'SMS Send Successfully!');
        }  


        if($request->all_homeowners){
            $message_f_name = $request->all_homeowners_sms;   
            $jobs = HomeownerInformation::where(['homeowner'=>'1', 'status'=>'1'])->groupBy('homeowner_phone')->get(); 
            if($request->file('profile_homeowner_all')){
                $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/sms_images/';
                $profile = $request->file('profile_homeowner_all');
                $fileName = time() . '.' . $profile->getClientOriginalExtension();
                $profile->move($folderPath, $fileName);
                $final_url = env('ADMIN_URL') . "sms_images/".$fileName;
                foreach($jobs as $winner ){  
                    $first_name_homeowner =  str_replace("first_name_homeowner",$winner->homeowner_first_name,$message_f_name);
                    $last_name_homeowner =  str_replace("last_name_homeowner",$winner->homeowner_last_name,$first_name_homeowner);
                    $address_homeowner =  str_replace("address_homeowner",$winner->homeowner_location,$last_name_homeowner);
                    $contest_link_homeowner =  str_replace("contest_link_homeowner",env("APP_URL")."single-entry/".base64_encode($winner->id),$address_homeowner);        
                    //$receiverNumber = '+918219631147';
                    $receiverNumber = '+1'.$winner->homeowner_phone;     
                     try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number, 
                            'body' => $contest_link_homeowner,
                            'mediaUrl' => $final_url  
                        ]);
                    } catch (\Exception $e) {
                        \Log::info("Send_SMS_to_ALL_homeowners: ". $e->getMessage());
                    } 
                    \Log::info($receiverNumber);
                    \Log::info($contest_link_homeowner);
                }
            } else{
                foreach($jobs as $winner ){  
                    $first_name_homeowner =  str_replace("first_name_homeowner",$winner->homeowner_first_name,$message_f_name);
                    $last_name_homeowner =  str_replace("last_name_homeowner",$winner->homeowner_last_name,$first_name_homeowner);
                    $address_homeowner =  str_replace("address_homeowner",$winner->homeowner_location,$last_name_homeowner);
                    $contest_link_homeowner =  str_replace("contest_link_homeowner",env("APP_URL")."single-entry/".base64_encode($winner->id),$address_homeowner);        
                    //$receiverNumber = '+918219631147';
                    $receiverNumber = '+1'.$winner->homeowner_phone;     
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number, 
                            'body' => $contest_link_homeowner]);
                    } catch (\Exception $e) {
                        \Log::info("Send_SMS_to_ALL_homeowners: ". $e->getMessage());
                    } 
                    \Log::info($receiverNumber);
                    \Log::info($contest_link_homeowner);
                }
            }
            return back()->with('success', 'SMS Send Successfully!');
        } 

        if($request->all_nominators){
            $message_f_name = $request->all_nominators_sms;
            $jobs = HomeownerInformation::where(['homeowner'=>'2', 'status'=>'1'])->get();
            if($request->file('profile_nominator_all')){
                $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/sms_images/';
                $profile = $request->file('profile_nominator_all');
                $fileName = time() . '.' . $profile->getClientOriginalExtension();
                $profile->move($folderPath, $fileName);
                $final_url = env('ADMIN_URL') . "sms_images/".$fileName;
                foreach($jobs as $winner ){    
                    $first_name_nominator =  str_replace("first_name_nominator",$winner->nominator_first_name,$message_f_name);
                    $last_name_nominator =  str_replace("last_name_nominator",$winner->nominator_last_name,$first_name_nominator);
                    $address_nominator =  str_replace("address_nominator",$winner->nominator_location,$last_name_nominator);
                    $contest_link_nominator =  str_replace("contest_link_nominator",env("APP_URL")."single-entry/".base64_encode($winner->id),$address_nominator);   
                    $receiverNumber = '+1'.$winner->nominator_phone;     
                    //$receiverNumber = '+918219631147';     
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number, 
                            'body' => $contest_link_nominator,
                            'mediaUrl' => $final_url  
                        ]);
                    } catch (\Exception $e) {
                        \Log::info("Send_SMS_to_ALL_nominator: ". $e->getMessage());
                    }
                    \Log::info($receiverNumber);
                    \Log::info($contest_link_nominator);
                }
            } else {
                foreach($jobs as $winner ){    
                    $first_name_nominator =  str_replace("first_name_nominator",$winner->nominator_first_name,$message_f_name);
                    $last_name_nominator =  str_replace("last_name_nominator",$winner->nominator_last_name,$first_name_nominator);
                    $address_nominator =  str_replace("address_nominator",$winner->nominator_location,$last_name_nominator);
                    $contest_link_nominator =  str_replace("contest_link_nominator",env("APP_URL")."single-entry/".base64_encode($winner->id),$address_nominator);   
                    $receiverNumber = '+1'.$winner->nominator_phone;     
                    //$receiverNumber = '+918219631147';     
                    try {
                        $account_sid = getenv("TWILIO_SID");
                        $auth_token = getenv("TWILIO_TOKEN");
                        $twilio_number = getenv("TWILIO_FROM");
                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number, 
                            'body' => $contest_link_nominator]);
                    } catch (\Exception $e) {
                        \Log::info("Send_SMS_to_ALL_nominator: ". $e->getMessage());
                    }
                    \Log::info($receiverNumber);
                    \Log::info($contest_link_nominator);
                }
            }
            return back()->with('success', 'SMS Send Successfully!');
        }

        if($request->all_voters){
           

            $message_f_name = $request->all_voters_sms;
            $jobs = VoterReview::groupBy('reported_by')->get();
            
            if($request->file('profile_voter_all')){
                $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/sms_images/';
                $profile = $request->file('profile_voter_all');
                $fileName = time() . '.' . $profile->getClientOriginalExtension();
                $profile->move($folderPath, $fileName);
                $final_url = env('ADMIN_URL') . "sms_images/".$fileName;
                foreach($jobs as $job){
                    $SendSms = User::where('id',$job->reported_by)->where('phone_number' ,'!=' ,null)->get();
                    foreach($SendSms as $sms){
                        $first_name_voter =  str_replace("first_name_voter",$sms->first_name,$message_f_name);
                        $last_name_voter =  str_replace("last_name_voter",$sms->last_name,$first_name_voter);
                        //$receiverNumber = '+918219631147';        
                        $receiverNumber = '+1'.$sms->phone_number;     
                         try {
                            $account_sid = getenv("TWILIO_SID");
                            $auth_token = getenv("TWILIO_TOKEN");
                            $twilio_number = getenv("TWILIO_FROM");
                            $client = new Client($account_sid, $auth_token);
                            $client->messages->create($receiverNumber, [
                                'from' => $twilio_number, 
                                'body' => $last_name_voter,
                                'mediaUrl' => $final_url  
                            ]);
                        } catch (\Exception $e) {
                            \Log::info("Send_SMS_to_ALL_voter: ". $e->getMessage());
                        }
                        \Log::info($receiverNumber);
                        \Log::info($last_name_voter);
                    }
                }
            } else {
                foreach($jobs as $job){
                    $SendSms = User::where('id',$job->reported_by)->where('phone_number' ,'!=' ,null)->get();
                    foreach($SendSms as $sms){
                        $first_name_voter =  str_replace("first_name_voter",$sms->first_name,$message_f_name);
                        $last_name_voter =  str_replace("last_name_voter",$sms->last_name,$first_name_voter);
                        //$receiverNumber = '+918219631147';        
                        $receiverNumber = '+1'.$sms->phone_number;     
                         try {
                            $account_sid = getenv("TWILIO_SID");
                            $auth_token = getenv("TWILIO_TOKEN");
                            $twilio_number = getenv("TWILIO_FROM");
                            $client = new Client($account_sid, $auth_token);
                            $client->messages->create($receiverNumber, [
                                'from' => $twilio_number, 
                                'body' => $last_name_voter]);
                        } catch (\Exception $e) {
                            \Log::info("Send_SMS_to_ALL_voter: ". $e->getMessage());
                        }
                        \Log::info($receiverNumber);
                        \Log::info($last_name_voter);
                    }
                }
            }
        

            return back()->with('success', 'SMS Send Successfully!');
        } 
        

    }
    
}
