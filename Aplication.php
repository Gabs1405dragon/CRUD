<?php  
 class Aplication{
     public function run(){
         $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home';
         $url = ucfirst($url);
         $url.="Controller";
         if(file_exists("Controllers/".$url.'.php')){
            $class = "Controllers\\".$url;
            $novoClass = new $class;
            $novoClass->index();
         }else{
             die('arquivo não existe....');
         }
    }
 }