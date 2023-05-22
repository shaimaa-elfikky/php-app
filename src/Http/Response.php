<?php
  namespace TestTask\Http;

  
  class Response
  {
      public function setStatusCode(int $code)
      {
          http_response_code($code);
      }
  
      public function back()
      {
        if (!empty($route)) {
            header('Location:' . $route);
        } elseif (!empty($_SERVER['HTTP_REFERER'])) {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
  
          return $this;
      }
  }