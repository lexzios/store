<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
	protected $primaryKey = "id";

	private $_create_rules = array(
		'product_category_id' => 'required|numeric',
		'currency_code' => 'required',
		'formula_id' => 'required|numeric',
		'permalink' => 'required',
		'name' => 'required',
		'short_description' => 'required',
		'long_description' => 'required',
		'base_price' => 'required|numeric',
	);

	private $_update_rules = array(
		'product_category_id' => 'required|numeric',
		'currency_code' => 'required',
		'formula_id' => 'required|numeric',
		'permalink' => 'required',
		'name' => 'required',
		'short_description' => 'required',
		'long_description' => 'required',
		'base_price' => 'required|numeric',
	);

	public static function fresh( $product_params )
  	{
  		$product = new Product();
   		foreach($product_params as $key => $param)
    	{
      		$product->$key = $param;
    	}
    	$product->created_by = Auth::user()->email;
    	return $product;
	}

	public function modify( $product_params )
	{
		foreach($product_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $product_params = null )
	{
		if( empty($product_params) ) $product_params = $this->toArray();
			if( $this->exists ) $validator = Validator::make($product_params,$this->_update_rules);
			else $validator = Validator::make($product_params, $this->_create_rules);
		if( $validator->passes() )
		{
			if(isset($product_params['id']))
			{
				$isExist = count(Product::where('permalink', $product_params['permalink'])->where('id', '<>', $product_params['id'])->get());
			}
			else
			{
				$isExist = count(Product::where('permalink', $product_params['permalink'])->get());

			}
			if($isExist != 0)
			{
				$messages = new Illuminate\Support\MessageBag;
				$messages->add('error', 'Permalink already exist');
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
		$csv_file = fopen($this->_temp_file_directory.$this->_csv_name,"r");
		fgetcsv($csv_file);
		while(! feof($csv_file))
		{
			$data = fgetcsv($csv_file);
			if($data != ""
				&& $data[1] != "" 
				&& $data[2] != "" 
				&& $data[3] != "" 
				&& $data[5] != ""
				&& $data[6] != ""
				&& $data[7] != ""
				&& $data[8] != ""
				&& is_numeric($data[1])
				&& is_numeric($data[3]) 
				&& is_numeric($data[8]) )
			{
				if($product = Product::find($data[0]))
			    {
			    	$product->updated_by = Auth::user()->email;
			    }
				else
				{
					$product = new Product();
					if($data[0]!="" && is_numeric($data[0]))
					{
						$product->id = $data[0];
					}
					$product->created_by = Auth::user()->email;
					
				}
				$product->product_category_id = $data[1];
				$product->currency_code = $data[2];
				$product->formula_id = $data[3];
				if($data[4] != "")
				{
					$product->permalink = $this->_seoUrl($data[4]);
				}
				else
				{
					$product->permalink = $this->_seoUrl($data[5]);
				}
				$product->name = $data[5];
				$product->short_description = $data[6];
				$product->long_description = $data[7];
				$product->base_price = $data[8];
				$product->is_sale = $data[9];
				$product->streak_price = $data[10];
				$product->is_call_for_best_price = $data[11];

				$product->save();
			}
		}
		fclose($csv_file);
		return true;
	}

	private function _seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "-", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", "-", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
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
				    	if( $data[1] != "" 
				    		&& $data[2] != "" 
				    		&& $data[3] != "" 
				    		&& $data[5] != ""
				    		&& $data[6] != ""
				    		&& $data[7] != ""
				    		&& $data[8] != ""
				    		&& is_numeric($data[1])
				    		&& is_numeric($data[3]) 
				    		&& is_numeric($data[8]) )
				    	{
				    		if($data[4] == "")
				    		{
				    			$data[4] = $data[5];
				    		}
				    		if($data[0] != "")
				    		{
				    			$product_exists = Product::where('id', '<>', $data[0])->where('permalink', $this->_seoUrl($data[4]))->where('is_deleted', 0)->get();
				    			if(isset($product_exists[0]))
				    			{
				    				$messages = new Illuminate\Support\MessageBag;
									$messages->add('error', 'Existing Permalink in row '.$i);
									$this->errors = $messages;
									fclose($csv_file);
								  	return false;
				    			}
				    		}
				    		else
				    		{
				    			$product_exists = Product::where('permalink', $this->_seoUrl($data[4]))->where('is_deleted', 0)->get();
				    			if(isset($product_exists[0]))
				    			{
				    				$messages = new Illuminate\Support\MessageBag;
									$messages->add('error', 'Existing Permalink in row '.$i);
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

  	//for image upload
  private $_destination_directory = 'images/product/';
	//upload file
  public function upload_image($filename)
  {
    // check if contain some file
    if(Input::hasFile('product')) 
    {
      //check if file valid
      if(Input::file('product')['image_path']->isValid()) 
      {
        //resize image input
        $img = $this->image_resizing(Input::file('product')['image_path']);

        //check existing folder
        if(!is_dir($this->_destination_directory))
        {
          mkdir($this->_destination_directory);
        }

        //move or save file
        if($img->save($this->_destination_directory.$filename, 100))
        {
          return true;
        }
        else
        {
			$messages = new Illuminate\Support\MessageBag;
			$messages->add('error', 'Save Image Failed');
			$this->errors = $messages;
			return false;
        }
      }
      else
      {
      	$messages = new Illuminate\Support\MessageBag;
        $messages->add('error', 'Image not Valid');
        $this->errors = $messages;
        return false;
      }
    }
    else
    {
    	$messages = new Illuminate\Support\MessageBag;
      	$messages->add('error', 'Please Upload Image');
      	$this->errors = $messages;
      	return false;
    }
  }

  //image resize
  public function image_resizing($image)
  {
    $heightToResize = 232;
    $widthToResize = 232;
    $img = Image::make($image);
    list($width, $height, $type, $attr) = getimagesize($image);
    if($width < $widthToResize && $height < $heightToResize)
    {
      if($width > $height)
      {
        // resize the image to a width of widthToResize and constrain aspect ratio (auto height)
          $img->resize($widthToResize, null, function ($constraint) {
              $constraint->aspectRatio();
          });
      }
      else
      {
        // resize the image to a height of heightToResize and constrain aspect ratio (auto width)
          $img->resize(null, $heightToResize, function ($constraint) {
              $constraint->aspectRatio();
          });
      }
    }
    else
    {
      if($width > $height)
      {
        if($width > $widthToResize)
        {
          // resize the image to a width of widthToResize and constrain aspect ratio (auto height)
          $img->resize($widthToResize, null, function ($constraint) {
              $constraint->aspectRatio();
          });
        }
      }
      else
      {
        if($width > $widthToResize)
        {
          // resize the image to a width of widthToResize and constrain aspect ratio (auto height)
          $img->resize($widthToResize, null, function ($constraint) {
              $constraint->aspectRatio();
          });
        }
      }
    }
    // resize canvas fix
    return $img->resizeCanvas($widthToResize, $heightToResize);
    // resize only the width of the image
    // return $img->resize(300, null);

    // resize only the height of the image
    // return $img->resize(null, 200);

    // resize the image to a width of 300 and constrain aspect ratio (auto height)
    // return $img->resize(300, null, function ($constraint) 
    //   {
    //     $constraint->aspectRatio();
    //   });

    // resize the image to a height of 200 and constrain aspect ratio (auto width)
    // return $img->resize(null, 200, function ($constraint) 
    //   {
    //     $constraint->aspectRatio();
    //   });

    // prevent possible upsizing
    // return $img->resize(null, 400, function ($constraint) 
    //   {
    //     $constraint->aspectRatio();
    //     $constraint->upsize();
    //   });
  }

	//has Many eloquent table join
	public function productImage() 
	{
		return $this->hasMany('ProductImage', 'product_id');
	}

	public function productDistributor() 
	{
		return $this->hasMany('DistributorProduct', 'product_id');
	}

	//has One eloquent table join
	public function productCategory() 
	{
		return $this->hasOne('Category', 'id', 'product_category_id');
	}

	public function productFormula() 
	{
		return $this->hasOne('MarkUpFee', 'id', 'formula_id');
	}

	public function productCurrency() 
	{
		return $this->hasOne('Currency', 'code', 'currency_code');
	}
}
