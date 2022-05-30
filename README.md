<h2>Documentação da aplicação do crud</h2>
<h3>O objetivo dessa aplicação é poder fazer um cadastro de um usuário do banco de dados e listar todos os usuários que já estão cadastrados no banco de dados,
e excluir eles quando quiser e tambem poder fazer uma alteração de um usuário individual.</h3>
<p>Vamos lá para começamos é necessario primeiro criar uma tabela de dados a onde vai ser inserido todos os dados.</p>
<p>A tabela vai se chamar de <b>Usuario(s)</b>, e os campos que a tabela terá vai ser <b>(Id)</b> para toda vez que um usuário ser criado o id vai ser auto incrementado
,<b>(nome_usuario)</b> o campo responsável pelo o nome do usuário,<b>(email_usuario)</b> Responsável pelo o email do usuário e por último <b>(cpf_usuario)</b> que vai ser
obviamente o cpf do usuário.</p>

      create table usuario(
       id int unsigned not null auto_increment,
       nome_usuario varchar(20) not null,
       email_usuario varchar(30) not null,
       cpf_usuario varchar(20) not null,
       primary key (id)
      );

<h3>Agora proximo passo é fazer o front-End da aplicação e para isso nós ultilizaremos o <a href="https://getbootstrap.com/">Boostrap</a> para a estilização não ser 
um problema.</h3>  
<p>Então o layout da tela será essa imagem de baixo.</p>

![crud3](https://user-images.githubusercontent.com/89558456/170910197-6af70276-b69e-44f2-8eed-d881e15e335e.png)

<h3>Agora vamos cadastrar o usuário na tabela.</h3>
<p>Para isso vamos ter que recuperar os dados do formulário para fazer a validação no <b>Back-end</b>, e para isso a requisição que vai ser mais segurar para os dados virem
com segurança será feito pelo o método <b>"POST"</b>.</p>
<ol>
  <li>é necessario usar uma função do PHP para ver se o usuário clicou no submit do formulário, que é a função <a href="https://www.php.net/manual/en/function.isset.php">isset()</a>, e como
    parâmetro vai ser passado o valor do submit que vai ser recuperado com a superglobal <a href="https://www.php.net/manual/en/reserved.variables.post.php">$_POST</a>.</li>
  <li>Recuperar os valores dos input e colocar tudo em uma variável que vai ser 3(três) variaveis com o nome dos campos da tabela do banco de dados <b>(nome,email,cpf),e o valores das variaveis
    vai ser o name de cada input que está no formulário.</b></li>
  <li>Fazer uma condição com o <a href="https://www.php.net/manual/en/control-structures.if.php">if()</a> para verificar se os campos estão vázios, para isso vai ser necessario usar a função <a href="https://www.php.net/manual/en/function.empty">empty()</a>
  ,e passa como parâmetro as variaveis que foi atribuida a pouco tempo tem que ser passada individualmente cada variavel.</li>
  <li>Verificar se o email é válido com a função <a href="https://www.php.net/manual/en/function.filter-var.php">filter_var()</a> e passar 2(dois) parâmetros primeiro a $variavel do email
  e em segundo uma constante <b>FILTER_VALIDATE_EMAIL</b>.</li>
  <li>Validar o cpf com a expressao regular que vai ser <b>"/^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/"</b>, e usar a função do <a href="https://www.php.net/manual/en/function.preg-match.php">preg_match()</a> 
  passando 2(dois) parâmetros, o primeiro a expressão e o segundo a $variavel do cpf.</li>
  <li>Inserir tudo na tabela usando o <a href="https://www.w3schools.com/sql/sql_insert.asp">INSERT</a> e os valores vai ser o id como <b>null</b> e as 3(três) $variaveis.</li>
</ol>


          if(isset($_POST['cadastrar'])){
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $cpf = $_POST['cpf'];

            if(empty($nome) || empty($email) || empty($cpf)){
                echo '<div style="padding:10px;color:white;" class=" bg-danger bg-gradient ">Preenchar todos os campos!!</div>';
            }else{
                if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                    if(\Models\coisasModel::validarCpf($cpf)){
                        $sql = \MySql::connect()->prepare("INSERT INTO usuario VALUES (null,?,?,?)");
                        $sql->execute(array($nome,$email,$cpf));
                        echo '<script>alert("cadastrado com sucesso!!!");location.href="home"</script>';
                    }else{
                        echo '<div style="padding:10px;color:white;" class=" bg-danger bg-gradient">Cpf invalido!!</div>'; 
                    }
                }else{
                    echo '<div style="padding:10px;color:white;" class=" bg-danger bg-gradient">Email invalido!!</div>';
                }
            }
        }
        
 <h3>Agora fazer uma consulta na tabela usuario para pegar todos os dados da tabela.</h3>
 <p>Vai ser utilizado o <a href="https://www.w3schools.com/sql/sql_select.asp">SELECT</a> para puxar todos os dados da tabela e em seguida usar a função <a href="https://www.php.net/manual/en/control-structures.foreach.php">foreach()</a> 
