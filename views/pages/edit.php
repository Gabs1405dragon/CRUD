<div class="container">
<div class="card " style="width: 100%;margin-top:20px;box-shadow: 10px 10px rgba(20,20,20,0.6);margin-bottom: 30px;">
    <div class="card-body">
        <h2>Editar o usuário!</h2>
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nome</label>
                <input type="text" value="<?= $fetch['nome_usuario'] ?>" name="nome" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Faça uma atualização no nome do usuário!!</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">E-mail</label>
                <input type="email" disabled value="<?= $fetch['email_usuario'] ?>" class="form-control" name="email" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">CPF</label>
                <input type="text" value="<?= $fetch['cpf_usuario'] ?>" class="form-control" name="cpf" id="exampleInputPassword1">
            </div>
            <div class="mb-3"> 
                <input type="submit" class="btn btn-primary"  name="editar_usuario" value="Atualizar!!">
            </div>
        </form>
        <a class="btn btn-success" href="home">Voltar</a>
        </div>
    </div>
</div>