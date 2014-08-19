function handleChange(obj){
	
	if (obj.id.indexOf('disabled')==0){
		var t=obj.id.replace(/_f\[|_m\[/,'_t[');
		var f=t.replace('_t[','_f[');
		var m=t.replace('_t[','_m[');

		var d = document.forms[0];
		
		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum?sum:'';
		
		// calculate row total
		if (obj.id.indexOf('_t_')>0) return;
		
		var r1=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_1_');
		var r2=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_2_');
		var r3=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_3_');
		var r4=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_4_');
		var r5=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_5_');
		var r6=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_6_');
		var r7=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_7_');
                var r8=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_8_');
		var rt=obj.id.replace(/_1_|_2_|_3_|_4_|_5_|_6_|_7_|_8_/,'_t_');
		
		sum = d[r1].value*1 + d[r2].value*1 + d[r3].value*1 + d[r4].value*1 + d[r5].value*1 + d[r6].value*1 + d[r7].value*1+d[r8].value*1;
		d[rt].value = sum?sum:'';
		
		
		handleChange(d[rt]);
	
	}
	

	if (validate) validation(obj);

}

function validation(obj){

	if (obj.id.indexOf('disabled')>=0){
		var sx=obj.id.substring(11,12);
		var cl=obj.id.substring(13,14);
		
		//alert(sx+" "+cl);
		
		ajaxRequest("flash1backend.php?req=enrollment&schoolcode="+currentSchoolCode+"&class="+cl+"&sex="+sx, function(t){
			blinkConst(obj.id, t.responseText*1, "Number of disabled students should be less total enrollment ("+t.responseText*1+")");
		});
		
	}
	

}
