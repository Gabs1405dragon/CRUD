<?php  
namespace Controllers;

class EditController{
    public function index(){
        if(isset($_GET['usuario'])){
        $id = $_GET['usuario'];
        $editar = \MySql::connect()->prepare("SELECT * FROM usuario WHERE id = $id");
        $editar->execute();
       
        if($editar->rowCount() == 1){
                    $editar = $editar->fetch();
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
               
                    \Views\MainView::render('edit',$editar,['titulo'=>'Editando o '.$editar['nome_usuario'].' ']);
                
        }else{
            echo '<script>location.href="home"</script>';
        }
       }else{
                    echo '<script>location.href="home"</script>';
    }
    }
}