<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;
use App\Models\HomeownerInformation;

class WinnerHome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winner:home';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used for send sms in the end of year to announce the winner of chrismas home';

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

        return false; /// comment to enable this cron  
        $users = HomeownerInformation::where('status', '1')->get()->sortByDesc('avg_rate')->take(1);

        foreach ($users as $winner) {
            if ($winner->homeowner == '1') {
                //send congirmation sms
                $receiverNumber = '+1' . $winner->homeowner_phone;
                //$message = $request->path;
                $message = "Congratulations, " . $winner->homeowner_first_name . "! Your nominated home in " . $winner->homeowner_location . " is the champion for this year's Holiday Home Hunt. We will contact you shortly to inform you of how to claim your rewards. Thank you for joining Atlanta's Holiday Home Hunt!";
                try {
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");

                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message
                    ]);
                    info('SMS Sent Successfully.');
                } catch (Exception $e) {
                    dd("Error: " . $e->getMessage());
                }
            } else {
                $winner->nominator_phone;

                //send congirmation sms
                $receiverNumber = '+1' . $winner->nominator_phone;
                //$message = $request->path;
                $message = "Congratulations, " . $winner->nominator_first_name . "! Your nominated home in " . $winner->nominator_location . " is the champion for this year's Holiday Home Hunt. We will contact you shortly to inform you of how to claim your rewards. Thank you for joining Atlanta's Holiday Home Hunt!";
                try {
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");

                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($receiverNumber, [
                        'from' => $twilio_number,
                        'body' => $message
                    ]);
                    info('SMS Sent Successfully.');
                } catch (Exception $e) {
                    dd("Error: " . $e->getMessage());
                }
            }
            \Log::info($winner->nominator_phone);
        }
    }
}
