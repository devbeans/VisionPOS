<html><head>
		<link href="../../css/default.css" rel="stylesheet" media="screen" type="text/css" >
		
	<style type="text/css" media="screen" >
body {
	font-family:helvetica;
}

#navigation {
	list-style-type:none;
	list-style-position:initial;
	list-style-image:initial;
}

#navigation li {
	float:left;
}

#navigation a * {
	display:none;
}

#navigation a, #navigation a .hover {
	height:70px;
	position:relative;
	display:block;
	background-image:url(ExampleResources/FadingNavigation/dragon%2dsprite.jpg);
	background-repeat-x:no-repeat;
	background-repeat-y:no-repeat;
	background-repeat:no-repeat;
	background-attachment:initial;
	background-position:0px 0px;
	background-position-x:0px;
	background-position-y:0px;
	background-origin:initial;
	background-clip:initial;
	background-color:#000000;
}

#navigation a.home {
	background-position:0px 0px;
	background-position-x:0px;
	background-position-y:0px;
	width:102px;
}

#navigation .highlight a.home:hover, #navigation a.home .hover {
	background-position:0px -280px;
	background-position-x:0px;
	background-position-y:-280px;
	width:102px;
}

#navigation a.services {
	background-position:-102px -140px;
	background-position-x:-102px;
	background-position-y:-140px;
	width:115px;
}

#navigation .highlight a.services:hover, #navigation a.services .hover {
	background-position:-102px -280px;
	background-position-x:-102px;
	background-position-y:-280px;
}

#navigation a.portfolio {
	background-position:-217px 0px;
	background-position-x:-217px;
	background-position-y:0px;
	width:120px;
}

#navigation .highlight a.portfolio:hover, #navigation a.portfolio .hover {
	background-position:-218px -280px;
	background-position-x:-218px;
	background-position-y:-280px;
}

#navigation a.about {
	background-position:-337px 0px;
	background-position-x:-337px;
	background-position-y:0px;
	width:100px;
}

#navigation .highlight a.about:hover, #navigation a.about .hover {
	background-position:-339px -280px;
	background-position-x:-339px;
	background-position-y:-280px;
}

#navigation a.contact {
	background-position:-437px 0px;
	background-position-x:-437px;
	background-position-y:0px;
	width:115px;
}

#navigation .highlight a.contact:hover, #navigation a.contact .hover {
	background-position:-440px -280px;
	background-position-x:-440px;
	background-position-y:-280px;
}

</style><script src="../../Libraries/jquery-1.4.2.min.js" type="text/javascript" ></script>
<script type="text/javascript" charset="utf-8" >
    $(function () {
        if ($.browser.msie && $.browser.version < 7) return;
        
        $('#navigation li')
            .removeClass('highlight')
            .find('a')
            .append('<span class="hover" />').each(function () {
                    var $span = $('> span.hover', this).css('opacity', 0);
                    $(this).hover(function () {
                        // on hover
                        $span.stop().fadeTo(500, 1);
                    }, function () {
                        // off hover
                        $span.stop().fadeTo(500, 0);
                    });
                });
                
    });
</script>
</head><body style="left:20px; top:-32px; " onclick="(new Fx.Tween('temple_styles', {duration: 1000, })).start('background-color','#00ff00');" >
		<div id="edit_order" style="position:absolute; left:71px; top:128px; width:740px; height:448px; " >
			<fieldset>
				<legend>
