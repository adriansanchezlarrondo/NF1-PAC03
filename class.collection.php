<?php

class KeyInUseException extends Exception {}
class KeyInvalidException extends Exception {}

class Collection {

    private $_members = array();    //collection members

    public function addItem ($obj, $key = null){ // $obj = objeto que añado a la array y la $key es la posicion del array

        //COMPROBAR SI EXISTE LA LLAVE

        if($key){
            if (isset($this->_members[$key])){
                throw new KeyInUseException("Key \"$key\" esta repetida!");
            } else {
                $this->_members[$key] = $obj; // Si no esta repetido añade el objeto al array
            }
        }else{
            $this->_members[] = $obj; // Si la key no existe añade el objeto al array
        }
    }


    public function removeItem($key) {
        
        if(isset($this->_members[$key])) {
            unset($this->_members[$key]);
        } else {
            throw new KeyInvalidException("Invalid key \"$key\"!");
        }  
    }
  
    public function getItem($key) {
        
        if(isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new KeyInvalidException("Invalid key \"$key\"!");
        }
    }

    public function keys() {
        return array_keys($this->_members);
    }

    public function length() {
        return sizeof($this->_members);
    }

    public function exists($key) {
        return (isset($this->_members[$key]));
    }

    public function __toString(){
        $result = "Mostrant tots els elements de la col·lecció:\n";
            for ($i = 0; $i < count($this->_members); $i++) {
                $result.= $this->_members[$i] . "\n";  //__toString must be defined
            }
        return $result;
    }

}
?>
