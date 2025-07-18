<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Exception;
use Hash;
use Auth;

use App\Models\User;
use App\Models\News;
use App\Models\MdCountry;
use App\Models\MdDropdown;
use App\Models\CountryNews;
use App\Models\Story;
use App\Models\PaymentTransaction;
use Log;

class NewsController extends Controller
{
    public function newsList(){
   
        if(Auth::user()->can('manage_news_action')) {
            $stories = Story::orderBy('publish_at','DESC')->get();
            return view('news/list')->with('stories', $stories);
        }
        else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

	public function addNews() {

        $countries = MdCountry::all();
        $first_covers = MdDropdown::where('slug','first_cover')->get();
        $other_covers = MdDropdown::where('slug','other_cover')->get();

		if(Auth::user()->can('add_news')) {
			return view('news/add')->with(['countries'=>$countries,'first_covers'=>$first_covers,'other_covers'=>$other_covers]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	public function saveNews(Request $request) {

        // return $request->news_source_website_image_2;
        // $users = User::with('schoolusers')->where('user_type','school')->get();
        //             foreach($users as $key => $user){
        //                 $paymenttransactions = PaymentTransaction::where([
        //                     ['user_id','=',$user->id]
        //                 ])->first();
        //                 if(!empty($paymenttransactions)){

        //                     $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $paymenttransactions->created_at)->addYear();
        //                     $date2 = Carbon::createFromFormat('Y-m-d H:i:s', now());
        //                     if($date1->gt($date2)){
        //                         foreach($user->schoolusers as $data){
        //                             if($user->id==$data->school_id){
        //                                 $school_user = User::find($data->user_id);

        //                                 if($school_user->fcm_token!=null){
                                   
        //                                      $this->sendNotification($school_user->fcm_token, $user->school_name." added a news");
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //             die;

        $publish_at = \DateTime::createFromFormat('d/m/y', $request->news_publish_datetime);

        $randomString = \Str::random(6).time();

        $story = New Story;
        $story->story_reference_id = $randomString;
        $story->publish_at = $publish_at->format('Y-m-d');

        if($story->save()){
            for ($i=1; $i <=3 ; $i++) { 
                $news = new News;
                $news->story_id = $story->id;
                $news->news_title = $request->get('news_title_'.$i);
                $news->news_description = $request->get('news_description_'.$i);
                $news->news_source_website_url = $request->get('news_source_website_url_'.$i);
                $news->news_publish_datetime = $publish_at->format('Y-m-d');

                $news->news_main_image = $request->get('cover_image_'.$i);
                
                if($request->get('source_logo_'.$i)!=null && $request->get('source_logo_'.$i)!='null'){

                    $news_source_website_image = upload_base64_image($request->get('source_logo_'.$i), 'news'); 

                }else{
                    $news_source_website_image = upload_new_image($request->file('news_source_website_image_'.$i), 'news'); 
                }

                $news->news_source_website_image = $news_source_website_image;
                // second image

                if($news->save()){
                    foreach($request->countries as $country){
                        foreach($request->get('timezones_'.$country) as $timezone){
                            $country_news = new CountryNews;
                            $country_news->news_id = $news->id;
                            $country_news->country_id = $country;
                            $country_news->timezone_id = $timezone;
                            $country_news->save();
                        }

                    }
                    $users = User::with('schoolusers')->where('user_type','school')->get();
                    foreach($users as $key => $user){
                        $paymenttransactions = PaymentTransaction::where([
                            ['user_id','=',$user->id]
                        ])->first();
                        if(!empty($paymenttransactions)){

                            $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $paymenttransactions->created_at)->addYear();
                            $date2 = Carbon::createFromFormat('Y-m-d H:i:s', now());
                            if($date1->gt($date2)){
                                foreach($user->schoolusers as $data){
                                    if($user->id==$data->school_id){
                                        $school_user = User::find($data->user_id);

                                        if($school_user->fcm_token!=null){

                                             $this->sendNotification($school_user->fcm_token, $user->school_name." added a news");
                                        }
                                    }
                                }
                            }
                        }
                    }


                }
            }
            return redirect()->route('news_list')->with('success','The News have been added successfully!');
        }else{
            return redirect()->back()->with('warning','Something went wrong!');
        }
	}
        
    public function fetchCountriesList(Request $request){

        $term = $request->post('search');
        $md_countries = MdCountry::where('nicename','LIKE','%'.$term.'%')->get();

        $result = [];
        if($md_countries->isNotEmpty()){
            foreach($md_countries as $key => $value){
                $result[] = ['text' => $value->nicename, 'value' => $value->id];
            }
        }

        return json_encode($result);
    }   
   
    public function fetchSelectedCountriesList(Request $request){
        
        $selected_countries = CountryNews::where('news_id',$request->news_id)->pluck('country_id');
        $md_selected_countries = MdCountry::whereIn('id',$selected_countries)->get();
        $result = [];
        if($md_selected_countries->isNotEmpty()){
            foreach($md_selected_countries as $key => $value){
                $result[] = ['text' => $value->nicename, 'value' => $value->id];
            }
        }
        return json_encode($result);
    }   

    
    public function viewNews($id){

        if(Auth::user()->can('view_news')) {

            $story = Story::where('id', $id)->first();
            
            $countries_ids = [];

            foreach($story->news as $news){
                foreach($news->country_news->pluck('country_id') as $item){
                    array_push($countries_ids , $item);
                }
            }

            $countries_ids = array_values(array_unique($countries_ids));

            $countries = MdCountry::all();
            $cover_images = MdDropdown::where('slug','cover_image')->get();

            return view('news/view',['story'=>$story,'countries' => $countries,'cover_images'=>$cover_images,'countries_ids'=>$countries_ids]);

        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    
    }
    
	public function editNews(Request $request) {
		if(Auth::user()->can('edit_news')) {
            $story = Story::where('id',$request->id)->first();

            $countries_ids = [];

            foreach($story->news as $news){
                foreach($news->country_news->pluck('country_id') as $item){
                    array_push($countries_ids , $item);
                }
            }

            $countries_ids = array_values(array_unique($countries_ids));

            $countries = MdCountry::all();
            
            $first_covers = MdDropdown::where('slug','first_cover')->get();
            $other_covers = MdDropdown::where('slug','other_cover')->get();

			return view('news/edit',['story'=>$story,'countries' => $countries,'first_covers'=>$first_covers,'countries_ids'=>$countries_ids,'other_covers'=>$other_covers]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}
    
    public function updateNews(Request $request) {

        $story = Story::find($request->id);

        $publish_at = \DateTime::createFromFormat('d/m/y', $request->news_publish_datetime);

        $story->publish_at = $publish_at->format('Y-m-d');

        if($story->save()){
            for ($i=1; $i <=3 ; $i++) { 
                $news = News::where('id',$request->get('news_id_'.$i))->first();
                $news->story_id = $request->id;
                $news->news_title = $request->get('news_title_'.$i);
                $news->news_description = $request->get('news_description_'.$i);

                $news->news_source_website_url = $request->get('news_source_website_url_'.$i);

                $news->news_publish_datetime = $publish_at->format('Y-m-d');

                $news->news_main_image = $request->get('cover_image_'.$i);
                
                if($request->hasFile('news_source_website_image_'.$i)){

                    if($request->get('source_logo_'.$i)!=null && $request->get('source_logo_'.$i)!='null'){

                        $news_source_website_image = upload_base64_image($request->get('source_logo_'.$i), 'news'); 

                    }else{
                        $news_source_website_image = upload_new_image($request->file('news_source_website_image_'.$i), 'news'); 
                    }

                    // $news_source_website_image = upload_new_image($request->file('news_source_website_image_'.$i), 'news'); 
                    
                    $news->news_source_website_image = $news_source_website_image;
                }

                // second image

                if($news->save()){
                    CountryNews::where('news_id',$news->id)->delete();
                    foreach($request->countries as $country){
                        foreach($request->get('timezones_'.$country) as $timezone){
                            $country_news = new CountryNews;
                            $country_news->news_id = $news->id;
                            $country_news->country_id = $country;
                            $country_news->timezone_id = $timezone;
                            $country_news->save();
                        }

                    }
                }
            }
            return redirect()->route('news_list')->with('success','The News have been updated successfully!');
        }else{
            return redirect()->back()->with('warning','Something went wrong');
        }


	}
        
    
    
    public function deleteNews(Request $request){
        if(Auth::user()->can('delete_news')) {
            
            $news = Story::where('id', $request->id)->onlyTrashed()->delete();
    
               
                 // $news->news_story()->each(function($member){
                 //    $userTobDeleted[] = News::where('id', $member->news_id)->value('id');
                 //     $member->delete();
                 // });


       
          if($story){
                $trashedStory = story::destroy($request->id);

                if($trashedStory) {
                    $res['success'] = 1;
                    return json_encode($res);
                }
                else {
                    $res['success'] = 0;
                    return json_encode($res);
                }
            }else{
                $res['success'] = 0;
                return json_encode($res);
            }

        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }
    /*
    public function permanentWantsGroups(Request $request) {

        if(Auth::user()->can('permanent_delete_wants')) {

            $users = Want::where('id', $request->id)->onlyTrashed()->first();
            $deleteUsers = $users->forceDelete();

            if($deleteUsers) {
                $res['success'] = 1;
                return json_encode($res);
            }
            else {
                $res['success'] = 0;
                return json_encode($res);
            }
        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
*/
    public function deletedNews() {

        if(Gate::check('restore_news') || Gate::check('permanent_delete_news')){
         
            // $news = Story::onlyTrashed()->orderBy('id')->get();
            $news = News::onlyTrashed()->orderBy('id')->get();
           

            return view('news/deleted_list', ['news' => $news]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function restoreNews(Request $request){
            $news = Story::where('id', $request->id)->onlyTrashed()->first();
            $story=News::where('store_id',$request_id)->onlyTrashed()->first();
            
            $restoreNews = $news->restore();
            if($news) {
                $newsList = News::all();
                $res['success'] = 1;
                $res['data'] = $newsList;
                return json_encode($res);
            }
            else {
                $res['success'] = 0;
                return json_encode($res);
            }
       
    }


    public function permanentDeleteNews(Request $request) {

            $news = Story::where('id', $request->id)->onlyTrashed()->first();

            $deleteNews = $news->forceDelete();

            if($deleteNews) {
                $res['success'] = 1;
                return json_encode($res);
            }
            else {
                $res['success'] = 0;
                return json_encode($res);
            }

       
    }

    public function sendNotification($device_token, $message)
    {
    
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmKey = env('FCM_SERVER_KEY');

      
        $data = [
            "registration_ids" => array($device_token),
            "notification" => [
                "title" => 'Notification',
                "body" => $message,  
            ]
        ];

        $RESPONSE = json_encode($data);
 
        $headers = [
            'Authorization:key=' . $FcmKey,
            'Content-Type: application/json',
        ];
    
        // CURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $RESPONSE);

        $output = curl_exec($ch);
        if ($output === FALSE) {
            die('Curl error: ' . curl_error($ch));
        } 
         Log::info($output);      
        curl_close($ch);
        
   
    }
/*
    public function restoreWant(Request $request){
        if(Auth::user()->can('restore_wants')) {

            //echo"hi";die;
            $users = Want::where('id', $request->id)->onlyTrashed()->first();
            //print_r($users);die;
            $restoreUsers = $users->restore();
            if($users) {
                $usersList = Want::all();
                $res['success'] = 1;
                $res['data'] = $usersList;
                return json_encode($res);
            }
            else {
                $res['success'] = 0;
                return json_encode($res);
            }
        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }


    public function restoreReportedWantDiscussion(Request $request){
        if(Auth::user()->can('restore_wants_discussion_reported')) {
          
            $users = WantDiscussion::where('id', $request->id)->onlyTrashed()->first();
            $restoreUsers = $users->restore();

            if($users) {
                $usersList = WantDiscussion::all();
                $res['success'] = 1;
                $res['data'] = $usersList;
                return json_encode($res);
            }
            else {
                $res['success'] = 0;
                return json_encode($res);
            }
        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    
    public function deletedReportedWantsDiscussionList() {

        if(Auth::user()->can('manage_recycle_bin_wants_discussion_reported')) {

            $reportedDiscussion = DiscussionReport::selectRaw('discussion_reports.*,want_discussions.reference_id as discussions_reference_id,wants.reference_id as want_reference_id')->onlyTrashed()
            ->join('want_discussions', 'discussion_reports.want_discussion_id', '=', 'want_discussions.id')
            ->leftJoin('wants', 'wants.id', '=', 'want_discussions.want_id')
            ->get();
            
            return view('wants/deleted_reported_wants_discussion_list', ['reportedDiscussion' => $reportedDiscussion]);
        }
        else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function permanentDeleteReportedWantsDiscussion(Request $request) {

        if(Auth::user()->can('permanent_delete_wants_discussion_reported')) {

            $users = WantDiscussion::where('id', $request->id)->onlyTrashed()->first();

            $deleteUsers = $users->forceDelete();

            if($deleteUsers) {
                $res['success'] = 1;
                return json_encode($res);
            }
            else {
                $res['success'] = 0;
                return json_encode($res);
            }

        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    

    public function viewWant($id){

        if(Auth::user()->can('view_want')) {

            $want = Want::where('id', $id)->with("wantDiscussion","wantDiscussion.discussion","rankHistory")->first();
            //echo "<pre>";print_r($want->toArray());die;
            $wantVote = WantVote::where('want_id', $id)->count();
            $discussion = WantDiscussion::where('want_id', $id)->orderBy('id', 'Desc')->get()->toArray();
            $wantVotes = WantVote::where('want_id', $id)->with('user_info')->get()->toArray();
            //echo"<pre>";print_r($wantVotes);die;
            $wantVoteRes = WantDiscussion::selectRaw('discussion_votes.user_id,want_discussions.reference_id,discussion_votes.created_at,users.email')
                ->join('discussion_votes', 'want_discussions.id', '=', 'discussion_votes.want_discussion_id')
                ->leftJoin('users', 'users.id', '=', 'discussion_votes.user_id')
                ->where('want_id', $id)
                ->get();

            $wantStatus = UserWantStatus::where('want_id', $id)->orderBy('id', 'Desc')->get()->toArray();

            $wantWires = WantWired::where('want_id', $id)->get()->toArray();
            $wantWiredToUser = WantWiredToUser::where('want_id', $id)->get()->toArray();


            //echo"<pre>";print_r($wantStatus);die;
            return view('wants.view', ['want' => $want, 'wantVote' => $wantVote,'discussion'=> $discussion,'wantVoteRes'=>$wantVoteRes, 'wantStatus' => $wantStatus, 'wantVotes' => $wantVotes, 'wantWires' => $wantWires, 'wantWiredToUser' => $wantWiredToUser]);
        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }    
    
    }
   */
/*
    public function wiredUsers(Request $request){

        /*
        $wantWiredToUser = WantWiredToUser::where('want_id', $request->wantId)
                                            ->where('user_id', $request->userId)
                                            ->get()
                                            ->toArray();   
                                                 
        //$htmlResponse = "<tr><td>07/22/21</td><td>jone@gmail.com</td></tr><tr><td>07/22/21</td><td>jone@gmail.com</td></tr>";
        foreach ($wantWiredToUser as $key => $wantWired) {
            $date = date('m/d/y', strtotime($wantWired['created_at']));
            $user = User::where('id', $wantWired['wired_to'])->first();
            $email = $user->email;
            $htmlResponse[] = "<tr><td>$date</td><td>$email</td></tr>";
        }
        
        return json_encode($htmlResponse); */
/*
        $wantWiredToUser = WantWiredToUser::where('want_id', $request->wantId)
                        ->where('user_id', $request->userId)
                        ->get()
                        ->toArray();   

        return View::make("wants.ajaxUserWiredView")
        ->with("wantWiredToUser", $wantWiredToUser)
        ->render();
    }
*/
    /*
    public function editWant($id){

        if(Auth::user()->can('edit_want')) {
            $want = Want::where('id', $id)->first();
            return view('wants.edit', ['want' => $want]);	
        }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }  
    }

    public function updateWant(Request $request){

        $want = Want::where("id",$request->id)->first();
        $want->want_text = $request->want_text;
        //$group->description = $request->description;
        
        if($want->save()){
            return redirect()->route('want_list')->with('success', 'Want Updated Successfully!');
        }else{
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }*/
}
