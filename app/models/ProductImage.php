<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ProductImage extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_image';
	protected $primaryKey = "id";
	
	public function productImage() 
	{
		return $this->belongsTo('Product');
	}

	private $_create_rules = array(
		'image_path' => 'required|min:1'
	);

	private $_update_rules = array(
		'image_path' => 'required|min:1'
	);

	public static function fresh( $image_params, $product_id )
  	{
  		$image = new ProductImage();
  		$image->product_id = $product_id;
   		foreach($image_params as $key => $param)
    	{
      		$image->$key = $param;
    	}
    	$image->created_by = Auth::user()->email;
    	return $image;
	}

	public function modify( $image_params )
	{
		foreach($image_params as $key => $param)
		{
		  $this->$key = $param;
		}
    	$this->updated_by = Auth::user()->email;
	}

	public $errors = null;
	public function validate( $image_params = null )
	{
		if( empty($image_params) ) $image_params = $this->toArray();
			if( $this->exists ) $validator = Validator::make($image_params,$this->_update_rules);
			else $validator = Validator::make($image_params, $this->_create_rules);
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



	//for image upload
  	private $_destination_directory = 'images/product/';
	//upload file
	//upload all image input and save to DB
	  public function image_upload($filename)
	  {
		//check if contain some file
	    if(Input::hasFile('image')) 
	    {
	        //check if file valid
	        if(Input::file('image')['image_path']->isValid()) 
	        {
	          // resize image input
	          $img = $this->image_resizing(Input::file('image')['image_path']);
	          //check directory existing
	          if(!is_dir($this->_destination_directory))
	          {
	            mkdir($this->_destination_directory);
	          }
	          //move or save file
	          $upload_success = $img->save($this->_destination_directory.$filename, 100);

	          if($upload_success)
	          {
	            return true;            
	          }
	          else
	          {
	          	$messages = new Illuminate\Support\MessageBag;
				$messages->add('error', 'Upload Image Failed');
				$this->errors = $messages;
	          	return false;
	          }
	        }
	        else 
	        {
	        	$messages = new Illuminate\Support\MessageBag;
				$messages->add('error', 'File is not valid');
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
	    // if($width < $widthToResize && $height < $heightToResize)
	    // {
	    //   if($width > $height)
	    //   {
	    //     // resize the image to a width of widthToResize and constrain aspect ratio (auto height)
	    //       $img->resize($widthToResize, null, function ($constraint) {
	    //           $constraint->aspectRatio();
	    //       });
	    //   }
	    //   else
	    //   {
	    //     // resize the image to a height of heightToResize and constrain aspect ratio (auto width)
	    //       $img->resize(null, $heightToResize, function ($constraint) {
	    //           $constraint->aspectRatio();
	    //       });
	    //   }
	    // }
	    // else
	    // {
	    //   if($width > $height)
	    //   {
	    //     if($width > $widthToResize)
	    //     {
	    //       // resize the image to a width of widthToResize and constrain aspect ratio (auto height)
	    //       $img->resize($widthToResize, null, function ($constraint) {
	    //           $constraint->aspectRatio();
	    //       });
	    //     }
	    //   }
	    //   else
	    //   {
	    //     if($width > $widthToResize)
	    //     {
	    //       // resize the image to a width of widthToResize and constrain aspect ratio (auto height)
	    //       $img->resize($widthToResize, null, function ($constraint) {
	    //           $constraint->aspectRatio();
	    //       });
	    //     }
	    //   }
	    // }

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
	        if($height > $heightToResize)
	        {
	          // resize the image to a height of heightToResize and constrain aspect ratio (auto width)
	          $img->resize(null, $heightToResize, function ($constraint) {
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
	        if($height > $heightToResize)
	        {
	          // resize the image to a height of heightToResize and constrain aspect ratio (auto width)
	          $img->resize(null, $heightToResize, function ($constraint) {
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
}
