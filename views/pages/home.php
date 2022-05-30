<div class="container">
<?php  

if(isset($_GET['apagar'])){
$apagar = $_GET['apagar'];
$excluir = \MySql::connect()->prepare("DELETE FROM usuario WHERE id = $apagar");
$excluir->execute();
echo '<script>alert("O usuário com o id '.$apagar.' foi deletado com sucesso!!");location.href="home"</script>';
}
?>
    <div class="card " style="width: 100%;margin-top:20px;box-shadow: 10px 10px rgba(20,20,20,0.6);margin-bottom: 30px;">
        <div class="card-body">
            <h2 >Todos os usuários do sistema!!</h2>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Cpf</th>
                <td scope="col" >Atualizar</td>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pegarTudo = \MySql::connect()->prepare("SELECT * FROM usuario");
                $pegarTudo->execute();
                $pegarTudo = $pegarTudo->fetchAll();
                foreach($pegarTudo as $pegar){ ?>
                <tr>
                <th scope="row"><?= $pegar['nome_usuario']?></th>
                <td><?= $pegar['email_usuario']?></td>
                <td><?= $pegar['cpf_usuario']?></td>
                <td><a class="btn btn-outline-primary" href="edit?usuario=<?= $pegar['id'] ?>" >Update</a></td>
                <td><a class="btn btn-outline-danger" href="?apagar=<?= $pegar['id'] ?>" >Exit</a></td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
    </div>
        </div>

    <div class="card " style="width: 100%;margin-top:20px;box-shadow: 10px 10px rgba(20,20,20,0.6);margin-bottom: 30px;">
        <div class="card-body">
            <h2>Cadastrar novo usuário</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nome</label>
                    <input type="text" value="<?php echo \Models\coisasModel::pegarPost('nome') ?>" name="nome" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Coloque o nome do usuário!!</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">E-mail</label>
                    <input type="email" value="<?php echo \Models\coisasModel::pegarPost('email') ?>" class="form-control" name="email" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">CPF</label>
                    <input type="text" value="<?php echo \Models\coisasModel::pegarPost('cpf') ?>" class="form-control" name="cpf" id="exampleInputPassword1">
                </div>
                <div class="mb-3"> 
                    <input type="submit" class="btn btn-primary" placeholder="000.000.000-00" name="cadastrar" value="Cadastrar Usuário">
                </div>    
            </form>
        </div>
    </div>
</div>