New Order				</legend>

		<? echo  form_open('invoice/edit_order'); ?>	

	<div id="carriers" style="position:absolute; left:151px; top:25px; " >
		<? echo  '<label class="field4" for="carrier">Insurance Carrier<BR>'; ?>
		<? echo  form_dropdown('carriers', $list_carriers ) . '</label>'; ?>
	</div>
	
	<div id="bridges" style="position:absolute; left:232px; top:27px; width:198px; height:22px; " >
		<? echo  '<label class="field4" for="bridge">Bridges<BR>'; ?>
		<? echo  form_dropdown('bridge', $list_bridges ) . '</label>'; ?>				
	<?php echo "Hello World!";?></div>
	
	<div id="discounts" style="position:relative; width:120px; height:24px; left:11px; top:23px; " >
		<? echo  '<label class="field4" for="discount">discount<BR>'; ?>
		<? echo  form_dropdown('discount', $list_discounts ) . '</label>'; ?>				
	</div>
		
	<div id="frame_divisions" style="position:relative; left:44px; top:44px; " >
		<? echo  '<label class="field4" for="frame_division">Frame Divisions<BR>'; ?>
		<? echo  form_dropdown('division', $frame_divisions ) . '</label>'; ?>
	</div>
		
	<div id="invoice_status" style="position:relative; left:44px; top:67px; " >
		<? echo  '<label class="field4" for="inv_status">Invoice Status<BR>'; ?>
		<? echo  form_dropdown('status', $list_invoice_status ) . '</label>'; ?>
	</div>
		
		
	<div id="order_type" style="position:relative; height:20px; width:260px; left:389px; top:120px; " >
		<? echo  '<label class="field4" for="order_type">Order Type<BR>'; ?>
		<? echo  form_dropdown('order_type', $list_order_type ) . '</label>'; ?>
	</div>
		
	<div id="lens_coating" style="position:absolute; left:47px; top:112px; " >
		<? echo  '<label class="field4" for="coating">Lens Coating<BR>'; ?>
		<? echo  form_dropdown('coating', $list_lens_coatings ) . '</label>'; ?>
	</div>
	
	<div id="lens_color" style="position:absolute; left:47px; top:135px; " >
		<? echo  '<label class="field4" for="color">Lens Color<BR>'; ?>
		<? echo  form_dropdown('color', $list_lens_colors ) . '</label>'; ?>
	</div>
	
	<div id="lens_material" style="position:absolute; width:249px; height:141px; left:138px; top:211px; " onfocus="alert('hello world!');" onload="alert('hello world!');" >	
		<? echo  '<label class="field4" for="material">Lens Material<BR>'; ?>
		<? echo  form_dropdown('material', $list_lens_materials ) . '</label>'; ?>
	<big></big>this is a test. &nbsp;Does it work?<br></div>
	
	<div id="lens_near_l" style="position:absolute; left:45px; top:182px; " >	
		<? echo  '<label class="field4" for="pd">Near L<BR>'; ?>
		<? echo  form_dropdown('pd', $list_lens_pd ) . '</label>'; ?>
	</div>
	
	<div id="lens_near_r" style="position:absolute; left:47px; top:206px; " >		
		<? echo  '<label class="field4" for="pd">Near R<BR>'; ?>
		<? echo  form_dropdown('pd', $list_lens_pd ) . '</label>'; ?>
	</div>
			
	<div id="lens_far_l" style="position:absolute; left:46px; top:230px; " >
		<? echo  '<label class="field4" for="pd">Far L<BR>'; ?>
		<? echo  form_dropdown('pd', $list_lens_pd ) . '</label>'; ?>
	</div>
			
	<div id="lens_far_r" style="position:absolute; left:46px; top:258px; " >
		<? echo  '<label class="field4" for="pd">Far R<BR>'; ?>
		<? echo  form_dropdown('pd', $list_lens_pd ) . '</label>'; ?>
	</div>
		
	<div id="lens_shape" style="position:absolute; left:47px; top:282px; " >	
		<? echo  '<label class="field4" for="shape">Lens Shape<BR>'; ?>
		<? echo  form_dropdown('shape', $list_lens_shapes ) . '</label>'; ?>
	</div>
			
	<div id="lens_sizes" style="position:absolute; left:49px; top:306px; " >
		<? echo  '<label class="field4" for="size">Lens Size<BR>'; ?>
		<? echo  form_dropdown('size', $list_lens_sizes ) . '</label>'; ?>
	</div>
		
	<div id="lens_treatment" style="position:absolute; left:48px; top:331px; " >
		<? echo  '<label class="field4" for="treatment">Lens treatment<BR>'; ?>
		<? echo  form_dropdown('treatment', $list_lens_treatments ) . '</label>'; ?>
	</div>
		
	<div id="frame_manufacturers" style="position:absolute; left:48px; top:358px; " >
		<? echo  '<label class="field4" for="manufacturer">Frame Manufacturer<BR>'; ?>
		<? echo  form_dropdown('manufacturer', $list_manufacturers ) . '</label>'; ?>
	</div>
		
	<div id="remake_reason" style="position:absolute; left:48px; top:380px; " >
		<? echo  '<label class="field4" for="remake_reason">Remake Reason<BR>'; ?>
		<? echo  form_dropdown('remake_reason', $list_remake_reasons ) . '</label>'; ?>
	</div>
		
	<div id="temple_length" style="position:absolute; left:46px; top:402px; " >
		<? echo  '<label class="field4" for="temple_length">Temple Length<BR>'; ?>
		<? echo  form_dropdown('temple_length', $list_temple_lengths ) . '</label>'; ?>
	</div>
		
	<div id="temple_styles" style="position:absolute; width:259px; height:23px; left:220px; top:119px; " >
		<? echo  '<label class="field4" for="temple_style">Temple Style<BR>'; ?>
		<? echo  form_dropdown('temple_style', $list_temple_styles ) . '</label>'; ?>
	</div>
	
	<div id="submit" style="position:absolute; height:23px; left:220px; top:167px; width:260px; " >
		<? echo  form_submit('submit','Submit'); ?>
		<? echo  form_close(); ?>
	</div>
		
			</fieldset>
		</div>

</body></html>