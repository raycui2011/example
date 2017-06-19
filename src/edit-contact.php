<?php
include 'objects/Contact.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'header.php';
?>
<?php
if (count($_GET) > 0) {
    $id = $_GET['id'];
    $contact = new Contact();
    $contact = $contact->listById($id);
}?>
    <div class="container">
    <h2>Edit Contact id <?php echo $id;?></h2>
    <div clas="col-md-8">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	    <table class='table table-hover table-responsive table-bordered'>

		<tr>
		    <td>First Name</td>
		    <td><input type='text' name='first_name' class='form-control' value ="<?php echo $contact['first_name'];?>"/></td>
		</tr>

		<tr>
		    <td>Last Name</td>
		    <td><input type='text' name='last_name' class='form-control' value ="<?php echo $contact['last_name'];?>"/></td>
		</tr>

		<tr>
		    <td>Mobile</td>
		    <td><input type='text' name='mobile' class='form-control' value="<?php echo $contact['mobile'];?>"/></td>
		</tr>

		<tr>
		    <td>Email</td>
		    <td>
			<input type='text' name='email' class='form-control' value="<?php echo $contact['email'];?>"/>
		    </td>
		</tr>

		<tr>
		    <td>Post Code</td>
		    <td>
			<input type='text' name='post_code' class='form-control' value="<?php echo $contact['post_code'];?>"/>
		    </td>
		</tr>

		<tr>
		    <td></td>
		    <td>
			<button type="submit" name="btn-save" class="btn btn-primary">Update</button>
		    </td>
		</tr>

	    </table>
	</form>
    </div>
</div>
<?php include 'footer.php' ?>
