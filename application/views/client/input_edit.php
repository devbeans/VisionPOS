<!-- VIEW-> client_input_edit.php  -->

<div id="client_input"><fieldset><legend>Edit Client Information</legend>
<?php	 $hidden = array('client_id' => $this->uri->segment(3));	echo form_open('main/edit_client/'. $this->uri->segment(3), '',$hidden);
  	$client = $clientdata[0];		echo '<div id="data-row1">';		echo '<label class="field1" for="firstname">First Name<br />';		$data = array(              'name'        => 'firstname',              'id'          => 'firstname',			  'maxlength'   => '30',			  'size'        => '30',			  'value'       => $client['clientfirstname']            );		echo form_input($data) .'</label>';		echo '<label class="field2" for="lastname">Last Name<br />';		$data = array(              'name'        => 'lastname',              'id'          => 'lastname',			  'maxlength'   => '30',			  'size'        => '30',			  'value'       => $client['clientlastname']            );		echo form_input($data) .'</label>';		echo '<p class="clear">&nbsp;</p>';		echo '</div>';		echo '<div id="data-row2">';		echo '<label class="field1" for="addres">Street Address<br />';		$data = array(              'name'        => 'address',              'id'          => 'address',			  'maxlength'   => '30',			  'size'        => '30',			  'value'       => $client['address']            );		echo form_input($data) .'</label>';		echo '<label class="field2" for="address2">Street Address (cont.)<br />';		$data = array(              'name'        => 'address2',              'id'          => 'address2',			  'maxlength'   => '30',			  'size'        => '30',			  'value'       => $client['address2']            );		echo form_input($data) .'</label>';		echo '<p class="clear">&nbsp;</p>';		echo '</div>';		echo '<div id="data-row3">';		echo '<label class="field1" for="city">City<br />';		$data = array(              'name'        => 'city',              'id'          => 'city',			  'maxlength'   => '30',			  'size'        => '30',			  'value'       => $client['city']            );		echo form_input($data) .'</label>';		echo '<label class="field4" for="state">State<BR>';		echo form_dropdown('state', $content_states, 'IA') . '</label>';		echo '<label class="field3" for="zip">Zip Code<br>';		$data = array(              'name'        => 'zip',              'id'          => 'zip',              'maxlength'   => '9',              'size'        => '9',			  'value'       => $client['zip']            );		echo form_input($data) .'</label>';		echo '<p class="clear">&nbsp;</p>';		echo '</div>';		echo '<div id="data-row4">';		echo '<label class="field1" for="phone">Primary Phone<br>';		$data = array(              'name'        => 'phone',              'id'          => 'phone',              'maxlength'   => '11',              'size'        => '11',			  'value'       => $client['phone']            );		echo form_input($data) .'</label>';		echo '<label class="field2" for="phone2">Mobile Phone<br>';		$data = array(              'name'        => 'phone2',              'id'          => 'phone2',              'maxlength'   => '11',              'size'        => '11',			  'value'       => $client['phone2']            );		echo form_input($data) .'</label>';		echo '<label class="field3" for="phone3">Work Phone<br>';		$data = array(              'name'        => 'phone3',              'id'          => 'phone3',              'maxlength'   => '11',              'size'        => '11',			  'value'       => $client['phone3']            );		echo form_input($data) .'</label>';		echo '<p class="clear">&nbsp;</p>';		echo '</div>';		echo '<div id="data-row5">';		echo '<label class="field1" for="email">Email Address<br>';		$data = array(              'name'        => 'email',              'id'          => 'email',              'maxlength'   => '50',              'size'        => '50',			  'value'       => $client['email']            );		echo form_input($data) .'</label>';		echo '<p class="clear">&nbsp;</p>';		echo '</div>';		echo '<div id="data-row6" >';		echo '<label class="field1" for="examtype">Exam Type<br>';		$options = array(				'undefined' => 'Undefined',              'glasses'  