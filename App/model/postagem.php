<?php
    class Postagem{
        public static function selecionaTodos(){
            $con = Conection::getCon();
            $query = 'SELECT * FROM postagem ORDER BY id  DESC';
            $query = $con->prepare($query);
            $query->execute();
            $resultado = array();
            while($row = $query->fetchObject('postagem')){
                $resultado[] = $row;
            }
            if(!$resultado){
                throw new Exception('Não foi possivel encontrar nem um registro no Banco.');
            }
            return $resultado;

        }
        public static function selecionarporID($idPost){
            $con = Conection::getCon();
            $query = 'SELECT * FROM postagem WHERE id = :id';
            $query = $con->prepare($query);
            $query->bindValue(':id',$idPost);
            $query->execute();

            $resultado = $query->fetchObject('postagem');
            if(!$resultado){
                throw new Exception('Não foi possivel encontrar nem um registro no Banco.');
            }else{
                $resultado->comentarios = Comentario::selecionaComentariosTodos($resultado->id);
                
            }
            return $resultado;
            

        }public static function insert($dadosPost){

            if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
                throw new Exception("Preencha todos os campos");
                return false;
            }
            $con = Conection::getCon();
            $query = 'INSERT INTO postagem (titulo,conteudo) VALUES(:titulo,:conteudo)';
            $query = $con->prepare($query);
            $query->bindValue(':titulo', $dadosPost['titulo']);
            $query->bindValue(':conteudo', $dadosPost['conteudo']);
            $resultado = $query->execute();
            if($resultado == 0){
                throw new Exception("Falha ao publicar publição");
                return false;
                
            }
            return true;
        }    
        public static function delete($idPost){
            $con = Conection::getCon();
            $query = 'DELETE FROM postagem WHERE :id = id';
            $query = $con->prepare($query);
            $query->bindValue(':id', $idPost['id']);
            $resultado = $query->execute();
            if($resultado == 0){
                throw new Exception('Não possivel deletar a postagem');
                return false;
            }
            return true;

        }
        public static function update($idPost){
            $con = Conection::getCon();
            $query = 'UPDATE postagem SET id = :id, titulo = :titulo, conteudo = :conteudo WHERE :id = id';
            $query = $con->prepare($query);
            $query->bindValue(':id', $idPost['id']);
            $query->bindValue(':titulo', $idPost['titulo']);
            $query->bindValue(':conteudo', $idPost['conteudo']);
            $resultado = $query->execute();
            if($resultado == 0){
                throw new Exception('Não possivel Atualizar a postagem');
                return false;
            }
            return true;

        }
    }

?>