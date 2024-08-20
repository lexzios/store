<?php

namespace admin;
use View;
use Input;
use Redirect;
use LayoutHelper;

use Category;
use Auth;

class CategoryController extends BaseController {

  public function __construct()
  {
    parent::__construct();

    $this->beforeFilter('@set_attribute', array('only' => array('show', 'fresh', 'create', 'update')));
    $this->beforeFilter('@set_category', array('only' => array('show', 'edit', 'update', 'destroy')));
    $this->template['page-title'] = 'Central PC Admin - Category Management';
    $this->template['main-bar-title'] = '<i class="fa fa-list"></i>&nbsp; Category Management';
    LayoutHelper::addActiveMenu('admin.category');
  }

  # GET /admin/rateconversions
  public function index()
  {
    $categories = Category::where('is_deleted', 0)->orderBy('sorting_id', 'DESC')->get();
    return View::make('admin.category.index', array('categories' => $categories));
  }

  public function show($id)
  {
    return View::make('admin.category.show', array('category' => $this->_category, 'categories' => $this->_categories, 'parent_categories' => $this->_parent_categories));
  }

  public function fresh()
  {
    $category = new Category();
    return View::make('admin.category.new', array('category' => $category, 'categories' => $this->_categories, 'parent_categories' => $this->_parent_categories));
  }

  public function edit($id)
  {
    $this->_categories = $this->setAllParentCategory(Category::where('is_deleted', 0)->where('id', '<>', $id)->orderBy('sorting_id', 'DESC')->get());
    $this->_parent_categories = $this->addCategoryArray(Category::where('is_deleted', 0)->orderBy('sorting_id', 'DESC')->where('parent_id', 0)->where('id', '<>', $id)->get(array('sorting_id', 'name'))->lists('name', 'sorting_id'));
    return View::make('admin.category.edit',  array('category' => $this->_category, 'categories' => $this->_categories, 'parent_categories' => $this->_parent_categories));
  }

  public function create()
  {
    $category = Category::fresh( $this->_category_params() );
    if($category->validate() && $category->upload_image($this->_filename) && $category->save())
    {
      Category::where('parent_id', 0)->where('is_deleted', 0)->where('sorting_id', '>=', $category->sorting_id)->where('id', '<>', $category->id)->increment('sorting_id', 1);
      return Redirect::to('/admin/category/'. $category->id)->with('message', 'New Category was successfully created.');
    }
    else
    {
      return View::make('admin.category.new', array('category' => $category, 'categories' => $this->_categories, 'parent_categories' => $this->_parent_categories));
    }
  }

  public function update($id) {
    $this->_category->modify( $this->_category_params() );
    if( $this->_category->validate() && $this->_category->upload_image($this->_filename) && $this->_category->save() )
    {
      Category::where('parent_id', 0)->where('is_deleted', 0)->where('sorting_id', '>=', $this->_category->sorting_id)->where('id', '<>', $this->_category->id)->increment('sorting_id', 1);
      return Redirect::to('/admin/category/'. $this->_category->id)->with('message', 'New Category was successfully updated.');
    }
    else
    {
      return View::make('admin.category.edit',  array('category' => $this->_category, 'categories' => $this->_categories, 'parent_categories' => $this->_parent_categories));
    }
  }

  public function destroy($id) {
    Category::where('is_deleted', 0)->where('parent_id', $this->_category->id)->update(array('parent_id' => 0));
    $this->_category->deleted_by = Auth::user()->email;
    $this->_category->permalink = $this->_category->permalink."-deleted";
    $this->_category->is_deleted = '1';
    $this->_category->save();
    // $this->_product->delete();
    return Redirect::to('/admin/category')->with('message', 'Category was successfully deleted.');
  }

  public function getCategoryRoot($id)
  {
    if($id == "root")
    {
      $categories = Category::where('is_deleted', 0)->where('parent_id', 0)->orderBy('sorting_id', 'DESC')->get();
    }
    else
    {
      $categories = Category::where('is_deleted', 0)->where('parent_id', $id)->orderBy('sorting_id', 'DESC')->get();
    }
    return View::make('admin.category.management_sorting', array('categories' => $categories));
  }

  public function manageCategory()
  {
    $categories = $_POST['categories'];
    for($i=0;$i<count($categories);$i++)
    {
      Category::where('is_deleted', 0)->where('id', $categories[$i])->update(array('sorting_id' => count($categories)-($i+1)));
    }
  }

  private $_category;
  public function set_category($route, $request)
  {
    $this->_category = Category::find($route->getParameter('id'));
  }

  private $_categories;
  private $_parent_categories;
  public function set_attribute()
  {
    $this->_categories = $this->setAllParentCategory(Category::where('is_deleted', 0)->orderBy('sorting_id', 'DESC')->get());
    $this->_parent_categories = $this->addCategoryArray(Category::where('is_deleted', 0)->orderBy('sorting_id', 'DESC')->where('parent_id', 0)->get(array('sorting_id', 'name'))->lists('name', 'sorting_id'));
  }

  # Get product params
  private $_allowed_category_params = array('parent_id', 'name', 'permalink', 'sorting_id', 'description', 'file_path', 'title_seo', 'description_seo', 'keyword_seo');
  //for image upload
  private $_destination_directory = 'images/price_list/';
  private $_filename;

  private function _category_params()
  {
    $input_category_params = Input::get('category');
    $category_params = array();
    foreach($input_category_params as $key => $category_param)
    {
      if( in_array($key, $this->_allowed_category_params) )
      {
        $category_params[$key] = $category_param;
      }
    }
    if($category_params['parent_id'] != 0)
    {
      $category_params['sorting_id'] = 0;
    }
    else
    {
      $category_params['sorting_id'] = $category_params['sorting_id'] + 1;
    }

    // check if contain some file
    if(Input::hasFile('category')) 
    {
      //check if file valid
      if(Input::file('category')['file_path']->isValid()) 
      {
        $this->_filename = $input_category_params['name'].'.'.Input::file('category')['file_path']->getClientOriginalExtension();
        $category_params['file_path'] = "/".$this->_destination_directory.$this->_filename;
      }
    }

    return $category_params;
  }

  public function addCategoryArray($data)
  {
    $category = array();
    $category[0] = '--Automatic--';
    foreach($data as $key => $category_param)
    {
      $category[$key] = $category_param;
    }
    return $category;
  }

  private function setAllParentCategory($data)
  {
    $dataParent = array();
    $dataParent[0] = "--As Root--";
    for($i=0;$i<count($data);$i++)
    {
      for($j=0;$j<count($data);$j++)
      {
        $is_header = 0;
        if($data[$i]->parent_id == $data[$j]->id && $data[$j]->is_header == 1)
        {
          $is_header = 1;
          break;
        }
      }
      if($is_header == 0)
        {
          $dataParent[$data[$i]->id] = $data[$i]->name;
        }
    }
    // dd($dataParent);
    return $dataParent;
  }
}
