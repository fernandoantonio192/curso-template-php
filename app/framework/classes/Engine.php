<?php

namespace app\framework\classes;

use Exception;

class Engine {

  private function test() {
    return "test";
  }

  public function render(string $view, array $data) {
    $srcView = dirname(__FILE__, 2)."/resources/views/{$view}.php";

    if (!file_exists($srcView)) {
      throw new Exception("View <strong>{$view}</strong> not found");
    }
    
    ob_start();

    extract($data);

    require $srcView;

    $content = ob_get_contents();

    ob_end_clean();

    return $content;
  }

}