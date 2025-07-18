<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;
use App\Models\User;
use App\Models\VoterReview;
use Carbon\Carbon;
use Auth , Session , DB, Log, Hash,Notification;;
class VoterController extends Controller
{
   
        //Users List
    public function usersList($searchqueryyear=null)
    {
        if (Auth::user()->can('view_user'))
        {

            /* if($searchqueryyear == null){
                $searchqueryyear = Carbon::now()->format('Y');
            } */

            if(Session::get('years_data') == ''){
                $searchqueryyear = Carbon::now()->format('Y');
            } else {
                $searchqueryyear = Session::get('years_data');
            }

        //$usersList = Voter::orderBy('id', 'DESC')->get();
        $usersList = User::orderBy('id', 'DESC')->whereYear('created_at', $searchqueryyear)->get();
        $csv_list = VoterReview::with('reported_by_user','reported_to_user')->whereYear('created_at', $searchqueryyear)->get();
        return view('voter/list', compact('usersList', 'csv_list','searchqueryyear'));
        }
        else
        {
        return redirect()->route('dashboard')
        ->with('warning', 'You do not have permission for this action!');
        }
    }


      // View User
      public function viewUser($id)
      {
          if (Auth::user()->can('view_user'))
          { 
            
            
        //    $users = Voter::with('voterreview' , 'voterreview.user')->find($id);
            $users = User::with('voterreview' , 'voterreview.user')->find($id);
          //  $users = User::find($id);
            
            // $users = Voter::find($id);
               
  
              return view('voter/view', compact('users'));
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
            //dd($request);
            $user = User::find($request->id);
            if($user->delete()){
                return "success";
            }else{
                return "failure";
            }
        }


        //deletedUsersList
        public function deletedUsersList()
        {

            if (Auth::user()
                ->can('view_deleted_users'))
            {
                $usersList = User::onlyTrashed()->get();
                //dd($usersList);
                return view('voter/deleted_users_list', compact('usersList'));
            }
            else
            {
                return redirect()
                    ->route('dashboard')
                    ->with('warning', 'You do not have permission for this action!');
            }
        }

        //Permanent Delete User
        public function permanentDeleteUser(Request $request)
        {
            $usersList = User::onlyTrashed()->find($request->id)
                ->forceDelete();
            return "success";
        }

        //Restore User
        public function restoreUser(Request $request)
        {
            $usersList = User::withTrashed()->find($request->id)
                ->restore();
            return "success";
        }
}
