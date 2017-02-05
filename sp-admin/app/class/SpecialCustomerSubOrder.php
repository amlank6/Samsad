<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 03-01-17
 * Time: 4:48 PM
 */
class SpecialCustomerSubOrder
{
    var $id;
    var $specialCustomerMainOrderId;
    var $productCode;
    var $productAmount;
    var $quantity;

    /**
     * SpecialCustomerSubOrder constructor.
     * @param $id
     * @param $specialCustomerMainOrderId
     * @param $productCode
     * @param $productAmount
     * @param $quantity
     */
    public function __construct($specialCustomerMainOrderId, $productCode, $productAmount, $quantity)
    {
        $this->specialCustomerMainOrderId = $specialCustomerMainOrderId;
        $this->productCode = $productCode;
        $this->productAmount = $productAmount;
        $this->quantity = $quantity;
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
    public function getSpecialCustomerMainOrderId()
    {
        return $this->specialCustomerMainOrderId;
    }

    /**
     * @param mixed $specialCustomerMainOrderId
     */
    public function setSpecialCustomerMainOrderId($specialCustomerMainOrderId)
    {
        $this->specialCustomerMainOrderId = $specialCustomerMainOrderId;
    }

    /**
     * @return mixed
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param mixed $productCode
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    /**
     * @return mixed
     */
    public function getProductAmount()
    {
        return $this->productAmount;
    }

    /**
     * @param mixed $productAmount
     */
    public function setProductAmount($productAmount)
    {
        $this->productAmount = $productAmount;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


    public function insert()
    {
        $query = $GLOBALS['conn']->prepare("INSERT INTO `special_customers_sub_order` (`special_customer_main_order_id`,`product_code`,`product_amount`,`quantity`) VALUES (:specialCustomerMainOrderId,:productCode,:productAmount,:productQuantity)");
        $query->execute(array('specialCustomerMainOrderId' => $this->getSpecialCustomerMainOrderId(), 'productCode' => $this->getProductCode(), 'productAmount' => $this->getProductAmount(), 'productQuantity' => $this->getQuantity()));
    }


    static function findBySpecialCustomerMainOrderId($specialCustomerMainOrderId)
    {


        $query = $GLOBALS['conn']->prepare("SELECT * FROM special_customers_sub_order WHERE special_customer_main_order_id= :specialCustomerMainOrderId ");
        $query->execute(array('specialCustomerMainOrderId' => $specialCustomerMainOrderId));
        $query->setFetchMode(PDO::FETCH_OBJ);
        return $specialCustomerSubOrders = $query->fetchAll();
    }

}