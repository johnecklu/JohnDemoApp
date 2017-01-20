<?php

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {

        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();

    }

    // destructor
    function __destruct() {

    }

    public function getAllProducts(){
        $res = mysqli_query($this->conn, "SELECT products.product_name as name, products.product_price as price, products.product_image as image from products") or die(mysqli_error($this->db));
        $json = array();

        if(mysqli_num_rows($res)){
            while($row=mysqli_fetch_assoc($res)){
                $row['image'] = utf8_encode($row['image']);
                $json[]=$row;
            }
        }

        echo json_encode($json);

    }

    public function addProduct($product_name ,$product_price, $product_image){
        $stmt = $this->conn->prepare("INSERT INTO products(product_name, product_price, product_image ) VALUES(?,?,?)");
        $stmt->bind_param("sss",  $product_name, $product_price, $product_image);
        $result = $stmt->execute();
        $stmt->close();
        if($result){
            return true;
        }else{
            return false;
        }
    }





}

?>
