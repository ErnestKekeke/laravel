<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class CheckController extends Controller
{
    public static function name($input): mixed{
        $regx_name = "/^[\w \' ]{3,40}$/";
        $test = preg_match($regx_name, $input);
        return $test? $input : null;
    }

    public static function tel($input): mixed{
        $regx_tel = "/^\+?[0-9]{5,20}$/m";
        $test = preg_match($regx_tel, $input);
        return $test? $input : null;
    }

    public static function email($input): mixed{
        $regx_email = "/^([a-z 0-9 A-Z \- \.]+)@([a-z A-Z \.\- 0-9]+)\.([a-z A-Z \-]{1,8})([a-z A-Z \-]{1,8})?$/";
        $test = preg_match($regx_email, $input);
        return $test? $input : null;
    }

    public static function address($input): mixed{
        $regx_adr = "/^[A-Za-z0-9\s,.\/-]{5,50}$/";
        $test = preg_match($regx_adr, $input);
        return $test? $input : null;
    }

    public static function password($input): mixed{
        $regx_pwd = "/^(?=.*\d).{6,}$/";
        $test = preg_match($regx_pwd, $input);
        return $test? $input : null;
    }

    public static function clinic_id($input): mixed{
        $regx_clinic_id = "/^[1-9][0-9]{3}$/";
        $test = preg_match($regx_clinic_id, $input);
        return $test? $input : null;
    }

    public static function reg_no($input): mixed{
        $regx_reg_no = "/^(?:\d{6,12}|(?:[A-Za-z]{1,6}[\/-]?)+\d{2,4}[\/-]?\d{4,6}(?:[\/-]?[A-Za-z]{1,4})?)$/";
        $test = preg_match($regx_reg_no, $input);
        return $test? $input : null;
    }

    // public static function company($input): mixed{
    //     $result = null;
    //     switch ($input) {
    //         case "andela": $result = $input; break;
    //         case "glo": $result = $input; break;
    //         case "jumia": $result = $input; break;
    //         case "kobo360": $result = $input; break;
    //         case "terragon": $result = $input; break;
    //         default: $result = null;
    //     }
    //     return $result;
    // }


    // public static function gotoCompany($input): mixed{
    //     $result = env('APP_URL');;
    //     $input = strtolower($input);
    //     switch ($input) {
    //         case "andela": $result = 'https://andela.com/'; break;
    //         case "glo": $result = 'https://www.gloworld.com/ng/'; break;
    //         case "jumia": $result = 'https://group.jumia.com'; break;
    //         case "kobo360": $result = 'https://www.weforum.org/organizations/kobo360/'; break;
    //         case "terragon": $result = 'https://terragongroup.com/'; break;
    //         default: $result = $result;
    //     }
    //     return $result;
    // }

    // public static function generateSecureAlphanumeric($length = 6):string {
    //     $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    //     $result = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $result .= $chars[random_int(0, strlen($chars) - 1)];
    //     }
    //     return $result;
    // }
}
