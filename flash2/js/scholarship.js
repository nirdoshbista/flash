
function cV(obj){

	var d=document.forms[0];
	
	if (obj.id.substring(0,1)=='q') return;
	
	var currentClass = parseInt(obj.id.substring(6,8));
	var currentLine = parseInt(obj.id.substring(obj.id.indexOf('[')+1));
	
	var tot=0;
	tot+=(d['sch_g_'+currentClass+'['+currentLine+']'].value==''?0:parseInt(d['sch_g_'+currentClass+'['+currentLine+']'].value));
	tot+=(d['sch_b_'+currentClass+'['+currentLine+']'].value==''?0:parseInt(d['sch_b_'+currentClass+'['+currentLine+']'].value));
	
	d['sch_t_'+currentClass+'['+currentLine+']'].value = (tot>0?tot:'');
	
	
	var tmp;
	
	// total students getting sch should be less than total students
	blinkConst('sch_g_'+currentClass+'['+currentLine+']',tmp=sn['t_e_g_'+currentClass],"Number of scholarships should be less or equal to enrollment ("+tmp+")");
	blinkConst('sch_b_'+currentClass+'['+currentLine+']',tmp=sn['t_e_b_'+currentClass],"Number of scholarships should be less or equal to enrollment ("+tmp+")");
	blinkConst('sch_t_'+currentClass+'['+currentLine+']',tmp=sn['t_e_t_'+currentClass],"Number of scholarships should be less or equal to enrollment ("+tmp+")");
	
	// dalit and janjati students sch
	if (currentClass<=5){
		blinkConst('sch_g_'+currentClass+'[3]',tmp=sn['d_e_g_'+currentClass],"Number of scholarships should be less or equal to dalit enrollment ("+tmp+")");
		blinkConst('sch_b_'+currentClass+'[3]',tmp=sn['d_e_b_'+currentClass],"Number of scholarships should be less or equal to dalit enrollment ("+tmp+")");
		blinkConst('sch_t_'+currentClass+'[3]',tmp=sn['d_e_t_'+currentClass],"Number of scholarships should be less or equal to dalit enrollment ("+tmp+")");

		blinkConst('sch_g_'+currentClass+'[4]',tmp=sn['j_e_g_'+currentClass],"Number of scholarships should be less or equal to janjati enrollment ("+tmp+")");
		blinkConst('sch_b_'+currentClass+'[4]',tmp=sn['j_e_b_'+currentClass],"Number of scholarships should be less or equal to janjati enrollment ("+tmp+")");
		blinkConst('sch_t_'+currentClass+'[4]',tmp=sn['j_e_t_'+currentClass],"Number of scholarships should be less or equal to janjati enrollment ("+tmp+")");
		
	}
	
	
	// dalit and janjati students sch
	if (currentClass>=5){
		blinkConst('sch_g_'+currentClass+'[7]',tmp=sn['j_e_g_'+currentClass],"Number of scholarships should be less or equal to janjati enrollment ("+tmp+")");
		blinkConst('sch_b_'+currentClass+'[7]',tmp=sn['j_e_b_'+currentClass],"Number of scholarships should be less or equal to janjati enrollment ("+tmp+")");
		blinkConst('sch_t_'+currentClass+'[7]',tmp=sn['j_e_t_'+currentClass],"Number of scholarships should be less or equal to janjati enrollment ("+tmp+")");
		
	}	
	
}
