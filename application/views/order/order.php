
<link href="../../css/my_form.css" rel="stylesheet" type="text/css" />

 <fieldset>
	<form action="#" method="post">
	<div class="order_box">

		<div class="order_title">
			<h1 id="name_form" class="name_form">PATIENT FORM</h1>
			<h2 id="form_id" class="form_id">No: 96696</h2>
			<p class="clear">&nbsp;</p>
		</div>
		<div class="subcateg_title">CONTACT INFORMATION</div>
		<div class="info_box" id="contact_box">

		  <ul class="order_nav">
			<li class="left"><label for="patient_email">Patient E-mail:</label><input type="text" id="patient_email" name="patient_email" class="field"/></li>
			<li class="right"><label for="mail_to_patient">Mail to Patient:</label><input type="text" id="mail_to_patient" name="mail_to_patient" class="field"/></li>
		  </ul>
		  <p class="clear">&nbsp;</p>
		  <ul class="order_nav" id="contact_detail">
		    <li>
				<p><label for="store" class="left">Store:</label><input type="text" id="store" name="store" class="field left"/></p>

				<p><label for="dispenser" class="left">Dispenser:</label><input type="text" id="dispenser" name="dispenser" class="field left"/></p>
				<p><label for="insurance_carrier" class="left">Insurance Carrier:</label><input type="text" id="insurance_carrier" name="insurance_carrier" class="field left"/></p>
				<p><label for="date" class="left">Date:</label><input type="text" id="date" name="date" class="field left"/></p>
			</li>
		  </ul>
		  <p class="clear">&nbsp;</p>
		</div>

		<div class="subcateg_title">PATIENT INFORMATION</div>
		<div class="info_box" id="patient_box">
			<ul class="order_nav">
				<li>
					<p><label for="last_name" class="left">Last Name:</label><input type="text" id="last_name" name="last_name" class="field left"/></p>
					<p><label for="first_name" class="left">First Name:</label><input type="text" id="first_name" name="first_name" class="field left size_field"/></p>
					<p class="clear">&nbsp;</p>

			    </li>
				<li>
					<p><label for="street" class="left">Street:</label><input type="text" id="street" name="street" class="field left"/></p>
					<p><label for="phone"  class="left">Home/Business Phone:</label><input type="text" id="phone" name="phone" class="field left size_field"/></p>
					<p class="clear">&nbsp;</p>
			    </li>
				<li >
					<p><label for="city"  class="left">City:</label><input type="text" id="city" name="city" class="field left"/></p>

					<p id="zip_code_field"><label for="zip_code" class="left">Zip Code:</label><input type="text" id="zip_code" name="zip_code" class="field left size50"/></p>
					<p id="employer_field"><label for="employer" class="left">Employer:</label><input type="text" id="employer" name="employer" class="field left"/></p>
					<p class="clear">&nbsp;</p>
			    </li>
			</ul>
			<p class="clear">&nbsp;</p>
		</div>
		<div class="subcateg_title">LENSES INFORMATION</div>

		<div class="info_box" id="lenses_box">
			<div class="left_right_lenses left">
				<div class="legend_lenses">
					<span class="elem_0">&nbsp;</span>
					<span class="elem_1">Shere*</span>
					<span class="elem_2">Cylinder</span>
					<span class="elem_3">Axis</span>

					<span class="elem_4">Addition</span>
					<p class="clear">&nbsp;</p>
				</div>
				<div class="right_lenses">
				    <span class="elem_0">RE</span>
					<span class="elem_1"><input type="text" name="right_sphere" id="right_sphere" /></span>
					<span class="elem_2"><input type="text" name="right_cylinder" id="right_cylinder" /></span>
					<span class="elem_3"><input type="text" name="right_axis" id="right_axis" /></span>

					<span class="elem_4"><input type="text" name="right_addition" id="right_addition" /></span>
					<p class="clear">&nbsp;</p>
				</div>				
				<div class="command_lenses">
					<span class="elem_0"><img src="#" alt="button"/></span>
					<span class="elem_1"><img src="#" alt="button"/></span>
					<span class="elem_2"><img src="#" alt="button"/></span>
					<span class="elem_3"><img src="#" alt="button"/></span>
					<span class="elem_4"><img src="#" alt="button"/></span>

					<p class="clear">&nbsp;</p>
				</div>
				<div class="left_lenses">
				    <span class="elem_0">LE</span>
					<span class="elem_1"><input type="text" name="left_sphere" id="left_sphere" /></span>
					<span class="elem_2"><input type="text" name="left_cylinder" id="left_cylinder" /></span>
					<span class="elem_3"><input type="text" name="left_axis" id="left_axis" /></span>
					<span class="elem_4"><input type="text" name="left_addition" id="left_addition" /></span>

					<p class="clear">&nbsp;</p>
				</div>
			</div>
			<div class="prism left">
				<label for="show_prism" >Show prims:</label><input  type="text" name="show_prism" id="show_prism" />
			</div>
			<div class="clear">&nbsp;</div>
			<div class="add_distance_lenses">

				<ul>
					<li class="add_lenses">
						<ul class="add_lenses_elem">
							<li>
								<ul class="nav_bar">
									<li>Dist. PD *</li>
									<li><input  type="text" name="RE_dist" id="RE_dist" /></li>
									<li>(RE) mm</li>

								</ul>
							</li>
							<li><span id="dist_image_lenses">&nbsp;</span></li>
							<li>
								<ul class="nav_bar">
									<li>Dist. PD *</li>
									<li><input  type="text" name="LE_dist" id="LE_dist" /></li>
									<li>(LE) mm</li>

								</ul>
							</li>
						</ul>
					</li>
					<li class="add_lenses">
						<ul class="add_lenses_elem">
							<li>
								<ul class="nav_bar">
									<li>Near PD</li>

									<li><input  type="text" name="RE_near" id="RE_near" /></li>
									<li>(RE) mm</li>
								</ul>
							</li>
							<li><span id="near_image_lenses">&nbsp;</span></li>
							<li>
								<ul class="nav_bar">
									<li>Near PD</li>

									<li><input  type="text" name="LE_near" id="LE_near" /></li>
									<li>(LE) mm</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="add_lenses">
						<ul class="add_lenses_elem">

							<li>
								<ul class="nav_bar">
									<li>Height </li>
									<li><input  type="text" name="RE_height" id="RE_height" /></li>
									<li>(RE) mm</li>
								</ul>
							</li>
							<li><span id="height_image_lenses">&nbsp;</span></li>

							<li>
								<ul class="nav_bar">
									<li>Height</li>
									<li><input  type="text" name="LE_height" id="LE_height" /></li>
									<li>(LE) mm</li>
								</ul>
							</li>
						</ul>

					</li>
				</ul>
				<p class="clear">&nbsp;</p>
			</div>
			<div class="details_lens">
				<ul>
					<li>
					    <label for="lens_size_shape">LENS SIZE AND SHAPE</label>

						<select id="lens_size_shape" name="lens_size_shape">
							<option>A</option>
							<option>B</option>
							<option>E D</option>
						</select>
					</li>
					<li>

						<label for="base_curve">BASE CURVE</label>
						<select id="base_curve" name="base_curve">
							<optgroup label="PUPILLARY DISTANCE">
								<option value="frame">FRAME</option>
								<option value="distance">DISTANCE</option>
								<option value="near">NEAR</option>
							  </optgroup>

						</select>
					</li>	
					<li>
						<label for="diagnosis_code">DIAGNOSIS CODES</label>
						<select id="diagnosis_code" name="diagnosis_code">
								<option value="3670">367.0</option>
								<option value="36720">367.20</option>
								<option value="3671">367.1</option>

								<option value="3674">367.4</option>
						</select>
					</li>
					<li>
						<span>LENS MATERIAL</span> 
						<span>(Over +/- 6.00 attach RX)</span>
						<select id="lens_material" name="lens_material">
								<option value="plastic">Plastic</option>

								<option value="poly">Poly</option>
								<option value="safety">Safety</option>
						</select>					
					</li>
				</ul>
				<p class="clear">&nbsp;</p>
			</div>
			<div class="specific_lenses">

			   <ul>
					<li>
						<span class="elem_1"><label for="bridge_size">Bridge Size</label><input type="text" name="bridge_size" id="bridge_size" /></span>
						<span class="elem_2"><label for="temple_leght">Temple Leght</label><input type="text" name="temple_leght" id="temple_leght" /></span>
						<span class="elem_3"><label for="temple_style">Temple Style</label><input type="text" name="temple_style" id="temple_style" /></span>
						<span class="elem_4"><label for="bifocal_style">Lenses Type</label><select name="bifocal_style" id="bifocal_style" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></span>

						<p class="clear">&nbsp;</p>
					</li>
					<li>
						<span class="elem_1" id="frame_label"><label for="frame_manufacturer">Frame Manufact.</label><input type="text" name="frame_manufacturer" id="frame_manufacturer" /></span>
						<span class="elem_2"><label for="frame_name">Frame Name</label><input type="text" name="frame_name" id="frame_name" /></span>
						<span class="elem_3"><label for="frame_color">Frame Color</label><input type="text" name="frame_color" id="frame_color" /></span>
						<span class="elem_4"><label for="trifocal_style">Lenses Design</label><select name="trifocal_style" id="trifocal_style" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></span>

						<p class="clear">&nbsp;</p>
					</li>
			   </ul>
			   <p class="clear">&nbsp;</p>
			</div>
			<div class="add_distance_lenses" id="ab_box_lenses">
				<ul>
					<li class="add_lenses">
						<ul class="add_lenses_elem">

							<li>
								<ul class="nav_bar">
									<li>A Box *</li>
									<li><input  type="text" name="a_box" id="a_box" /></li>
									<li>mm</li>
								</ul>
							</li>
							<li><span id="a_box_image_lenses">&nbsp;</span></li>

						</ul>
					</li>
					<li class="add_lenses">
						<ul class="add_lenses_elem">
							<li>
								<ul class="nav_bar">
									<li>B Box*</li>
									<li><input  type="text" name="b_box" id="b_box" /></li>

									<li>mm</li>
								</ul>
							</li>
							<li><span id="b_box_image_lenses">&nbsp;</span></li>
						</ul>
					</li>
					<li class="add_lenses">
						<ul class="add_lenses_elem">

							<li>
								<ul class="nav_bar">
									<li>DBL *</li>
									<li><input  type="text" name="dbl" id="dbl" /></li>
									<li>mm</li>
								</ul>
							</li>
							<li><span id="dbl_image_lenses">&nbsp;</span></li>

						</ul>
					</li>
					<li class="add_lenses">
						<ul class="add_lenses_elem">
							<li>
								<ul class="nav_bar">
									<li>ED *</li>
									<li><input  type="text" name="ed" id="ed" /></li>

									<li>mm</li>
								</ul>
							</li>
							<li><span id="ed_image_lenses">&nbsp;</span></li>
						</ul>
					</li>
				</ul>
				<p class="clear">&nbsp;</p>

			</div>
		</div>
		<div class="info_box" id="treatment_box">
			<label for="special_instruction">Special Instruction</label><input type="text" class="field " name="special_instruction" id="special_instruction" /><label for="lenses_treatment" >Lenses Treatment</label><select name="lenses_treatment" id="lenses_treatment" ><option value="elem1">ROOL & POLIS</option><option value="elem2">LENSGUARD</option><option value="elem3">UV400</option><option value="elem1">TINT</option><option value="elem1">AR  COATING</option></select>
		</div>

		<div class="subcateg_title">INVOICE</div>
		<div class="info_box" id="invoice_box">
			<ul>
				<li><label for="referring_dr">REFERRING DR.</label><select name="referring_dr" id="referring_dr" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></li>
				<li><label for="rx_expiration">RX. EXPIRATION</label><select name="rx_expiration" id="rx_expiration" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></li>

				<li><label for="date_filed">DATE FILED</label><input type="text" name="date_filed" id="date_filed" /></li>
				<li><label for="authorization">AUTHORIZATION</label><input type="text" name="authorization" id="authorization" /></li>
				<li><label for="invoice_form_id">ID#</label><input type="text" name="invoice_form_id" id="invoice_form_id" /></li>
				<li><label for="dob">D.O.B</label><input type="text" name="dob" id="dob" /></li>
				<li><label for="delivered_by">Delivered By</label><input type="text" name="delivered_by" id="delivered_by" /></li>
				<li><label for="form_date">Date</label><input type="text" name="form_date" id="form_date" /></li>

			</ul>
			<ul>
				<li><label for="drop_lenses">LENSES</label><select name="drop_lenses" id="drop_lenses" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></li>
				<li><label for="drop_frames">FRAMES</label><select name="drop_frames" id="drop_frames" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></li>
				<li><label for="drop_lens_coating">LENS COATING</label><select name="drop_lens_coating" id="drop_lens_coating" ><option value="elem1">Elem 1</option><option value="elem2">Elem 2</option><option value="elem3">Elem 3</option></select></li>

				<li><label for="drop_other">OTHER</label><input type="text" name="drop_other" id="drop_other" /></li>
				<li><label for="drop_subtotal">SUBTOTAL</label><input type="text" name="drop_subtotal" id="drop_subtotal" /></li>
				<li><label for="drop_discount">DISCOUNT</label><input type="text" name="drop_discount" id="drop_discount" /></li>
				<li><label for="drop_total">TOTAL</label><input type="text" name="drop_total" id="drop_total" /></li>
				<li><label for="drop_tax">TAX</label><input type="text" name="drop_tax" id="drop_tax" /></li>
				<li><label for="drop_deposit">DEPOSIT</label><input type="text" name="drop_deposit" id="drop_deposit" /></li>

				
			</ul>
			<div class="clear">&nbsp;</div>
		</div>
		<div id="total_invoice">
			<p><label for="balance_due">BALANCE DUE</label><input type="text" name="balance_due" id="balance_due" /></p>
			<p><label for="date_now">Date</label><input type="text" name="date_now" id="date_now" /></p>				
		</div>
		<input type="submit"  name="submit" value="Submit" />

	</div>
	</form>
   </fieldset>


