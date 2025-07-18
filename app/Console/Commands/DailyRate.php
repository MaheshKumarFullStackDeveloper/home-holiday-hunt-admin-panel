<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HomeownerInformation;
use App\Models\VoterReview;
use App\Models\HomeownerInformationPics;
use DB;
use Twilio\Rest\Client; 
use \Carbon\Carbon;
class DailyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to send daily sms to user and show ranking';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = HomeownerInformation::where('status','1')->get()->sortByDesc('avg_rate');
        $Year = Carbon::now()->format('Y');
        $currentyearall= HomeownerInformation::with(['reviews'=>function($query) use ($Year){
            $query->whereYear('created_at', $Year);
  }])->withCount('reviews')->orderBy('reviews_count', 'desc')->whereHas('reviews')->get()->sortByDesc('winner_old');

        $i = 0;
        foreach($currentyearall as $winner ){
            $i++;
            if($winner->homeowner == '1'){
                //send congirmation sms
                $receiverNumber = '+1'.$winner->homeowner_phone;
                //$message = $request->path;
                $message = "Your holiday home in ".$winner->homeowner_location." is sitting at ".$i."th place! Share your home ".$winner->home_key_val." entry to your friends now to get ratings: ".env("APP_URL")."single-entry/".base64_encode($winner->id)."?popup=share";
               /*  try {
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");
            
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number, 
                        'body' => $message]);
                    //    dd('SMS Sent Successfully.');
            
                } catch (\Exception $e) {
                    \Log::info("Twilio_Error: ". $e->getMessage());
		        } */ 
            } else {
                
                 //send congirmation sms
                 $receiverNumber = '+1'.$winner->nominator_phone;

                 $message = "Your holiday home in ".$winner->nominator_location." is sitting at ".$i."th place! Share your home entry to your friends now to get ratings: ".env("APP_URL")."single-entry/".base64_encode($winner->id)."?popup=share";

                 /* try {
                     $account_sid = getenv("TWILIO_SID");
                     $auth_token = getenv("TWILIO_TOKEN");
                     $twilio_number = getenv("TWILIO_FROM");
             
                     $client = new Client($account_sid, $auth_token);
                     $client->messages->create($receiverNumber, [
                         'from' => $twilio_number, 
                         'body' => $message]);
                 //    dd('SMS Sent Successfully.');
             
                 } catch (\Exception $e) {
                    \Log::info("Twilio_Error: ". $e->getMessage());
		         }  */
            }
                
              \Log::info($receiverNumber);
              \Log::info($message);
              \Log::info($winner->home_key_val);
             
        }

      
    }
}
