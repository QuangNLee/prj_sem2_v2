<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class categoryController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database(); 
            $this->fm = new Format();   
        }

        public function insert_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            if(empty($catName)){
                $alert = "<span style='color: red; font-size: 18px'>Category must be not empty!!!</span>";
                return $alert;
            } else {
                $query_check_cat = "SELECT * FROM tbl_category WHERE catName LIKE '%$catName%'";
                $result_check = $this->db->select($query_check_cat);
                if($result_check){
                    $alert = "<span style='font-size: 18px; color: red'>Category name existed!!!</span>";
                    return $alert;
                } else {
                    $query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Success!!!</span>";
                        return $alert;
                    } else {
                        $alert = "<span style='font-size: 18px; color: red'>Failed!!!</span>";
                        return $alert;
                    }
                }
            }
        }

        public function show_category(){
            $query = "SELECT * FROM tbl_category";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_pagination_category($cat_start,$limit){
            $cat_start = mysqli_real_escape_string($this->db->link, $cat_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_category ORDER BY catId ASC LIMIT {$cat_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_category_index(){
            $query = "SELECT * FROM tbl_category WHERE status = '1' ORDER BY catName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($catName,$status,$id){
            $catName = $this->fm->validation($catName);
            $status = $this->fm->validation($status);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $status = mysqli_real_escape_string($this->db->link, $status);
            $id = mysqli_real_escape_string($this->db->link, $id);
            if(empty($catName)){
                $alert = "<span style='font-size: 18px; color: red'>Category must be not empty!!!</span>";
                return $alert;
            } else {
                $query = "UPDATE tbl_category SET catName = '$catName', status = '$status' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Updated successfully!!!</span>";
                    return $alert;
                } else {
                    $alert = "<span style='font-size: 18px; color: red'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

//        public function delete_category($id){
//            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
//            $result = $this->db->delete($query);
//            if($result){
//                $alert = "<span class='success'>Deleted successfully!!!</span>";
//                return $alert;
//            } else {
//                $alert = "<span class='error'>Failed!!!</span>";
//                return $alert;
//            }
//        }

        public function getcatbyId($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getAll_category(){
            $query = "SELECT * FROM tbl_category ORDER BY catName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getAll_active_category(){
            $query = "SELECT * FROM tbl_category where status = '1' ORDER BY catName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_name_by_cat($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>