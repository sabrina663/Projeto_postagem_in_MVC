<?php
    
    class AdminController{
        public function index(){
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');

            $objPostagens =  Postagem::selecionaTodos();
            $paramentros = array();
            $paramentros['postagens'] = $objPostagens;

            $conteudo = $template->render($paramentros);

            echo $conteudo;
        }
        public function create(){
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('create.html');

            $paramentros = array();

            $conteudo = $template->render($paramentros);

            echo $conteudo;

        }
        public function insert(){
            try {
                Postagem::insert($_POST);
                
                echo '<script>alert("Publicada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/MVC_projetos/?pagina=admin&metodo=index";</script>';

            } catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC_projetos/?pagina=admin&metodo=create";</script>';
            }
        }
        public function delete(){
            try {
                Postagem::delete($_GET);
                echo '<script>alert("Deletada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/MVC_projetos/?pagina=admin&metodo=index";</script>';

            } catch (\Throwable $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC_projetos/?pagina=admin&metodo=create";</script>';
            }
        }
        public function change($param){
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('update.html');

            $post = Postagem::selecionarporID($param);

            $paramentros = array();
            $paramentros['id'] = $post->id;
            $paramentros['titulo'] = $post->titulo;
            $paramentros['conteudo'] = $post->conteudo; 

            $conteudo = $template->render($paramentros);

            echo $conteudo;
        }
        public function update(){
            try {
                Postagem::update($_POST);
                echo '<script>alert("Editada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/MVC_projetos/?pagina=admin&metodo=index";</script>';

            } catch (\Throwable $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/MVC_projetos/?pagina=admin&metodo=change&id='.$_POST['id'].'";</script>';
            }
        }
    }

?>