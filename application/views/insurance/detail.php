<p class="validateTips">All form fields are required.</p>
<form id="form-insurance-detail" onsubmit="return false;">
    
    <p>
    	<label>Insurance:</label>
        <input type="text" name="insurance" id="insurance-name" size="30" value="<?=@$insurance->carrier?>" />
    </p>
    
    <input type="hidden" name="id" value="<?=$id?>" />
    
</form>