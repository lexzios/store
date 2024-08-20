<?php

class CaraOrderController extends BaseController {

  # GET /CaraOrder
  public function index()
  {
	 return View::make('userweb.cara_order')->withTitle("Cara Order");  	
  }

}
