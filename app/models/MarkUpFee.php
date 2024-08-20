<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class MarkUpFee extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'formula';
	protected $primaryKey = "id";

	private $_create_rules = array(
		'name' => 'required',
		'float_fee' => 'required|between:0,100|numeric',
		'fixed_fee' => 'required|numeric'
	);

	private $_update_rules = array(
		'name' => 'required',
		'float_fee' => 'required|between:0,100|numeric',
		'fixed_fee' => 'required|numeric'
	);

	public static function fresh( $markup_params )
  	{
  		$markup = new MarkUpFee();
   		foreach($markup_params as $key => $param)
    	{
      		$markup->$key = $param;
    	}
    	$markup->created_by = Auth::user()->email;
    	return $markup;
	}

	public function modify( $markup_params )
	{
		foreach($markup_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $markup_params = null )
	{
	if( empty($markup_params) ) $markup_params = $this->toArray();
		if( $this->exists ) $validator = Validator::make($markup_params,$this->_update_rules);
		else $validator = Validator::make($markup_params, $this->_create_rules);
	if( $validator->passes() )
	{
	  	if(isset($markup_params['id']))
		{
			$isExist = count(MarkUpFee::where('id', '<>', $markup_params['id'])->where('name', $markup_params['name'])->where('is_deleted', 0)->get());
		}
		else
		{
			$isExist = count(MarkUpFee::where('name', $markup_params['name'])->where('is_deleted', 0)->get());

		}
		if($isExist != 0)
		{
			$messages = new Illuminate\Support\MessageBag;
			$messages->add('error', 'Formula already exist');
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

	// $temp_file_directory = sys_get_temp_dir()."/";
	private $_temp_file_directory = 'csv/';
	private $_csv_name ="";

	//file => csv
	public function csv_upload($file)
	{
		//check existing folder
		$csv_file = fopen($this->_temp_file_directory.$this->_csv_name,"r");
		fgetcsv($csv_file);
		while(! feof($csv_file))
		{
			$data = fgetcsv($csv_file);
			if($data != ""
				&& $data[1] != "" 
				&& $data[2] != "" 
				&& $data[3] != "" 
				&& is_numeric($data[2])
				&& is_numeric($data[3]) 
				&& $data[2] >= 0 
				&& $data[2] <= 100)
			{
				if($markup = MarkUpFee::find($data[0]))
			    {
			      $markup->name = $data[1];
			      $markup->float_fee = $data[2];
			      $markup->fixed_fee = $data[3];
			      $markup->updated_by = Auth::user()->email;
			      $markup->save();
			    }
		    	else
		    	{
		    		$markup = new MarkUpFee();
		    		if($data[0]!="" && is_numeric($data[0]))
		    		{
		    			$markup->id = $data[0];
		    		}
		    		$markup->name = $data[1];
		    		$markup->float_fee = $data[2];
		    		$markup->fixed_fee = $data[3];
		    		$markup->created_by = Auth::user()->email;
		    		$markup->save();
		    	}
			}
		}
		fclose($csv_file);
		return true;
	}

	public function csv_upload_validate($file)
  	{
  		if(isset($file))
  		{
  			if($file->isValid() 
	        && ($file->getClientOriginalExtension() == "csv" 
	          || $file->getClientOriginalExtension() == "xls"
	          || $file->getClientOriginalExtension() == "xlsx"
	          || $file->getClientOriginalExtension() == "ppt"
	          || $file->getClientOriginalExtension() == "txt"))
		    {
		      	//check existing folder
			    if(!is_dir($this->_temp_file_directory))
			    {
			      mkdir($this->_temp_file_directory);
			    }
				$this->_csv_name = "CSV".str_random(5).".".$file->getClientOriginalExtension();
				$upload_success = $file->move($this->_temp_file_directory, $this->_csv_name);
				if($upload_success)
				{
				  $csv_file = fopen($this->_temp_file_directory.$this->_csv_name,"r");
				  fgetcsv($csv_file);
				  $i=1;
				  while(! feof($csv_file))
				  {
				  	$i++;
				    $data = fgetcsv($csv_file);
				    if($data != "")
				    {
				    	if($data[1] != "" 
			    		&& $data[2] != "" 
			    		&& $data[3] != "" 
			    		&& is_numeric($data[2])
			    		&& is_numeric($data[3]) 
			    		&& $data[2] >= 0 
			    		&& $data[2] <= 100)
					    {
					    	if($data[0] != "")
							{
								$isExist = count(MarkUpFee::where('id', '<>', $data[0])->where('name', $data[1])->where('is_deleted', 0)->get());
							}
							else
							{
								$isExist = count(MarkUpFee::where('name', $data[1])->where('is_deleted', 0)->get());

							}
							if($isExist != 0)
							{
								$messages = new Illuminate\Support\MessageBag;
								$messages->add('error', 'Existing Name in row '.$i);
								$this->errors = $messages;
								fclose($csv_file);
						    	return false;
							}
					    }
					    else
					    {
					    	$messages = new Illuminate\Support\MessageBag;
							$messages->add('error', 'Error in row '.$i);
							$this->errors = $messages;
							fclose($csv_file);
					    	return false;

					    }
				    }
				  }
				  fclose($csv_file);
				  return true;
				}
				else
				{
					$messages = new Illuminate\Support\MessageBag;
					$messages->add('error', 'Upload CSV Failed');
					$this->errors = $messages;
				  	return false;
				}
		    }
		    else
		    {
		    	$messages = new Illuminate\Support\MessageBag;
				$messages->add('error', 'File is not Valid');
				$this->errors = $messages;
		      	return false;
		    }
  		}
  		else
  		{
  			$messages = new Illuminate\Support\MessageBag;
			$messages->add('error', 'File is not Valid');
			$this->errors = $messages;
	      	return false;
  		}
  	}

}
