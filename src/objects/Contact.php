<?php
include 'config/database.php';

class Contact {
    private $conn;
    private $table_name = 'contacts';
    private $first_name;
    private $last_name;
    private $mobile;
    private $email;
    private $postCode;

    function __construct()
    {
	$database = new Database();
	$this->conn = $database->getConnection();
    }
    
    
    public function listAll(){
        $query = "SELECT id, first_name, last_name, mobile, email, post_code, deleted
                FROM
                    " . $this->table_name . "
		where deleted = 0
                ORDER BY
                    id";
	$stmt = $this->conn->prepare( $query );
	$stmt->execute();
	$result = $stmt->fetchAll();
 
        return $result;
    }
    
    public function getFirstName() {
	return $this->first_name;
    }
    
    public function getLastName() {
	return $this->last_name;
    }
    
    public function getEmail() {
	return $this->email;
    }
    
    public function getPostCode() {
	return $this->postCode;
    }
    
    public function getMobile() {
	return $this->mobile;
    }
    
    public function setFirstName($first_name) {
	$this->first_name = $first_name;
    }
    
    public function setLastName($last_name) {
	$this->last_name = $last_name;
    }
    
    public function setMobile($mobile) {
	$this->mobile = $mobile;
    }
    
    public function setEmail($email) {
	$this->email = $email;
    }
    public function setPostCode() {
	$this->postCode = $post_code;
    }
    
    public function listById($id) {
	$stmt = $this->conn->prepare("select * from contacts where id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$result = $stmt->fetch();
	
	return $result;
    }
    
    public function create($first_name, $last_name, $mobile, $email, $post_code) {
	//$query = 'insert into contacts `first_name`,'
	$stmt = $this->conn->prepare("insert into contacts (first_name, last_name, mobile, email, created_at, modified_at, post_code)"
		. "values (:first_name, :last_name, :mobile, :email, :created_at, :modified_at, :post_code)");
	$stmt->bindParam(':first_name', $first_name);
	$stmt->bindParam(':last_name', $last_name);
	$stmt->bindParam(':mobile', $mobile);
	$stmt->bindParam(':email', $email);
	//$stmt->bindParam(':deleted', 0);
	$stmt->bindParam(':created_at', date('Y-m-d H:i:s'));
	$stmt->bindParam(':modified_at', date('Y-m-d H:i:s'));
	$stmt->bindParam(':post_code', $post_code);
	
	if ($stmt->execute()) {
	    $id = $this->conn->lastInsertId();
	    $arr_json = ['id' => $id, 'first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'email' => $email,
	    'created_at' => date('Y-m-d H:i:s'), 'modified_at' => date('Y-m-d H:i:s'), 'post_code' => $post_code];
	    $json = json_encode($arr_json);
	    $stmt = $this->conn->prepare('update contacts set json_text = :json_data where id = :id');
	    $stmt->bindParam(':json_data', $json);
	    $stmt->bindParam(':id', $id);
	   
	   return $stmt->execute();
	} else {
	    return false;
	}
    }
    
    public function addJsonData($id) {
	if ($id) {
	   $stmt = $htis->coon->prepare('select * from contacts where id =:id');
	   
	   $arr_json = ['id' => $id, 'first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'email' => $email,
	    'created_at' => date('Y-m-d H:i:s'), 'modified_at' => date('Y-m-d H:i:s'), 'post_code' => $post_code];
	   $json = json_encode($arr_json);
	   $stmt = $this->conn->prepare('update contacts set json_text = :json_data where id = :id');
	   $stmt->bindParam(':json_data', $json);
	   $stmt->bindParam(':id', $id);
	   
	   return $stmt->execute();
	}
    }
    
    
    public function editView($id) {
	$result = $this->listById($id);
	if (count($result) > 0 ) {
	    foreach ($result as $contact) {
		$return =  '<tr>'
		. '<td>' . $contact['id'] . '</td>' 
		. '<td>' . $contact['first_name'] . '</td><td>' .
		  $contact['last_name'] . '</td><td>' . 
		  $contact['mobile'] . '</td><td>' . 
		  $contact['email'];
		$return .= '</td><td>' . $contact['post_code']. '</td>';
		$return .= '<td> <a><span name="delete-'.$contact['id'].'" data-value=" '. $contact['id'] . '"  class="glyphicon glyphicon-remove">delete</span></a>';
		$return .= ' <a href="edit-contact.php?id='.$contact['id'].'"><span name="edit-'.$contact['id'].'" data-value=" '. $contact['id'] . '"  class="glyphicon glyphicon-edit">edit</span></a></td>';
		$return .= '</tr>';
	    }
	} else {
	    $return .= '<tr><td colspan="5"> No Records</td></tr>';
	}
	return $return;
    }
    
    public function update() {
	
    }
    
    public function delete() {
	
    }
    
}
?>
