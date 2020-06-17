<?php

Class Usuario{
    private $pdo;

    //------------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    public function conectar($nome,$host,$usuario,$senha)
    {
        $this->pdo= new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
    }

    //--------------------------------------------------------------------------------------------------------------------------------------------------------//
    
    public function cadastrar($nome,$telefone,$email,$senha)
    {
        //verificar se já está cadastrado//
        $sql= $this->pdo->prepare(" SELECT id_usuario FROM usuarios WHERE email = :e ");
        
        $sql->bindValue(":e", $email);

        $sql->execute();

        if ($sql->rowCount() == 1){
            return false;//ja tá cadastrada//
        }

        else{
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n,:t,:e,:s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------------//


    public function logar($email,$senha)
    {
        $this->pdo;
        //verificando//
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if($sql->rowCOunt() == 1)
        {//entrar no sistema//
            $dado=$sql->fetch();
            session_start();
            $_SESSION["id_usuario"] = $dado['id_usuario'];
            return true; //logado com sucesso//
        }
        else
        {
            return false; //nao logou//
        }
    }
}
    //------------------------------------------------------------------------------------------------------------------------------------//



?>