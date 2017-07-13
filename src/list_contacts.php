<?php
require_once 'objects/Contact.php';
$contact = new Contact();
$contacts = $contact->listAll();
echo $contacts;