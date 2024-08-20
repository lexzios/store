<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_category';
	protected $primaryKey = "id";

	private $_create_rules = array(
		'parent_id' => 'required',
		'name' => 'required',
		'permalink' => 'required',
	);

	private $_update_rules = array(
		'parent_id' => 'required',
		'name' => 'required',
		'permalink' => 'required',
	);

	public static function fresh( $category_params )
  	{
  		$category = new Category();
   		foreach($category_params as $key => $param)
    	{
      		$category->$key = $param;
    	}
      	$category->created_by = Auth::user()->email;

    	return $category;
	}

	public function modify( $category_params )
	{
		foreach($category_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $category_params = null )
	{
		if( empty($category_params) ) $category_params = $this->toArray();
			if( $this->exists ) $validator = Validator::make($category_params,$this->_update_rules);
			else $validator = Validator::make($category_params, $this->_create_rules);
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

	//for image upload
	private $_destination_directory = 'images/price_list/';

	public function upload_image($filename) {
		// check if contain some file
	    if(Input::hasFile('category')) 
	    {
	      //check if file valid
	      if(Input::file('category')['file_path']->isValid()) 
	      {
	        //check existing folder
	        if(!is_dir($this->_destination_directory))
	        {
	          mkdir($this->_destination_directory);
	        }

	        $file = Input::file('category')['file_path'];

	        //move or save file
	        if($file->move($this->_destination_directory, $filename))
	        {
	          return true;
	        }
	        else
	        {
				$messages = new Illuminate\Support\MessageBag;
				$messages->add('error', 'Save File Failed');
				$this->errors = $messages;
				return false;
	        }
	      }
	      else
	      {
	      	$messages = new Illuminate\Support\MessageBag;
	        $messages->add('error', 'File not Valid');
	        $this->errors = $messages;
	        return false;
	      }
	    }
	    else
	    {
	      	return true;
	    }
	}

	//has Many eloquent table join
	public function product() 
	{
		return $this->hasMany('Product', 'product_category_id');
	}
}
