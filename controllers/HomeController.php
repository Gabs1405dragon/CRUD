<?php  

namespace Controllers;

class HomeController{
    public function index(){
     
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
        \Views\MainView::render('home','o',['titulo'=>'Listas de todos os usuarios']);
    }
}