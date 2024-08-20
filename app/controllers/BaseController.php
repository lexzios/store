<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function not_found()
  {
  	return View::make('userweb.404');
  }

	//calculation
	  public function product_price_calculation($data) {
	    for($i=0;$i<count($data);$i++)
	    {
	      //if from distributor
	      if(isset($data[$i]->productDistributor[0]))
	      {
	        $data[$i]->base_price = $data[$i]->productDistributor[0]->distributor_product_price;
	        for($j=0;$j<count($data[$i]->productDistributor);$j++)
	        {
	          if($data[$i]->base_price > $data[$i]->productDistributor[$j]->distributor_product_price)
	          {
	            $data[$i]->base_price = $data[$i]->productDistributor[$j]->distributor_product_price;
	          }
	        }
	      }

	      //if not rupiah //1=IDR ->rupiah flag from db
	      if(strcmp($data[$i]->currency_code, 'IDR') !== 0)
	      {
	        $rateConversion = RateConversion::where('is_deleted', 0)->where('from_currency_code', $data[$i]->currency_code)->where('to_currency_code', 'IDR')->get();
	        if(isset($rateConversion[0]))
	        {
	          $rateConversion = $rateConversion[0];
	          $data[$i]->base_price = $data[$i]->base_price*$rateConversion->rate;
	        }
	      }
	      if($data[$i]->base_price != 0)
	      {
	        if($data[$i]->formula_id != 0)
	        {
	          $formula = MarkUpFee::where('is_deleted', 0)->where('id', $data[$i]->formula_id)->get();
	          if(isset($formula[0]))
	          {
	            $formula = $formula[0];
	            $data[$i]->base_price = ($data[$i]->base_price + ($data[$i]->base_price*($formula->float_fee/100))) + $formula->fixed_fee;
	          }       
	        }
	        if($data[$i]->is_sale == 1)
	        {
	          if($data[$i]->streak_price > $data[$i]->base_price)
	          {
	            $data[$i]->discount = '-'.ceil((($data[$i]->streak_price - $data[$i]->base_price)/$data[$i]->streak_price)*100) .'%';
	            $data[$i]->streak_price = 'Rp. '.number_format($data[$i]->streak_price,0,",",".");
	          }
	          else
	          {
	            $data[$i]->streak_price = "";
	          }
	        }
	        $data[$i]->base_price = 'Rp. '.number_format($this->_roundNearestThousandUp($data[$i]->base_price),0,",",".");

	        if($data[$i]->is_call_for_best_price == 1)
	        {
	          $data[$i]->streak_price = 'Call For Best Price';
	        }
	      }
	      else
	      {
	        $data[$i]->streak_price = 'call';
	        $data[$i]->base_price = 'CALL';
	      }
	    }
	    return $data;
	  }

	  public function _roundNearestThousandUp($number)
	  {
	    return ceil($number/1000)*1000;
	  }


	  public function latest_blog() {
		// include our wordpress functions
		// change relative path to find your WP dir
		define('WP_USE_THEMES', false);
		global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
		// require('http://dev.tokocentralpc.com/blog/wp-blog-header.php');
		require('/blog/wp-blog-header.php');

		// set header for json mime type
		header('Content-type: application/json;');
		 
		// get latest single post
		query_posts(array(
		  'posts_per_page' => 10,
		));
		 
		$jsonpost = array();
		if (have_posts()) {
		  // initialize functions used below
			$i=0;
			while (have_posts() ) : the_post();
				// construct our array for json
			  // apply_filters to content to process shortcodes, etc
			  $jsonpost[$i]["id"] = get_the_ID();
			  $jsonpost[$i]["title"] = get_the_title();
			  $jsonpost[$i]["url"] = apply_filters('the_permalink', get_permalink());
			  $jsonpost[$i]["content"] = strip_shortcodes(wp_trim_words( get_the_content(), 20 ));
			 
			  // would rather do iso 8601, but not supported in gwt (yet)
			  $jsonpost[$i]["date_day"] = get_the_time('d');
			  $jsonpost[$i]["date_month"] = get_the_time('M');
			  $i++;
			endwhile;
		} else {
		  // deal with no posts returned
		}
		 
		// output json to file
		return $jsonpost;
		// echo json_encode($jsonpost);

	  }

}
