<p class="validateTips">All form fields are required.</p>
<form id="form-doctor-detail">
	<p>
    <label>First Name: </label>
    <input type="text" name="firstname" id="firstname" size="30" value="<?=@$doctor->firstname?>" />
    </p>
	<p>
    <label>Last Name: </label>
    <input type="text" name="lastname" id="lastname" size="30" value="<?=@$doctor->lastname?>" />
    </p>
	<p>
    <label>Title: </label>
    <input type="text" name="title" id="title" size="30" value="<?=@$doctor->title?>" />
    </p>

	<p>
    <label>Phone: </label>
    <input type="text" name="phone" id="phone" size="30" value="<?=@$doctor->firstname?>" />
    </p>

	<p>
    <label>Email: </label>
    <input type="text" name="email" id="email" size="30" value="<?=@$doctor->firstname?>" />
    </p>

	<p>
    <label>License: </label>
    <input type="text" name="license" id="license" size="30" value="<?=@$doctor->firstname?>" />
    </p>

	<p>
    <label>License Expiry Date: </label>
    <input type="text" name="license_expiry" id="license_expiry" size="30" value="<?=@$doctor->firstname?>" />
    </p>

	<p>
    <label>Address: </label>
    <input type="text" name="address" id="address" size="30" value="<?=@$doctor->firstname?>" />
    </p>
    
    <p>
    	<label>State: </label>
        <select name="state">
        	<? foreach($states as $state): ?>
            	<option value="<?=$state?>"><?=$state?></option>
            <? endforeach; ?>
        </select>
    </p>
    
  <p>
    <label>City: </label>
    <input type="text" name="city" id="city" size="30" value="<?=@$doctor->firstname?>" />
    </p>
    
    <input type="hidden" name="id" value="<?=$id?>" />
    
</form>