<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 30-12-16
 * Time: 12:09 PM
 */
class Credit
{
    var $id;
    var $specialCustomerMasterId;
    var $creditLimit;
    var $creditPeriod;
    var $discountPercentage;

    /**
     * Credit constructor.
     * @param $id
     * @param $specialCustomerMasterId
     * @param $creditLimit
     * @param $creditPeriod
     * @param $discountPercentage
     */
    public function __construct($id, $specialCustomerMasterId, $creditLimit, $creditPeriod, $discountPercentage)
    {
        $this->id = $id;
        $this->specialCustomerMasterId = $specialCustomerMasterId;
        $this->creditLimit = $creditLimit;
        $this->creditPeriod = $creditPeriod;
        $this->discountPercentage = $discountPercentage;
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
    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    /**
     * @param mixed $creditLimit
     */
    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }

    /**
     * @return mixed
     */
    public function getCreditPeriod()
    {
        return $this->creditPeriod;
    }

    /**
     * @param mixed $creditPeriod
     */
    public function setCreditPeriod($creditPeriod)
    {
        $this->creditPeriod = $creditPeriod;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * @param mixed $discountPercentage
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
    }

    static function find($id)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM credit WHERE id= :id");
        $query->execute(array('id' => $id));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $credit = new Credit($row->id,$row->special_customer_master_id,$row->credit_limit,$row->credit_period,$row->discount_percentage);
        return $credit;
    }

    static function findBySpecialCustomerMasterId($findBySpecialCustomerMasterId)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM credit WHERE special_customer_master_id= :findBySpecialCustomerMasterId");
        $query->execute(array('findBySpecialCustomerMasterId' => $findBySpecialCustomerMasterId));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $credit = new Credit($row->id,$row->special_customer_master_id,$row->credit_limit,$row->credit_period,$row->discount_percentage);
        return $credit;
    }

    
}