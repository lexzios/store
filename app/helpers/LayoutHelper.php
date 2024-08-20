<?php

class LayoutHelper
{
  private static $_active_menu_list = array();

  public static function celarActiveMenuList()
  {
    self::$_active_menu_list = array();
  }

  public static function addActiveMenu( $menu )
  {
    self::$_active_menu_list[] = $menu;
  }

  public static function setActiveClass( $menu )
  {
    if(in_array($menu, self::$_active_menu_list))
    {
      return 'class="active"';
    }
    else return '';
  }
}
