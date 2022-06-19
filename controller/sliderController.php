<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class sliderController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insertSlider($data,$files){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $permitted = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($name == "" || $type == ""){
                $alert = "<span style='color: red; font-size: 18px'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                if(!empty($file_name)){
                    if($file_size > 2048000){
                        $alert = "<span style='color: red; font-size: 18px'>Image size should be less than 200MB!</span>";
                        return $alert;
                    } else if (in_array($file_ext, $permitted) === false){
                        $alert = "<span style='color: red; font-size: 18px'> You can upload only :-".implode(', ', $permitted)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_slider (sliderName, image, type) VALUES ('$name', '$unique_image', '$type')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Success!!!</span>";
                        return $alert;
                    } else {
                        $alert = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                        return $alert;
                    }
                }
            }
        }

        public function show_slider(){
            $query = "SELECT * FROM tbl_slider WHERE TYPE = '1' ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_slider_admin(){
            $query = "SELECT * FROM tbl_slider";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_pagination_slider($slider_start, $limit){
            $slider_start = mysqli_real_escape_string($this->db->link, $slider_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_slider ORDER BY id ASC LIMIT {$slider_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_type($id,$type){
            $query = "UPDATE tbl_slider SET type = '$type' WHERE id = '$id'";
            $result = $this->db->update($query);
            return $result;
        }

        public function del_slider($id){
            $query = "DELETE FROM tbl_slider WHERE id = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Deleted successfully!!!</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
            }
        }
    }
?>
