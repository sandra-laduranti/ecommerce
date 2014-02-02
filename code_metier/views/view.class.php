<?php

require_once 'code_metier/configuration/config.class.php';

class View {

    private $_file;
    private $_entete = "code_metier/views/viewEntete.php";
    private $_title;

    public function __construct($parPage) {
        $this->_file = "code_metier/views/view" . $parPage . ".php";
    }

    public function compute($parData = array()) {

        $locContent = $this->getFile($this->_file, $parData);
        $locEntete = $this->getFile($this->_entete, $parData);

        $locView = $this->getFile('code_metier/templates/master.template.php',
                array('titre' => $this->_title,
                  'content' => $locContent,
                  'entete' => $locEntete,
                  'baseURL' => Config::get('baseURL'))
        );

        echo $locView;
    }

    private function getFile($parFile, $parData) {
        if (file_exists($parFile)) {
            extract($parData);
            ob_start();
            require $parFile;
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$parFile' introuvable");
        }
    }

}

?>