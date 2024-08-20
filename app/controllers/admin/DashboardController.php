<?php

namespace admin;
use View;
use LayoutHelper;

use RateConversion;
use Auth;

class DashboardController extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->template['page-title'] = 'Central PC Admin - Dashboard';
    LayoutHelper::addActiveMenu('dashboard');
  }

  public function index()
  {
    $this->template['main-bar-title'] = '<i class="fa fa-dashboard"></i>&nbsp; Dashboard';
    $conversions = RateConversion::with('currency_from')->with('currency_to')->where('is_deleted', '0')->get();
    return View::make('admin.dashboard.index', array('conversions' => $conversions));
  }

}
