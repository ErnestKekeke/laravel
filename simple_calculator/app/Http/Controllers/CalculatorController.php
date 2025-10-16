<?php

namespace App\Http\Controllers;
use App\Models\Calculator;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    private static int $value_id = 1;
    //...........................
    public function index() {
        // return "Hello guys";
        return view('home');
    }

    //...........................
    public function cal(Request $request) {
        $request->validate([
            'numA' => 'required',
            'numB' => 'required'
        ]);

        $numA = $request->input('numA');
        $numB = $request->input('numB');
        $opp = $request->input('opp');

        $result =  self::calculate($numA, $numB, $opp);
        return redirect()->route('calculator.index', ['result' => $result]);
    }

    //...........................
    public static function calculate(float $numA, float $numB, mixed $opp): mixed{
        $result = 0;

        switch($opp){
            case 'add': 
                $result = $numA + $numB;
                break;

            case 'sub':
                $result = $numA - $numB;
                break;
            
            case 'mul':
                $result = $numA * $numB;
                break;

            case 'div':
                $result = $numB != 0? $numA / $numB : "Cannot divide by Zero";
                break;
        }

        if($numB != 0) {
            $result = round($result, 3);
            self::save_val($result);
        }
        return $result;
    }

    //...........................
    public function last_val() {
        $lastVal = Calculator::find(self::$value_id);
        // return $lastVal->value;
        return redirect()->route('calculator.index', ['result' => $lastVal->value]);
    }

    //...........................
    public static function save_val($val) {
        $lastVal = Calculator::find(self::$value_id);
        $lastVal->update(['value' => $val]);
    }


    //...........................
    public function update_val(Request $request) {
        $val = $request->input('val');
        self::save_val($val);
        // return redirect()->route('calculator.last_memory');
        return $val;
    }
}

