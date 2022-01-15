<?php

    class PostController{
        public function index($params){
           try{
            $postagem =  Postagem::selecionarporID($params);
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $paramentros = array();
            $paramentros['titulo'] = $postagem->titulo;
            $paramentros['conteudo'] = $postagem->conteudo;
            $paramentros['comentarios'] = $postagem->comentarios;

            $conteudo = $template->render($paramentros);

            echo $conteudo;

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

?>