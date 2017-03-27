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
								<th style="width:200px;font-size: 10px"><?php echo $award_detail['A6b'] ?></th>
								<td style="font-size: 10px"><?php echo $sign['A6b']?></td>
								<td style="font-size: 10px"><?php echo $time['A6b'] ?></td>
							</tr>
						<?php break; ?>

						<?php default: ?>
							<tr>
								<th style="width:200px;font-size: 10px"><?php echo $award_detail['A4a'] ?></th>
								<td style="font-size: 10px"><?php echo $sign['A4a']?></td>
								<td style="font-size: 10px"><?php echo $time['A4a'] ?></td>
							</tr>
							<tr>
								<th style="width:200px;font-size: 10px"><?php echo $award_detail['A4b'] ?></th>
								<td style="font-size: 10px"><?php echo $sign['A4b']?></td>
								<td style="font-size: 10px"><?php echo $time['A4b'] ?></td>
							</tr>
						<?php break; } ?>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1a'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['B1a']?></td>
						<td style="font-size: 10px"><?php echo $time['B1a'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['B1b'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['B1b']?></td>
						<td style="font-size: 10px"><?php echo $time['B1b'] ?></td>
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
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['B4biii'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['B4biii']?></td>
						<td style="font-size: 10px"><?php echo $time['B4biii'] ?></td>
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
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C1chop'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C1chop']?></td>
						<td style="font-size: 10px"><?php echo $time['C1chop'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2a'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C2a']?></td>
						<td style="font-size: 10px"><?php echo $time['C2a'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2bi'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C2bi']?></td>
						<td style="font-size: 10px"><?php echo $time['C2bi'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2bii'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C2bii']?></td>
						<td style="font-size: 10px"><?php echo $time['C2bii'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C2biii'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C2biii']?></td>
						<td style="font-size: 10px"><?php echo $time['C2biii'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C3a'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C3a']?></td>
						<td style="font-size: 10px"><?php echo $time['C3a'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C3bi'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C3bi']?></td>
						<td style="font-size: 10px"><?php echo $time['C3bi'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C3bii'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C3bii']?></td>
						<td style="font-size: 10px"><?php echo $time['C3bii'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['C3biii'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['C3biii']?></td>
						<td style="font-size: 10px"><?php echo $time['C3biii'] ?></td>
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
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['D3a'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['D3a']?></td>
						<td style="font-size: 10px"><?php echo $time['D3a'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['D3b'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['D3b']?></td>
						<td style="font-size: 10px"><?php echo $time['D3b'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['E1'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['E1']?></td>
						<td style="font-size: 10px"><?php echo $time['E1'] ?></td>
					</tr>
					<tr>
						<th style="width:200px;font-size: 10px"><?php echo $award_detail['E2'] ?></th>
						<td style="font-size: 10px"><?php echo $sign['E2']?></td>
						<td style="font-size: 10px"><?php echo $time['E2'] ?></td>
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