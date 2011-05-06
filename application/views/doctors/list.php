
    
    <br style="clear:both" />
    <br/>
&nbsp;

<div  style="width:80%; margin:auto">

<button id="create-doctor">Add Doctor</button>
<table width="100%" border="0 align="center"" id="tbl_doctors" class="blue-table-b">
	<thead>
    	<tr>
            <th align="left">ID</th>
            <th align="left">Last Name</th>
            <th align="left">First Name</th>
            <th align="left">Email</th>
            <th align="left">Address</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
    
    	<? foreach($doctors->result() as $doctor): ?>
    	<tr>
            <td><a href="#" class="a-doctor tooltip" title="Edit" id="<?=$doctor->doctor_id?>"><?=$doctor->doctor_id?></a></td>
            <td><?=$doctor->lastname?></td>
            <td><?=$doctor->firstname?></td>
            <td><?=$doctor->email?></td>
            <td><?=$doctor->address?></td>
            <td> <a href="#" rel="<?=$doctor->doctor_id?>" doctor_name="<?=$doctor->lastname?>, <?=$doctor->firstname?>" class="a-delete-doctor tooltip" title="Delete Doctor"><img src="<?=site_url("images/icons/delete.png")?>"  /></a> </td>
        </tr>
        <? endforeach; ?>
    </tbody>
</table>
<div align="right">
	<select id="select-per-page-inventory">
	<? for ($val = 5; $val<=50; $val+=5): ?>
    	<option value="<?=$val?>" <?=($val == $this->session->userdata("pagination_per_page")) ? "checked" : ""?>><?=$val?></option>
    <? endfor;?>
    </select>
	<?=$pages?>
    
</div>
</div>


