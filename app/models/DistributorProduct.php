<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class DistributorProduct extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'distributor_product';
	protected $primaryKey = "id";

	public function productName() 
	{
		return $this->hasOne('Product', 'id', 'product_id');
	}

	private $_create_rules = array(
		'name' => 'required',
		'distributor_product_price' => 'required|numeric',
		'product_id' => 'required',
		'currency_code' => 'required'
	);

	private $_update_rules = array(
		'name' => 'required',
		'distributor_product_price' => 'required|numeric',
		'product_id' => 'required',
		'currency_code' => 'required'
	);

	public static function fresh( $distributor_product_params )
  	{
  		$distributorProduct = new DistributorProduct();
   		foreach($distributor_product_params as $key => $param)
    	{
      		$distributorProduct->$key = $param;
    	}
    	$distributorProduct->created_by = Auth::user()->email;
    	return $distributorProduct;
	}

	public function modify( $distributor_product_params )
	{
		foreach($distributor_product_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $distributor_product_params = null )
	{
		if( empty($distributor_product_params) ) $distributor_product_params = $this->toArray();
			if( $this->exists ) $validator = Validator::make($distributor_product_params,$this->_update_rules);
			else $validator = Validator::make($distributor_product_params, $this->_create_rules);
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
			if( $data != ""
				&& $data[1] != ""
				&& $data[2] != ""
				&& $data[4] != ""
				&& $data[5] != ""
				&& is_numeric($data[5]) )  
			{
				if($distributorProduct = DistributorProduct::find($data[0]))
			    {
			    	$distributorProduct->distributor_id = $data[1];
				    $distributorProduct->name = $data[2];
				    $distributorProduct->currency_code = $data[4];
				    $distributorProduct->distributor_product_price = $data[5];
				    $distributorProduct->updated_by = Auth::user()->email;
			    	if($data[3] != "")
			    	{
					    $product = Product::where('id', $data[3])->get(array('currency_code'))->lists('currency_code');
			    		if(isset($product[0]) && strcmp($product[0],  $data[4]) == 0)
			    		{
						    $distributorProduct->product_id = $data[3];
			    		}
			    	}
			    }
				else
				{
					$distributorProduct = new DistributorProduct();
					if($data[0]!="" && is_numeric($data[0]))
					{
						$distributorProduct->id = $data[0];
					}
					$distributorProduct->distributor_id = $data[1];
					$distributorProduct->name = $data[2];
					$distributorProduct->currency_code = $data[4];
					$distributorProduct->distributor_product_price = $data[5];
					$distributorProduct->created_by = Auth::user()->email;
					if($data[3] != "")
			    	{
			    		$product = Product::where('id', $data[3])->get(array('currency_code'))->lists('currency_code');
			    		if(isset($product[0]) && strcmp($product[0],  $data[4]) == 0)
			    		{
			    			$distributorProduct->product_id = $data[3];
			    		}
			    	}
				}
			}
			$distributorProduct->save();
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
				    if( $data != "" )
				    {
				    	if( $data[1] != ""
				    		&& $data[2] != ""
				    		&& $data[4] != ""
				    		&& $data[5] != ""
				    		&& is_numeric($data[5]) )  
				    	{
						    	if($data[3] != "")
						    	{
								    $product = Product::where('id', $data[3])->get(array('currency_code'))->lists('currency_code');
						    		if(isset($product[0]) && strcmp($product[0],  $data[4]) == 0)
						    		{}
							    	else
							    	{
							    		$messages = new Illuminate\Support\MessageBag;
										$messages->add('error', 'Error Currency in row '.$i);
										$this->errors = $messages;
										fclose($csv_file);
								    	return false;
							    	}
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
			$messages->add('error', 'File is required');
			$this->errors = $messages;
	      	return false;
	    }
  	}

  	//has One eloquent table join
	public function distributor() 
	{
		return $this->hasOne('Distributor', 'id', 'distributor_id');
	}
	
}
