<?php

    class SobreController{
        public function index(){
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('sobre.html');
        $paramentros = array();
        $conteudo = $template->render($paramentros);

        echo $conteudo;
        }
    }

?>