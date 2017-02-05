<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 29-12-16
 * Time: 3:09 PM
 */
class SpecialCustomerMainOrder
{
    var $id;
    var $specialCustomerMasterId;
    var $date;
    var $school;
    var $estimatedDateOfDelivery;
    var $totalAmount;
    var $deliveryCharge;
    var $discountAmount;
    var $amountToBePaid;
    var $isApproved;

    /**
     * SpecialCustomerMainOrder constructor.
     * @param $id
     * @param $specialCustomerMasterId
     * @param $date
     * @param $school
     * @param $estimatedDateOfDelivery
     * @param $totalAmount
     * @param $deliveryAmount
     * @param $discountAmount
     * @param $amountToBePaid
     * @param $isApproved
     */
    public function __construct($specialCustomerMasterId, $date, $school, $estimatedDateOfDelivery, $totalAmount, $deliveryAmount, $discountAmount, $amountToBePaid)
    {
        $this->specialCustomerMasterId = $specialCustomerMasterId;
        $this->date = $date;
        $this->school = $school;
        $this->estimatedDateOfDelivery = $estimatedDateOfDelivery;
        $this->totalAmount = $totalAmount;
        $this->deliveryCharge = $deliveryAmount;
        $this->discountAmount = $discountAmount;
        $this->amountToBePaid = $amountToBePaid;

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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param mixed $school
     */
    public function setSchool($school)
    {
        $this->school = $school;
    }

    /**
     * @return mixed
     */
    public function getEstimatedDateOfDelivery()
    {
        return $this->estimatedDateOfDelivery;
    }

    /**
     * @param mixed $estimatedDateOfDelivery
     */
    public function setEstimatedDateOfDelivery($estimatedDateOfDelivery)
    {
        $this->estimatedDateOfDelivery = $estimatedDateOfDelivery;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param mixed $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return mixed
     */
    public function getDeliveryCharge()
    {
        return $this->deliveryCharge;
    }

    /**
     * @param mixed $deliveryCharge
     */
    public function setDeliveryCharge($deliveryCharge)
    {
        $this->deliveryCharge = $deliveryCharge;
    }

    /**
     * @return mixed
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @param mixed $discountAmount
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
    }

    /**
     * @return mixed
     */
    public function getAmountToBePaid()
    {
        return $this->amountToBePaid;
    }

    /**
     * @param mixed $amountToBePaid
     */
    public function setAmountToBePaid($amountToBePaid)
    {
        $this->amountToBePaid = $amountToBePaid;
    }

    /**
     * @return mixed
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * @param mixed $isApproved
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;
    }

    public function insert()
    {
        $query = $GLOBALS['conn']->prepare("INSERT INTO `special_customers_main_order` (`special_customer_master_id`, `date`, `school`, `estimated_date_of_delivery`, `total_amount`, `delivery_charge`, `discount_amount`, `amount_to_be_paid`) VALUES (:specialCustomerMasterId,:date,:school,:estimatedDateOfDelivery,:totalAmount,:deliveryCharge,:discountAmount,:amountToBePaid)");
        $query->execute(array('specialCustomerMasterId' => $this->getSpecialCustomerMasterId(), 'date' => $this->getDate(), 'school' => $this->getSchool(), 'estimatedDateOfDelivery' => $this->getEstimatedDateOfDelivery(), 'totalAmount' => $this->getTotalAmount(), 'deliveryCharge' => $this->getDeliveryCharge(), 'discountAmount' => $this->getDiscountAmount(), 'amountToBePaid' => $this->getAmountToBePaid()));
    }

    static function findBySpecialCustomerMasterId($specialCustomerMasterId)
    {

        $query = $GLOBALS['conn']->prepare("SELECT * FROM special_customers_main_order WHERE special_customer_master_id= :specialCustomerMasterId");
        $query->execute(array('specialCustomerMasterId' => $specialCustomerMasterId));
        $query->setFetchMode(PDO::FETCH_OBJ);
        return $specialCustomerMainOrders = $query->fetchAll();
    }

    static function placeOrder($school, $estimatedDateOfDelivery, $bookList, $specialCustomerType)
    {
        $specialCustomerMaster = $_SESSION['specialCustomerMaster'];
        $specialCustomerMasterId = $specialCustomerMaster->id;
        $date = date("Y-m-d");

        $totalAmount = self::calculateTotalAmount($bookList);
        $discountAmount = self::calculateDiscountAmount($totalAmount);
        $deliveryCharge = self::calculateDeliveryCharge($bookList);
        $amountToBePaid = ($totalAmount - $discountAmount) + $deliveryCharge;

        $specialCustomerMainOrder = new SpecialCustomerMainOrder($specialCustomerMasterId, $date, $school, $estimatedDateOfDelivery, $totalAmount, $deliveryCharge, $discountAmount, $amountToBePaid);
        $specialCustomerMainOrder->insert();

        foreach ($bookList as $book)
        {
            $specialCustomerMainOrderId = "1";
            $productCode = $book['productCode'];
            $productAmount = $book['productAmount'];
            $quantity = $book['quantity'];

            $specialCustomerSubOrder = new SpecialCustomerSubOrder($specialCustomerMainOrderId,$productCode,$productAmount,$quantity);
            $specialCustomerSubOrder->insert();
        }

    }

    static function calculateDiscountAmount($totalAmount)
    {
        $specialCustomerMaster = $_SESSION['specialCustomerMaster'];
        $specialCustomerMasterId = $specialCustomerMaster->id;
        $query = $GLOBALS['conn']->prepare("SELECT * FROM credit WHERE special_customer_master_id = :specialCustomerMasterId");
        $query->execute(array('specialCustomerMasterId' => $specialCustomerMasterId));
        $query->setFetchMode(PDO::FETCH_OBJ);
        $credit = $query->fetch();
        $discountPercentage = $credit->discount_percentage;
        $discountAmount = ($discountPercentage/100)*$totalAmount;
        return $discountAmount;

    }

    static function calculateTotalAmount($bookList)
    {
        $totalPrice = 0;
        foreach ($bookList as $book)
        {

            $quantity = $book['quantity'];
            $productCode = $book['productCode'];

            $query = $GLOBALS['connOld']->prepare("SELECT * FROM product WHERE product_code= :productCode");
            $query->execute(array('productCode' => $productCode));
            $query->setFetchMode(PDO::FETCH_OBJ);
            $product = $query->fetch();

            $price = ($product->p_price) * $quantity;
            $totalPrice = $totalPrice + $price;

        }
        return $totalPrice;
    }

    static function calculateDeliveryCharge($bookList)
    {
        return 100;
    }

}
