<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class customerController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $district = mysqli_real_escape_string($this->db->link, $data['district']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $district == "" || $phone == "" || $password == ""){
                $alert = "<span class='error'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if ($result_check){
                    $alert = "<span style='font-size: 18px; color: red'>Email already exists!!!</span>";
                    return $alert;
                } else {
                    $query = "INSERT INTO tbl_customer (name, address, district, city, zipcode, phone, email, password) 
                        VALUES ('$name', '$address', '$district', '$city', '$zipcode', '$phone', '$email', '$password')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span style='font-size: 18px; color: green'>Success!!!</span>";
                        return $alert;
                    } else {
                        $alert = "<span style='font-size: 18px; color: red'>Failed!!!</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customer($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($email == "" || $password == ""){
                $alert = "<span style='font-size: 18px; color: red'>Email or password must be not empty!!!</span>";
                return $alert;
            } else {
                $check_em_lg = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
                $result_check_lg = $this->db->select($check_em_lg);
                if ($result_check_lg != false){
                    $value = $result_check_lg->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $value['id']);
                    Session::set('customer_name', $value['name']);
                    header('Location:index.php');
                } else {
                    $alert = "<span style='font-size: 18px; color: red'>Email or password does not correct!!!</span>";
                    return $alert;
                }
            }
        }

        public function show_customer($id){
            $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_customer($data, $id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $district = mysqli_real_escape_string($this->db->link, $data['district']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            if($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $district == "" || $phone == ""){
                $alert = "<span class='error'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                $query = "UPDATE tbl_customer SET 
                    name = '$name', 
                    address = '$address', 
                    district = '$district', 
                    city = '$city',
                    zipcode = '$zipcode',
                    phone = '$phone',
                    email = '$email'
                    WHERE id = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Updated successfully!!!</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

        public function insert_comment($productId,$data){
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $commentName = mysqli_real_escape_string($this->db->link, $data['commentName']);
            $comment = mysqli_real_escape_string($this->db->link, $data['comment']);
            if($commentName == "" || $comment == ""){
                $alert = "<span class='error'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_comment (productId, commentName, comment) VALUES ('$productId', '$commentName', '$comment')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span style='color: green; font-size: 18px'>Success!!!</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

        public function changePassword($id,$data){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $o_password = mysqli_real_escape_string($this->db->link, md5($data['o_password']));
            $n_password = mysqli_real_escape_string($this->db->link, md5($data['n_password']));
            $rn_password = mysqli_real_escape_string($this->db->link, md5($data['rn_password']));
            $query_check = "SELECT * FROM tbl_customer WHERE id = '$id' AND password = '$o_password'";
            $result_check = $this->db->select($query_check);
            if ($result_check){
                if($n_password != $rn_password){
                    echo '<span class="error">Password and retype password do not match!!!</span>';
                } else {
                    $query = "UPDATE tbl_customer SET password = '$n_password' WHERE id = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        echo '<span class="success">Success!!!</span>';
                    } else {
                        echo '<span class="error">Failed!!!</span>';
                    }
                }
            } else {
                echo '<span class="error">Old password does not match!!!</span>';
            }
        }

        public function contact_support($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phoneNumber = mysqli_real_escape_string($this->db->link, $data['phoneNumber']);
            $subjectQuestion = mysqli_real_escape_string($this->db->link, $data['subjectQuestion']);
            if($name == "" || $email == "" || $phoneNumber == "" || $subjectQuestion == ""){
                $alert = '<span style="color: red; font-size: 18px">Fields must not empty!!!</span>';
                return $alert;
            } else {
                $query = "INSERT INTO tbl_contact (name, email, phone, subject) VALUES ('$name', '$email', '$phoneNumber', '$subjectQuestion')";
                $result = $this->db->insert($query);
                if($result){
                    echo '<span style="color: green; font-size: 18px">We will answer your question soon!!!</span>';
                } else {
                    echo '<span style="color: red; font-size: 18px">Failed!!!</span>';
                }
            }
        }

        public function get_contact(){
            $query = "SELECT * FROM tbl_contact ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_pagination_contact($contact_start, $limit){
            $contact_start = mysqli_real_escape_string($this->db->link, $contact_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_contact ORDER BY id DESC LIMIT {$contact_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_status_contact($id,$status){
            $query = "UPDATE tbl_contact SET status = '$status' WHERE id = '$id'";
            $result = $this->db->update($query);
            return $result;
        }
    }
?>