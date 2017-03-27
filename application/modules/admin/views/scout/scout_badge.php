<?php echo $form->messages(); ?>
<body>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body" style="width: 50%;">
					<?php echo $form->open(); ?>
						<?php $js =  array('onchange'=>"configureDropDownLists(this,document.getElementById('ddl1','ddl2'));"); ?>
						<?php echo $form->bs3_dropdown('Badge Group?','ddl1', $ddl1 = ['','Interest','Pursuit','Service','Instructor','Activities'],'', $js); ?>
						<?php echo $form->bs3_dropdown('What badge?', 'ddl2') ?>
						<?php echo $form->bs3_submit(); ?>
					<?php echo $form->close(); ?>
				</div>
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
<script type="text/javascript">
function configureDropDownLists(ddl1,ddl2) {
	console.log('hi');
    var badgeInt = ['Angler','Artist','Athlete','Campcook','Canoeist','Collector','Cyclist','Dragonboatman','Horseman','Librarian','Modelmaker','Musician','Naturalist','Parkorienteer','Photographer','Rowingboatman','SailorInt','Smallholder','Swimmer','Tourism','Windsurfer','ArcheryInt','FootdrillInt','Animalcare'];
    var badgePur = ['Astronomer','Boatswain','Camper','Canoeist','Canoepolo','Communicator','Computer','Cookchinesedishes','Craftsman','Electronics','Explorer','Treecarer','Internationalracingkayak','Mapmaker','Marksman','Masteratarms','Mechanic','Meteorologist','Navigator','Observer','Orienteer','Pioneer','Racehelmsman','Sailor','Skindiver','Sportsman','Worldfriendship','Archery','Backwoodscook'];
    var badgeSer = ['Firstaid','Campwarden','Canoerescuer','Conservator','Environmentalprotection','Fireman','Guide','Interpreter','Jobman','Lifesaver','Pilot','Quartermaster','Secretary','Civics','Disabilityawareness'];
    var badgeIns = ['ConservatorGold','LifesaverGold','CamperGold','CommunicatorGold','CookchinesedishesGold','TreecarerGold','MapmakerGold','MechanicGold','MeteorologistGold','ObserverGold','OrienteerGold','PioneerGold','CyclistGold','PhotographerGold','SailorGold','SwimmerGold','BackwoodscookGold'];
    var badgeAct = ['Boatman','Coxswainsmate','Coxswain','Airman','Seniorairman','Masterairman'];
    console.log(ddl1.value);
    switch (ddl1.value) {
        case '1':
	        document.getElementById('ddl2').options.length = 0;
            for (i = 0; i < badgeInt.length; i++) {
                createOption(ddl2, badgeInt[i], i);
            }
            break;
        case '2':
	        document.getElementById('ddl2').options.length = 0;
	        for (i = 0; i < badgePur.length; i++) {
	            	createOption(ddl2, badgePur[i], i);
	            }
            break;
        case '3':
	        document.getElementById('ddl2').options.length = 0;
            for (i = 0; i < badgeSer.length; i++) {
                createOption(ddl2, badgeSer[i], i);
            }
            break;
        case '4':
	        document.getElementById('ddl2').options.length = 0;
            for (i = 0; i < badgeIns.length; i++) {
                createOption(ddl2, badgeIns[i], i);
            }
            break;
        case '5':
	        document.getElementById('ddl2').options.length = 0;
            for (i = 0; i < badgeAct.length; i++) {
                createOption(ddl2, badgeAct[i], i);
            }
            break;
    }

}

function createOption(ddl, text, value) {
    var opt = document.createElement('option');
    opt.value = value;
    opt.text = text;
    document.getElementById('ddl2').options.add(opt);
}
</script>