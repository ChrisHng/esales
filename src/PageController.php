<?php

namespace eSales;

use Symfony\Component\HttpFoundation\Request;

class PageController {
    
    public static function content($page) {
        $loader = new \Twig_Loader_Filesystem('../templates');
        $twig = new \Twig_Environment($loader);

        return $twig->render('home.html.twig');
    }
}
