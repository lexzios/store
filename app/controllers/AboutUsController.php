<?php

class AboutUsController extends BaseController {

  # GET /AboutUs
  public function index()
  {
	 return View::make('userweb.about_us')->withTitle("About Us");  	
  }

  public function postMail() 
  {
    $input = Input::all();
  	$mail_rules = array(
		'name' => 'required',
		'email' => 'required|email',
		'subject' => 'required',
		'message' => 'required');

  	$validate = Validator::make($input, $mail_rules);
  	if($validate->passes())
  	{
  		$message = "From : ".$input['name']."<".$input['email'].">\n\n\n".$input['message'];

	  	// if(mail($to, $input['subject'], $message))
      if($this->email())
	  	{
      	return View::make('userweb.about_us')->with('error_code', '0');
	  	}
	  	else
	  	{
	  		return Redirect::to('/about-us')->with('error_code', '1')->withInput(); 
	  	}
  	}
  	else
  	{
  		return Redirect::to('/about-us')->withErrors($validate)->withInput();
  	}
  }

  public function email()
  {
    Mail::send('emails.auth.mail_format', array('email' => Input::get('email'), 'name' => Input::get('name'), 'subject' => Input::get('subject'), 'content' => Input::get('message')), function($message)
      {
        $message->from(Config::get('mail.MAIL_FROM'), Input::get('name'));
        $message->to(Config::get('mail.MAIL_TO'), Config::get('mail.MAIL_NAME'))->subject(Input::get('subject'));
      });
    return true;
  }
}
