<?php

class Controller {

    //pour rediriger l'URL vers le controlleur
    public function model($model, $folder)
    {
        //ceci ajoute le fichier
        require_once '../app/models/'.$folder.'/'. $model .'.php';
        return new $model();
    }
    
    public function view($view, $data = [])
    {
        require_once '../app/views/'. $view .'.php';
    }
}