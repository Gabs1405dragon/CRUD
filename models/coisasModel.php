<?php  
namespace Models;

class coisasModel{
    public static function pegarPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }

    public static function validarCpf($cpf){
        $expressao = "/^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/";
        return preg_match($expressao,$cpf);
    }
}