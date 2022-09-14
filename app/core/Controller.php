<?php

namespace app\core;

use app\classes\Macros;

use ReflectionClass;

class Controller
{

    private ?string $layout;
    private string $content;
    private array $data;
    private array $dependencies;
    private array $section;
    private string $actualSection;

    protected function load(string $view, $params = [])
    {
        $view = $_SERVER['DOCUMENT_ROOT'] . "/app/view/{$view}.php";
        if (file_exists($view)) {
            $this->dependencies([new Macros]);
            echo $this->render($view, $params);
        } 
    }


    public function render(string $view, array $data)
    {
        if (!file_exists($view)) {
            echo $view;
        }

        ob_start();

        extract($data);

        require $view;

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

    private function dependencies(array $dependencies)
    {
        foreach ($dependencies as $dependency) {
            $className = strtolower((new ReflectionClass($dependency))->getShortName());
            $this->dependencies[$className] = $dependency;
        }
    }

    public function showMessage(string $titulo, string $descricao, string $link = null, int $httpCode = 200)
    {
        http_response_code($httpCode);

        $this->load('partials/message', [
            'titulo'    => $titulo,
            'descricao' => $descricao,
            'link'      => $link
        ]);
    }
}
