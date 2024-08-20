<?php

namespace admin;
use View;
ini_set("auto_detect_line_endings", true);

// // //include composer autoload
// // require 'vendor/autoload.php';

// //import the Intervention Image Manager Class
// use Intervention\Image\ImageManagerStatic as Image;

// //configure with favored image driver (gd by default)
// Image::configure(array('driver' => 'imagick'));

class BaseController extends \BaseController {

  public $template;

  public function __construct()
  {
    // Perform CSRF check on all post/put/patch/delete requests
    $this->beforeFilter('auth');
    $this->template = array(
      'page-title' => 'Central PC Admin',
      'main-bar-title' => '<i class="fa fa-square-o"></i>&nbsp; Blank Page'
    );
    View::composer('admin.*', function($view) {
      $view->with('template', $this->template);
    });
  }


  //file => csv
  //table => table db where you want to insert csv
  // public function _csv_upload($file, $table)
  // {
  //   // $temp_file_directory = sys_get_temp_dir()."/";
  //   $temp_file_directory = 'csv/';
  //   $csv_name = "CSV".str_random(5).".".$file->getClientOriginalExtension();
  //   $upload_success = $file->move($temp_file_directory, $csv_name);
  //   if($upload_success)
  //   {
  //     $query = sprintf("LOAD DATA LOCAL INFILE '%s' REPLACE INTO TABLE ".$table." FIELDS TERMINATED BY ','  LINES TERMINATED BY '\\n' IGNORE 0 LINES", addslashes($temp_file_directory.$csv_name));
  //     return DB::connection()->getpdo()->exec($query);
  //   }
  //   else
  //   {
  //     return false;
  //   }

  // }

}
