<?php echo $form->messages(); ?>
<body onload="Age()">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary" >
				<div class="box-header">
					<h3 class="box-title">Scout Info</h3>
				</div>
				<div class="box-body" id="pp">
					<table class="table table-bordered">
						<tr>
							<th style="width:120px">Chinese Name: </th>
							<td><?php echo $record['chinese_name']; ?></td>
							<th style="width:120px">English Name: </th>
							<td ><?php echo $record['english_first_name']; ?><?php echo $record['english_last_name']; ?></td>
						</tr>
						<tr>
							<th style="width:60px">Date of Birth: </th>
							<td><?php echo $record['date_of_birth']; ?></td>
							<th style="width:10px">Age: </th>
							<td id="idAge"></td>
						</tr>
						<tr>
							<th style="width:10px">Gender: </th>
							<td><?php echo $record['gender']; ?></td>
							<th style="width:10px">HKID: </th>
							<td><?php echo $record['hkid']; ?></td>
						</tr>
						<tr>
							<th style="width:60px">Record Book No.: </th>
							<td><?php echo $record['record_book_number']; ?></td>
							<th style="width:10px">Date of Investiture: </th>
							<td><?php echo $record['date_of_investiture']; ?></td>
						</tr>
						<tr>
							<th>Unit:</th>
							<th style="width:120px">Region: </th>
							<td><?php echo $region[$record['region']]; ?></td>
						</tr>
						<tr>
							<th style="width:120px">District: </th>
							<td><?php echo $district[$record['district']]; ?></td>
							<th style="width:120px">Group: </th>
							<td><?php echo $record['group_number']; ?></td>
						</tr>
						<tr>
							<th style="width:60px">Chinese Address: </th>
							<td><?php echo $record['chinese_address']; ?></td>
						</tr>
						<tr>
							<th style="width:10px">English Address: </th>
							<td><?php echo $record['english_address']; ?></td>
						</tr>
						<tr>
							<th style="width:60px">Contact No.: </th>
							<td><?php echo $record['contact_number']; ?></td>
						</tr>
						<tr>
							<th style="width:10px">E-mail Address: </th>
							<td><?php echo $record['email_address']; ?></td>
						</tr>
					</table>
					<button type="button" class="btn btn-primary" onclick="document.getElementById('edit').hidden = false; document.getElementById('pp').hidden = true;" >Edit</button>
				</div>
				<div class="box-body" id="edit" hidden>
					<?php echo $form->open(); ?>
						<!-- hidden  when done-->
						<label for="user id">User ID</label>
						<label><?php echo $user_id ?></label>
						<?php echo $form->bs3_text('中文全名', 'chinese_name', $record['chinese_name']); ?>
						<?php echo $form->bs3_text('English First Name', 'english_first_name', $record['english_first_name']); ?>
						<?php echo $form->bs3_text('English Last Name', 'english_last_name', $record['english_last_name']); ?>
						<label for="dateOfBirth">Date of Birth</label>
						<input type="date" class="form-control" name="date_of_birth" value="<?php echo $record['date_of_birth'] ?>" onchange="Age()" />
						<br>
						<?php echo $form->bs3_text_disable('Age', 'age'); ?>
						<?php echo $form->bs3_text('Gender', 'gender', $record['gender']); ?>
						<?php echo $form->bs3_text('HKID Card No.(e.g. A123)', 'hkid', $record['hkid']); ?>
						<?php echo $form->bs3_text('Record Book No.', 'record_book_number', $record['record_book_number']); ?>
						<label for="Date of Investiture">Date of Investiture</label>
						<input type="date" class="form-control" name="date_of_investiture" value="<?php echo $record['date_of_investiture'] ?>" />
						<br>
						<?php echo $form->bs3_dropdown('Region', 'region', $region, $record['region']); ?>
						<?php echo $form->bs3_dropdown('District', 'district',$district, $record['district']); ?>
						<?php echo $form->bs3_text('Group', 'group_number', $record['group_number']); ?>
						<?php echo $form->bs3_text('通訊地址(中文)', 'chinese_address', $record['chinese_address']); ?>
						<?php echo $form->bs3_text('Address', 'english_address', $record['english_address']); ?>
						<?php echo $form->bs3_text('Contact No.', 'contact_number', $record['contact_number']); ?>
						<?php echo $form->bs3_email('E-mail Address', 'email_address', $record['email_address']); ?>
						<br>
						<?php echo $form->bs3_submit(); ?>
					<?php echo $form->close(); ?>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	function Age(){
	    var today = new Date();
	    var thisYear = 0;
	    var birthDay = '<?php echo $record['date_of_birth']; ?>';
	    var date = birthDay.split("-");
	    console.log(today.getDate());
	    console.log(birthDay);
	    if (today.getMonth()+1 > date[1]) {
	        thisYear = 0;
	        console.log('0');
	    } else if ((today.getMonth()+1 == date[1]) && today.getDate() > date[2]) {
	        thisYear = 0;
	        console.log('0');
	    } else if ((today.getMonth()+1 == date[1]) && today.getDate() == date[2]) {
	    	thisYear = 0; 
	        console.log('0');
		}else {
	    	thisYear = 1;
	        console.log('1');
	    }
	    var age = today.getFullYear() - date[0] - thisYear;
	    console.log(age);
	    document.getElementById('idAge').innerHTML = age;
	    document.getElementById('age').value = age;
	}
	$(document).ready(function(){
	  $("#submit").on("click",function(){
	    $("#age").removeAttr('disabled');
	  });
	});
	// function              
</script>
