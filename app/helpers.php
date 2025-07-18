<?php
use Illuminate\Http\Request;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (! function_exists('create_unique_slug')) {
    
    function create_unique_slug($string) {
        
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', trim(strtolower($string)));   
        return $slug.'-'.uniqid();
    }
}


if (! function_exists('upload_new_image')) {
    
    function upload_new_image($file_image,$destination) {
        
        if( $file_image!= ""){
            if (!file_exists( public_path("/images/$destination"))) {
                mkdir(public_path("/images/$destination"), 0777, true);
            }    
            $path = public_path("/images/$destination/");
            $image = $file_image;
            $logo = uniqid().'.'.$image->getClientOriginalExtension();
            
            $destinationPath = public_path("/images/$destination");
            $test = $image->move($destinationPath, $logo);
            $url = "/images/$destination";
            $main_image = $url.'/'.$logo;
        }else{
            $main_image = '';  
        }
        
        return $main_image;
    }
}

// base64 upload
if (! function_exists('upload_base64_image')) {
    
    function upload_base64_image($base64,$destination) {
        
        // added
        if( $base64!= ""){
            if (!file_exists( public_path("/images/$destination"))) {
                mkdir(public_path("/images/$destination"), 0777, true);
            }
            $folderPath = public_path("/images/$destination/");

            $explodes = explode('base64,', $base64);
            $base_64 = $explodes[1];
            $extension = explode('/', $explodes[0])[1];
            $image_type = explode(';', $extension)[0];
            $image_base64 = base64_decode($base_64);
            $file = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($file, $image_base64);

            $url = "/images/$destination";
            $main_image = $url.'/'.explode($folderPath, $file)[1];
        }else{
            $main_image = '';  
        }
        
        return $main_image;
        // added
    }
}

// base64 upload


if (! function_exists('mysql_date_time')) {
    
    function mysql_date_time($datetime) {
        return date('Y-m-d H:i:s', strtotime($datetime));
    }
}

if (! function_exists('display_news_date_time')) {
    
    function display_news_date_time($datetime) {
        return date('d/m/Y H:i A', strtotime($datetime));
    }
}

if (! function_exists('display_created_at')) {
    
    function display_created_at($datetime) {
        return date('d/m/y', strtotime($datetime));
    }
}

if (! function_exists('web_image_url')) {
    
    function web_image_url($image_name) {
        return url(config('adminlte.website_url').$image_name);
    }
}
