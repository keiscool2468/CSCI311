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
								<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A5a','A5b','A5c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'],'',$js); ?>
							<?php break; ?>
							
							<?php case '3': ?>
								<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A6a','A6b','A6c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'],'',$js); ?>
							<?php break; ?>

							<?php default: ?>
								<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A4a','A4bi','A4bii','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'],'',$js); ?>
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
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A2ai'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A2ai']?></td>
							<td style="font-size: 10px"><?php echo $time['A2ai'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A2aii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A2aii']?></td>
							<td style="font-size: 10px"><?php echo $time['A2aii'] ?></td>
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
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['A3c'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['A3c']?></td>
							<td style="font-size: 10px"><?php echo $time['A3c'] ?></td>
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
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A5c'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A5c']?></td>
									<td style="font-size: 10px"><?php echo $time['A5c'] ?></td>
								</tr>
							<?php break; ?>
							
							<?php case '3': ?>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6a'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6a']?></td>
									<td style="font-size: 10px"><?php echo $time['A6a'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6b'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6b']?></td>
									<td style="font-size: 10px"><?php echo $time['A6b'] ?></td>
								</tr>
								<tr>
									<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6c'] ?></th>
									<td style="font-size: 10px"><?php echo $sign['A6c']?></td>
									<td style="font-size: 10px"><?php echo $time['A6c'] ?></td>
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
							<?php break; } ?>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1ai'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B1ai']?></td>
							<td style="font-size: 10px"><?php echo $time['B1ai'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1aii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B1aii']?></td>
							<td style="font-size: 10px"><?php echo $time['B1aii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1aiii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B1aiii']?></td>
							<td style="font-size: 10px"><?php echo $time['B1aiii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1aiv'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B1aiv']?></td>
							<td style="font-size: 10px"><?php echo $time['B1aiv'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2a']?></td>
							<td style="font-size: 10px"><?php echo $time['B2a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2bi'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2bi']?></td>
							<td style="font-size: 10px"><?php echo $time['B2bi'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2bii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2bii']?></td>
							<td style="font-size: 10px"><?php echo $time['B2bii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2biii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2biii']?></td>
							<td style="font-size: 10px"><?php echo $time['B2biii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2biv'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2biv']?></td>
							<td style="font-size: 10px"><?php echo $time['B2biv'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2bv'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2bv']?></td>
							<td style="font-size: 10px"><?php echo $time['B2bv'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B2bvi'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B2bvi']?></td>
							<td style="font-size: 10px"><?php echo $time['B2bvi'] ?></td>
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
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B4bi'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B4bi']?></td>
							<td style="font-size: 10px"><?php echo $time['B4bi'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['B4bii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['B4bii']?></td>
							<td style="font-size: 10px"><?php echo $time['B4bii'] ?></td>
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
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C1c'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C1c']?></td>
							<td style="font-size: 10px"><?php echo $time['C1c'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C1d'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C1d']?></td>
							<td style="font-size: 10px"><?php echo $time['C1d'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C1chop'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C1chop']?></td>
							<td style="font-size: 10px"><?php echo $time['C1chop'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2ai'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C2ai']?></td>
							<td style="font-size: 10px"><?php echo $time['C2ai'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2aii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C2aii']?></td>
							<td style="font-size: 10px"><?php echo $time['C2aii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2aiii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C2aiii']?></td>
							<td style="font-size: 10px"><?php echo $time['C2aiii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C3ai'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C3ai']?></td>
							<td style="font-size: 10px"><?php echo $time['C3ai'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['C3aii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['C3aii']?></td>
							<td style="font-size: 10px"><?php echo $time['C3aii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D1a'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D1a']?></td>
							<td style="font-size: 10px"><?php echo $time['D1a'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D2ai'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D2ai']?></td>
							<td style="font-size: 10px"><?php echo $time['D2ai'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D2aii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D2aii']?></td>
							<td style="font-size: 10px"><?php echo $time['D2aii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D2bi'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D2bi']?></td>
							<td style="font-size: 10px"><?php echo $time['D2bi'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D2bii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D2bii']?></td>
							<td style="font-size: 10px"><?php echo $time['D2bii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D3ai'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D3ai']?></td>
							<td style="font-size: 10px"><?php echo $time['D3ai'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['D3aii'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['D3aii']?></td>
							<td style="font-size: 10px"><?php echo $time['D3aii'] ?></td>
						</tr>
						<tr>
							<th style="width:200px;font-size: 10px"><?php echo $award_detail['E1'] ?></th>
							<td style="font-size: 10px"><?php echo $sign['E1']?></td>
							<td style="font-size: 10px"><?php echo $time['E1'] ?></td>
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
			items = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A5a','A5b','A5c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'];
			break;

		case '3':
			items = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A6a','A6b','A6c','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'];
			break;

		case '1':
			items = ['A1a','A1b','A1c','A2ai','A2aii','A2b','A2c','A3a','A3b','A3c','A4a','A4bi','A4bii','B1ai','B1aii','B1aiii','B1aiv','B2a','B2bi','B2bii','B2biii','B2biv','B2bv','B2bvi','B3a','B4a','B4bi','B4bii','C1a','C1b','C1c','C1d','C1chop','C2ai','C2aii','C2aiii','C3ai','C3aii','D1a','D2ai','D2aii','D2bi','D2bii','D3ai','D3aii','E1'];
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