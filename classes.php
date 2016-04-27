<?php
    class Image {
        public $image_id;
        public $name;
        public $date;
        public $uid;
        public $file_type;
        public $tags;

        function validateImage($fileArray) {
            $errors= array();
            $file_name =  $fileArray['name'];
            $file_size = $fileArray['size'];
            $file_tmp = $fileArray['tmp_name'];
            $file_type = $fileArray['type'];
            $file_ext = strtolower(end(explode('.',$fileArray['name'])));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }

            return $errors;
        }

        function create($fileArray) {
            global $db;
            $errors = $this->validateImage($fileArray);
            if(sizeof($errors) > 0) return $errors;
            $this->file_type = strtolower(end(explode('.',$fileArray['name'])));
            $this->date = date('Y-m-d');

            $query = "INSERT INTO `images_table` (`name`,`date`,`uid`,`file_type`) VALUES ('".$this->name."','".$this->date."','".$this->uid."','".$this->file_type."')";
            $db->query($query);

            $this->image_id = $db->insert_id;

            $filename = $this->image_id.'.'.$this->file_type;
            move_uploaded_file($fileArray['tmp_name'],'images/'.$filename);

            return true;
        }


        function getURL() {
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

            return "http://$host$uri/images/$this->image_id.$this->file_type";
        }

        function get() {
            global $db;
            if(!is_int($this->image_id)) throw new Exception('Image must be initialized with an image');
            $query = "SELECT * FROM `images_table` WHERE `image_ID`=".$this->image_id;
            $result = $db->query($query);
            $result = $result->fetch_assoc();
            $this->name = $result['name'];
            $this->date = $result['date'];
            $this->uid = $result['uid'];
            $this->file_type = $result['file_type'];
            $this->tags = Tag::getImageTags($this->image_id);
        }

        function addTag($category) {
            $tag = new Tag();
            $tag->image_id = $this->image_id;
            $tag->category = $category;
            $tag->create();
        }


    }

class Tag {
    public $image_id;
    public $category;

    function create() {
        global $db;
        $query = "INSERT INTO `tags_table` (`image_ID`,`category`) VALUES ('".$this->image_id."','".$this->category."')";
        $db->query($query);
    }

    static function getImageTags($image_id) {
        global $db;
        $query = "SELECT `category` FROM `tags_table` WHERE `image_ID`=".$image_id;
        $result = $db->query($query);
        $result = $result->fetch_all();
        $return = array();
        foreach($result as $tag) {
            $return[] = $tag[0];
        }
        return $return;
    }
}
?>