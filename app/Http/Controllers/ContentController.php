<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Admin;
use DB;
use Auth;

class ContentController extends Controller {


	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function mobilePagesList(Request $request) {
	if (Auth::user()->can('view_mobile_content')) {
		
			$mobilePagesList = Page::where('device_type', 'web')->get();
	
			return view('content/list')->with('mobilePagesList', $mobilePagesList);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
		
	}

	

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function editMobilePage($id) {
		
if (Auth::user()->can('edit_mobile_content')) {
			$pageContent = Page::find($id);
			return view('content/edit', [
				'pageContent' => $pageContent,
			]);
		}else{
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function updateMobilePage(Request $request) {
		if (Auth::user()->can('edit_mobile_content')) {
		$page = Page::find($request->id);
		if($request->id == '5'){
			$page->content = $request->datetimepicker;
		}elseif($request->id == '6') {
			$page->content = $request->datepicker;
		} else{
			$page->content = $request->content;
		}
		
		if($page->save()) {
			$mobilePagesList = Page::all();
			return redirect()->route('content.mobilePage.list', ['mobilePagesList' => $mobilePagesList])->with('success', 'Page Updated successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong!');
		}
	}else{
		return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
	}
	}

	/**
	 * This function is used to View Mobile Content
	*/
	public function viewMobilePage($id) {
		if (Auth::user()->can('view_mobile_content')) {
			$pageContent = Page::find($id);
			//return $pageContent;
			//$section = DB::table('pages_sections')->where('slug', $pageContent->section)->first();
			//return $section;
			$addedBy = Admin::find($pageContent->added_by_id);
			$updatedBy = Admin::find($pageContent->updated_by_id);
			return view('content/view', [
				'addedBy' => $addedBy,
				'updatedBy' => $updatedBy,
				//'section' => $section->title,
				'pageContent' => $pageContent
			]);
		}else{
		return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
	}
		
	}

	

	

	

}
