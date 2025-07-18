<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
class ReviewController extends Controller
{
    //Show review 
     
     public function ReviewList(){
         if (Auth::user()->can('view_reviews')) {
           $allReviews = Review::with('order.orderItems.product:id,name','user:id,first_name,last_name')->get();
           
           //dd($allReviews);
           return view('reviews.list',compact('allReviews'));
           }
           else{
             return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
           } 
     }

}
