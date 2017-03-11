<?php echo $form->messages(); ?>

<div class="row">

	<div class="col-md-6">
		<div class="box box-primary">
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
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['1'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['one'] ?></td>
						<td style="font-size: 10px"><?php echo $time['one'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['2'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['two']?></td>
						<td style="font-size: 10px"><?php echo $time['two'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['3'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['three']?></td>
						<td style="font-size: 10px"><?php echo $time['three'] ?></td>
					</tr>

					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['4'] ?></th>	
						<td style="font-size: 10px"><?php echo $sign['four']?></td>
						<td style="font-size: 10px"><?php echo $time['four'] ?></td>
					</tr>

					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['5'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['five']?></td>
						<td style="font-size: 10px"><?php echo $time['five'] ?></td>
					</tr>

					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['6'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['six']?></td>
						<td style="font-size: 10px"><?php echo $time['six'] ?></td>
					</tr>

					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['7'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['seven']?></td>
						<td style="font-size: 10px"><?php echo $time['seven'] ?></td>
					</tr>

					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['8'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['eight']?></td>
						<td style="font-size: 10px"><?php echo $time['eight'] ?></td>
					</tr>

					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['9'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['nine']?></td>
						<td style="font-size: 10px"><?php echo $time['nine'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['10'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['ten']?></td>
						<td style="font-size: 10px"><?php echo $time['ten'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px">完成日期</th>
						<td></td>
						<td style="font-size: 10px"><?php echo $awardData['issue_date'] ?></td>
					</tr>
				</table>
			</div>
			<div class="box-body" style="width: 50%;">
				<?php echo $form->open(); ?>
					<?php echo $form->bs3_dropdown('Select Item', 'field', $item = ['1','2','3','4','5','6','7','8','9','10']); ?>
					<?php echo $form->bs3_dropdown('Sign Up or Unsign', 'bool', $bool = ['Sign','Unsign']); ?>
					<?php echo $form->bs3_submit(); ?>
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>