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
use Carbon\Carbon;
use Auth , Session , DB, Log;

class UserController extends Controller
{
    //Users List
   public function usersList()
        {
         if (Auth::user()->can('view_user'))
        {

         $usersList = User::orderBy('id', 'DESC')->get();
         return view('users/list', compact('usersList'));
        }
        else
        {
         return redirect()->route('dashboard')
         ->with('warning', 'You do not have permission for this action!');
        }
        }

 
    //User Delete
    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        if($user->delete()){
            return "success";
        }else{
            return "failure";
        }
    }

    //User Ban
    public function banUser(Request $request)
    {

        $user = User::find($request->id);
        if($user){
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
        }else{
            return response()
                    ->json(['status' => 'false', 'success' => 0]);
        }
    }

    
    public function deleteProfileImage(Request $request)
    {
        $user = User::where('id', $request->user_id)
            ->first();
  
        if ($user)
        {
            $user->profile_picture = null;
            if ($user->save())
            {
                return response()
                    ->json(['status' => 'true', 'success' => 1]);
            }
            else
            {
                return response()
                    ->json(['status' => 'true', 'success' => 0]);
            }
        }
        else
        {
            return response()
                ->json(['status' => 'true', 'success' => 0]);
        }
    }
   

   //Add user

    public function addUser(){
         $destination = Destination::where('dest_status','1')->get();
         $ethnicity = Ethnicity::get();
         $interests = Interest::get(); 
         return view('users/add',compact('destination','ethnicity','interests'));
    }



   
 //User Email check
    public function checkUserEmail(Request $request) {
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

    public function saveUser(Request $request){
     
      
         
         if ($request->hasFile('profile_picture'))
            {
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
            $user->ethinicity = $request->ethinicity ;
            $user->sexual_orientation = $request->sexual_orientation ;
            $user->skin_color = $request->skin_color ;
            $user->body_type = $request->body_type ;
            $user->height = $request->height ;
            $user->weight = $request->weight ;
            $user->bio = $request->bio; 
            $user->profile_updated_from = '0';
            $user->is_email_verified = '1';
            $user->email_verified_at = Carbon::now();
            if ($request->hasFile('profile_picture'))
            {
                $user->profile_picture = $fileName;
            }
            else
            {
                $user->profile_picture = null;
            }
                 $user->save();
                $user->id;
 
        if($request->interest){
            foreach($request->interest as $interests){
            $interest =  new UserInterest;
            $interest->user_id = $user->id;
            $interest->interest_id = $interests;
            $interest->save();
        }
    }

        if($request->destination){
            foreach($request->destination as $destinations){
            $interest =  new UserDestination;
            $interest->user_id = $user->id;
            $interest->dest_id = $destinations;
            $interest->save();
        }
    }
            // Log::info($this->saveInterest($request->interest,$user->id));
             
            Session::put('current_user_id', $user->id);
         
         return "success";
            // return redirect()
            //     ->route('user_list')
            //     ->with('success', 'User Added  successfully'); 

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

    public function storeImage(Request $request){
         
 
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
        if (Auth::user()->can('view_user'))
        { 
            $destination = Destination::get();
            $ethnicity = Ethnicity::get();

        $users = User::with('userImages:user_id,image_name','userdestination','userinterest')->find($id);
             

            return view('users/view', compact('users','destination','ethnicity'));
        }
        else
        {
            return redirect()->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }

    } 

    //edit User
    public function editUser($id)
    {
        if (Auth::user()->can('edit_user'))
        {    
            $destination = Destination::where('dest_status','1')->get();
            $interests=Interest::get();
            $ethnicity = Ethnicity::get();
           $editUser = User::with('userImages:user_id,image_name','userdestination','userinterest')->find($id);

             $user_images = $editUser->userImages->toArray();


            return view('users/edit', compact('editUser','user_images','destination','ethnicity','interests'));
        }
        else
        {
            return redirect()->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    //update User
    public function updateUser(Request $request)
    {
      
        if (Auth::user()->can('edit_user'))
        { 
            Log::info($request->all());

           //  $response = DB::transaction(function () use (
           //  $request
           // ) {

            $profile = $request->file('profile_picture');

            if ($request->file('profile_picture'))
            {
                $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/' . env('API_END_PROJECT_NAME') . "/public/user_profile_images/";

                $profile = $request->file('profile_picture');
                $fileName = time() . '.' . $profile->getClientOriginalExtension();

                $profile->move($folderPath, $fileName);
               
            }

            $user = User::find($request->user_id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->country_code = $request->country_code;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            // $user->destination = implode(",",$request->destination);
            $user->preferred_lang = $request->preferred_lang;
            $user->ethinicity = $request->ethinicity ;
            $user->sexual_orientation = $request->sexual_orientation ;
            $user->skin_color = $request->skin_color ;
            $user->body_type = $request->body_type ;
            $user->height = $request->height ;
            $user->weight = $request->weight ;
            $user->bio = $request->bio; 
            $user->user_locked = isset($request->status) ? '0' : '1';
            $user->user_locked_at = isset($request->status) ? null : Carbon::now();
            $user->profile_updated_from = '0';
            if ($request->file('profile_picture'))
            {
                $user->profile_picture = $fileName;
            }
            else
            {
                $user->profile_picture = null;
            }
             $user->save();

      if($request->interest){
        UserInterest::where('user_id',$request->user_id)->forceDelete(); 
            foreach($request->interest as $interests){
            $interest =  new UserInterest;
            $interest->user_id = $request->user_id;
            $interest->interest_id = $interests;
            $interest->save();
        }
     }
        if($request->destination){
         UserDestination::where('user_id',$request->user_id)->forceDelete();            
          foreach($request->destination as $destinations){
            $destination =  new UserDestination;
            $destination->user_id = $request->user_id;
            $destination->dest_id = $destinations;
            $destination->save();
        }
        
       
    }


           $userImage = UserImage::where(
                'user_id',
                $request->user_id
            )->forceDelete();



            $old_images_old = explode("--", $request->old_images_name);
            for (
                $i = 0;
                $i < count(explode("--", $request->old_images_name)) - 1;
                $i++
            ) {
                $userImage = UserImage::create([
                    'user_id' => $request->user_id,
                    'image_name' => $old_images_old[$i],
                    'image_updated_from' => '1'
                     
                ]);

               
            }
            
             Session::put('current_user_id', $request->user_id);
           
            // }); 
            return  "success";




        }
        else
        {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }

    }


    public function updateImage(Request $request){
      
           
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





    //deletedUsersList
    public function deletedUsersList()
    {

        if (Auth::user()
            ->can('view_deleted_users'))
        {
            $usersList = User::onlyTrashed()->get();
            return view('users/deleted_users_list', compact('usersList'));
        }
        else
        {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'You do not have permission for this action!');
        }
    }

    //Restore User
    public function restoreUser(Request $request)
    {
        $usersList = User::withTrashed()->find($request->id)
            ->restore();
        return "success";
    }

    //Permanent Delete User
    public function permanentDeleteUser(Request $request)
    {
        $usersList = User::onlyTrashed()->find($request->id)
            ->forceDelete();
        return "success";
    }

}

