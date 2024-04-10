<?php

namespace app\framework\classes;

class Auth {

  public static function check(string $type) {
    switch ($type) {
      case "auth":
        if (!$_SESSION["logged"]) {
          return redirect("/");
        }
      break;
    }
  } 

}