<?php

use Ions\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ions_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('encrypted_password', 'remember_token');

	protected $password;
	protected $password_confirmation;

	private $_create_rules = array(
		'first_name' => 'required|between:1,50|alpha_num',
		'last_name' => 'required|between:1,50|alpha_num',
		'email' => 'required|between:5,100|email',
		'password' => 'required|confirmed',
		'password_confirmation' => 'required'
	);

	private $_update_rules = array(
		'first_name' => 'required|between:1,50|alpha_num',
		'last_name' => 'required|between:1,50|alpha_num',
		'email' => 'required|between:5,100|email',
		'password' => 'confirmed'
	);

	public static function fresh( $user_params )
  {
    $user = new User();
    foreach($user_params as $key => $param)
    {
      $user->$key = $param;
    }
    $user->created_by = Auth::user()->email;
    return $user;
  }

  public function modify( $user_params )
  {
    foreach($user_params as $key => $param)
    {
      $this->$key = $param;
    }
    $this->updated_by = Auth::user()->email;
  }

  public $errors = null;
  public function validate( $user_params = null )
  {
    if( empty($user_params) ) $user_params = $this->toArray();
		if( $this->exists ) $validator = Validator::make($user_params,$this->_update_rules);
		else $validator = Validator::make($user_params, $this->_create_rules);
    if( $validator->passes() )
    {
			if( !empty($this->password) ) $this->encrypted_password = Hash::make($this->password);
      return true;
    }
    else
    {
      $this->errors = $validator->messages();
      return false;
    }
  }

	/**
	* Convert the model instance to an array.
	*
	* @return array
	*/
	public function toArray()
	{
		$extra_attributes = array(
			'password' => $this->password,
			'password_confirmation' => $this->password_confirmation
		);
		return array_merge(parent::toArray(), $extra_attributes);
	}

}
