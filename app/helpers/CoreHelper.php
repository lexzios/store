<?php

class CoreHelper {

  private static $_current_user;
  pubilc static function current_user() {
    if( !empty(self::$_current_user) ) return self::$_current_user;
    else {
      if(Auth::check() || Auth::viaRemember()) {
        self::$_current_user = User->find(Auth::id());
        return self::$_current_user;
      } else return null;
    }
  }

}
