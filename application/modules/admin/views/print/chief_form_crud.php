<?php echo $form->messages(); ?>
<body>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body" style="width: 100%;">
					<div class="box-body" style="width: 50%;">
						<?php echo $form->open(); ?>
							<?php $js =  array('onchange'=>"myFunction(this,document.getElementById('chief'));"); ?>
							<?php echo $form->bs3_dropdown('What you want to Print?','ddl1', $ddl1 = ['','Pathfinder','Standard','Advanced','Chiefs Scout'],'', $js); ?>
							<?php echo $form->bs3_dropdown('Who to Print?', 'chief'); ?>
							<?php echo $form->bs3_submit(); ?>
						<?php echo $form->close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	function myFunction(chief){
		var paths = JSON.parse('<?php echo json_encode($paths) ?>');
		var stands = JSON.parse('<?php echo json_encode($stands) ?>');
		var advans = JSON.parse('<?php echo json_encode($advans) ?>');
		var chiefs = JSON.parse('<?php echo json_encode($chiefs) ?>');
		console.log(document.getElementById('ddl1').value);
		switch (document.getElementById('ddl1').value) {
	        case '1':
		        document.getElementById('chief').options.length = 0;
	            for(i = 0; i < paths.length; i++){
					createOption(chief, paths[i][0]['chinese_name'], paths[i][0]['user_id']);
				}	
	            break;
	        case '2':
		        document.getElementById('chief').options.length = 0;
		        for(i = 0; i < stands.length; i++){
					createOption(chief, stands[i][0]['chinese_name'], stands[i][0]['user_id']);
				}	
	            break;
	        case '3':
		        document.getElementById('chief').options.length = 0;
	            for(i = 0; i < advans.length; i++){
					createOption(chief, advans[i][0]['chinese_name'], advans[i][0]['user_id']);
				}	
	            break;
	        case '4':
		        document.getElementById('chief').options.length = 0;
	            for(i = 0; i < chiefs.length; i++){
					createOption(chief, chiefs[i][0]['chinese_name'], chiefs[i][0]['user_id']);
				}	
	            break;
		}
	}
	function createOption(ddl, text, value) {
	    var opt = document.createElement('option');
	    opt.value = value;
	    opt.text = text;
	    document.getElementById('chief').options.add(opt);
	}
</script>