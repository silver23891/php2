<?php
require_once '/var/www/html/geekbrains/lesson_3/1/components/Twig/Autoloader.php';
/* 
 * Рендер шаблонов
 */
class Render
{
    /**
     * Сформировать вывод пользователю
     * 
     * @param string $template
     * @param array $params
     * @param string $directory
     * 
     * @return string
     */
    public function renderTemplate($template, $params = array(), $directory = '/var/www/html/geekbrains/lesson_4/views')
    {
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem($directory);
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate($template);
        return $template->render($params);
    }
}
