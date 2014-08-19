function handleChange(obj){
	if (obj.id.indexOf('sections')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		
		for (i=0;i<=10;i++){
			sum += d['sections_'+i].value * 1;
		}
		
		d['sections_t'].value = sum?sum:'';
		
	}
	
	if (obj.id.indexOf('classrooms')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		
		for (i=0;i<=10;i++){
			sum += d['classrooms_'+i].value * 1;
		}
		
		d['classrooms_t'].value = sum?sum:'';
		
	}	
	
	if (obj.name=='compound') {
		document.getElementById('i3').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('cstatus');
			document.getElementById('cstatus').focus();
		}
		else disableIDs('cstatus');
	}
		
	if (obj.name=='water') {
		document.getElementById('i3_1').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('water_tap water_tubewell water_well water_other');
			document.getElementById('water_tap').focus();
		}
		else disableIDs('water_tap water_tubewell water_well water_other');		
	}
	if (obj.name=='toilet') {
		document.getElementById('i3_2').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('t_total t_girls t_all t_teachers');
			document.getElementById('t_total').focus();
		}
		else disableIDs('t_total t_girls t_all t_teachers');		
	}
	
	if (obj.name=='urinal') {
		document.getElementById('i3_3').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('urinal_teachers urinal_girls');
			document.getElementById('urinal_teachers').focus();
		}
		else disableIDs('urinal_teachers urinal_girls');		
	}
	
	if (obj.name=='pground') {
		document.getElementById('i4_1').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('pground_enough_space');
			document.getElementById('pground_enough_space').focus();
		}
		else disableIDs('pground_enough_space');			
	}
	if (obj.name=='computer_room') {
		document.getElementById('i4_2').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('num_computers admin_computers teaching_computers');
			document.getElementById('num_computers').focus();
		}
		else disableIDs('num_computers admin_computers teaching_computers');		
	}
	
	if (obj.name=='rigid_buildings' || obj.name=='num_buildings'){
		blink('rigid_buildings','num_buildings',"This value should be less or equal to total");
		var diff = getValueId('num_buildings') - getValueId('rigid_buildings');
		document.forms[0]['weak_buildings'].value = (diff>=0)?diff:'';
	}
	
	
}

function disableIDs(ids){
	var idarr = ids.split(" ");
	for (i=0;i<idarr.length;i++){
		document.getElementById(idarr[i]).disabled = true;
		if (document.getElementById(idarr[i]).type=='select-one') document.getElementById(idarr[i]).selectedIndex = 0;
		else document.getElementById(idarr[i]).value = '';
	}
}

function enableIDs(ids){
		var idarr = ids.split(" ");
	for (i=0;i<idarr.length;i++){
		document.getElementById(idarr[i]).disabled = false;
	}
}
