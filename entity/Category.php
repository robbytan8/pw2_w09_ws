<?php

/**
 * Description of Category
 *
 * @author Robby
 */
class Category implements JsonSerializable {

    private $id;
    private $name;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
