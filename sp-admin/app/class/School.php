<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 02-01-17
 * Time: 12:23 PM
 */
class School
{
    var $id;
    var $specialCustomerMasterId;
    var $schoolName;
    var $headName;
    var $contactNumber;
    var $emailId;
    var $streetAddress;
    var $state;
    var $postalCode;
    var $managingCommittee;
    var $medium;
    var $noOfStudents;

    /**
     * School constructor.
     * @param $id
     * @param $specialCustomerMasterId
     * @param $schoolName
     * @param $headName
     * @param $contactNumber
     * @param $emailId
     * @param $streetAddress
     * @param $state
     * @param $postalCode
     * @param $managingCommittee
     * @param $medium
     * @param $noOfStudents
     */
    public function __construct($id, $specialCustomerMasterId, $schoolName, $headName, $contactNumber, $emailId, $streetAddress, $state, $postalCode, $managingCommittee, $medium, $noOfStudents)
    {
        $this->id = $id;
        $this->specialCustomerMasterId = $specialCustomerMasterId;
        $this->schoolName = $schoolName;
        $this->headName = $headName;
        $this->contactNumber = $contactNumber;
        $this->emailId = $emailId;
        $this->streetAddress = $streetAddress;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->managingCommittee = $managingCommittee;
        $this->medium = $medium;
        $this->noOfStudents = $noOfStudents;
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
    public function getSchoolName()
    {
        return $this->schoolName;
    }

    /**
     * @param mixed $schoolName
     */
    public function setSchoolName($schoolName)
    {
        $this->schoolName = $schoolName;
    }

    /**
     * @return mixed
     */
    public function getHeadName()
    {
        return $this->headName;
    }

    /**
     * @param mixed $headName
     */
    public function setHeadName($headName)
    {
        $this->headName = $headName;
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
    public function getManagingCommittee()
    {
        return $this->managingCommittee;
    }

    /**
     * @param mixed $managingCommittee
     */
    public function setManagingCommittee($managingCommittee)
    {
        $this->managingCommittee = $managingCommittee;
    }

    /**
     * @return mixed
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * @param mixed $medium
     */
    public function setMedium($medium)
    {
        $this->medium = $medium;
    }

    /**
     * @return mixed
     */
    public function getNoOfStudents()
    {
        return $this->noOfStudents;
    }

    /**
     * @param mixed $noOfStudents
     */
    public function setNoOfStudents($noOfStudents)
    {
        $this->noOfStudents = $noOfStudents;
    }

    static function find($id)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM school WHERE id= :id");
        $query->execute(array('id' => $id));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $school = new School($row->id,$row->special_customer_master_id,$row->school_name,$row->head_name,$row->contact_number,$row->email_id,$row->street_address,$row->state,$row->postal_code,$row->managing_committee,$row->medium,$row->no_of_students);
        return $school;
    }

    static function findBySpecialCustomerMasterId($findBySpecialCustomerMasterId)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM school WHERE special_customer_master_id= :findBySpecialCustomerMasterId");
        $query->execute(array('findBySpecialCustomerMasterId' => $findBySpecialCustomerMasterId));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $school = new School($row->id,$row->special_customer_master_id,$row->school_name,$row->head_name,$row->contact_number,$row->email_id,$row->street_address,$row->state,$row->postal_code,$row->managing_committee,$row->medium,$row->no_of_students);
        return $school;
    }

}