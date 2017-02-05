<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 05-01-17
 * Time: 11:29 AM
 */
class Product
{
    var $id;
    var $uniqueId;
    var $productCode;
    var $pImageLink;
    var $pName;
    var $pAuthor;
    var $pFormat;
    var $pSize;
    var $pWeight;
    var $pPages;
    var $pPrice;
    var $pInventory;
    var $pStatus;
    var $pDescription;
    var $pSubCategory;
    var $pRootCategory;
    var $pSubstractStock;

    /**
     * Product constructor.
     * @param $id
     * @param $uniqueId
     * @param $productCode
     * @param $pImageLink
     * @param $pName
     * @param $pAuthor
     * @param $pFormat
     * @param $pSize
     * @param $pWeight
     * @param $pPages
     * @param $pPrice
     * @param $pInventory
     * @param $pStatus
     * @param $pDescription
     * @param $pSubCategory
     * @param $pRootCategory
     * @param $pSubstractStock
     */
    public function __construct($id, $uniqueId, $productCode, $pImageLink, $pName, $pAuthor, $pFormat, $pSize, $pWeight, $pPages, $pPrice, $pInventory, $pStatus, $pDescription, $pSubCategory, $pRootCategory, $pSubstractStock)
    {
        $this->id = $id;
        $this->uniqueId = $uniqueId;
        $this->productCode = $productCode;
        $this->pImageLink = $pImageLink;
        $this->pName = $pName;
        $this->pAuthor = $pAuthor;
        $this->pFormat = $pFormat;
        $this->pSize = $pSize;
        $this->pWeight = $pWeight;
        $this->pPages = $pPages;
        $this->pPrice = $pPrice;
        $this->pInventory = $pInventory;
        $this->pStatus = $pStatus;
        $this->pDescription = $pDescription;
        $this->pSubCategory = $pSubCategory;
        $this->pRootCategory = $pRootCategory;
        $this->pSubstractStock = $pSubstractStock;
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
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @param mixed $uniqueId
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
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
    public function getPImageLink()
    {
        return $this->pImageLink;
    }

    /**
     * @param mixed $pImageLink
     */
    public function setPImageLink($pImageLink)
    {
        $this->pImageLink = $pImageLink;
    }

    /**
     * @return mixed
     */
    public function getPName()
    {
        return $this->pName;
    }

    /**
     * @param mixed $pName
     */
    public function setPName($pName)
    {
        $this->pName = $pName;
    }

    /**
     * @return mixed
     */
    public function getPAuthor()
    {
        return $this->pAuthor;
    }

    /**
     * @param mixed $pAuthor
     */
    public function setPAuthor($pAuthor)
    {
        $this->pAuthor = $pAuthor;
    }

    /**
     * @return mixed
     */
    public function getPFormat()
    {
        return $this->pFormat;
    }

    /**
     * @param mixed $pFormat
     */
    public function setPFormat($pFormat)
    {
        $this->pFormat = $pFormat;
    }

    /**
     * @return mixed
     */
    public function getPSize()
    {
        return $this->pSize;
    }

    /**
     * @param mixed $pSize
     */
    public function setPSize($pSize)
    {
        $this->pSize = $pSize;
    }

    /**
     * @return mixed
     */
    public function getPWeight()
    {
        return $this->pWeight;
    }

    /**
     * @param mixed $pWeight
     */
    public function setPWeight($pWeight)
    {
        $this->pWeight = $pWeight;
    }

    /**
     * @return mixed
     */
    public function getPPages()
    {
        return $this->pPages;
    }

    /**
     * @param mixed $pPages
     */
    public function setPPages($pPages)
    {
        $this->pPages = $pPages;
    }

    /**
     * @return mixed
     */
    public function getPPrice()
    {
        return $this->pPrice;
    }

    /**
     * @param mixed $pPrice
     */
    public function setPPrice($pPrice)
    {
        $this->pPrice = $pPrice;
    }

    /**
     * @return mixed
     */
    public function getPInventory()
    {
        return $this->pInventory;
    }

    /**
     * @param mixed $pInventory
     */
    public function setPInventory($pInventory)
    {
        $this->pInventory = $pInventory;
    }

    /**
     * @return mixed
     */
    public function getPStatus()
    {
        return $this->pStatus;
    }

    /**
     * @param mixed $pStatus
     */
    public function setPStatus($pStatus)
    {
        $this->pStatus = $pStatus;
    }

    /**
     * @return mixed
     */
    public function getPDescription()
    {
        return $this->pDescription;
    }

    /**
     * @param mixed $pDescription
     */
    public function setPDescription($pDescription)
    {
        $this->pDescription = $pDescription;
    }

    /**
     * @return mixed
     */
    public function getPSubCategory()
    {
        return $this->pSubCategory;
    }

    /**
     * @param mixed $pSubCategory
     */
    public function setPSubCategory($pSubCategory)
    {
        $this->pSubCategory = $pSubCategory;
    }

    /**
     * @return mixed
     */
    public function getPRootCategory()
    {
        return $this->pRootCategory;
    }

    /**
     * @param mixed $pRootCategory
     */
    public function setPRootCategory($pRootCategory)
    {
        $this->pRootCategory = $pRootCategory;
    }

    /**
     * @return mixed
     */
    public function getPSubstractStock()
    {
        return $this->pSubstractStock;
    }

    /**
     * @param mixed $pSubstractStock
     */
    public function setPSubstractStock($pSubstractStock)
    {
        $this->pSubstractStock = $pSubstractStock;
    }

    static function find()
    {
        $query = $GLOBALS['connOld']->prepare("SELECT * FROM product");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_OBJ);

        //$product = new Product($row->id,$row->unique_id,$row->product_code,$row->p_image_link,$row->p_name,$row->p_author,$row->p_format,$row->p_size,$row->p_weight,$row->p_pages,$row->p_price,$row->p_inventory,$row->p_status,$row->p_description,$row->p_sub_category,$row->p_root_category,$row->p_substract_stock);
        return $product = $row;
    }















}