    <br style="clear:both" />
    <br/>
&nbsp;

<div  style="width:80%; margin:auto">

<button id="create-insurance">Add Insurance</button>
<table id="tbl_insurance" width="100%" border="0" align="center" class="blue-table-b">
	<thead>
    	<tr>
            <th align="left">Insurance</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
    
    	<? foreach($insurance->result() as $i): ?>
    	<tr>
        	<td><a href="#" class="a-insurance" id="<?=$i->id?>"><?=$i->carrier?></a></td>
            <td> <a href="#" rel="<?=$i->id?>" insurance_name="<?=$i->carrier?>" class="a-delete-insurance tooltip" title="Delete Insurance"><img src="<?=site_url("images/icons/delete.png")?>"  /></a> </td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
	<div style="margin-left:40px">
	Results Per Page: 
	<select id="select-per-page-inventory">
	<? for ($val = 5; $val<=50; $val+=5): ?>
    	<option value="<?=$val?>" <?=($val == $this->session->userdata("pagination_per_page")) ? "selected" : ""?>><?=$val?></option>
    <? endfor;?>
    </select>
    </div>
<?=$pages?>
</div>

