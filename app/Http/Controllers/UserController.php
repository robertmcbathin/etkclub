<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;
use DB;
use App\Http\Requests;

class UserController extends Controller
{
	public $email;
    public function generatePassword($length = 8)
    {
      $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
      $numChars = strlen($chars);
      $string = '';
      for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
      }
      return $string;
    }
    public function postSignUp (Request $request)
    {
    	$this->validate($request,[
    		'card_serie' => 'required|min:2',
    		'card_number' => 'required|min:9',
            'second_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'dob' => 'date',
            'phone' => 'required|max:15',
            'email' => 'required|email|max:50'
    		]);
        /*INITIALIZING THE VARIABLES*/
        $third_name = '';
        $sex        = 'U';
        $dob        = NULL;
        /*--------------------------*/
    	/*CARD CREDENTIALS*/
    	$card_serie  = $request['card_serie'];
    	$card_number = $request['card_number'];
    	/*----------------*/
    	/*CHECK CARD CREDENTIALS*/
    	$card = DB::table('CARDS')->where('SERIE',$card_serie)
    	                          ->where('NUM',$card_number)
    	                          ->first();
    	if($card == NULL)
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
        $psw_to_send = $this->generatePassword();
        $psw         = bcrypt($psw_to_send);
    	/*-----------------*/
    	/*CONTACT INFORMATION*/
    	$phone = $request['phone'];
    	$email = $request['email'];
    	/*-------------------*/
        /*TOKEN*/
        $token = $request['_token'];
        /*-----*/
        /*VALIDATE SEX*/
        if ($sex == 'муж') $sex = 'M';
            else if ($sex == 'жен') $sex = 'F';
                else $sex = 'U';
        /*------------*/
        /*SAVE TO DATABASE*/
        DB::table('CARDS')
            ->where('SERIE', $card_serie)
            ->where('NUM', $card_number)
            ->update(['ACTIVATION_TOKEN' => $token]);

        $preactive_card_id = DB::table('ACTIVATED_CARDS')->insertGetId([
            'SERIE' => $card_serie, 
            'NUM' => $card_number
        ]);

        $user_id = DB::table('USERS')->insertGetId([
            'USERNAME' => '',
            'FIRST_NAME' => $first_name,
            'SECOND_NAME' => $second_name,
            'PATRONYMIC' => $third_name,
            'EMAIL' => $email,
            'PHONE' => $phone,
            'SEX' => $sex,
            'DOB' => $dob,
            'PSW' => $psw,
            'CARD_ID' => $preactive_card_id,
            'IS_ACTIVE' => 0
        ]);

        /*----------------*/
        /*SENDING E-MAIL
        *user_id, 

        */
      Mail::send('emails.email_verifier',
          ['user_id' => $user_id,
           'email' => $email,
           'psw' => $psw_to_send,
           'token' => $token],
           function ($m) use ($email){
    $m->from('activation@etk-club.ru', 'ЕТК-Клуб');
    $m->to($email)->subject('Активация аккаунта в программе "ЕТК-Клуб"');
    });
        /*--------------*/
        return redirect()->route('entrance.ok',[$email]);
    }

    public function verifyAccount($token)
    {
    	if ($card = DB::table('CARDS')->where('ACTIVATION_TOKEN',$token)->first())
    		{
    		  DB::table('CARDS')
                ->where('ID', $card->ID)
                ->update(['ACTIVATION_TOKEN' => null,
                	      'IS_ACTIVATED'     => 1
              ]);
              DB::table('ACTIVATED_CARDS')
                ->where('SERIE', $card->SERIE)
                ->where('NUM', $card->NUM)
                ->update(['IS_ACTIVE'        => 1
              ]);
              $activated_card = DB::table('ACTIVATED_CARDS')->where('SERIE', $card->SERIE)
                                                            ->where('NUM', $card->NUM)
                                                            ->first();
              DB::table('USERS')
                ->where('CARD_ID', $activated_card->ID)
                ->update(['IS_ACTIVE'        => 1
              ]);
                /*MAIL ABOUT HOW GREAT THE SIGN UP WAS*/
                /*------------------------------------*/
              return redirect()->route('activation.ok');
    		}
    }
    public function postSignIn(Request $request)
    {

    }
    public function showEntranceOk($email)
    {
        return view('callbacks.send_confirmation_email',[
            'email' => $email
            ]);
    }
    public function showActivationOk()
    {
        return view('callbacks.show_that_account_is_activated');
    }
}
