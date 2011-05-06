<p class="validateTips">All form fields are required.</p>
<form id="form-lens-material-detail">
	<p>
    <label>Design: </label>
    <select name="design_id" id="design_id">
    	<option value="0">Select Design</option>
        <? foreach($designs as $design): ?>
        	<option <?=(@$lens_material->design_id == $design['id']) ? "selected" : ""  ?> value="<?=$design['id']?>"><?=$design['design']?></option>
        <? endforeach; ?>
    </select>
    </p>
    
    <p>
    	<label>Material:</label>
        <input type="text" name="material" id="material" size="30" value="<?=@$lens_material->material?>" />
    </p>
    
    <p>
    	<label>Retail Price:</label>
        <input type="text" name="retail_price" id="retail_price" size="5" value="<?=@$lens_material->retail_price?>" />
    </p>
    
    <p>
    	<label>Cost Price:</label>
        <input type="text" name="cost_price" id="cost_price" size="5" value="<?=@$lens_material->cost_price?>" />
    </p>
    <input type="hidden" name="id" value="<?=$id?>" />
    
</form>