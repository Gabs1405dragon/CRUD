<?php 

namespace Views;

class MainView{
    public static function render($fileName,$fetch = null,$arr = [],$header = 'pages/templates/header.php',$footer = 'pages/templates/footer.php'){
        include($header);
        include('pages/'.$fileName.'.php');
        include($footer);
    }
}