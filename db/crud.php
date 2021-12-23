<?php 
    class crud{
        // private database object
        private $db;
        
        /*constructor to initialize private variable to the database connection*/
        function __construct($conn){
            $this->db = $conn;
        }
        
        /* function to insert a new record into the attendee database*/
        public function insertFans($fname, $lname, $dob, $email,$contact,$gender,$avatar_path){
            try {
                // define sql statement to be executed
                $sql = "INSERT INTO fans (firstname,lastname,dateofbirth,emailaddress,contactnumber,gender_id,avatar_path) VALUES (:fname,:lname,:dob,:email,:contact,:gender,:avatar_path)";
                //prepare the sql statement for execution
                $stmt = $this->db->prepare($sql);
                // bind all placeholders to the actual values
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':gender',$gender);
                $stmt->bindparam(':avatar_path',$avatar_path);

                // execute statement
                $stmt->execute();
                return true;
        
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function editFans($id,$fname, $lname, $dob, $email,$contact, $gender){
           try{ 
                $sql = "UPDATE `fans` SET `firstname`=:fname,`lastname`=:lname,`dateofbirth`=:dob,`emailaddress`=:email,`contactnumber`=:contact,`gender`=:gender WHERE fan_id = :id ";
                $stmt = $this->db->prepare($sql);
                // bind all placeholders to the actual values
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':gender',$gender);

                // execute statement
                $stmt->execute();
                return true;
           }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
           }
            
        }

        public function getFans(){
            try{
                $sql = "SELECT * FROM `fans` a inner join genders b on a.gender_id = b.gender_id";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
           }
           
        }

        public function getFanDetails($id){
           try{
                $sql = "select * from `fans` a inner join genders b on a.gender_id = b.gender_id 
                where fan_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
           }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function deleteFan($id){
           try{
                $sql = "delete from fans where fan_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                return true;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getGenders(){
            try{
                $sql = "SELECT * FROM `genders`";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

        public function getGenderById($id){
            try{
                $sql = "SELECT * FROM `genders` where gender_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }


        

    }
?>