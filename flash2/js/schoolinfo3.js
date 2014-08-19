function handleChange(obj){
	if (obj.name=='additional_rooms') {
		document.getElementById('i6_3').className = (obj.value == 1)?'':'divhide';
		if (obj.value=='1') {
			enableIDs('additional_rooms_num additional_rooms_land');
			document.getElementById('additional_rooms_num').focus();
		}
		else disableIDs('additional_rooms_num additional_rooms_land');		
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
