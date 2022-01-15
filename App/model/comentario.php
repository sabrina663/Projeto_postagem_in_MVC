<?php
    class Comentario{
        public static function selecionaComentariosTodos($idPost){
            $con = Conection::getCon();
            $query = 'SELECT * FROM comentario WHERE id_postagem = :id';
            $query = $con->prepare($query);
            $query->bindValue(':id',$idPost);
            $query->execute();
            $resultado = array();
            while($row = $query->fetchObject('comentario')){
                $resultado[] = $row;
            }
            return $resultado;

        }
    }

?>