<?php

class DebugHelper
{
  public static function neat_dump($data, $var_dump=false)
  {
    echo '<pre>';
    if( $var_dump ) var_dump($data);
    else print_r($data);
    echo '</pre>';
  }
}
