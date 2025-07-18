<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MdCountry;
use App\Models\MdDropdown;
use DB;
use Auth;
class MiscController extends Controller
{     
      //Currency List 
       public function currenciesList()
       {
           
           if(Auth::user()->can('view_misc')) {
         
          $mdCurrencies=  MdDropdown::where('slug','products_currency')->get();
          return view('misc.currencies.list',compact('mdCurrencies'));
          }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
       }

       
       //Add Country
       public function addCurrency()
       {
           if(Auth::user()->can('add_misc')) {

        $countries_with_currencies = DB::table('md_countries')->get();
        $existing_currency = MdDropdown::where('slug','products_currency')->pluck('country')->toArray();
       
        return view('misc.currencies.add',compact('countries_with_currencies','existing_currency'));
          }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
       }


      //Check Country exists !
      public function checkCurrency(Request $request)
      {
        $country =  MdDropdown::where('country',$request->country)->get();
        if(count($country)>0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        }
        else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }                  
      }


 

        //Save Country
      public function saveCurrency(Request $request)
      {
            
               $dropdown =  new MdDropdown();
               $dropdown->name = $request->currency_name;
               $dropdown->slug = "products_currency";
               $dropdown->values = $request->iso_code;
               $dropdown->country = $request->country; 
               $dropdown->save(); 
         
          return redirect()->route('countries_list')->with('status','Currency created successfully');
       }

 


       public function changeCurrencyStatus(Request $request){
      
         if(Auth::user()->can('edit_misc')) {
        
        if($request->status_value == 0)
          {
            $currency = MdDropdown::where('id',$request->id)->first();
            $currency->status = '0';
            $currency->save();
            return response()->json(['status' =>'currency_locked','message'=>"Currency Disabled"]);   
          }
          else{
            $currency = MdDropdown::where('id',$request->id)->first();
            $currency->status = '1';
            $currency->save();
            return response()->json(['status' =>'currency_unlocked','message'=>"Currency Enabled"]);
            
          }

            }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
        

       }

 
  
 


 

       //Delete Country  
       public function deleteCurrency(Request $request)
       {
           
           $del_currency = MdDropdown::where('slug','products_currency')->find($request->id)->delete();
           return response()->json(['success' => 1]);
       }


       //deleted country list
      public function deletedCurrencyList(Request $request){
        if(Auth::user()->can('view_deleted_currency')) {
        $countriesList = MdDropdown::onlyTrashed()->get();
        return view('misc.currencies.deleted_list',compact('countriesList'));
         }else{
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
      }

     //Restore Deleted Country
    public function restoreCurrencyList(Request $request){
        $CountryList = MdDropdown::withTrashed()->find($request->id)->restore();
        return "success";
    }


 

    //Permanent Delete  Country
    public function permanentDeleteCurrencyList(Request $request)
    {
         $CountryList = MdDropdown::onlyTrashed()->find($request->id)->forceDelete();
         return "success";   
     }


}
