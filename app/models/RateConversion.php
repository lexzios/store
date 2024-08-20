<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class RateConversion extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'currency_exchange';
	protected $primaryKey = "id";

	private $_create_rules = array(
		'from_currency_code' => 'required',
		'to_currency_code' => 'required',
		'rate' => 'required|numeric'
	);

	private $_update_rules = array(
		'from_currency_code' => 'required',
		'to_currency_code' => 'required',
		'rate' => 'required|numeric'
	);

	public static function fresh( $conversion_params )
  	{
  		$conversion = new RateConversion();
   		foreach($conversion_params as $key => $param)
    	{
      		$conversion->$key = $param;
    	}
    	$conversion->created_by = Auth::user()->email;
    	return $conversion;
	}

	public function modify( $conversion_params )
	{
		foreach($conversion_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $conversion_params = null )
	{
		if( empty($conversion_params) ) $conversion_params = $this->toArray();
			if( $this->exists ) $validator = Validator::make($conversion_params,$this->_update_rules);
			else $validator = Validator::make($conversion_params, $this->_create_rules);
		if( $validator->passes() )
		{
			if(isset($conversion_params['id']))
			{
				$isExist = count(RateConversion::where('id', '<>', $conversion_params['id'])->where('from_currency_code', $conversion_params['from_currency_code'])->where('to_currency_code', $conversion_params['to_currency_code'])->where('is_deleted', 0)->get());
			}
			else
			{
				$isExist = count(RateConversion::where('from_currency_code', $conversion_params['from_currency_code'])->where('to_currency_code', $conversion_params['to_currency_code'])->where('is_deleted', 0)->get());

			}
			if($isExist != 0)
			{
				$messages = new Illuminate\Support\MessageBag;
				$messages->add('error', 'Conversion Rate already exist');
				$this->errors = $messages;
				return false;
			}
			else
			{
				return true;
			}
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
		return array_merge(parent::toArray());
	}

	//has One eloquent table join
	public function currency_from() 
	{
		return $this->hasOne('Currency', 'code', 'from_currency_code');
	}

	public function currency_to() 
	{
		return $this->hasOne('Currency', 'code', 'to_currency_code');
	}
}
