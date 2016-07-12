<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Http\Requests;

class UserController extends Controller
{
	public function messages()
    {
      return [
        'validation.required' => 'Вы оставили пустым поле',
      ];
    }
    public function postSignUp (Request $request)
    {
    	$this->validate($request,[
    		'card_serie' => 'required|min:2',
    		'card_number' => 'required|min:9'

    		]);
    	/*CARD CREDENTIALS*/
    	$card_serie  = $request['card_serie'];
    	$card_number = $request['card_number'];
    	/*----------------*/
    	/*CHECK CARD CREDENTIALS*/
    	$card = DB::table('CARDS')->where('SERIE',$card_serie)
    	                          ->where('NUM',$card_number)
    	                          ->first();
    /*	if($card == NULL)
    	{
    		return redirect()->back();
    	}
    	/*----------------------*/
    	/*OWNER CREDENTIALS*/
    	$second_name = $request['second_name'];
    	$first_name  = $request['first_name'];
    	$third_name  = $request['third_name'];
    	$sex         = $request['sex'];
    	$dob         = $request['dob'];
    	/*-----------------*/
    	/*CONTACT INFORMATION*/
    	$phone = $request['phone'];
    	$email = $request['email'];
    	/*-------------------*/
    }
    public function postSignIn(Request $request)
    {

    }
}
