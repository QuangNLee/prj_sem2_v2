<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class newsController{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_news($data,$files){
            $title = mysqli_real_escape_string($this->db->link, $data['title']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            //Check image and put image into folder upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/news/".$unique_image;
            if($title == "" || $content == "" || $file_name == ""){
                $msg = "<span style='color: red; font-size: 18px'>Fields must be not empty!!!</span>";
                return $msg;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_news (title, image, content) VALUES ('$title', '$unique_image', '$content')";
                $result = $this->db->insert($query);
                if($result){
                    $msg = "<span class='success'>Success!!!</span>";
                    return $msg;
                } else {
                    $msg = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                    return $msg;
                }
            }
        }

        public function update_news($data,$files,$id){
            $title = mysqli_real_escape_string($this->db->link, $data['title']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);
            //Check image and put image into folder upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/news/".$unique_image;
            if($title == "" || $content = "" || $status == ""){
                $msg = "<span style='color: red; font-size: 18px'>Fields must be not empty!!!</span>";
                return $msg;
            } else {
                if(!empty($file_name)) {
                    if ($file_size > 20480) {
                        $alert = "<span style='color: red; font-size: 18px'>Image size should be less than 2MB!</span>";
                        return $alert;
                    } else if (in_array($file_ext, $permitted) === false) {
                        $alert = "<span style='color: red; font-size: 18px'> You can upload only :-" . implode(', ', $permitted) . "</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = 'UPDATE tbl_news SET title = \'$title\', image = \'$unique_image\', content = \'$content\', status = \'$status\' WHERE id = \'$id\'';
                } else {
                    $query = 'UPDATE tbl_news SET title = \'$title\', content = \'$content\', status = \'$status\' WHERE id = \'$id\'';
                }
                $result = $this->db->update($query);
                if($result){
                    $msg = "<span class='success'>Updated successfully!!!</span>";
                    return $msg;
                } else {
                    $msg = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                    return $msg;
                }
            }
        }

        public function get_news(){
            $query = "SELECT * FROM tbl_news";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_news_pagination($news_start, $limit){
            $news_start = mysqli_real_escape_string($this->db->link, $news_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_news ORDER by id desc LIMIT {$news_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_new_by_id($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $query = "SELECT * FROM tbl_news WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_news_index(){
            $query = "SELECT * FROM tbl_news WHERE status = 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_news_index_pagination($news_start, $limit){
            $news_start = mysqli_real_escape_string($this->db->link, $news_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_news WHERE status = 1 ORDER BY id DESC LIMIT {'$news_start'},{'$limit'}";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>