<?php echo $form->messages(); ?>
<body onload="matchTheSign()">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body" style="width: 50%;">
					<?php echo $form->open(); ?>
						<?php $js =  array('onchange'=>"matchTheSign()"); ?>
						<?php switch ($awardPath) {
							case '2': ?>
								<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A5a','A5b','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'],'', $js); ?>
							<?php break; ?>
							
							<?php case '3': ?>
								<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'],'', $js); ?>
							<?php break; ?>

							<?php default: ?>
								<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A4a','A4bi','A4bii','A4biii','A5a','A5b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'],'',$js); ?>
							<?php break;} ?>
						<?php echo $form->bs3_dropdown('Sign Up or Unsign', 'bool', $bool = ['Sign','Unsign'],'',$js); ?>
						<?php echo $form->bs3_submit(); ?>
					<?php echo $form->close(); ?>
				</div>
				<div class="box-header">
					<h3 class="box-title"><?php echo $award_detail['name'] ?></h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered">
						<tr>
							<th style="width:128px;font-size: 12px">Item Selected</th>
							<th style="width:64px;font-size: 12px">Signed By</th>
							<th style="width:64px;font-size: 12px">Signed On</th> 
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A1a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A1a'] ?></td>
							<td style="font-size: 10px"><?php echo $time['A1a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A1b'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A1b']?></td>
							<td style="font-size: 10px"><?php echo $time['A1b'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A1c'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A1c']?></td>
							<td style="font-size: 10px"><?php echo $time['A1c'] ?></td>
						</tr>

						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A1d'] ?></th>	
							<td style="font-size: 10px"><?php echo $sign['A1d']?></td>
							<td style="font-size: 10px"><?php echo $time['A1d'] ?></td>
						</tr>

						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A2a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A2a']?></td>
							<td style="font-size: 10px"><?php echo $time['A2a'] ?></td>
						</tr>

						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A2b'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A2b']?></td>
							<td style="font-size: 10px"><?php echo $time['A2b'] ?></td>
						</tr>

						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A2c'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A2c']?></td>
							<td style="font-size: 10px"><?php echo $time['A2c'] ?></td>
						</tr>

						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A3a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A3a']?></td>
							<td style="font-size: 10px"><?php echo $time['A3a'] ?></td>
						</tr>

						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A3b'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A3b']?></td>
							<td style="font-size: 10px"><?php echo $time['A3b'] ?></td>
						</tr>
						<?php switch ($awardPath) {
							case '2': ?>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A5a'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A5a']?></td>
									<td style="font-size: 10px"><?php echo $time['A5a'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A5b'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A5b']?></td>
									<td style="font-size: 10px"><?php echo $time['A5b'] ?></td>
								</tr>
							<?php break; ?>
							
							<?php case '3': ?>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6a'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6a']?></td>
									<td style="font-size: 10px"><?php echo $time['A6a'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6bi'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6bi']?></td>
									<td style="font-size: 10px"><?php echo $time['A6bi'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6bii'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6bii']?></td>
									<td style="font-size: 10px"><?php echo $time['A6bii'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6biii'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6biii']?></td>
									<td style="font-size: 10px"><?php echo $time['A6biii'] ?></td>
								</tr>
							<?php break; ?>

							<?php default: ?>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A4a'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A4a']?></td>
									<td style="font-size: 10px"><?php echo $time['A4a'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A4bi'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A4bi']?></td>
									<td style="font-size: 10px"><?php echo $time['A4bi'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A4bii'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A4bii']?></td>
									<td style="font-size: 10px"><?php echo $time['A4bii'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A4biii'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A4biii']?></td>
									<td style="font-size: 10px"><?php echo $time['A4biii'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A5a'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A5a']?></td>
									<td style="font-size: 10px"><?php echo $time['A5a'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A5b'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A5b']?></td>
									<td style="font-size: 10px"><?php echo $time['A5b'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6a'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6a']?></td>
									<td style="font-size: 10px"><?php echo $time['A6a'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6bi'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6bi']?></td>
									<td style="font-size: 10px"><?php echo $time['A6bi'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6bii'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6bii']?></td>
									<td style="font-size: 10px"><?php echo $time['A6bii'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6biii'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6biii']?></td>
									<td style="font-size: 10px"><?php echo $time['A6biii'] ?></td>
								</tr>
							<?php break; } ?>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B1a']?></td>
							<td style="font-size: 10px"><?php echo $time['B1a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2a']?></td>
							<td style="font-size: 10px"><?php echo $time['B2a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B3a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B3a']?></td>
							<td style="font-size: 10px"><?php echo $time['B3a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B4a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B4a']?></td>
							<td style="font-size: 10px"><?php echo $time['B4a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B4b'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B4b']?></td>
							<td style="font-size: 10px"><?php echo $time['B4b'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C1a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C1a']?></td>
							<td style="font-size: 10px"><?php echo $time['C1a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C1b'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C1b']?></td>
							<td style="font-size: 10px"><?php echo $time['C1b'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C2a']?></td>
							<td style="font-size: 10px"><?php echo $time['C2a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D1a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D1a']?></td>
							<td style="font-size: 10px"><?php echo $time['D1a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D2a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D2a']?></td>
							<td style="font-size: 10px"><?php echo $time['D2a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px">完成日期</th>
							<td></td>
							<td style="font-size: 10px"><?php echo $awardData['issue_date'] ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
function matchTheSign() {
    var awardPath = '<?php echo $awardPath ?>';
	var mUser = '<?php echo $vistor ?>';
	var field = document.getElementById('field').value;
	var signStr = '<?php echo json_encode($sign) ?>';
	var signArr = JSON.parse(signStr);
	var items;
	switch (awardPath){
		case '2':
			items = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A5a','A5b','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			break;

		case '3':
			items = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			break;

		case '1':
			items = ['A1a','A1b','A1c','A1d','A2a','A2b','A2c','A3a','A3b','A4a','A4bi','A4bii','A4biii','A5a','A5b','A6a','A6bi','A6bii','A6biii','B1a','B2a','B3a','B4a','B4b','C1a','C1b','C2a','D1a','D2a'];
			break;	
	}
	var selectedField = items[field];
	var signer = signArr[selectedField];
	if(signer != '' || signer != mUser) {
		console.log('HI');
		document.getElementById('submit').style.visibility = "hidden";
	} 
	if(signer == '' || signer == mUser) {
		document.getElementById('submit').style.visibility = "";
	}
}
</script>