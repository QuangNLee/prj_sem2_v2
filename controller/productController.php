<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class productController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database(); 
            $this->fm = new Format();   
        }

        public function insert_product($data,$files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_description = mysqli_real_escape_string($this->db->link, $data['product_description']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $origin = mysqli_real_escape_string($this->db->link, $data['origin']);
            $size = mysqli_real_escape_string($this->db->link, $data['size']);
            $productWeight = mysqli_real_escape_string($this->db->link, $data['productWeight']);
            $material = mysqli_real_escape_string($this->db->link, $data['material']);
            $radiators = mysqli_real_escape_string($this->db->link, $data['radiators']);
            $cpu = mysqli_real_escape_string($this->db->link, $data['cpu']);
            $ram = mysqli_real_escape_string($this->db->link, $data['ram']);
            $typeOfRam = mysqli_real_escape_string($this->db->link, $data['typeOfRam']);
            $ramSpeed = mysqli_real_escape_string($this->db->link, $data['ramSpeed']);
            $numberOfRamSlot = mysqli_real_escape_string($this->db->link, $data['numberOfRamSlot']);
            $maximumRamSupport = mysqli_real_escape_string($this->db->link, $data['maximumRamSupport']);
            $screenSize = mysqli_real_escape_string($this->db->link, $data['screenSize']);
            $resolution = mysqli_real_escape_string($this->db->link, $data['resolution']);
            $screenRatio = mysqli_real_escape_string($this->db->link, $data['screenRatio']);
            $onboardCard = mysqli_real_escape_string($this->db->link, $data['onboardCard']);
            $removableCard = mysqli_real_escape_string($this->db->link, $data['removableCard']);
            $storage = mysqli_real_escape_string($this->db->link, $data['storage']);
            $webCommunication = mysqli_real_escape_string($this->db->link, $data['webCommunication']);
            $wifi = mysqli_real_escape_string($this->db->link, $data['wifi']);
            $bluetooth = mysqli_real_escape_string($this->db->link, $data['bluetooth']);
            $camera = mysqli_real_escape_string($this->db->link, $data['camera']);
            $keyboardType = mysqli_real_escape_string($this->db->link, $data['keyboardType']);
            $pin = mysqli_real_escape_string($this->db->link, $data['pin']);
            $osVersion = mysqli_real_escape_string($this->db->link, $data['osVersion']);
            $waterResistance = mysqli_real_escape_string($this->db->link, $data['waterResistance']);
            $internalMemory = mysqli_real_escape_string($this->db->link, $data['internalMemory']);
            $simType = mysqli_real_escape_string($this->db->link, $data['simType']);
            $networkSupport = mysqli_real_escape_string($this->db->link, $data['networkSupport']);
            //Check image and put image into folder upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/products/".$unique_image;
            if($productName == "" || $category == "" || $brand == "" || $product_description == "" || $price == "" || $type == "" || $file_name == ""){
                $alert = "<span style='color: red; font-size: 18px'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product (productName, catId, brandId, product_description, type, price, image) 
                    VALUES ('$productName', '$category', '$brand', '$product_description', '$type', '$price', '$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $get_ID_pro = "SELECT productId FROM tbl_product WHERE productName LIKE '$productName' AND catId = '$category' AND brandId = '$brand' AND price = '$price'";
                    $result_get_ID_pro = $this->db->select($get_ID_pro)->fetch_assoc();
                    $productId = $result_get_ID_pro['productId'];
                    $get_origin_id = "SELECT id FROM tbl_specification WHERE name LIKE '%origin%'";
                    $result_origin_id = $this->db->select($get_origin_id)->fetch_assoc();
                    $originId = $result_origin_id['id'];
                    $get_size_id = "SELECT id FROM tbl_specification WHERE name LIKE '%size%'";
                    $result_size_id = $this->db->select($get_size_id)->fetch_assoc();
                    $sizeId = $result_size_id['id'];
                    $get_productWeight_id = "SELECT id FROM tbl_specification WHERE name LIKE '%product weigh%'";
                    $result_productWeight_id = $this->db->select($get_productWeight_id)->fetch_assoc();
                    $productWeightId = $result_productWeight_id['id'];
                    $get_material_id = "SELECT id FROM tbl_specification WHERE name LIKE '%material%'";
                    $result_material_id = $this->db->select($get_material_id)->fetch_assoc();
                    $materialId = $result_material_id['id'];
                    $get_radiators_id = "SELECT id FROM tbl_specification WHERE name LIKE '%radiator%'";
                    $result_radiators_id = $this->db->select($get_radiators_id)->fetch_assoc();
                    $radiatorsId = $result_radiators_id['id'];
                    $get_cpu_id = "SELECT id FROM tbl_specification WHERE name LIKE '%cpu%'";
                    $result_cpu_id = $this->db->select($get_cpu_id)->fetch_assoc();
                    $cpuId = $result_cpu_id['id'];
                    $get_ram_id = "SELECT id FROM tbl_specification WHERE name LIKE '%ram%'";
                    $result_ram_id = $this->db->select($get_ram_id)->fetch_assoc();
                    $ramId = $result_ram_id['id'];
                    $get_typeOfRam_id = "SELECT id FROM tbl_specification WHERE name LIKE '%type of ram%'";
                    $result_typeOfRam_id = $this->db->select($get_typeOfRam_id)->fetch_assoc();
                    $typeOfRamId = $result_typeOfRam_id['id'];
                    $get_ramSpeed_id = "SELECT id FROM tbl_specification WHERE name LIKE '%ram speed%'";
                    $result_ramSpeed_id = $this->db->select($get_ramSpeed_id)->fetch_assoc();
                    $ramSpeedId = $result_ramSpeed_id['id'];
                    $get_numberOfRamSlot_id = "SELECT id FROM tbl_specification WHERE name LIKE '%number of ram slot%'";
                    $result_numberOfRamSlot_id = $this->db->select($get_numberOfRamSlot_id)->fetch_assoc();
                    $numberOfRamSlotId = $result_numberOfRamSlot_id['id'];
                    $get_maximumRamSupport_id = "SELECT id FROM tbl_specification WHERE name LIKE '%maximum ram support%'";
                    $result_maximumRamSupport_id = $this->db->select($get_maximumRamSupport_id)->fetch_assoc();
                    $maximumRamSupportId = $result_maximumRamSupport_id['id'];
                    $get_screenSize_id = "SELECT id FROM tbl_specification WHERE name LIKE '%screen size%'";
                    $result_screenSize_id = $this->db->select($get_screenSize_id)->fetch_assoc();
                    $screenSizeId = $result_screenSize_id['id'];
                    $get_resolution_id = "SELECT id FROM tbl_specification WHERE name LIKE '%resolution%'";
                    $result_resolution_id = $this->db->select($get_resolution_id)->fetch_assoc();
                    $resolutionId = $result_resolution_id['id'];
                    $get_screenRatio_id = "SELECT id FROM tbl_specification WHERE name LIKE '%screen ratio%'";
                    $result_screenRatio_id = $this->db->select($get_screenRatio_id)->fetch_assoc();
                    $screenRatioId = $result_screenRatio_id['id'];
                    $get_onboardCard_id = "SELECT id FROM tbl_specification WHERE name LIKE '%onboard card%'";
                    $result_onboardCard_id = $this->db->select($get_onboardCard_id)->fetch_assoc();
                    $onboardCardId = $result_onboardCard_id['id'];
                    $get_removableCard_id = "SELECT id FROM tbl_specification WHERE name LIKE '%removable card%'";
                    $result_removableCard_id = $this->db->select($get_removableCard_id)->fetch_assoc();
                    $removableCardId = $result_removableCard_id['id'];
                    $get_storage_id = "SELECT id FROM tbl_specification WHERE name LIKE '%storage%'";
                    $result_storage_id = $this->db->select($get_storage_id)->fetch_assoc();
                    $storageId = $result_storage_id['id'];
                    $get_webCommunication_id = "SELECT id FROM tbl_specification WHERE name LIKE '%the web of communication%'";
                    $result_webCommunication_id = $this->db->select($get_webCommunication_id)->fetch_assoc();
                    $webCommunicationId = $result_webCommunication_id['id'];
                    $get_wifi_id = "SELECT id FROM tbl_specification WHERE name LIKE '%wifi%'";
                    $result_wifi_id = $this->db->select($get_wifi_id)->fetch_assoc();
                    $wifiId = $result_wifi_id['id'];
                    $get_bluetooth_id = "SELECT id FROM tbl_specification WHERE name LIKE '%bluetooth%'";
                    $result_bluetooth_id = $this->db->select($get_bluetooth_id)->fetch_assoc();
                    $bluetoothId = $result_bluetooth_id['id'];
                    $get_camera_id = "SELECT id FROM tbl_specification WHERE name LIKE '%camera%'";
                    $result_camera_id = $this->db->select($get_camera_id)->fetch_assoc();
                    $cameraId = $result_camera_id['id'];
                    $get_keyboardType_id = "SELECT id FROM tbl_specification WHERE name LIKE '%keyboard type%'";
                    $result_keyboardType_id = $this->db->select($get_keyboardType_id)->fetch_assoc();
                    $keyboardTypeId = $result_keyboardType_id['id'];
                    $get_pin_id = "SELECT id FROM tbl_specification WHERE name LIKE '%pin%'";
                    $result_pin_id = $this->db->select($get_pin_id)->fetch_assoc();
                    $pinId = $result_pin_id['id'];
                    $get_osVersion_id = "SELECT id FROM tbl_specification WHERE name LIKE '%os version%'";
                    $result_osVersion_id = $this->db->select($get_osVersion_id)->fetch_assoc();
                    $osVersionId = $result_osVersion_id['id'];
                    $get_waterResistance_id = "SELECT id FROM tbl_specification WHERE name LIKE '%Water/Dirt resistance%'";
                    $result_waterResistance_id = $this->db->select($get_waterResistance_id)->fetch_assoc();
                    $waterResistanceId = $result_waterResistance_id['id'];
                    $get_internalMemory_id = "SELECT id FROM tbl_specification WHERE name LIKE '%internal memory%'";
                    $result_internalMemory_id = $this->db->select($get_internalMemory_id)->fetch_assoc();
                    $internalMemoryId = $result_internalMemory_id['id'];
                    $get_simType_id = "SELECT id FROM tbl_specification WHERE name LIKE '%sim type%'";
                    $result_simType_id = $this->db->select($get_simType_id)->fetch_assoc();
                    $simTypeId = $result_simType_id['id'];
                    $get_networkSupport_id = "SELECT id FROM tbl_specification WHERE name LIKE '%network support%'";
                    $result_networkSupport_id = $this->db->select($get_networkSupport_id)->fetch_assoc();
                    $networkSupportId = $result_networkSupport_id['id'];
                    $query_pro_spec = "insert into tbl_pro_spec values
                        ('$productId','$originId','$origin'),
                        ('$productId','$sizeId','$size'),
                        ('$productId','$productWeightId','$productWeight'),
                        ('$productId','$materialId','$material'),
                        ('$productId','$radiatorsId','$radiators'),
                        ('$productId','$cpuId','$cpu'),
                        ('$productId','$ramId','$ram'),
                        ('$productId','$typeOfRamId','$typeOfRam'),
                        ('$productId','$ramSpeedId','$ramSpeed'),
                        ('$productId','$numberOfRamSlotId','$numberOfRamSlot'),
                        ('$productId','$maximumRamSupportId','$maximumRamSupport'),
                        ('$productId','$screenSizeId','$screenSize'),
                        ('$productId','$resolutionId','$resolution'),
                        ('$productId','$screenRatioId','$screenRatio'),
                        ('$productId','$onboardCardId','$onboardCard'),
                        ('$productId','$removableCardId','$removableCard'),
                        ('$productId','$storageId','$storage'),
                        ('$productId','$webCommunicationId','$webCommunication'),
                        ('$productId','$wifiId','$wifi'),
                        ('$productId','$bluetoothId','$bluetooth'),
                        ('$productId','$cameraId','$camera'),
                        ('$productId','$keyboardTypeId','$keyboardType'),
                        ('$productId','$pinId','$pin'),
                        ('$productId','$osVersionId','$osVersion'),
                        ('$productId','$waterResistanceId','$waterResistance'),
                        ('$productId','$internalMemoryId','$internalMemory'),
                        ('$productId','$simTypeId','$simType'),
                        ('$productId','$networkSupportId','$networkSupport');";
                    $result_pro_spec = $this->db->insert($query_pro_spec);
                    if($result_pro_spec){
                        $alert = "<span class='success'>Success!!!</span>";
                        return $alert;
                    } else {
                        $alert = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                        return $alert;
                    }
                } else {
                    $alert = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

        public function show_product(){
            $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                WHERE p.catId = c.catId and p.brandId = b.brandId
                ORDER BY p.productName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_product($product_start,$limit){
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                WHERE p.catId = c.catId and p.brandId = b.brandId
                ORDER BY p.productId ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data,$files,$id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_description = mysqli_real_escape_string($this->db->link, $data['product_description']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);
            $get_origin_id = "SELECT id FROM tbl_specification WHERE name LIKE '%origin%'";
            $result_origin_id = $this->db->select($get_origin_id)->fetch_assoc();
            $originId = $result_origin_id['id'];
            $get_size_id = "SELECT id FROM tbl_specification WHERE name LIKE '%size%'";
            $result_size_id = $this->db->select($get_size_id)->fetch_assoc();
            $sizeId = $result_size_id['id'];
            $get_productWeight_id = "SELECT id FROM tbl_specification WHERE name LIKE '%product weigh%'";
            $result_productWeight_id = $this->db->select($get_productWeight_id)->fetch_assoc();
            $productWeightId = $result_productWeight_id['id'];
            $get_material_id = "SELECT id FROM tbl_specification WHERE name LIKE '%material%'";
            $result_material_id = $this->db->select($get_material_id)->fetch_assoc();
            $materialId = $result_material_id['id'];
            $get_radiators_id = "SELECT id FROM tbl_specification WHERE name LIKE '%radiator%'";
            $result_radiators_id = $this->db->select($get_radiators_id)->fetch_assoc();
            $radiatorsId = $result_radiators_id['id'];
            $get_cpu_id = "SELECT id FROM tbl_specification WHERE name LIKE '%cpu%'";
            $result_cpu_id = $this->db->select($get_cpu_id)->fetch_assoc();
            $cpuId = $result_cpu_id['id'];
            $get_ram_id = "SELECT id FROM tbl_specification WHERE name LIKE '%ram%'";
            $result_ram_id = $this->db->select($get_ram_id)->fetch_assoc();
            $ramId = $result_ram_id['id'];
            $get_typeOfRam_id = "SELECT id FROM tbl_specification WHERE name LIKE '%type of ram%'";
            $result_typeOfRam_id = $this->db->select($get_typeOfRam_id)->fetch_assoc();
            $typeOfRamId = $result_typeOfRam_id['id'];
            $get_ramSpeed_id = "SELECT id FROM tbl_specification WHERE name LIKE '%ram speed%'";
            $result_ramSpeed_id = $this->db->select($get_ramSpeed_id)->fetch_assoc();
            $ramSpeedId = $result_ramSpeed_id['id'];
            $get_numberOfRamSlot_id = "SELECT id FROM tbl_specification WHERE name LIKE '%number of ram slot%'";
            $result_numberOfRamSlot_id = $this->db->select($get_numberOfRamSlot_id)->fetch_assoc();
            $numberOfRamSlotId = $result_numberOfRamSlot_id['id'];
            $get_maximumRamSupport_id = "SELECT id FROM tbl_specification WHERE name LIKE '%maximum ram support%'";
            $result_maximumRamSupport_id = $this->db->select($get_maximumRamSupport_id)->fetch_assoc();
            $maximumRamSupportId = $result_maximumRamSupport_id['id'];
            $get_screenSize_id = "SELECT id FROM tbl_specification WHERE name LIKE '%screen size%'";
            $result_screenSize_id = $this->db->select($get_screenSize_id)->fetch_assoc();
            $screenSizeId = $result_screenSize_id['id'];
            $get_resolution_id = "SELECT id FROM tbl_specification WHERE name LIKE '%resolution%'";
            $result_resolution_id = $this->db->select($get_resolution_id)->fetch_assoc();
            $resolutionId = $result_resolution_id['id'];
            $get_screenRatio_id = "SELECT id FROM tbl_specification WHERE name LIKE '%screen ratio%'";
            $result_screenRatio_id = $this->db->select($get_screenRatio_id)->fetch_assoc();
            $screenRatioId = $result_screenRatio_id['id'];
            $get_onboardCard_id = "SELECT id FROM tbl_specification WHERE name LIKE '%onboard card%'";
            $result_onboardCard_id = $this->db->select($get_onboardCard_id)->fetch_assoc();
            $onboardCardId = $result_onboardCard_id['id'];
            $get_removableCard_id = "SELECT id FROM tbl_specification WHERE name LIKE '%removable card%'";
            $result_removableCard_id = $this->db->select($get_removableCard_id)->fetch_assoc();
            $removableCardId = $result_removableCard_id['id'];
            $get_storage_id = "SELECT id FROM tbl_specification WHERE name LIKE '%storage%'";
            $result_storage_id = $this->db->select($get_storage_id)->fetch_assoc();
            $storageId = $result_storage_id['id'];
            $get_webCommunication_id = "SELECT id FROM tbl_specification WHERE name LIKE '%the web of communication%'";
            $result_webCommunication_id = $this->db->select($get_webCommunication_id)->fetch_assoc();
            $webCommunicationId = $result_webCommunication_id['id'];
            $get_wifi_id = "SELECT id FROM tbl_specification WHERE name LIKE '%wifi%'";
            $result_wifi_id = $this->db->select($get_wifi_id)->fetch_assoc();
            $wifiId = $result_wifi_id['id'];
            $get_bluetooth_id = "SELECT id FROM tbl_specification WHERE name LIKE '%bluetooth%'";
            $result_bluetooth_id = $this->db->select($get_bluetooth_id)->fetch_assoc();
            $bluetoothId = $result_bluetooth_id['id'];
            $get_camera_id = "SELECT id FROM tbl_specification WHERE name LIKE '%camera%'";
            $result_camera_id = $this->db->select($get_camera_id)->fetch_assoc();
            $cameraId = $result_camera_id['id'];
            $get_keyboardType_id = "SELECT id FROM tbl_specification WHERE name LIKE '%keyboard type%'";
            $result_keyboardType_id = $this->db->select($get_keyboardType_id)->fetch_assoc();
            $keyboardTypeId = $result_keyboardType_id['id'];
            $get_pin_id = "SELECT id FROM tbl_specification WHERE name LIKE '%pin%'";
            $result_pin_id = $this->db->select($get_pin_id)->fetch_assoc();
            $pinId = $result_pin_id['id'];
            $get_osVersion_id = "SELECT id FROM tbl_specification WHERE name LIKE '%os version%'";
            $result_osVersion_id = $this->db->select($get_osVersion_id)->fetch_assoc();
            $osVersionId = $result_osVersion_id['id'];
            $get_waterResistance_id = "SELECT id FROM tbl_specification WHERE name LIKE '%Water/Dirt resistance%'";
            $result_waterResistance_id = $this->db->select($get_waterResistance_id)->fetch_assoc();
            $waterResistanceId = $result_waterResistance_id['id'];
            $get_internalMemory_id = "SELECT id FROM tbl_specification WHERE name LIKE '%internal memory%'";
            $result_internalMemory_id = $this->db->select($get_internalMemory_id)->fetch_assoc();
            $internalMemoryId = $result_internalMemory_id['id'];
            $get_simType_id = "SELECT id FROM tbl_specification WHERE name LIKE '%sim type%'";
            $result_simType_id = $this->db->select($get_simType_id)->fetch_assoc();
            $simTypeId = $result_simType_id['id'];
            $get_networkSupport_id = "SELECT id FROM tbl_specification WHERE name LIKE '%network support%'";
            $result_networkSupport_id = $this->db->select($get_networkSupport_id)->fetch_assoc();
            $networkSupportId = $result_networkSupport_id['id'];
            $origin = mysqli_real_escape_string($this->db->link, $data[$originId]);
            $size = mysqli_real_escape_string($this->db->link, $data[$sizeId]);
            $productWeight = mysqli_real_escape_string($this->db->link, $data[$productWeightId]);
            $material = mysqli_real_escape_string($this->db->link, $data[$materialId]);
            $radiators = mysqli_real_escape_string($this->db->link, $data[$radiatorsId]);
            $cpu = mysqli_real_escape_string($this->db->link, $data[$cpuId]);
            $ram = mysqli_real_escape_string($this->db->link, $data[$ramId]);
            $typeOfRam = mysqli_real_escape_string($this->db->link, $data[$typeOfRamId]);
            $ramSpeed = mysqli_real_escape_string($this->db->link, $data[$ramSpeedId]);
            $numberOfRamSlot = mysqli_real_escape_string($this->db->link, $data[$numberOfRamSlotId]);
            $maximumRamSupport = mysqli_real_escape_string($this->db->link, $data[$maximumRamSupportId]);
            $screenSize = mysqli_real_escape_string($this->db->link, $data[$screenSizeId]);
            $resolution = mysqli_real_escape_string($this->db->link, $data[$resolutionId]);
            $screenRatio = mysqli_real_escape_string($this->db->link, $data[$screenRatioId]);
            $onboardCard = mysqli_real_escape_string($this->db->link, $data[$onboardCardId]);
            $removableCard = mysqli_real_escape_string($this->db->link, $data[$removableCardId]);
            $storage = mysqli_real_escape_string($this->db->link, $data[$storageId]);
            $webCommunication = mysqli_real_escape_string($this->db->link, $data[$webCommunicationId]);
            $wifi = mysqli_real_escape_string($this->db->link, $data[$wifiId]);
            $bluetooth = mysqli_real_escape_string($this->db->link, $data[$bluetoothId]);
            $camera = mysqli_real_escape_string($this->db->link, $data[$cameraId]);
            $keyboardType = mysqli_real_escape_string($this->db->link, $data[$keyboardTypeId]);
            $pin = mysqli_real_escape_string($this->db->link, $data[$pinId]);
            $osVersion = mysqli_real_escape_string($this->db->link, $data[$osVersionId]);
            $waterResistance = mysqli_real_escape_string($this->db->link, $data[$waterResistanceId]);
            $internalMemory = mysqli_real_escape_string($this->db->link, $data[$internalMemoryId]);
            $simType = mysqli_real_escape_string($this->db->link, $data[$simTypeId]);
            $networkSupport = mysqli_real_escape_string($this->db->link, $data[$networkSupportId]);
            //Check image and put image into folder upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/products/".$unique_image;
            if($productName == "" || $category == "" || $brand == "" || $product_description == "" || $price == "" || $type == "" || $status == ""){
                $alert = "<span style='color: red; font-size: 18px'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                if(!empty($file_name)){
                    if($file_size > 20480){
                        $alert = "<span style='color: red; font-size: 18px'>Image size should be less than 2MB!</span>";
                        return $alert;
                    } else if (in_array($file_ext, $permitted) === false){
                        $alert = "<span style='color: red; font-size: 18px'> You can upload only :-".implode(', ', $permitted)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET 
                        productName = '$productName',
                        catId = '$category',
                        brandId = '$brand',
                        product_description = '$product_description',
                        type = '$type',
                        price = '$price',
                        image = '$unique_image',
                        status = '$status'
                        WHERE productId = '$id'";
                } else {
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category',
                    brandId = '$brand',
                    product_description = '$product_description',
                    type = '$type',
                    price = '$price',
                    status = '$status'
                    WHERE productId = '$id'";
                }
                $result = $this->db->update($query);
                $query_origin = "UPDATE tbl_pro_spec SET value = '$origin' WHERE productId = '$id' AND specId = '$originId'";
                $result_origin = $this->db->update($query_origin);
                $query_size = "UPDATE tbl_pro_spec SET value = '$size' WHERE productId = '$id' AND specId = '$sizeId'";
                $result_size = $this->db->update($query_size);
                $query_productWeigh = "UPDATE tbl_pro_spec SET value = '$productWeight' WHERE productId = '$id' AND specId = '$productWeightId'";
                $result_productWeigh = $this->db->update($query_productWeigh);
                $query_material = "UPDATE tbl_pro_spec SET value = '$material' WHERE productId = '$id' AND specId = '$materialId'";
                $result_material = $this->db->update($query_material);
                $query_radiators = "UPDATE tbl_pro_spec SET value = '$radiators' WHERE productId = '$id' AND specId = '$radiatorsId'";
                $result_radiators = $this->db->update($query_radiators);
                $query_cpu = "UPDATE tbl_pro_spec SET value = '$cpu' WHERE productId = '$id' AND specId = '$cpuId'";
                $result_cpu = $this->db->update($query_cpu);
                $query_ram = "UPDATE tbl_pro_spec SET value = '$ram' WHERE productId = '$id' AND specId = '$ramId'";
                $result_ram = $this->db->update($query_ram);
                $query_typeOfRam = "UPDATE tbl_pro_spec SET value = '$typeOfRam' WHERE productId = '$id' AND specId = '$typeOfRamId'";
                $result_typeOfRam = $this->db->update($query_typeOfRam);
                $query_ramSpeed = "UPDATE tbl_pro_spec SET value = '$ramSpeed' WHERE productId = '$id' AND specId = '$ramSpeedId'";
                $result_ramSpeed = $this->db->update($query_ramSpeed);
                $query_numberOfRamSlot = "UPDATE tbl_pro_spec SET value = '$numberOfRamSlot' WHERE productId = '$id' AND specId = '$numberOfRamSlotId'";
                $result_numberOfRamSlot = $this->db->update($query_numberOfRamSlot);
                $query_maximumRamSupport = "UPDATE tbl_pro_spec SET value = '$maximumRamSupport' WHERE productId = '$id' AND specId = '$maximumRamSupportId'";
                $result_maximumRamSupport = $this->db->update($query_maximumRamSupport);
                $query_screenSize = "UPDATE tbl_pro_spec SET value = '$screenSize' WHERE productId = '$id' AND specId = '$screenSizeId'";
                $result_screenSize = $this->db->update($query_screenSize);
                $query_resolution = "UPDATE tbl_pro_spec SET value = '$resolution' WHERE productId = '$id' AND specId = '$resolutionId'";
                $result_resolution = $this->db->update($query_resolution);
                $query_screenRatio = "UPDATE tbl_pro_spec SET value = '$screenRatio' WHERE productId = '$id' AND specId = '$screenRatioId'";
                $result_screenRatio = $this->db->update($query_screenRatio);
                $query_onboardCard = "UPDATE tbl_pro_spec SET value = '$onboardCard' WHERE productId = '$id' AND specId = '$onboardCardId'";
                $result_onboardCard = $this->db->update($query_onboardCard);
                $query_removableCard = "UPDATE tbl_pro_spec SET value = '$removableCard' WHERE productId = '$id' AND specId = '$removableCardId'";
                $result_removableCard = $this->db->update($query_removableCard);
                $query_storage = "UPDATE tbl_pro_spec SET value = '$storage' WHERE productId = '$id' AND specId = '$storageId'";
                $result_storage = $this->db->update($query_storage);
                $query_webCommunication = "UPDATE tbl_pro_spec SET value = '$webCommunication' WHERE productId = '$id' AND specId = '$webCommunicationId'";
                $result_webCommunication = $this->db->update($query_webCommunication);
                $query_wifi = "UPDATE tbl_pro_spec SET value = '$wifi' WHERE productId = '$id' AND specId = '$wifiId'";
                $result_wifi = $this->db->update($query_wifi);
                $query_bluetooth = "UPDATE tbl_pro_spec SET value = '$bluetooth' WHERE productId = '$id' AND specId = '$bluetoothId'";
                $result_bluetooth = $this->db->update($query_bluetooth);
                $query_camera = "UPDATE tbl_pro_spec SET value = '$camera' WHERE productId = '$id' AND specId = '$cameraId'";
                $result_camera = $this->db->update($query_camera);
                $query_keyboardType = "UPDATE tbl_pro_spec SET value = '$keyboardType' WHERE productId = '$id' AND specId = '$keyboardTypeId'";
                $result_keyboardType = $this->db->update($query_keyboardType);
                $query_pin = "UPDATE tbl_pro_spec SET value = '$pin' WHERE productId = '$id' AND specId = '$pinId'";
                $result_pin = $this->db->update($query_pin);
                $query_osVersion = "UPDATE tbl_pro_spec SET value = '$osVersion' WHERE productId = '$id' AND specId = '$osVersionId'";
                $result_osVersion = $this->db->update($query_osVersion);
                $query_waterResistance = "UPDATE tbl_pro_spec SET value = '$waterResistance' WHERE productId = '$id' AND specId = '$waterResistanceId'";
                $result_waterResistance = $this->db->update($query_waterResistance);
                $query_internalMemory = "UPDATE tbl_pro_spec SET value = '$internalMemory' WHERE productId = '$id' AND specId = '$internalMemoryId'";
                $result_internalMemory = $this->db->update($query_internalMemory);
                $query_simType = "UPDATE tbl_pro_spec SET value = '$simType' WHERE productId = '$id' AND specId = '$simTypeId'";
                $result_simType = $this->db->update($query_simType);
                $query_networkSupport = "UPDATE tbl_pro_spec SET value = '$networkSupport' WHERE productId = '$id' AND specId = '$networkSupportId'";
                $result_networkSupport = $this->db->update($query_networkSupport);
                if($result && $result_origin && $result_size && $result_productWeigh && $result_material && $result_radiators && $result_cpu && $result_ram && $result_typeOfRam && $result_ramSpeed && $result_numberOfRamSlot && $result_maximumRamSupport && $result_screenSize && $result_resolution && $result_screenRatio && $result_onboardCard && $result_removableCard && $result_storage && $result_webCommunication && $result_wifi && $result_bluetooth && $result_camera && $result_keyboardType && $result_pin && $result_osVersion && $result_waterResistance && $result_internalMemory && $result_simType && $result_networkSupport){
                    $alert = "<span class='success'>Updated successfully!!!</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color: red; font-size: 18px'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

//        public function delete_product($id){
//            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
//            $result = $this->db->delete($query);
//            if($result){
//                $alert = "<span class='success'>Deleted successfully!!!</span>";
//                return $alert;
//            } else {
//                $alert = "<span class='error'>Failed!!!</span>";
//                return $alert;
//            }
//        }

        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //FRONTEND
        public function getproduct_featured(){
            $query = "SELECT * FROM tbl_product WHERE type = '1' AND status = '1' ORDER BY productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product WHERE status = '1' ORDER BY productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product_new(){
            $query = "SELECT * FROM tbl_product WHERE status = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_details($id){
            $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                where p.catId = c.catId and p.brandId = b.brandId
                and p.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product($keyword){
            $keyword = $this->fm->validation($keyword);
            $query = "SELECT * FROM tbl_product WHERE productId IN (SELECT productId FROM tbl_product
                WHERE productName LIKE '%$keyword%' AND status = 1) OR productId IN (SELECT productId FROM tbl_product
                WHERE catId = (SELECT catId FROM tbl_category WHERE catName LIKE '%$keyword%' AND status = 1))
                OR productId IN (SELECT productId FROM tbl_product
                WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE '%$keyword%' AND status = 1))
                ORDER BY productName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product_pagination($keyword,$product_start,$limit){
            $keyword = $this->fm->validation($keyword);
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_product WHERE productId IN (SELECT productId FROM tbl_product
                WHERE productName LIKE '%$keyword%' AND status = 1) OR productId IN (SELECT productId FROM tbl_product
                WHERE catId = (SELECT catId FROM tbl_category WHERE catName LIKE '%$keyword%' AND status = 1))
                OR productId IN (SELECT productId FROM tbl_product
                WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE '%$keyword%' AND status = 1))
                ORDER BY type DESC, productName ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_brand($brandId){
            $catId = mysqli_real_escape_string($this->db->link, $brandId);
            $query = "SELECT * FROM tbl_product WHERE brandId = '$brandId' AND status = 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_product_by_brand($brandId,$product_start,$limit){
            $brandId = mysqli_real_escape_string($this->db->link, $brandId);
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_product where brandId = '$brandId' AND status = 1 ORDER BY type DESC, productName ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_product_by_cat($catId,$product_start,$limit){
            $catId = mysqli_real_escape_string($this->db->link, $catId);
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_product where catId = '$catId' AND status = 1 ORDER BY type DESC, productName ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_spec($productId){
            $query = "SELECT s.name, ps.value FROM tbl_specification s, tbl_pro_spec ps WHERE s.id = ps.specId AND ps.productId = '$productId' AND ps.value NOT LIKE ''";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_value_pro_spec($productId){
            $query = "SELECT s.id, s.name, ps.value FROM tbl_specification s, tbl_pro_spec ps WHERE productId = '$productId' AND ps.specId = s.id";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_related_product($productId){
            $query = "select * from tbl_product WHERE catId = (SELECT catId FROM tbl_product WHERE productId = '$productId') OR brandId = (SELECT brandId FROM tbl_product WHERE productId = '$productId') ORDER BY type DESC, productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>