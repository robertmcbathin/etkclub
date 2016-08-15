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

    protected $last_inserted_id;

    protected $user;

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
    		'card_number' => 'required|min:6',
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
    	$card = DB::table('cards')->where('serie',$card_serie)
    	                          ->where('num',$card_number)
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
    	/*-----------------*/
    	/*CONTACT INFORMATION*/
    	$phone = $request['phone'];
    	$email = $request['email'];
    	/*-------------------*/
        /*TOKEN*/
        $token = $request['_token'];
        /*-----*/
        /*SAVE TO DATABASE*/
        DB::transaction(function() use ($card_serie, $card_number,$token,$first_name,$second_name, $third_name, $email,$phone,$sex,$dob){
          DB::table('cards')
              ->where('serie', $card_serie)
              ->where('num', $card_number)
              ->update(['activation_token' => $token]);
  
          $preactive_card_id = DB::table('activated_cards')->insertGetId([
              'serie' => $card_serie, 
              'num' => $card_number
          ]);
  
          $this->last_inserted_id = DB::table('users')->insertGetId([
              'username' => '',
              'first_name' => $first_name,
              'second_name' => $second_name,
              'patronymic' => $third_name,
              'email' => $email,
              'phone' => $phone,
              'sex' => $sex,
              'dob' => $dob,
              'password' => null,
              'card_id' => $preactive_card_id,
              'is_active' => 0
          ]);
        });

        /*----------------*/
        /*SENDING E-MAIL
        *user_id, 

        */
      Mail::send('emails.email_verifier',
          ['user_id' => $this->last_inserted_id,
           'email' => $email,
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
        $password_to_send = $this->generatePassword();
        $password         = bcrypt($password_to_send);
                DB::transaction(function() use ($password,$token){
                   $card = DB::table('cards')->where('activation_token',$token)->first();
                    /*SET CARD STATUS TO ACTIVE, SET TOKEN TO NULL*/
                    DB::table('cards')
                      ->where('id', $card->id)
                      ->update(['activation_token' => null,
                                'is_activated'     => 1
                    ]);
                    /*ACTIVATE CARD*/
                    DB::table('activated_cards')
                      ->where('serie', $card->serie)
                      ->where('num', $card->num)
                      ->update(['is_active'        => 1
                    ]);
                    /*GET CARD ID*/
                    $activated_card = DB::table('activated_cards')->where('serie', $card->serie)
                                                                  ->where('num', $card->num)
                                                                  ->first();
                    /*ACTIVATE USER ACCOUNT*/
                    DB::table('users')
                      ->where('card_id', $activated_card->id)
                      ->update(['is_active' => 1,
                                'password' => $password
                    ]);
                    /*GET USER ROW*/
                    $this->user = DB::table('users')
                        ->where('card_id', $activated_card->id)
                        ->first();
                });
                $user_id = $this->user->id;
                $email   =$this->user->email;
                /*MAIL ABOUT HOW GREAT THE SIGN UP WAS*/
                Mail::send('emails.email_confirmed',
                      ['user_id' => $user_id,
                       'email' => $email,
                       'password' => $password_to_send],
                       function ($m) use ($email){
                $m->from('activation@etk-club.ru', 'ЕТК-Клуб');
                $m->to($email)->subject('Успешная активация аккаунта в программе "ЕТК-Клуб"');
                });
                /*------------------------------------*/
              return redirect()->route('activation.ok');
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
