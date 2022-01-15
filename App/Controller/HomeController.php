<?php

    class HomeController{
        public function index(){
           try{
               
            $postagens =  Postagem::selecionaTodos();
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $paramentros = array();
            $paramentros['postagens'] = $postagens;

            $conteudo = $template->render($paramentros);

            echo $conteudo;

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

?>