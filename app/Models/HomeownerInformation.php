<?php

namespace App\Models;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class HomeownerInformation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'homeowner_information';
    protected $appends =  ["avg_rate","home_key_val","winner","bonus","avg_daily_review","winner_old","bonus_old"];

    public function userImages(){
        return  $this->hasMany(HomeownerInformationPics::class , 'user_id' , 'id');
      }

      public function getAvgRateAttribute()
      {
          $avg_rate_listing = VoterReview::select(\DB::raw("round(avg(rate_count),1) As rate_count"))
      ->where('reported_to',$this->id)->get();
          if($avg_rate_listing->count()){ 
              $overall_average_rating = round(collect(array_values($avg_rate_listing->toArray()[0]))->avg(),1);
              return $overall_average_rating;
          }else{
              return null;
          
          }
      }

      public function getHomeKeyValAttribute()
      {
         
          $Home_key = HomeKey::where('id',$this->home_key)->first();
         
          if($Home_key){
              return $Home_key->keyword;
          }else {
              return null;
          }
      }

      public function reviews(){
        return $this->hasMany(VoterReview::class,'reported_to');
      }


      public function getBonusOldAttribute(){
        if( $this->approved_at){
            $start_date = strtotime($this->approved_at);
            $end_date = strtotime("2022/12/28");
        }else{
            $start_date = strtotime("2022/12/28");
            $end_date = strtotime("2022/12/28");
        }
        $no_of_review = $this->reviews_count;
        $days_publish =  ($end_date - $start_date)/60/60/24;

         try {
            $avg_daily_review = $no_of_review/$days_publish;
            $result = $avg_daily_review*$days_publish;
            if($result){
                return $result;
            }else {
                return null;
            }
         }catch(\DivisionByZeroError $e){
           // echo "got $e";
         } catch(\ErrorException $e) {
           // echo "got $e";
         }
      }

      public function getAvgDailyReviewAttribute(){
        if( $this->approved_at){
            $start_date = strtotime($this->approved_at);
            $end_date = strtotime("2022/12/28");
        }else{
            $start_date = strtotime("2022/12/28");
            $end_date = strtotime("2022/12/28");
        }
        $no_of_review = $this->reviews_count;
        $days_publish =  ($end_date - $start_date)/60/60/24;
         try {
            $result = $no_of_review/$days_publish;
            if($result){
                return $result;
            }else {
                return null;
            }
         }catch(\DivisionByZeroError $e){
           // echo "got $e";
         } catch(\ErrorException $e) {
           // echo "got $e";
         }
    }
   
    public function getWinnerOldAttribute(){
        if( $this->approved_at){
            /* $date_expire = date("Y/m/d",strtotime($this->approved_at));   
            $date = new DateTime($date_expire);
            $now = new DateTime('2022/12/28'); */

            $start_date = strtotime($this->approved_at);
            $end_date = strtotime("2022/12/28");
        }else{
            /* $date = new DateTime('2022/12/28');
            $now = new DateTime('2022/12/28');  */

            $start_date = strtotime("2022/12/28");
            $end_date = strtotime("2022/12/28");
        }
        $no_of_review = $this->reviews_count;
       // $days_publish =  $date->diff($now)->format("%d");  
        $days_publish =  (($end_date - $start_date)/60/60/24);
       // print_r($days_publish);
         try {
            $avg_daily_review = $no_of_review/$days_publish;
            $bonus_per_day_not_publish = $avg_daily_review*$days_publish;
            $result = $bonus_per_day_not_publish+$bonus_per_day_not_publish;
            if($result){
                return $result;
            }else {
                return null;
            }
         }catch(\DivisionByZeroError $e){
           // echo "got $e";
         } catch(\ErrorException $e) {
           // echo "got $e";
         }
    }

    public function getBonusAttribute(){
        /* if( $this->approved_at){
            $start_date = strtotime($this->approved_at);
            $end_date = strtotime("2022/12/28");
        }else{
            $start_date = strtotime("2022/12/28");
            $end_date = strtotime("2022/12/28");
        } */

        if( $this->approved_at){
            $date_expire = date("Y/m/d",strtotime($this->approved_at));   
            $date = new DateTime($date_expire);
            $now = new DateTime('2022/12/28');
         }else{
            $date = new DateTime('2022/12/28');
            $now = new DateTime('2022/12/28'); 
         }


        $no_of_review = $this->reviews_count;
        $days_publish = $date->diff($now)->format("%a"); 
       // $days_publish =  (($end_date - $start_date)/60/60/24);
         try {
            $avg_daily_review = $no_of_review/$days_publish;
            $result =   34*$avg_daily_review;
            if($result){
                return $result;
            }else {
                return null;
            }
         }catch(\DivisionByZeroError $e){
           // echo "got $e";
         } catch(\ErrorException $e) {
           // echo "got $e";
         }
    }


    public function getWinnerAttribute(){
        /* if( $this->approved_at){
            $start_date = strtotime($this->approved_at);
            $end_date = strtotime("2022/12/28");
        }else{
            $start_date = strtotime("2022/12/28");
            $end_date = strtotime("2022/12/28");
        } */

        if( $this->approved_at){
            $date_expire = date("Y/m/d",strtotime($this->approved_at));   
            $date = new DateTime($date_expire);
            $now = new DateTime('2022/12/28');
         }else{
            $date = new DateTime('2022/12/28');
            $now = new DateTime('2022/12/28'); 
         }


        $no_of_review = $this->reviews_count;
        $days_publish = $date->diff($now)->format("%a"); 
        //   $days_publish =  (($end_date - $start_date)/60/60/24);
         try {
            $avg_daily_review = $no_of_review/$days_publish;
            $no_of_days_tf = 34*$avg_daily_review;
                $avg_rate_listing = VoterReview::select(\DB::raw("round(avg(rate_count),1) As rate_count"))->where('reported_to',$this->id)->get();
                if($avg_rate_listing->count()){ 
                    $overall_average_rating = round(collect(array_values($avg_rate_listing->toArray()[0]))->avg(),1);
                    $rateing = $overall_average_rating;
                }else{
                    $rateing = 0;
                }
            $result =   $rateing*$no_of_days_tf;
            if($result){
                return $result;
            }else {
                return null;
            }
         }catch(\DivisionByZeroError $e){
           // echo "got $e";
         } catch(\ErrorException $e) {
           // echo "got $e";
         }
    }
}
