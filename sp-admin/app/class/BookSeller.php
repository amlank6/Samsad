<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 30-12-16
 * Time: 1:46 PM
 */
class BookSeller
{
    var $id;
    var $specialCustomerMasterId;
    var $storeName;
    var $contactPersonName;
    var $contactNumber;
    var $emailId;
    var $streetAddress;
    var $state;
    var $postalCode;
    var $areaOfOperation;
    var $registeredSince;

    /**
     * BookSeller constructor.
     * @param $id
     * @param $specialCustomerMasterId
     * @param $storeName
     * @param $contactPersonName
     * @param $contactNumber
     * @param $emailId
     * @param $streetAddress
     * @param $state
     * @param $postalCode
     * @param $areaOfOperation
     * @param $registeredSince
     */
    public function __construct($id, $specialCustomerMasterId, $storeName, $contactPersonName, $contactNumber, $emailId, $streetAddress, $state, $postalCode, $areaOfOperation, $registeredSince)
    {
        $this->id = $id;
        $this->specialCustomerMasterId = $specialCustomerMasterId;
        $this->storeName = $storeName;
        $this->contactPersonName = $contactPersonName;
        $this->contactNumber = $contactNumber;
        $this->emailId = $emailId;
        $this->streetAddress = $streetAddress;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->areaOfOperation = $areaOfOperation;
        $this->registeredSince = $registeredSince;
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
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param mixed $storeName
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
    }

    /**
     * @return mixed
     */
    public function getContactPersonName()
    {
        return $this->contactPersonName;
    }

    /**
     * @param mixed $contactPersonName
     */
    public function setContactPersonName($contactPersonName)
    {
        $this->contactPersonName = $contactPersonName;
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

    /**
     * @return mixed
     */
    public function getRegisteredSince()
    {
        return $this->registeredSince;
    }

    /**
     * @param mixed $registeredSince
     */
    public function setRegisteredSince($registeredSince)
    {
        $this->registeredSince = $registeredSince;
    }

    static function find($id)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM book_seller WHERE id= :id");
        $query->execute(array('id' => $id));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $bookSeller = new BookSeller($row->id,$row->special_customer_master_id,$row->store_name,$row->contact_person_name,$row->contact_number,$row->email_id,$row->street_address,$row->state,$row->postal_code,$row->area_of_operation,$row->registered_since);
        return $bookSeller;
    }

    static function findBySpecialCustomerMasterId($specialCustomerMasterId)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM book_seller WHERE special_customer_master_id= :specialCustomerMasterId");
        $query->execute(array('specialCustomerMasterId' => $specialCustomerMasterId));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $bookSeller = new BookSeller($row->id,$row->special_customer_master_id,$row->store_name,$row->contact_person_name,$row->contact_number,$row->email_id,$row->street_address,$row->state,$row->postal_code,$row->area_of_operation,$row->registered_since);
        return $bookSeller;
    }

}