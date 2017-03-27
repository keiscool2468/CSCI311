<?php echo $form->messages(); ?>
<body>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body">
					<table class="table table-bordered">
						<tr>
							<td>Interest</td>
						</tr>
						<tr>
							<?php foreach($interest as $key):  ?>
								<td><img src= "<?php echo "../assets/uploads/$key.gif" ?>" ></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>Pursuit</td>
						</tr>
						<tr>
							<?php foreach($pursuit as $key):  ?>
								<td><img src= "<?php echo "../assets/uploads/$key.gif" ?>" ></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>Service</td>
						</tr>
						<tr>
							<?php foreach($service as $key):  ?>
								<td><img src= "<?php echo "../assets/uploads/$key.gif" ?>" ></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>Instructor</td>
						</tr>
						<tr>
						<?php foreach($instructor as $key):  ?>
								<td><img src= "<?php echo "../assets/uploads/$key.gif" ?>" ></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>Activities</td>
						</tr>
						<tr>
						<?php foreach($Act as $key):  ?>
								<td><img src= "<?php echo "../assets/uploads/$key.gif" ?>" ></td>
							<?php endforeach; ?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>