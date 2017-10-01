<?php
require_once(__DIR__.'/Database.php');
require_once(__DIR__.'/../config.php');

class ADMIN
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

	public function doLogin($user_name,$pass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM w_admins WHERE user_name=:user_name  ");
			$stmt->execute(array(':user_name'=>$user_name));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($pass, $userRow['pass']))
				{
					$_SESSION['user_session'] = $userRow['admin_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

    public function is_loggedin()
  {
    if(isset($_SESSION['user_session']))
    {
      return true;
    }
  }
  public function redirect($url)
  {
    header("Location: $url");
  }
  public function doLogout()
  {
    session_destroy();
    unset($_SESSION['user_session']);
    return true;
  }

public function getCategoryName($cat_id){
  $stmt = $this->conn->prepare(" SELECT category_name FROM w_categories WHERE category_id = :cat_id");
  $stmt->execute(array(':cat_id' => $cat_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result[0];
}

public function getRecoCategoryName($cat_id){
  $stmt = $this->conn->prepare(" SELECT category_name FROM w_reco_cat WHERE category_id = :cat_id");
  $stmt->execute(array(':cat_id' => $cat_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result[0];
}
public function getSupplier($supplier_id){
  $stmt = $this->conn->prepare(" SELECT * FROM w_suppliers WHERE supplier_id = :supplier_id");
  $stmt->execute(array(':supplier_id' => $supplier_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result[0];
}

public function deleteSupplier($supplier_id){
  $stmt = $this->conn->prepare(" DELETE FROM w_suppliers WHERE supplier_id = :supplier_id");
  $stmt->execute(array(':supplier_id' => $supplier_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result[0];
}

public function updateSupplier($supplier){
    $stmt = $this->conn->prepare("UPDATE w_suppliers SET
    first_name = :first_name,
    last_name = :last_name,
    email = :email,
    phone = :phone,
    address = :address,
    rank = :rank,
    location = :location,
    price = :price,
    `desc` = :description
    WHERE supplier_id = :supplier_id;");
    $stmt->bindparam(":first_name", $supplier['first_name']);
    $stmt->bindparam(":last_name", $supplier['last_name']);
    $stmt->bindparam(":email", $supplier['email']);
    $stmt->bindparam(":phone", $supplier['phone']);
    $stmt->bindparam(":address", $supplier['address']);
    $stmt->bindparam(":rank", $supplier['rank']);
    $stmt->bindparam(":location", $supplier['location']);
    $stmt->bindparam(":price", $supplier['price']);
    $stmt->bindparam(":description", $supplier['description']);
    $stmt->bindparam(":supplier_id", $supplier['supplier_id']);
    try{
       $stmt->execute();
    return $stmt; 
    } catch (PDOException $e){
            echo $e->getMessage();
            return $stmt;
      }
    }
   
   

public function getRecoSupplier($supplier_id){
  $stmt = $this->conn->prepare(" SELECT * FROM w_reco_suppliers WHERE supplier_id = :supplier_id");
  $stmt->execute(array(':supplier_id' => $supplier_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result[0];
}
  public function getAllSuppliers()
{
  $stmt = $this->conn->prepare(" SELECT DISTINCT w_suppliers.*, w_categories.category_name  
  FROM w_suppliers
  INNER JOIN w_categories 
  ON w_suppliers.category_id = w_categories.category_id");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}


  public function getRecoSuppliers()
{
  $stmt = $this->conn->prepare(" SELECT DISTINCT w_reco_suppliers.*, w_reco_cat.category_name  
  FROM w_reco_suppliers
  INNER JOIN w_reco_cat 
  ON w_reco_suppliers.category_id = w_reco_cat.category_id");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}
      public function getRecoCategories()
{
  $stmt = $this->conn->prepare("SELECT * FROM w_reco_cat");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}


  public function getAllEvents()
{
  $stmt = $this->conn->prepare(" 
  SELECT * FROM w_events
  ORDER BY submission_date DESC
  ");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}

public function getEvent($event_id){
  $stmt = $this->conn->prepare(" SELECT * FROM w_events WHERE event_id = :event_id");
  $stmt->execute(array(':event_id' => $event_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result[0];
}

public function getEventSuppliers($suppliers_ids){
//  $ids = implode(',', $suppliers_ids);
  $stmt = $this->conn->prepare(" SELECT * FROM w_suppliers WHERE find_in_set(cast(supplier_id as char), :suppliers_ids)");
  $stmt->execute(array(':suppliers_ids' => $suppliers_ids));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}

public function getCategories(){
  $stmt = $this->conn->prepare(" SELECT * FROM w_categories");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}

public function getLocations(){
    $locations = [
        'צפון',
        'דרום',
        'מרכז'
    ];

    return $locations;
}

public function updateEventStatus($event_id, $new_status){

    $stmt = $this->conn->prepare("UPDATE w_events SET status = :new_status WHERE event_id = :event_id;");
    $stmt->bindparam(":event_id", $event_id);
    $stmt->bindparam(":new_status", $new_status);
    $stmt->execute();
    return $stmt;
}

public function getEventStatusList(){
  $stmt = $this->conn->prepare(" SELECT * FROM w_event_status");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);

    return $result;
}

public function getEventStatus($event_id){
  $stmt = $this->conn->prepare(" SELECT status FROM w_events WHERE event_id = :event_id");
  $stmt->execute(array(':event_id' => $event_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);

  $status_arr = $this->getEventStatusList();

  return $result[0]['status'];
}

public function registerSupplier($file_name, $first_name, $last_name, $email, $phone, $address, $rank, $category_id, $location, $price, $video, $reco, $desc){
  try{


    $stmt = $this->conn->prepare("INSERT INTO  w_suppliers (
      `supplier_id` ,
      `first_name` ,
      `last_name` ,
      `email` ,
      `phone` ,
      `address` ,
      `rank` ,
      `category_id` ,
      `location` ,
      `price` ,
      `last_update` ,
      `profile_pic` ,
      `video_link` ,
      `reco` ,
      `desc` ,
      `joining_date`
      )
      VALUES (
        NULL, :first_name, :last_name, :email, :phone, :address, :rank, :category_id, :location, :price, NULL, :profile_pic, :video_link ,:reco, :desc, CURRENT_TIMESTAMP
      );");

      $stmt->bindparam(":first_name", $first_name);
        $stmt->bindparam(":last_name", $last_name);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":phone", $phone);
        $stmt->bindparam(":address", $address);
        $stmt->bindparam(":rank", $rank);
      $stmt->bindparam(":category_id", $category_id);
      $stmt->bindparam(":location", $location);
      $stmt->bindparam(":price", $price);
      $stmt->bindparam(":profile_pic", $profile_pic);
      $stmt->bindparam(":video_link", $video);
      $stmt->bindparam(":reco", $reco);
      $stmt->bindparam(":desc", $desc);
			$stmt->execute();

			return $stmt;
    }catch (PDOException $e){
      echo $e->getMessage();
    }
}

    public function registerRecoSupplier($file_name, $first_name, $last_name, $email, $phone, $address, $rank, $category_id, $location, $price, $video, $reco, $desc){
  try{


    $stmt = $this->conn->prepare("INSERT INTO  w_reco_suppliers (
      `supplier_id` ,
      `first_name` ,
      `last_name` ,
      `email` ,
      `phone` ,
      `address` ,
      `rank` ,
      `category_id` ,
      `location` ,
      `price` ,
      `last_update` ,
      `profile_pic` ,
      `video_link` ,
      `reco` ,
      `desc` ,
      `joining_date`
      )
      VALUES (
        NULL, :first_name, :last_name, :email, :phone, :address, :rank, :category_id, :location, :price, NULL, :profile_pic, :video_link ,:reco, :desc, CURRENT_TIMESTAMP
      );");

      $stmt->bindparam(":first_name", $first_name);
        $stmt->bindparam(":last_name", $last_name);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":phone", $phone);
        $stmt->bindparam(":address", $address);
        $stmt->bindparam(":rank", $rank);
      $stmt->bindparam(":category_id", $category_id);
      $stmt->bindparam(":location", $location);
      $stmt->bindparam(":price", $price);
      $stmt->bindparam(":profile_pic", $profile_pic);
      $stmt->bindparam(":video_link", $video);
      $stmt->bindparam(":reco", $reco);
      $stmt->bindparam(":desc", $desc);
			$stmt->execute();

			return $stmt;
    }catch (PDOException $e){
      echo $e->getMessage();
    }
}

public function saveAlbumRecord($album_name, $supplier_id){
    try{
    $stmt = $this->conn->prepare("INSERT INTO w_albums (
        `album_id` ,
        `supplier_id` ,
        `album_name`,
        `submit_date`
      )
      VALUES (
        NULL ,  :supplier_id,  :album_name, CURRENT_TIMESTAMP
      );");

      $stmt->bindparam(":supplier_id", $supplier_id);
      $stmt->bindparam(":album_name", $album_name);
      $stmt->execute();
      return $this->conn->lastInsertId();

        }catch (PDOException $e){
            echo $e->getMessage();
     }
}

public function getAllAlbums(){
  $stmt = $this->conn->prepare(" SELECT * FROM w_albums");
  $stmt->execute();
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;

}

public function getSupplierAlbums($supplier_id){
  $stmt = $this->conn->prepare(" SELECT * FROM w_albums WHERE supplier_id = :supplier_id");
  $stmt->execute(array(':supplier_id' => $supplier_id));
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
}

public function saveTestimonial($supplier_id, $the_couple, $event_date, $reco_text){
  try{
  $stmt = $this->conn->prepare("INSERT INTO  w_testimonials (
      `testimonial_id`,
      `supplier_id` ,
      `text` ,
      `submit_date` ,
      `event_date`, 
      `testimonial_name` 
      )
      VALUES (
        NULL, :supplier_id, :reco_text, CURRENT_TIMESTAMP, :event_date, :the_couple);");

      $stmt->bindparam(":supplier_id", $supplier_id);
      $stmt->bindparam(":reco_text", $reco_text);
      $stmt->bindparam(":event_date", $event_date);
      $stmt->bindparam(":the_couple", $the_couple);
			$stmt->execute();

			return $stmt;
    }catch (PDOException $e){
      echo $e->getMessage();
    }
}

//End of Admin Class
}
