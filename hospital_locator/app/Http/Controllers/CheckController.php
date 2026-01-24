<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class CheckController extends Controller
{
    public static function name($input): mixed{
        $regx = "/^[A-Za-z\.\' ]{3,100}$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function tel($input): mixed{
        $regx = "/^\+?[0-9]{5,20}$/m";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function email($input): mixed{
        $regx = "/^([a-z 0-9 A-Z \- \.]+)@([a-z A-Z \.\- 0-9]+)\.([a-z A-Z \-]{1,8})([a-z A-Z \-]{1,8})?$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function address($input): mixed{
        $regx = "/^[A-Za-z0-9\s,.\/-]{5,50}$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function zipcode($input): mixed{
        $regx = "/^[A-Za-z0-9\- ]{3,15}$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    // public static function password($input): mixed{
    //     $regx_pwd = "/^(?=.*\d).{6,}$/";
    //     $test = preg_match($regx_pwd, $input);
    //     return $test? $input : null;
    // }

    // public static function hospital_id($input): mixed{
    //     $regx_clinic_id = "/^[1-9][0-9]{3}$/";
    //     $test = preg_match($regx_clinic_id, $input);
    //     return $test? $input : null;
    // }

    public static function reg_no($input): mixed{
        $regx = "/^(?:\d{6,12}|(?:[A-Za-z]{1,6}[\/-]?)+\d{2,4}[\/-]?\d{4,6}(?:[\/-]?[A-Za-z]{1,4})?)$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function latitude($input): mixed{
        $regx = "/^(\+|-)?(?:90(?:\.0+)?|[0-8]?\d(?:\.\d+)?)$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function longitude($input): mixed{
        $regx = "/^(\+|-)?(?:180(?:\.0+)?|1[0-7]\d(?:\.\d+)?|0?\d{1,2}(?:\.\d+)?)$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

    public static function bed($input): mixed{
        $regx = "/^\d+$/";
        $test = preg_match($regx, $input);
        return $test? $input : null;
    }

}
