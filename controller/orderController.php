<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class orderController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insertOrder($customer_id){
            $sid = session_id();
            $query_get_product = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
            $get_product = $this->db->select($query_get_product);
            if($get_product){
                $query_insert_order = "INSERT INTO tbl_order (customerId,orderType) VALUE ('$customer_id',0)";
                $insert_order = $this->db->insert($query_insert_order);
                while($result_product = $get_product->fetch_assoc()){
                    $query_get_order = "SELECT * FROM tbl_order WHERE customerId = '$customer_id' ORDER BY createdAt DESC LIMIT 1";
                    $get_order = $this->db->select($query_get_order);
                    $result_order = $get_order->fetch_assoc();
                    $orderId = $result_order['id'];
                    $productId = $result_product['productId'];
                    $quantity = $result_product['quantity'];
                    $price = $result_product['price'];
                    $query = "INSERT INTO tbl_orderDetail (orderId, productId, quantity, unitPrice)
                        VALUES ('$orderId', '$productId', '$quantity', $price)";
                    $result = $this->db->insert($query);
                }
            }
        }

        public function insertOrderOnline($customer_id, $gate){
            $sid = session_id();
            $query_get_product = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
            $get_product = $this->db->select($query_get_product);
            if($get_product){
                $query_insert_order = "INSERT INTO tbl_order (customerId,orderType,gate) VALUE ('$customer_id',1, '$gate')";
                $insert_order = $this->db->insert($query_insert_order);
                while($result_product = $get_product->fetch_assoc()){
                    $query_get_order = "SELECT * FROM tbl_order WHERE customerId = '$customer_id' ORDER BY createdAt DESC LIMIT 1";
                    $get_order = $this->db->select($query_get_order);
                    $result_order = $get_order->fetch_assoc();
                    $orderId = $result_order['id'];
                    $productId = $result_product['productId'];
                    $quantity = $result_product['quantity'];
                    $price = $result_product['price'];
                    $query = "INSERT INTO tbl_orderDetail (orderId, productId, quantity, unitPrice)
                        VALUES ('$orderId', '$productId', '$quantity', $price)";
                    $result = $this->db->insert($query);
                }
            }
        }

        public function get_amount($customer_id){
            $query_get_order = "SELECT id from tbl_order WHERE customerId = '$customer_id' ORDER BY createdAt DESC LIMIT 1";
            $get_order = $this->db->select($query_get_order);
            $result_get_order = $get_order->fetch_assoc();
            $order_id = $result_get_order['id'];
            $query_get_orderDetail = "SELECT ROUND(SUM(unitPrice*quantity)) AS 'total' FROM tbl_orderDetail WHERE orderId = '$order_id'";
            $get_od = $this->db->select($query_get_orderDetail);
            return $get_od;
        }

        public function get_order_detail($customer_id){
            $query_get_order = "SELECT id from tbl_order WHERE customerId = '$customer_id' ORDER BY createdAt DESC LIMIT 1";
            $get_order = $this->db->select($query_get_order);
            $result_get_order = $get_order->fetch_assoc();
            $order_id = $result_get_order['id'];
            $query = "SELECT p.productId, p.productName, p.image, od.unitPrice, 
                        od.quantity, ROUND(od.unitPrice*od.quantity) as 'total', 
                        o.createdAt, od.status FROM tbl_product p, tbl_orderDetail od, tbl_order o
                        WHERE od.orderId = '$order_id' AND p.productId = od.productId AND o.id = od.orderId";
            $result = $this->db->select($query);
            return $result;
        }

        public function check_order($customer_id){
            $query = "SELECT * FROM tbl_order WHERE customerId = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_order_detail($customer_id){
            $query = "SELECT p.productId, p.productName, p.image, od.unitPrice, o.id, 
                        od.quantity, ROUND(od.unitPrice*od.quantity) as 'total', 
                        o.createdAt AS 'orderDate', od.status FROM tbl_product p, tbl_orderDetail od, tbl_order o
                        WHERE o.customerId = '$customer_id' AND p.productId = od.productId AND o.id = od.orderId";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_all_order_detail($customer_id,$order_start,$limit){
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
            $order_start = mysqli_real_escape_string($this->db->link, $order_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT p.productId, p.productName, p.image, od.unitPrice, o.id, o.orderType, 
                        od.quantity, ROUND(od.unitPrice*od.quantity) as 'total', 
                        o.createdAt AS 'orderDate', od.status FROM tbl_product p, tbl_orderDetail od, tbl_order o
                        WHERE o.customerId = '$customer_id' AND p.productId = od.productId AND o.id = od.orderId
                        ORDER BY orderDate DESC LIMIT {$order_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_inbox_order(){
            $query = "SELECT o.id, o.customerId, o.createdAt, o.orderType, o.customerId, p.productName, od.quantity, od.productId, 
                        ROUND(od.quantity*od.unitPrice) AS 'total', od.status
                      FROM tbl_order o, tbl_orderDetail od, tbl_product p
                      WHERE o.id = od.orderId AND p.productId = od.productId AND od.status IN (SELECT DISTINCT status FROM tbl_orderDetail where status = '0' OR status = '1')
                      ORDER BY o.createdAt DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_order(){
            $query = "SELECT o.id, o.customerId, o.createdAt, o.orderType, o.gate, o.customerId, p.productName, od.quantity, od.productId, 
                        ROUND(od.quantity*od.unitPrice) AS 'total', od.status
                      FROM tbl_order o, tbl_orderDetail od, tbl_product p
                      WHERE o.id = od.orderId AND p.productId = od.productId
                      ORDER BY o.createdAt DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_all_order($order_start,$limit){
            $order_start = mysqli_real_escape_string($this->db->link, $order_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT o.id, o.customerId, o.createdAt, o.orderType, o.gate, o.customerId, p.productName, od.quantity, od.productId, 
                        ROUND(od.quantity*od.unitPrice) AS 'total', od.status
                      FROM tbl_order o, tbl_orderDetail od, tbl_product p
                      WHERE o.id = od.orderId AND p.productId = od.productId
                      ORDER BY o.createdAt DESC LIMIT {$order_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_completed_order(){
            $query = "SELECT o.id, o.customerId, o.createdAt, o.orderType, o.customerId, p.productName, od.quantity, od.productId, 
                        ROUND(od.quantity*od.unitPrice) AS 'total', od.status
                      FROM tbl_order o, tbl_orderDetail od, tbl_product p
                      WHERE o.id = od.orderId AND p.productId = od.productId AND od.status IN (SELECT DISTINCT status FROM tbl_orderDetail where status = '2' OR status = '3')
                      ORDER BY o.createdAt DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_completed_order($order_start,$limit){
            $order_start = mysqli_real_escape_string($this->db->link, $order_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT o.id, o.customerId, o.createdAt, o.orderType, o.customerId, p.productName, od.quantity, od.productId, 
                        ROUND(od.quantity*od.unitPrice) AS 'total', od.status
                      FROM tbl_order o, tbl_orderDetail od, tbl_product p
                      WHERE o.id = od.orderId AND p.productId = od.productId AND od.status IN (SELECT DISTINCT status FROM tbl_orderDetail where status = '2' OR status = '3')
                      ORDER BY o.createdAt DESC LIMIT {$order_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function shipped($id,$productId,$quantity){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $query = "UPDATE tbl_orderDetail SET status = '1' WHERE orderId = '$id' AND productId = '$productId' AND quantity = '$quantity'";
            $result = $this->db->update($query);
            if($result){
                $msg = "<span class='success'>Success!!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Failed!!!</span>";
                return $msg;
            }
        }

        public function confirm_order($id,$productId,$quantity){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $query = "UPDATE tbl_orderDetail SET status = '2' WHERE orderId = '$id' AND productId = '$productId' AND quantity = '$quantity'";
            $result = $this->db->update($query);
            return $result;
        }

        public function cancel_order($id,$productId,$quantity){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $query = "UPDATE tbl_orderDetail SET status = '3' WHERE orderId = '$id' AND productId = '$productId' AND quantity = '$quantity'";
            $result = $this->db->update($query);
            return $result;
        }
    }
?>
