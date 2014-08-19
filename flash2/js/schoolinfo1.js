function d2V(obj){
	
	fixYear(document.forms[0]['i8_2']);
	
	blinkConst('i8_2',currentYear,"Year cant be greater than current year (2066)");
	blinkConst('i3_3',32,"Number of days should be less or equal to 32");
	blinkConst('i4_3',32,"Number of days should be less or equal to 32");
	
	blinkConst('i15_1',365,"Number of days should be less or equal to 365");
	blinkConst('i15_2',365,"Number of days should be less or equal to 365");
	blinkConst('i15_3',365,"Number of days should be less or equal to 365");
	blinkConst('i15_4',365,"Number of days should be less or equal to 365");
	blinkConst('i15_5',365,"Number of days should be less or equal to 365");
	blinkConst('i15_6',365,"Number of days should be less or equal to 365");
	blinkConst('i15_7',365,"Number of days should be less or equal to 365");
	
	blinkConst('i16_1',365,"Number of days should be less or equal to 365");
	blinkConst('i16_2',365,"Number of days should be less or equal to 365");
	blinkConst('i16_3',365,"Number of days should be less or equal to 365");
	
	
}

function handleChange(obj){

	if (obj.name=='i2_1') {
		document.getElementById('i2_f').className=(obj.value==1?'divshow':'divhide'); 
		
		if (obj.value=='1') {
			enableIDs('i2_2');
			document.getElementById('i2_2').focus();
		}
		else{
			disableIDs('i2_2');
		}
	
	}
	if (obj.name=='i3_1') {
		document.getElementById('i3_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i3_2 i3_3');
			document.getElementById('i3_2').focus();
		}
		else disableIDs('i3_2 i3_3');
	}
	if (obj.name=='i4_1') {
		document.getElementById('i4_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i4_2 i4_3');
			document.getElementById('i4_2').focus();
		}
		else disableIDs('i4_2 i4_3');
	}
	
	/*
	if (obj.name=='i5_1') {
		document.getElementById('i5_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i5_2');
			document.getElementById('i5_2').focus();
		}
		else disableIDs('i5_2');
	}
	*/
	
	if (obj.name=='i6_1') {
		document.getElementById('i6_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i6_2');
			document.getElementById('i6_2').focus();
		}
		else disableIDs('i6_2');
	}

	if (obj.name=='i8_1') {
		document.getElementById('i8_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i8_2 i8_3');
			document.getElementById('i8_2').focus();
		}
		else disableIDs('i8_2 i8_3');
	}
	
	if (obj.name=='i9_1') {
		document.getElementById('i9_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i9_2 i9_3');
			
			document.getElementById('i9_2').focus();
		}
		else disableIDs('i9_2 i9_3');
	}
	
	if (obj.name=='i10_1') {
		document.getElementById('i10_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i10_2 i10_3');
			document.getElementById('i10_2').focus();
		}
		else disableIDs('i10_2 i10_3');
	}
	
	if (obj.name=='i11_1') {
		document.getElementById('i11_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i11_2 i11_3 i11_4');
			document.getElementById('i11_2').focus();
		}
		else disableIDs('i11_2 i11_3 i11_4');
	}
	
	if (obj.name=='i12_1') {
		document.getElementById('i12_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i12_2 i12_3 i12_4');
			document.getElementById('i12_2').focus();
		}
		else disableIDs('i12_2 i12_3 i12_4');
	}
	if (obj.name=='i13_1') {
		document.getElementById('i13_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i13_2 i13_3 i13_4');
			document.getElementById('i13_2').focus();
		}
		else disableIDs('i13_2 i13_3 i13_4');
	}
	if (obj.name=='i14_1') {
		document.getElementById('i14_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i14_2 i14_3 i14_4');
			document.getElementById('i14_2').focus();
		}
		else {
			disableIDs('i14_2 i14_3 i14_4');
		}
	}
	
	if (obj.name=='i19_1') {
		document.getElementById('i19_f').className=(obj.value==1?'divshow':'divhide'); 
		if (obj.value=='1') {
			enableIDs('i19_2');
			document.getElementById('i19_2').focus();
		}
		else disableIDs('i19_2');
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
