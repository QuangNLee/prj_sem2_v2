<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class brandController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database(); 
            $this->fm = new Format();   
        }

        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            if(empty($brandName)){
                $msg = '<span style="color: red; font-size: 18px">Brand name must be not empty!!!</span>';
                return $msg;
            } else {
                $query_check_brand = "SELECT * FROM tbl_brand WHERE brandName LIKE '%$brandName%'";
                $result_check = $this->db->select($query_check_brand);
                if($result_check){
                    $msg = '<span style="color: red; font-size: 18px">Brand name existed!!!</span>';
                    return $msg;
                } else {
                    $query = "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
                    $result = $this->db->insert($query);
                    if($result){
                        $msg = '<span style="color: green; font-size: 18px">Success!!!</span>';
                        return $msg;
                    } else {
                        $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                        return $msg;
                    }
                }
            }
        }

        public function show_brand(){
            $query = "SELECT * FROM tbl_brand ORDER by brandName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_pagination_brand($brand_start,$limit){
            $brand_start = mysqli_real_escape_string($this->db->link, $brand_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_brand ORDER BY brandId ASC LIMIT {$brand_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_brand($brandName,$status,$id){
            $brandName = $this->fm->validation($brandName);
            $status = $this->fm->validation($status);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $status = mysqli_real_escape_string($this->db->link, $status);
            $id = mysqli_real_escape_string($this->db->link, $id);
            if(empty($brandName)){
                $msg = '<span style="color: red; font-size: 18px">Brand name must be not empty!!!</span>';
                return $msg;
            } else {
                $query = "UPDATE tbl_brand SET brandName = '$brandName', status = '$status' WHERE brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $msg = '<span style="color: green; font-size: 18px">Updated successfully!!!</span>';
                    return $msg;
                } else {
                    $msg = '<span style="color: red; font-size: 18px">Failed!!!</span>';
                    return $msg;
                }
            }
        }

        public function getbrandbyId($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function list_brand(){
            $query = "SELECT * FROM tbl_brand WHERE status = 1 ORDER by brandName ASC LIMIT 14";
            $result = $this->db->select($query);
            return $result;
        }

        public function getNameByBrandId($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>