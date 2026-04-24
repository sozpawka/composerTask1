<?php

namespace Src;

use Exception;

class View
{
   private string $view = '';
   private array $data = [];
   private string $root = '';
   private string $layout = '/layouts/main.php';

   public function __construct(string $view = '', array $data = [])
   {
       $this->root = $this->getRoot();
       $this->view = $view;
       $this->data = $data;
   }

   private function getRoot(): string
   {
       // Находим путь к папке views относительно текущего файла (core/Src/View.php)
       return realpath(__DIR__ . '/../../views');
   }

   private function getPathToMain(): string
   {
       return $this->root . $this->layout;
   }

   private function getPathToView(string $view = ''): string
   {
       $view = str_replace('.', '/', $view);
       return $this->root . "/$view.php";
   }

   public function render(string $view = '', array $data = []): string
   {
       $path = $this->getPathToView($view);
       $mainPath = $this->getPathToMain();

       if (file_exists($mainPath) && file_exists($path)) {
           extract($data, EXTR_PREFIX_SAME, '');

           ob_start();
           require $path;
           $content = ob_get_clean();

           ob_start();
           require $mainPath;
           return ob_get_clean();
       }
       // Выводим путь в ошибке, чтобы понять, где он ищет файл, если опять упадет
       throw new Exception('Error render. Path not found: ' . $path);
   }

   public function __toString(): string
   {
       try {
           return $this->render($this->view, $this->data);
       } catch (Exception $e) {
           return $e->getMessage();
       }
   }
}