<?php

use App\Models\Branch;
use App\Models\BranchLink;
use App\Models\CustomPage;
use App\Models\StaticOption;
use App\Models\WebsiteMessage;
use Illuminate\Support\Facades\Http;


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

   function sms($number, $message){
       $text = urlencode($message);
       $user = get_static_option('sms_api_key');
       $pass = get_static_option('sms_api_pass');
       $smsresult =  Http::get("http://66.45.237.70/api.php?username=$user&password=$pass&number=$number&message=$text");

       if(strpos($smsresult, '1101') !== false){
           return true;
       } else{
           return false;
       }
   }

   function get_regular_invoice_message_content_for_new_customer(\App\Models\Invoice $invoice, $password){
        //$invoice->sender_name .' থেকে আপনার মাল নিউ শাপলা ট্রান্সপোর্টে বুকিং করা হয়েছে। বুকিং নং- '. $invoice->custom_counter . ' লগিন করে মালামালের অবস্থান জানতে ব্যবহার করুন মোবাইলঃ '. $invoice->receiver->phone .' এবং পাসওয়ার্ডঃ '. $password . 'লিংকঃ '.  url('/');
       try {
           $message = get_static_option('regular_invoice_message_content_for_new_customer');
           if($invoice->sender_name ?? null)
           $message = str_replace("[sender_name]", $invoice->sender_name, $message);
           if($invoice->custom_counter ?? null)
           $message = str_replace("[custom_counter]", $invoice->custom_counter, $message);
           if($invoice->receiver->phone ?? null)
           $message = str_replace("[receiver_phone]", $invoice->receiver->phone, $message);
           if($password ?? null)
           $message = str_replace("[receiver_password]", $password, $message);
           return $message;
       }catch (\Exception $exception){
           return $exception->getMessage();
       }
   }

   function get_regular_invoice_message_content_for_old_customer(\App\Models\Invoice $invoice){
        //$invoice->sender_name .' থেকে আপনার মাল নিউ শাপলা ট্রান্সপোর্টে বুকিং করা হয়েছে। বুকিং নং- '. $invoice->custom_counter . ' লগিন করে মালামালের অবস্থান জানতে আপনার মোবাইল নাম্বার এবং পাসওয়ার্ড ব্যবহার করুন। '.  url('/');
       try {
           $message = get_static_option('regular_invoice_message_content_for_old_customer');
           if($invoice->sender_name ?? null)
           $message = str_replace("[sender_name]", $invoice->sender_name, $message);
           if($invoice->custom_counter ?? null)
           $message = str_replace("[custom_counter]", $invoice->custom_counter, $message);
           return $message;
       }catch (\Exception $exception){
           return $exception->getMessage();
       }
   }
}