para pode fazer um loop de todos os dados já inseridos.</p>

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
            
 <h3>Agora fazer a fucionalidade de deletar o dado.</h3>
 <p>Para isso na tabela do front já vai ter uma opção para excluir o dado. esse botão vai ser uma tag <b>a</b> e no href vai ser passada uma query url que o nome vai ser apagar(excluir) 
e o valor vai ser o <b>id</b> do usuário escolhido.</p>
<p>E para isso mais uma vez vai ser usado a função <b>isset()</b> para verificar se existe o <b>GET</b> apagar(excluir).Agora deletar o usuario escolhido com o <a href="https://www.w3schools.com/sql/sql_delete.asp">DELETE</a>
onde o id do usuario escolhido vai ser o <b>GET</b> passado na url.</p>

      if(isset($_GET['apagar'])){
        $apagar = $_GET['apagar'];
        $excluir = \MySql::connect()->prepare("DELETE FROM usuario WHERE id = $apagar");
        $excluir->execute();
        echo '<script>alert("O usuário com o id '.$apagar.' foi deletado com sucesso!!");location.href="home"</script>';
      }
      
<h3>Agora Fazer a funcionalidade para atualizar o usuário</h3>  
<p>Para isso vai ser necessario criar uma nova tela com o nome edit e um layout desente no <b>front-end</b>.</p>

![edit](https://user-images.githubusercontent.com/89558456/170916383-83c404b2-a805-4433-ac9d-df8253a07f4e.png)

<p>Essa tela só vai pode ser acessada só se existir o usuário na tabela então terá que ser feita uma verificação para poder acessar essa tela.</p>
<p>Na tabela do front-end vai ter um botão<b>(tag a)</b> azul escrito update onde o caminho vai ser o arquivo edit e uma query url chamada usuario com o valor do <b>id</b> do usuario. </p>
<p>Se não existir essa query url a tela edit não vai ser rederizada.</p>
<p>E para verificar se existir o valor do <b>id</b> vai ser feita uma consulta na tabela onde o valor do <b>id</b> vai ser o valor da query url. se não existir a tabela com esse valor a tela edit não vai ser rederizada.</p>


     if(isset($_GET['usuario'])){
            $id = $_GET['usuario'];
            $editar = \MySql::connect()->prepare("SELECT * FROM usuario WHERE id = $id");
            $editar->execute();

        if($editar->rowCount() == 1){
                    $editar = $editar->fetch();

                    \Views\MainView::render('edit',$editar,['titulo'=>'Editando o '.$editar['nome_usuario'].' ']);
                
        }else{
            echo '<script>location.href="home"</script>';
        }
       }else{
                    echo '<script>location.href="home"</script>';
    }

<p>Os valores dos input vai ser a cosulta da tabela usuario onde o valor do id vai ser a query url usuario.</p>
<p>Agora é só fazer uma validação dos campos. verificar se os campos estão vázios ,validar o cpf e depois usar o <a href="">UPDATE</a> para fazer a atualização do usuário na tabela.</p>
<p>É muito importante não atualizar o email do usuário porque o email é uma caracteristica única do usuário.</p>

                if(isset($_POST['editar_usuario'])){
                        $nome = $_POST['nome'];
                        $cpf = $_POST['cpf'];
                
                        if(empty($nome) || empty($cpf)){
                            echo '<div style="padding:10px;color:white;" class=" bg-danger bg-gradient ">Preenchar todos os campos!!</div>';
                        }else{
                            
                                if(\Models\coisasModel::validarCpf($cpf)){
                                    $sql = \MySql::connect()->prepare("UPDATE usuario SET nome_usuario = ?,cpf_usuario = ? WHERE id = $id");
                                    $sql->execute(array($nome,$cpf));
                                    echo '<script>alert("Editado com sucesso!!!");location.href="home"</script>';
                             
                            }else{
                                echo '<div style="padding:10px;color:white;" class=" bg-danger bg-gradient">Email invalido!!</div>';
                            }
                        }
                    }

<h2>Chegamos até o fim da documentação!! Muito obrigado por ter lido a documentação até esse ponto :)</h2>
  <h3>Minhas redes sociais.</h3>
  <ul>
      <li><a href="https://www.instagram.com/gabs1405henrique/">Instagram!</a></li>
      <li><a href="https://github.com/Gabs1405dragon/">GitHub!</a></li>
      <li><a href="https://www.linkedin.com/in/gabriel-h-assis-de-souza-60b496207/">Linkedin!</a></li>
  </ul>

  
