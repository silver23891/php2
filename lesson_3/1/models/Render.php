<?php
require_once 'components/Twig/Autoloader.php';
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
    public function renderTemplate($template, $params = array(), $directory = 'views')
    {
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem($directory);
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate($template);
        return $template->render($params);
    }
}
