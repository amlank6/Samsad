<?php

/**
 * Created by PhpStorm.
 * User: Unikorn PC2
 * Date: 27-12-16
 * Time: 2:46 PM
 */
class SpecialCustomerMaster
{

    var $id;
    var $username;
    var $password;
    var $type;

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


    /**
     * SpecialCustomer constructor.
     * @param $username
     * @param $password
     * @param $type
     */
    public function __construct($id, $username, $password, $type)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
    }

    static function authenticate($username, $password, $type)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM special_customers_master WHERE username= :username AND password= :password AND type= :type");
        $query->execute(array('username' => $username, 'password' => $password, 'type' => $type));
        //$query->setFetchMode(PDO::FETCH_ASSOC);

        if ($query->rowCount() > 0)
        {
            $row = $query->fetch(PDO::FETCH_OBJ);
            $specialCustomerMasterId = $row->id;

            $specialCustomerMaster = self::find($specialCustomerMasterId);
            $_SESSION['specialCustomerMaster'] = $specialCustomerMaster;

            $credit = Credit::findBySpecialCustomerMasterId($specialCustomerMasterId);
            $_SESSION['credit'] = $credit;
            $_SESSION['type'] = $type;

            if ($type == "Canvasser")
            {
                $canvasser = Canvasser::findBySpecialCustomerMasterId($specialCustomerMasterId);
                $_SESSION["canvasser"] = $canvasser;
            }
            else if ($type == "Bookseller")
            {
                $bookSeller = BookSeller::findBySpecialCustomerMasterId($specialCustomerMasterId);
                $_SESSION["bookSeller"] = $bookSeller;
            }
            else
            {
                $school = School::findBySpecialCustomerMasterId($specialCustomerMasterId);
                $_SESSION["school"] = $school;

            }
            header("Location: dashboard.php");


            return true;
        }
        else
        {
            return false;
        }
    }

    static function find ($id)
    {
        $query = $GLOBALS['conn']->prepare("SELECT * FROM special_customers_master WHERE id= :id");
        $query->execute(array('id' => $id));
        $row = $query->fetch(PDO::FETCH_OBJ);
        $specialCustomerMaster = new SpecialCustomerMaster($row->id, $row->username, $row->password, $row->type);
        return $specialCustomerMaster;
    }
}