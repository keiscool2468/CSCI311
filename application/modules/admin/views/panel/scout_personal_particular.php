<?php echo $form->messages(); ?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Scout Info</h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>
					<?php echo $form->bs3_text('Username', 'username'); ?>
					<?php echo $form->bs3_text('中文全名', 'username'); ?>
					<?php echo $form->bs3_text('First Name', 'first_name'); ?>
					<?php echo $form->bs3_text('Last Name', 'last_name'); ?>
					<label for="dateOfBirth">Date of Birth</label>
					<input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d') ?>" />
					<?php echo $form->bs3_text('Age', 'username'); ?>
					<?php echo $form->bs3_text('Gender', 'username'); ?>
					<?php echo $form->bs3_text('HKID Card No.(e.g. A123)', 'username'); ?>
					<?php echo $form->bs3_text('Record Book No.', 'username'); ?>
					<label for="Date of Investiture">Date of Investiture</label>
					<input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d') ?>" />
					<?php echo $form->bs3_text('Region', 'username'); ?>
					<?php echo $form->bs3_text('District', 'username'); ?>
					<?php echo $form->bs3_text('Group', 'username'); ?>
					<?php echo $form->bs3_text('通訊地址(中文)', 'username'); ?>
					<?php echo $form->bs3_text('Address', 'username'); ?>
					<?php echo $form->bs3_text('Contact No.', 'username'); ?>
					<?php echo $form->bs3_text('E-mail Address', 'username'); ?>
					<?php if ( !empty($groups) ): ?>
					<div class="form-group">
						<label for="groups">Groups</label>
						<div>
						<?php foreach ($groups as $group): ?>
							<label class="checkbox-inline">
								<input type="checkbox" name="groups[]" value="<?php echo $group->id; ?>"> <?php echo $group->name; ?>
							</label>
						<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>

					<?php echo $form->bs3_submit(); ?>
					
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
</div>
