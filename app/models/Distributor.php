<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Distributor extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'distributor';
	protected $primaryKey = "id";

	private $_create_rules = array(
		'name' => 'required'
	);

	private $_update_rules = array(
		'name' => 'required'
	);

	public static function fresh( $distributor_params )
  	{
  		$distributor = new Distributor();
   		foreach($distributor_params as $key => $param)
    	{
      		$distributor->$key = $param;
    	}
    	$distributor->created_by = Auth::user()->email;
    	return $distributor;
	}

	public function modify( $distributor_params )
	{
		foreach($distributor_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $distributor_params = null )
	{
	if( empty($distributor_params) ) $distributor_params = $this->toArray();
		if( $this->exists ) $validator = Validator::make($distributor_params,$this->_update_rules);
		else $validator = Validator::make($distributor_params, $this->_create_rules);
	if( $validator->passes() )
	{
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
		return array_merge(parent::toArray());
	}

	// $temp_file_directory = sys_get_temp_dir()."/";
	private $_temp_file_directory = 'csv/';
	private $_csv_name ="";

	//file => csv
	public function csv_upload($file)
	{
		
		$csv_file = fopen($this->_temp_file_directory.$this->_csv_name,"r");
		fgetcsv($csv_file);
		while(! feof($csv_file))
		{
			$data = fgetcsv($csv_file);
			if($data != ""
				&& $data[1] != "")
			{
				if($distributor = Distributor::find($data[0]))
			    {
			      $distributor->name = $data[1];
			      $distributor->address = $data[2];
			      $distributor->updated_by = Auth::user()->email;
			      $distributor->save();
			    }
		    	else
		    	{
		    		$distributor = new Distributor();
		    		if($data[0]!="" && is_numeric($data[0]))
		    		{
		    			$distributor->id = $data[0];
		    		}
		    		$distributor->name = $data[1];
		    		$distributor->address = $data[2];
		    		$distributor->created_by = Auth::user()->email;
		    		$distributor->save();
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
				    	if($data[1] != "")
					    {}
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
			$messages->add('error', 'File is required');
			$this->errors = $messages;
	      	return false;
  		}
  	}
}
