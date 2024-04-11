<?php

namespace app\framework\classes;

use Exception;

class Engine {

  private ?string $layout;
  private string $content;
  private array $data;

  private function load() {
    return !empty($this->content) ? $this->content : '';
  }

  private function extends(string $layout, array $data = []) {
    $this->layout = $layout;
    $this->data = $data;
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

    if (!empty($this->layout)) {
      $this->content = $content;
      $data = array_merge($this->data, $data);
      $layout = $this->layout;
      $this->layout = null;
      return $this->render($layout, $this->data);
    }

    return $content;
  }

}