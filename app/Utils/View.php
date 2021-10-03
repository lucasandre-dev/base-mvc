<?php

namespace App\Utils;

class View
{

    /** Renderiza as views
     * @param $view
     * @param array $vars
     * @return array|string|string[]
     */
    private static function template($view, $vars = [])
    {
        $content = self::getView($view);
        return self::renderVars($content, $vars);
    }

    /** Verifica se existe e busca o arquivo que será renderizado
     * @param string $view
     * @return string
     */
    private static function getView($view)
    {
        $file = __DIR__ . "/../../resources/view/". THEME_DIR . $view . ".html";
        return file_exists($file) ? file_get_contents($file) : 'View não encontrada';
    }

    /** Converte as variaveis em texto e retorna a view renderizada
     * @param $content
     * @param array $vars
     * @return array|string|string[]
     */
    private static function renderVars($content, $vars = [])
    {
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return "{{".$item."}}";
        }, $keys);

        return str_replace($keys, $vars, $content);
    }

    /** Renderiza o header
     * @param $title
     * @return array|string|string[]
     */
    private static function header($title, $view)
    {
        return self::template($view, [
            'title'=>$title
        ]);
    }

    /** Renderiza o footer
     * @return array|string|string[]
     */
    private static function footer($view)
    {
        return self::template($view);
    }

    /** Renderiza a view completa com header, content e footer
     * @param $title
     * @param $content
     * @return array|string|string[]
     */
    private static function renderPage($title, $content, $header, $footer)
    {
        return self::template('page', [
            'header'=>self::header($title, $header),
            'content' => $content,
            'footer'=>self::footer($footer)
        ]);
    }

    /** Inicia a renderização da view
     * @param string $view
     * @return string
     */
    public static function render($view, $vars = [], $title = 'Site MVC', $header = "header", $footer = "footer")
    {
        $content = self::template($view, $vars);
        return self::renderPage($title, $content, $header, $footer);
    }
}