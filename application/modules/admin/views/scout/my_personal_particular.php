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
						<td><?php echo $thisPP['chinese_name']; ?></td>
						<th style="width:120px">English Name: </th>
						<td ><?php echo $thisPP['english_first_name']; ?><?php echo $thisPP['english_last_name']; ?></td>
					</tr>
					<tr>
						<th style="width:60px">Date of Birth: </th>
						<td><?php echo $thisPP['date_of_birth']; ?></td>
						<th style="width:10px">Age: </th>
						<td><?php echo $thisPP['age']; ?></td>
					</tr>
					<tr>
						<th style="width:10px">Gender: </th>
						<td><?php echo $thisPP['gender']; ?></td>
						<th style="width:10px">HKID: </th>
						<td><?php echo $thisPP['hkid']; ?></td>
					</tr>
					<tr>
						<th style="width:60px">thisPP Book No.: </th>
						<td><?php echo $thisPP['record_book_number']; ?></td>
						<th style="width:10px">Date of Investiture: </th>
						<td><?php echo $thisPP['date_of_investiture']; ?></td>
					</tr>
					<tr>
						<th>Unit:</th>
						<th style="width:120px">Region: </th>
						<td><?php echo $region[$thisPP['region']]; ?></td>
					</tr>
					<tr>
						<th style="width:120px">District: </th>
						<td><?php echo $district[$thisPP['district']]; ?></td>
						<th style="width:120px">Group: </th>
						<td><?php echo $thisPP['group_number']; ?></td>
					</tr>
					<tr>
						<th style="width:60px">Chinese Address: </th>
						<td><?php echo $thisPP['chinese_address']; ?></td>
					</tr>
					<tr>
						<th style="width:10px">English Address: </th>
						<td><?php echo $thisPP['english_address']; ?></td>
					</tr>
					<tr>
						<th style="width:60px">Contact No.: </th>
						<td><?php echo $thisPP['contact_number']; ?></td>
					</tr>
					<tr>
						<th style="width:10px">E-mail Address: </th>
						<td><?php echo $thisPP['email_address']; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>