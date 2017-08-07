
<?php
require_once(__DIR__.'/Database.php');
require_once(__DIR__.'/MailSpool.php');
require_once(__DIR__.'/../config.php');

class WEDDIS
{
  protected $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
  }
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

    public function getCatId($name){
        try{
            $stmt = $this->conn->prepare("
            SELECT category_id 
            FROM w_categories
            WHERE category_name = :category_name");
            $stmt->execute(array(':category_name' => $name));
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            $cat_id = $result[0]["category_id"];
            return $cat_id;
        } catch (Exception $e){
            echo 'Message: ' .$e->getMessage();
        }
    }
    
   public function getRecoCatName($cat_id){
    $stmt = $this->conn->prepare("SELECT category_name 
    FROM w_reco_cat
    WHERE category_id = :cat_id;");
    $stmt->execute(array(':cat_id' => $cat_id));
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result[0];
  }
    
  public function getRecoCatergories(){
    $stmt = $this->conn->prepare("SELECT * FROM w_reco_cat;");
    $stmt->execute();
    $result = $stmt->fetchall(PDO::FETCH_OBJ);
    return $result;
  }
  
    
  public function getRecoCatSuppliers($cat_id){
    $stmt = $this->conn->prepare("SELECT * FROM w_reco_suppliers
    WHERE category_id = :cat_id;");
    $stmt->execute(array(':cat_id' => $cat_id));
    $result = $stmt->fetchall(PDO::FETCH_OBJ);
    return $result;
  }
    
  public function getSuppliers(){
    $stmt = $this->conn->prepare("SELECT * FROM w_suppliers;");
    $stmt->execute();
    $result = $stmt->fetchall(PDO::FETCH_OBJ);
    return $result;
  }
    
    
    public function getSupplier($supplier_id){
        $stmt = $this->conn->prepare("SELECT * FROM w_suppliers where supplier_id=:supplier_id");
        $stmt->execute(array(':supplier_id' => $supplier_id));
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result[0];
    }
    
        
    public function getRecoSupplier($supplier_id){
        $stmt = $this->conn->prepare("SELECT * FROM w_reco_suppliers where supplier_id=:supplier_id");
        $stmt->execute(array(':supplier_id' => $supplier_id));
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result[0];
    }
    
//    present category suppliers random based on business logic 
    public function getRandCategorySuppliers($cat_id){
        $stmt = $this->conn->prepare("
        SELECT * FROM w_suppliers
        WHERE category_id = :cat_id
        ORDER BY RAND()
        LIMIT 8
        ");
        $stmt->execute(array(':cat_id' => $cat_id));
        $result = $stmt->fetchall(PDO::FETCH_OBJ);
        return $result;
    }
    
    //improve to query oall idsnce for  - get_wishlist.php

    public function getSupplierImage($id){
        $stmt = $this->conn->prepare("SELECT profile_pic FROM w_suppliers where supplier_id=:supplier_id");
        $stmt->execute(array(':supplier_id' => $id));
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        if(isset($result[0]['profile_pic'])){
        return $result[0]['profile_pic'];
        } else{
            return 0;
        }
    }
    
    public function submitEvent($name, $phone, $email, $date, $message, $suppliers){
        $status = 0;
        try
		{
        $stmt = $this->conn->prepare("INSERT INTO w_events (
            `event_id` ,
            `event_date` ,
            `event_desc` ,
            `contact_name` ,
            `contact_phone` ,
            `contact_mail` ,
            `message`,
            `suppliers`,
            `status`,
            `submission_date`
            )
            VALUES (NULL ,  :event_date, NULL, :contact_name, :contact_phone, :contact_mail, :message , :suppliers, :status, CURRENT_TIMESTAMP);");
        
            $stmt->bindparam(":event_date", $date);
			$stmt->bindparam(":contact_name", $name);
			$stmt->bindparam(":contact_phone", $phone);
			$stmt->bindparam(":contact_mail", $email);
			$stmt->bindparam(":message", $message);
			$stmt->bindparam(":suppliers", $suppliers);
			$stmt->bindparam(":status", $status);
			$stmt->execute();
            
//            MailSpool::addMail('Hello', $email, 'Hello from the spool');
//            register_shutdown_function('MailSpool::send');
//            exit();
			return $stmt;
        }
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
        
    }
    
    public function getSupplierAlbums($supplier_id){
            $stmt = $this->conn->prepare("SELECT * FROM w_albums WHERE supplier_id = :supplier_id;");
            $stmt->execute(array(':supplier_id' => $supplier_id));
            $result = $stmt->fetchall(PDO::FETCH_OBJ);
            return $result;
    }
    
    public function getTestimonials($supplier_id){
            $stmt = $this->conn->prepare("SELECT * FROM w_testimonials WHERE supplier_id = :supplier_id;");
            $stmt->execute(array(':supplier_id' => $supplier_id));
            $result = $stmt->fetchall(PDO::FETCH_OBJ);
            return $result;
    }
    
    public function sendMail($name, $phone, $email, $date, $message, $suppliers){
        $to = $email;
        $subject = "ברוכים הבאים ל - weddis!";

        $msg = '
    <html>
    <head>
        <title>Welcome to CodexWorld</title>
    </head>
    <body>
        <h1>Thanks you for joining with us!</h1>
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
            <tr>
                <th>Name:</th><td>CodexWorld</td>
            </tr>
            <tr style="background-color: #e0e0e0;">
                <th>Email:</th><td>contact@codexworld.com</td>
            </tr>
            <tr>
                <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td>
            </tr>
        </table>
    </body>
    </html>';

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <contact@weddis.com>' . "\r\n";
        $headers .= 'Cc: al@opiiweb.com' . "\r\n";

        mail($to,$subject,$msg,$headers);
    }
}
