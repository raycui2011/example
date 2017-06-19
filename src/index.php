<?php
include_once 'objects/Contact.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-contact.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
     <tr>
	<th>#</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Mobile</th>
	<th>Email</th>
	<th>Post Code</th>
	<th colspan="2" align="center">Actions</th>
     </tr>
     <?php
  $query = "SELECT * FROM contacts";
  $oContact = new Contact();
  $result = $oContact->listAll();
  //$records_per_page=3;
  //$newquery = $crud->paging($query,$records_per_page);
  //$crud->dataview($newquery);
  
  foreach ($result as $contact) {
      echo '<tr>'
	    . '<td>' . $contact['id'] . '</td>' 
	    . '<td>' . $contact['first_name'] . '</td><td>' .
	      $contact['last_name'] . '</td><td>' . 
	      $contact['mobile'] . '</td><td>' . 
	      $contact['email'];
      echo '</td><td>' . $contact['post_code']. '</td>';
      echo '<td> <a><span name="delete-'.$contact['id'].'" data-value=" '. $contact['id'] . '"  class="glyphicon glyphicon-remove">delete</span></a>';
      echo ' <a href="edit-contact.php?id='.$contact['id'].'"><span name="edit-'.$contact['id'].'" data-value=" '. $contact['id'] . '"  class="glyphicon glyphicon-edit">edit</span></a></td>';
      echo '</tr>';
  }
  ?>
    <tr>
        <td colspan="7" align="center">
    <div class="pagination-wrap">
            <?php //$crud->paginglink($query,$records_per_page); ?>
         </div>
        </td>
    </tr>
 
</table>
   
       
</div>
<script>
    jQuery( "span[name*='delete-']" ).on('click', function() {
	var id = $(this).attr('data-value');
	event.preventDefault();
	$.ajax({
	    url : '/edit-contact.php',
	    type: "POST",
	    data : {id: id, action:'delete'},
	    success: function(data, textStatus, jqXHR)
	    {
		window.location.reload()
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {

	    }
	});
    });
</script>
<?php include_once 'footer.php'; ?>