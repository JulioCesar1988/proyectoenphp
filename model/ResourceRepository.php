<?php

/**
 * Description of ResourceRepository
 *
 * @author fede
 */
class ResourceRepository extends PDORepository {
    private static $instance;
    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        
    }

    public function listAll() {
        $answer = $this->queryList("select * from usuario");
        $final_answer = [];
        foreach ($answer as &$element) {
            $final_answer[] = new Resource($element['last_name'].", ".$element['first_name'], $element['id_usuario']);
        }
        return $final_answer;
    }


    

}
