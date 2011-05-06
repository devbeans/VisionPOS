<style>
#sliders {
	margin-top: 100px;
	margin-left: 150px;
}

#sliders > .hidden {
	display: none;
}

#sliders > .slider {
	float: left;
	
	margin-left: 10px;
	margin-right: 10px;
}

#sliders > .slider > label {
	display: block;
}

#sliders > #sliders-clear {
	clear: both;
}
</style>

<script type="text/javascript">
(function($){
	/**
	 * Formats the URL with the given URI
	 * @param string uri
	 * @return string
	 */
	var base_url = function(uri) {
		return "<?php echo base_url(); ?>" + uri;
	},
	
	/**
	 * Clears out dropdowns/selects
	 * @param array an array of jquery objects
	 * @return void
	 */
	clearSelects = function(selects) {
		for (var i = 0, len = selects.length; i < len; ++i) {
			selects[i].html('<option value="">- - -</option>');
		}
	},
	
	/**
	 * Fills lens type
	 * @param jQuery jquery object
	 * @return void
	 */
	fillLensType = function(lensType) {
		$.ajax({
			type: "POST",
			url: base_url("lens/types"),
			dataType: "json",
			success: function(json) {
				if (json.result && json.result.length > 0) {
					var HTML = '<option value="">- - -</option>';
					for (var i = 0, len = json.result.length; i < len; ++i) {
						HTML += '<option value="'+json.result[i].id+'">'+json.result[i].type+'</option>';
					}
					lensType.html(HTML);
				}
			}
		});
	},
	
	/**
	 * Fills Lens Brand
	 * @param jQuery jquery object
	 * @param mixed type_id
	 * @return void
	 */
	fillLensBrand = function(lensBrand, type_id) {
		$.ajax({
			type: "POST",
			url: base_url("lens/brands"),
			dataType: "json",
			data: { type_id: type_id },
			success: function(json) {
				var HTML = '<option value="">- - -</option>';
				if (json.result && json.result.length > 0) {
					for (var i = 0, len = json.result.length; i < len; ++i) {
						HTML += '<option value="'+json.result[i].id+'">'+json.result[i].brand+'</option>';
					}
				}
				lensBrand.html(HTML);
			}
		});
	},
	
	/**
	 * Fills Lens Design
	 * @param jQuery jquery object
	 * @param mixed brand_id
	 * @return void
	 */
	fillLensDesign = function(lensDesign, brand_id) {
		$.ajax({
			type: "POST",
			url: base_url("lens/designs"),
			dataType: "json",
			data: { brand_id: brand_id },
			success: function(json) {
				var HTML = '<option value="">- - -</option>';
				if (json.result && json.result.length > 0) {
					for (var i = 0, len = json.result.length; i < len; ++i) {
						HTML += '<option value="'+json.result[i].id+'">'+json.result[i].design+'</option>';
					}
				}
				lensDesign.html(HTML);
			}
		});
	},
	
	/**
	 * Fills Lens Material
	 * @param jQuery jquery object
	 * @param mixed design_id
	 * @return void
	 */
	fillLensMaterial = function(lensMaterial, design_id) {
		$.ajax({
			type: "POST",
			url: base_url("lens/materials"),
			dataType: "json",
			data: { design_id: design_id },
			success: function(json) {
				var HTML = '<option value="">- - -</option>';
				if (json.result && json.result.length > 0) {
					for (var i = 0, len = json.result.length; i < len; ++i) {
						HTML += '<option value="'+json.result[i].id+'">'+json.result[i].material+'</option>';
					}
				}
				lensMaterial.html(HTML);
			}
		});
	},
	
	/**
	 * Fills Lens Material Price
	 * @param jQuery jquery object
	 * @param mixed material_id
	 * @return void
	 */
	fillLensMaterialPrice = function(lensMaterialPrice, material_id) {
		$.ajax({
			type: "POST",
			url: base_url("lens/materials"),
			dataType: "json",
			data: { material_id: material_id },
			success: function(json) {
				var costPrice = lensMaterialPrice.children("input#lens-material-cost-price"),
					retailPrice = lensMaterialPrice.children("input#lens-material-retail-price");
				
				costPrice.val("");
				retailPrice.val("");
				
				if (json.result && json.result.length > 0) {
					costPrice.val(json.result[0].cost_price);
					retailPrice.val(json.result[0].retail_price);
				}
			}
		});
	};
	
	$(function(){
		var lensType = $("select#select-lens-type"),
			lensBrand = $("select#select-lens-brand"),
			lensDesign = $("select#select-lens-design"),
			lensMaterial = $("select#select-lens-material"),
			lensMaterialPrice = $("div#slider-lens-material-price"),
			lensMaterialPriceSave = lensMaterialPrice.children("button#price-submit");
		
		fillLensType(lensType);
		
		lensType.change(function(){
			var $this = $(this);
			if ($this.val() === "") {
				clearSelects([lensBrand, lensDesign, lensMaterial]);
			} else {
				fillLensBrand(lensBrand, $this.val());
				clearSelects([lensDesign, lensMaterial]);
			}
		});
		
		lensBrand.change(function(){
			var $this = $(this);
			if ($this.val() === "") {
				clearSelects([lensDesign, lensMaterial]);
			} else {
				fillLensDesign(lensDesign, $this.val());
				clearSelects([lensMaterial]);
			}
		});
		
		lensDesign.change(function(){
			var $this = $(this);
			if ($this.val() === "") {
				clearSelects([lensMaterial]);
			} else {
				fillLensMaterial(lensMaterial, $this.val());
			}
		});
		
		lensMaterial.change(function(){
			var $this = $(this);
			if ($this.val() === "") {
				lensMaterialPrice.addClass("hidden");
			} else {
				lensMaterialPrice.removeClass("hidden");
				fillLensMaterialPrice(lensMaterialPrice, $this.val());
			}
		});
		
		lensMaterialPriceSave.click(function(){
			var $this = $(this),
				cost_price = $this.siblings("input#lens-material-cost-price").val(),
				retail_price = $this.siblings("input#lens-material-retail-price").val(),
				material_id = lensMaterial.val();
			
			$.ajax({
				type: "POST",
				url: base_url("lens/materials"),
				data: { material_id: material_id, cost_price: cost_price, retail_price: retail_price }
			});
		});
	});
})(jQuery);
</script>

<div id="sliders">
	<div id="sliders-lens-type" class="slider">
		<label for="select-lens-type">Lens Type</label>
		<select id="select-lens-type">
			<option value="">- - -</option>
		</select>
	</div>
	<div id="sliders-lens-brand" class="slider">
		<label for="select-lens-brand">Lens Brand</label>
		<select id="select-lens-brand">
			<option value="">- - -</option>
		</select>
	</div>
	<div id="sliders-lens-design" class="slider">
		<label for="select-lens-design">Lens Design</label>
		<select id="select-lens-design">
			<option value="">- - -</option>
		</select>
	</div>
	<div id="slider-lens-material" class="slider">
		<label for="select-lens-material">Lens Material</label>
		<select id="select-lens-material">
			<option value="">- - -</option>
		</select>
	</div>
	<div id="slider-lens-material-price" class="slider hidden">
		<label for="lens-material-cost-price">Cost Price</label>
		<input id="lens-material-cost-price" type="text" />
		<label for="lens-material-retail-price">Retail Price</label>
		<input id="lens-material-retail-price" type="text" />
		<button id="price-submit">Save</button>
	</div>
	<div id="sliders-clear"></div>
</div>