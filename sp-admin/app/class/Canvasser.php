<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 29-12-16
 * Time: 1:05 PM
 */
class Canvasser
{
    var $id;
    var $specialCustomerMasterId;
    var $name;
    var $contactNumber;
    var $emailId;
    var $streetAddress;
    var $state;
    var $postalCode;
    var $numberOfSchools;
    var $areaOfOperation;

    /**
     * Canvasser constructor.
     * @param $id
     * @param $specialCustomerMasterId
     * @param $name
     * @param $contactNumber
     * @param $email_id
     * @param $streetAddress
     * @param $state
     * @param $postalCode
     * @param $numberOfSchools
     * @param $areaOfOperation
     */
    public function __construct($id, $specialCustomerMasterId, $name, $contactNumber, $email_id, $streetAddress, $state, $postalCode, $numberOfSchools, $areaOfOperation)
    {
        $this->id = $id;
        $this->specialCustomerMasterId = $specialCustomerMasterId;
        $this->name = $name;
        $this->contactNumber = $contactNumber;
        $this->emailId = $email_id;
        $this->streetAddress = $streetAddress;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->numberOfSchools = $numberOfSchools;
        $this->areaOfOperation = $areaOfOperation;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSpecialCustomerMasterId()
    {
        return $this->specialCustomerMasterId;
    }

    /**
     * @param mixed $specialCustomerMasterId
     */
    public function setSpecialCustomerMasterId($specialCustomerMasterId)
    {
        $this->specialCustomerMasterId = $specialCustomerMasterId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * @param mixed $contactNumber
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;
    }

    /**
     * @return mixed
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param mixed $emailId
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    }

    /**
     * @return mixed
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * @param mixed $streetAddress
     */
    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getNumberOfSchools()
    {
        return $this->numberOfSchools;
    }

    /**
     * @param mixed $numberOfSchools
     */
    public function setNumberOfSchools($numberOfSchools)
    {
        $this->numberOfSchools = $numberOfSchools;
    }

    /**
     * @return mixed
     */
    public function getAreaOfOperation()
    {
        return $this->areaOfOperation;
    }

    /**
     * @param mixed $areaOfOperation
     */
    public function setAreaOfOperation($areaOfOperation)
    {
        $this->areaOfOperation = $areaOfOperation;
    }


    static function find($id)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM canvasser WHERE id= :id");
        $query->execute(array('id' => $id));
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetch(PDO::FETCH_OBJ);
        $canvasser = new Canvasser($row->id, $row->special_customer_master_id, $row->name, $row->contact_number, $row->email_id, $row->street_address, $row->state, $row->postal_code, $row->number_of_schools, $row->area_of_operation);
        return $canvasser;
    }

    static function findBySpecialCustomerMasterId($specialCustomerMasterId)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM canvasser WHERE special_customer_master_id= :specialCustomerMasterId");
        $query->execute(array('specialCustomerMasterId' => $specialCustomerMasterId));
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $row = $query->fetch(PDO::FETCH_OBJ);
        $canvasser = new Canvasser($row->id, $row->special_customer_master_id, $row->name, $row->contact_number, $row->email_id, $row->street_address, $row->state, $row->postal_code, $row->number_of_schools, $row->area_of_operation);
        return $canvasser;
    }

}