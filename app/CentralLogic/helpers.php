<?php

namespace App\CentralLogics;

use Faker\Extension\Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\BusinessSetting;


class Helpers
{
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }

    public static function get_business_settings($name)
    {
        $config = null;

        $paymentmethod = BusinessSetting::where('key', $name)->first();

        if ($paymentmethod) {
            $config = json_decode(json_encode($paymentmethod->value), true);
            $config = json_decode($config, true);
        }

        return $config;
    }

    public static function currency_code(){
        return BusinessSetting::where(['key' => 'currency'])->first()->value;
    }
    
    public static function upload(string $dir, string $format, $image = null){
        if($image == null){
            $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "-" . $format;
            if(!Storage::disk('public')->exists($dir)){
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
        }else{
            $imageName = 'def.png';
        }
        return $imageName;
    }

    public static function update(string $dir, $old_image, string $format,  $image = null){
        if($image == null){
            return $old_image;
        }
        if(Storage::disk('public')->exists($dir . $old_image)){
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = Helpers::upload($dir, $format, $image);
        return $imageName;
    }
}