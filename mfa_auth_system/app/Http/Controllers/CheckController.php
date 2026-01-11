<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class CheckController extends Controller
{
    public static function name($input): mixed{
        $regx_name = "/^[a-zA-Z]{2,40}$/m";
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

    public static function password($input): mixed{
        $regx_pwd = "/^(?=.*\d).{6,}$/";
        $test = preg_match($regx_pwd, $input);
        return $test? $input : null;
    }

    public static function userid($input): mixed{
        $regx_userid = "/^(an|gl|ju|ko|te)\d{3,6}$/";
        $test = preg_match($regx_userid, $input);
        return $test? $input : null;
    }

    public static function company($input): mixed{
        $result = null;
        switch ($input) {
            case "andela": $result = $input; break;
            case "glo": $result = $input; break;
            case "jumia": $result = $input; break;
            case "kobo360": $result = $input; break;
            case "terragon": $result = $input; break;
            default: $result = null;
        }
        return $result;
    }


    public static function gotoCompany($input): mixed{
        $result = env('APP_URL');;
        $input = strtolower($input);
        switch ($input) {
            case "andela": $result = 'https://andela.com/'; break;
            case "glo": $result = 'https://www.gloworld.com/ng/'; break;
            case "jumia": $result = 'https://group.jumia.com'; break;
            case "kobo360": $result = 'https://www.weforum.org/organizations/kobo360/'; break;
            case "terragon": $result = 'https://terragongroup.com/'; break;
            default: $result = $result;
        }
        return $result;
    }

    public static function generateSecureAlphanumeric($length = 6):string {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $result;
    }
}
