<?php
include 'objects/Contact.php';
$page_title = "Create Contact";
if( !ini_get('date.timezone') )
{
    date_default_timezone_set('GMT');
}

if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $post_code = $_POST['post_code'];
    
    $contact = new Contact();
    $response = $contact->create($first_name, $last_name, $mobile, $email, $post_code);
    if ($response) {
	echo 'Success!';
    } else {
	echo 'Failed';
    }
}

?>
<?php include 'header.php' ?>
<div class="container">
    <h2><?php echo $page_title;?></h2>
    <div clas="col-md-8">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	    <table class='table table-hover table-responsive table-bordered'>

		<tr>
		    <td>First Name</td>
		    <td><input type='text' name='first_name' class='form-control' /></td>
		</tr>

		<tr>
		    <td>Last Name</td>
		    <td><input type='text' name='last_name' class='form-control' /></td>
		</tr>

		<tr>
		    <td>Mobile</td>
		    <td><input type='text' name='mobile' class='form-control' /></td>
		</tr>

		<tr>
		    <td>Email</td>
		    <td>
			<input type='text' name='email' class='form-control' />
		    </td>
		</tr>

		<tr>
		    <td>Post Code</td>
		    <td>
			<input type='text' name='post_code' class='form-control' />
		    </td>
		</tr>

		<tr>
		    <td></td>
		    <td>
			<button type="submit" name="btn-save" class="btn btn-primary">Create</button>
		    </td>
		</tr>

	    </table>
	</form>
    </div>
</div>
<?php include 'footer.php' ?>