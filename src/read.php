<?php 
require_once 'objects/Contact.php';
$responese = '<table class="table table-bordered table-responsive">
    <tr>
       <th>#</th>
       <th>First Name</th>
       <th>Last Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Post Code</th>
       <th colspan="2" align="center">Actions</th>
    </tr>';
   
   $oContact = new Contact();
   $result = $oContact->listAll();
   if (count($result) > 0 ) {
	foreach ($result as $contact) {
	    $responese .= '<tr>'
		    . '<td>' . $contact['id'] . '</td>' 
		    . '<td>' . $contact['first_name'] . '</td><td>' .
		      $contact['last_name'] . '</td><td>' . 
		      $contact['mobile'] . '</td><td>' . 
		      $contact['email'];
	      $responese .= '</td><td>' . $contact['post_code']. '</td>';
	      $responese .= '<td> <a><span name="delete-'.$contact['id'].'" data-value="'. $contact['id'] . '"  class="glyphicon glyphicon-remove">delete</span></a>';
	      $responese .= ' <a href="edit-contact.php?id='.$contact['id'].'"><span name="edit-'.$contact['id'].'" data-value=" '. $contact['id'] . '"  class="glyphicon glyphicon-edit">edit</span></a></td>';
	      $responese .= '</tr>';
	}
   } else {
      $responese .= '<tr><td colspn="8">No Contacts</td></tr>';
   }

$responese .='</table>';
echo $responese; exit;?>
