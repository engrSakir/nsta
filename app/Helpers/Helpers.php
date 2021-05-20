<?php

use App\Models\Branch;
use App\Models\BranchLink;
use App\Models\CustomPage;
use App\Models\GlobalImages;
use App\Models\StaticOption;
use App\Models\WebsiteMessage;


if (!function_exists('random_code')){

    function set_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function get_static_option($key)
    {
        if (StaticOption::where('option_name', $key)->first()) {
            $return_val = StaticOption::where('option_name', $key)->first();
            return $return_val->option_value;
        }
        return null;
    }

    function update_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        } else {
            StaticOption::where('option_name', $key)->update([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function set_env_value(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }

   function active_custom_pages(){
       return CustomPage::all();
   }

   function count_of_website_incomplete_messages(){
       return WebsiteMessage::where('is_process_complete', false)->count();
   }

   function check_superadmin(){
       if(auth()->user()->type == 'Super Admin'){
           return true;
       }
       return false;
   }

   function check_admin(){
       if(auth()->user()->type == 'Admin'){
           return true;
       }
       return false;
   }

   function check_manager(){
       if(auth()->user()->type == 'Manager'){
           return true;
       }
       return false;
   }

   function check_customer(){
       if(auth()->user()->type == 'Customer'){
           return true;
       }
       return false;
   }

   function check_branch_link($from_branch_id, $to_branch_id){
       if(BranchLink::where('from_branch_id', $from_branch_id)->where('to_branch_id', $to_branch_id)->count() > 0){
           return true;
       }
       return false;
   }

   function en_to_bn($en_value){
       $search         = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
       $replace_by     =  array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
       return str_replace($search, $replace_by, $en_value);
   }

   function bn_to_en($bn_value){
       $replace_by  = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
       $search      =  array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
       return str_replace($search, $replace_by, $bn_value);
       //return filter_var(str_replace($search, $replace_by, $bn_value), FILTER_SANITIZE_NUMBER_INT);
   }


}
