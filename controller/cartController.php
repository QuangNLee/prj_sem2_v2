<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class cartController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database(); 
            $this->fm = new Format();   
        }

        public function add_to_cart($quantity,$id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sid = session_id();
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $productName = $result['productName'];
            $image = $result['image'];
            $price = $result['price'];
            $query_check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sid = '$sid'";
            $check_cart = $this->db->select($query_check_cart);
            if($check_cart){
                $msg = '<span style="color: red; font-size: 18px">Product already exists in cart!!!</span>';
                return $msg;
            } else {
                $query_insert = "INSERT INTO tbl_cart (productId, sid, productName, price, quantity, image) 
                    VALUES ('$id', '$sid', '$productName', '$price', '$quantity', '$image')";
                $result_insert = $this->db->insert($query_insert);
                if($result_insert){
                    header('Location:cart.php');
                } else {
                    header('Location:404.php');
                }
            }
        }

        public function get_product_cart(){
            $sid = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity,$cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link,$cartId);
            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
            $result = $this->db->update($query);
            if($result){
                header('Location:cart.php');
            } else {
                $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                return $msg;
            }
        }

        public function del_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link,$cartid);
            $query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
            } else{
                $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                return $msg;
            }
        }

        public function check_cart(){
            $sid = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_all_data_cart(){
            $sid = session_id();
            $query = "DELETE FROM tbl_cart WHERE sid = '$sid'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function insertCompare($productid,$customer_id){
            $productid  = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id  = mysqli_real_escape_string($this->db->link, $customer_id);
            $query_check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customerId = '$customer_id'";
            $check_compare = $this->db->select($query_check_compare);
            if($check_compare){
                $msg = '<br><span style="color: red; font-size: 18px">Product already exists to compare!!!</span>';
                return $msg;
            } else {
                $query_product = "SELECT * FROM tbl_product WHERE productId = '$productid'";
                $result_product = $this->db->select($query_product)->fetch_assoc();
                $productName = $result_product['productName'];
                $image = $result_product['image'];
                $price = $result_product['price'];
                $query = "INSERT INTO tbl_compare (customerId, productId, productName, image, price) 
                VALUES ('$customer_id', '$productid', '$productName', '$image', '$price')";
                $result = $this->db->insert($query);
                if($result){
                    $msg = '<br><span style="color: green; font-size: 18px">Add compare list successful!</span>';
                    return $msg;
                } else {
                    $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                    return $msg;
                }
            }
        }

        public function get_all_compare($customer_id){
            $query = "SELECT * FROM tbl_compare WHERE customerId = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_product_compare($compareId){
            $compareId = mysqli_real_escape_string($this->db->link,$compareId);
            $query = "DELETE FROM tbl_compare WHERE id = '$compareId'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:compare.php');
            } else{
                $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                return $msg;
            }
        }

        public function del_all_data_compare($customer_id){
            $query = "DELETE FROM tbl_compare WHERE customerId = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function insertflist($productid,$customer_id){
            $productid  = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id  = mysqli_real_escape_string($this->db->link, $customer_id);
            $query_check_flist = "SELECT * FROM tbl_favoriteList WHERE productId = '$productid' AND customerId = '$customer_id'";
            $check_flist = $this->db->select($query_check_flist);
            if($check_flist){
                $msg = '<br><span style="color: red; font-size: 18px">Product already exists in favorite list</span>';
                return $msg;
            } else {
                $query_product = "SELECT * FROM tbl_product WHERE productId = '$productid'";
                $result_product = $this->db->select($query_product)->fetch_assoc();
                $productName = $result_product['productName'];
                $image = $result_product['image'];
                $price = $result_product['price'];
                $query = "INSERT INTO tbl_favoriteList (customerId, productId, productName, image, price) 
                VALUES ('$customer_id', '$productid', '$productName', '$image', '$price')";
                $result = $this->db->insert($query);
                if($result){
                    $msg = '<br><span class="success">Add favorite list successful!</span>';
                    return $msg;
                } else {
                    $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                    return $msg;
                }
            }
        }

        public function get_all_flist($customer_id){
            $query = "SELECT * FROM tbl_favoriteList WHERE customerId = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_product_flist($favorId){
            $favorId = mysqli_real_escape_string($this->db->link,$favorId);
            $query = "DELETE FROM tbl_favoriteList WHERE id = '$favorId'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:favorite.php');
            } else{
                $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                return $msg;
            }
        }

        public function del_product_flist_ac($customerId,$productId){
            $customerId = mysqli_real_escape_string($this->db->link,$customerId);
            $productId = mysqli_real_escape_string($this->db->link,$productId);
            $query = "DELETE FROM tbl_favoriteList WHERE customerId = '$customerId' AND productId = '$productId'";
            $result = $this->db->delete($query);
            return $result;
        }
    }
?>