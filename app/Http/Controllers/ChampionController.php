<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeownerInformation;
use App\Models\VoterReview;
use App\Models\HomeownerInformationPics;
use App\Models\VoterReport;
use App\Models\ReportedIssue;

use DB , Session;
use \Carbon\Carbon;

class ChampionController extends Controller
{


	public function championList($search=null){


		/* if($search == null){
			$Year = Carbon::now()->format('Y');
		}else{
			$Year = $search;
		} */
		if(Session::get('years_data') == ''){
            $Year = Carbon::now()->format('Y');
        } else {
            $Year = Session::get('years_data');
        }

	  // $currentyeardata = HomeownerInformation::with(['reviews'=>function($query) use ($Year){
			//   				$query->whereYear('created_at', $Year);
			// 		}])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->first();
	  // dd($currentyeardata->userImages[0]->image);
	  // $previous_year_data = HomeownerInformation::with('reviews')->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->get()->groupBy(function($val) {
	  //         return Carbon::parse($val->created_at)->format('Y');
	  // });

	 		$currentyeardata = HomeownerInformation::with(['reviews'=>function($query) use ($Year){
			  				$query->whereYear('created_at', $Year);
					}])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->whereYear('created_at', $Year)->first();

				$currentyearall= HomeownerInformation::with(['reviews'=>function($query) use ($Year){
						$query->whereYear('created_at', $Year);
				  }])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->whereYear('created_at', $Year)->get()->sortByDesc('winner');	
		
				  $winnerrr= HomeownerInformation::with(['reviews'=>function($query) use ($Year){
					$query->whereYear('created_at', $Year);
			  }])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->whereYear('created_at', $Year)->get()->sortByDesc('winner')->take(1);	

			  //testing
			  $currentyearall_old= HomeownerInformation::with(['reviews'=>function($query) use ($Year){
				$query->whereYear('created_at', $Year);
		  }])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->whereYear('created_at', $Year)->get()->sortByDesc('winner_old');	

		  $winnerrr_old= HomeownerInformation::with(['reviews'=>function($query) use ($Year){
			$query->whereYear('created_at', $Year);
	  }])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->whereYear('created_at', $Year)->get()->sortByDesc('winner_old')->take(1);	






			$previous_year_data = HomeownerInformation::with('reviews')->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->whereYear('created_at', $Year)->get()->groupBy(function($val) {
					return Carbon::parse($val->created_at)->format('M-Y');
			});
	//    dd($previous_year_data->reverse());

   	 return view('champion.list',compact('previous_year_data','currentyeardata','search' ,'currentyearall','winnerrr','winnerrr_old','currentyearall_old'));

	
	}



	    // View User
		public function viewUser($id)
		{
			
			
				
				$users = HomeownerInformation::with(['reviews'=>function($query) use ($Year){
					$query->whereYear('created_at', $Year);
		  }])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->find($id); 
		   
			 // $users = HomeownerInformation::with('userImages')->find($id);
			 // $md_dropdown = MdDropdowns::where('slug','home_status')->get();
			   // dd($users);
			 
				return view('users/view', compact('users'));
			
	
		} 


		public function reportList($search=null){
			if(Session::get('years_data') == ''){
				$Year = Carbon::now()->format('Y');
			} else {
				$Year = Session::get('years_data');
			}

			$usersList = VoterReport::with('reported_to_user','reported_by_user','review_id_user')->whereYear('created_at', $Year)->get();
			return view('champion.reportlist', compact('usersList'));
		}
	

		public function issueReport(){
			if(Session::get('years_data') == ''){
				$Year = Carbon::now()->format('Y');
			} else {
				$Year = Session::get('years_data');
			}
			$usersList = ReportedIssue::whereYear('created_at', $Year)->get();
			return view('champion.report_issue', compact('usersList'));
		}

		public function issueDetail(int $id){
			$entries = new ReportedIssue(); 
			$entry = $entries->where('id', $id)->get();
	  
			echo json_encode($entry);
		  }
		
		public function deleteIssueReport(Request $request){
			
			$user = ReportedIssue::find($request->id);
            if($user->delete()){
                return "success";
            }else{
                return "failure";
            }
		}

		public function changeIssueReport(Request $request){
			if($request->status_value == 1)
			{
				$status = ReportedIssue::where('id',$request->id)->first();
				$status->status = '1';
				$status->save();
				return response()->json(['status' =>'success','message'=>"Resolved"]); 
			}
			else{
				$status = ReportedIssue::where('id',$request->id)->first();
				$status->status = '0';
				$status->save();
				return response()->json(['status' =>'success','message'=>"Pending"]);
			} 
		}
		

		public function deleteReport(Request $request)
        {
           
            $user = VoterReport::find($request->id);

            $user1 = VoterReview::find($user->review_id);
			
			if($user1->delete()){
				$user3 = VoterReport::where('review_id' , $user->review_id)->get();
				foreach($user3 as $del_review){
					$del_review->delete();
				}
				return "success";
			}else{
                return "failure";
            } 
             
        }



}

