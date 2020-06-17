<?php
require_once'usuarios.php';
$u= new Usuario;
?>

                    <html lang="pt-br">
                    <head>
                        <meta charset="utf-8"/>
                        <Title>Organize</Title>
                        <link rel="stylesheet" href="estilo.css">
                    </head>
                    <body>
                        <div class="corpo-form">
                        <h1>Cadastrar no Organize</h1>
                        <form method="POST" action="">
                            <input name="nome" type="text" placeholder="Nome Completo" maxlength="50"required>
                            <input name="telefone" type="text" placeholder="Telefone" maxlength="50"required>
                            <input name="email" type="email" placeholder="Usuário"maxlength="50"required>
                            <input name="senha" type="password" placeholder="Senha"maxlength="32" required>
                            <input name="confsenha" type="password" placeholder="Confirmar senha" maxlength="32"required>
                            <input type="submit" value="CADASTRAR" >
                        </form>
                    </div>

<?php
if (isset( $_POST["nome"]))
{
    $nome = addslashes($_POST["nome"]);
    $telefone= addslashes($_POST["telefone"]);
    $email= addslashes($_POST["email"]);
    $senha= addslashes($_POST["senha"]);
    $confsenha= addslashes($_POST["confsenha"]);
}

$u->conectar("organize_login", "localhost", "root","");

if($senha==$confsenha)
{
$u->cadastrar($nome,$telefone,$email,$senha);
}

else{
    echo "As senhas não correspondem";
}
?>

</body>
</html>