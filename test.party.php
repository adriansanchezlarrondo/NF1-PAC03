<?php

require_once('class.collection.php');

abstract class Party {
    private $displayName;

    function __construct($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName() {
        return $this->displayName;
    }
    
}

class Person extends Party {
    private $firstName;
    private $lastName;

    function __construct($displayName, $firstName, $lastName) {
        parent::__construct($displayName);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function __toString(){
        return 'Name Person: ' . $this->getDisplayName() . ' (' . $this->firstName . ' ' . $this->lastName . ')';
    }
}

class OrgUnit extends Party {
    private $name;
    private $employees = array();

    function __construct($displayName, $name) {
        parent::__construct($displayName);
        $this->name = $name;
    }

    public function addEmployee(Person $employee) {
        $this->employees[] = $employee;
    }
    
    public function getEmployees() {
        return $this->employees;
    }
    public function __toString(){
        echo 'Name OrgUnit: ' . $this->getDisplayName() . "<br>";
        $result = "Employees:<br>";
        foreach ($this->employees as $employee) {
            $result .= $employee . "<br>";
        }
        return $result;
    }


}

class Company extends Party {
    public $name;
    private $units = array();

    function __construct($displayName) {
        parent::__construct($displayName);
    }

    public function addUnit(OrgUnit $unit) {
        $this->units[] = $unit;
    }

    public function getDescription() {
        echo 'Company: ' . $this->getDisplayName() . "<br><br>";
        $result = "<br>OrgUnits:<br>";
        foreach ($this->units as $unit) {
            $result .= $unit . "<br>";
        }
        return $result;
    }
}

$company = new Collection();
$company->addItem(new Person("Person One", "Person", "One"), "1");
$company->addItem(new Person("Person Two", "Person", "Two"), "2");
$company->addItem(new OrgUnit("OrgUnit1", "Org1"), "3");
$company->addItem(new OrgUnit("OrgUnit2", "Org2"), "4");

$objPersonOne = $company->getItem("1");
print $objPersonOne;
print "<br>";

$company->removeItem("1"); //deletes the "1" object
print "Removed: PersonOne<br>";

try {
    $objPersonOne = $company->getItem("1"); //throws KeyInvalidException
} catch (KeyInvalidException $kie) {
    print "The collection doesn't contain anything called '1'";
}