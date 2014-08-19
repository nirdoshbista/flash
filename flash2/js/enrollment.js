var b2LargeCheck="enr_1_0 enr_2_0 enr_3_0";
var b2LargeCheck="enr_1_0 enr_2_0 enr_3_0";

function b2V(obj){
	var d=document.forms[0];

	var tot;
	var i=0,j=0;
	
	if (obj.id.indexOf('_1_')>0) i=1;
	if (obj.id.indexOf('_2_')>0) i=2;
	if (obj.id.indexOf('_3_')>0) i=3;
	
	tot=0;
	for (j=0;j<=12;++j){
		tot+=(d['enr_'+i+'_'+j].value==''?0:parseInt(d['enr_'+i+'_'+j].value));
		if (j>0) blink('enr_'+i+'_'+j,'t_e_t['+j+']',"This value should be less or equal to enrollment.");
	}
	d['enr_'+i+'_tot'].value = (tot>0?tot:'');
		
	
	blinkLarge(b2LargeCheck.split(" "));


}


var bLargeCheck="t_e_g[1] t_e_b[1] t_e_g[2] t_e_b[2] t_e_g[3] t_e_b[3] t_e_g[4] t_e_b[4] t_e_g[5] t_e_b[5] t_e_g[6] t_e_b[6] t_e_g[7] t_e_b[7] t_e_g[8] t_e_b[8] t_e_g[9] t_e_b[9] t_e_g[10] t_e_b[10] t_e_g[11] t_e_b[11] t_e_g[12] t_e_b[12]";

function bV(obj){

	var d=document.forms[0];

	var g=obj.id.replace(/_g|_b|_t/,'_g');
	var b=obj.id.replace(/_g|_b|_t/,'_b');
	var t=obj.id.replace(/_g|_b|_t/,'_t');
	
	var sum = d[g].value * 1 + d[b].value * 1;
	

	d[t].value = (sum>0?sum:'');
	
	if (obj.id.indexOf('[')<0) return;
	
	var cl=parseInt(obj.id.substring(6,8));
	var st=0;en=0;
	
	if (cl>=1 && cl<=5) {st=1; en=5;}
	if (cl>=6 && cl<=8) {st=6; en=8;}
	if (cl>=9 && cl<=10) {st=9; en=10;}
	if (cl>=11 && cl<=12) {st=11; en=12;}
	
	sum=0;
	for (i=st;i<=en;i++){
		g=obj.id.replace(/\[1\]|\[2\]|\[3\]|\[4\]|\[5\]|\[6\]|\[7\]|\[8\]|\[9\]|\[10\]|\[11\]|\[12\]/,'['+i+']');
		
		sum += (d[g].value * 1);
	}
	
	g=obj.id.replace(/\[.*\]/,'_'+st+en);
		
	
	d[g].value = (sum?sum:'');
	
	bV(d[g]);
	
	// appeared should be less or equal to enrollment
	blink(obj.id.replace(/_a_|_e_/,'_a_'), obj.id.replace(/_a_|_e_/,'_e_'),"Exam appearance should be less or equal to enrollment.");
	
	// dalit & janjati should be equal or less than total
	
	blink(obj.id.replace(/d_|j_|t_/,'d_'), obj.id.replace(/d_|j_|t_/,'t_'),TD);
	blink(obj.id.replace(/d_|j_|t_/,'j_'), obj.id.replace(/d_|j_|t_/,'t_'),TJ);
	
	// sum of dalit n janjati <= total
	
	blinkLtConst(obj.id.replace(/d_|j_|t_/,'t_'), getValueId(obj.id.replace(/d_|j_|t_/,'d_'))+getValueId(obj.id.replace(/d_|j_|t_/,'j_')),"Sum of Dalit and Janjati should be less or equal to total");
	
	blinkLarge(bLargeCheck.split(" "));
	
	return;

}

function bVRangeTotal(id){
	var d=document.forms[0];

	// total 1-5
	var item = id.substring(0,5);
	var tot=0;
	
	for (i=1;i<=5;++i){
		tot+=(d[item+'['+i+']'].value==''?0:parseInt(d[item+'['+i+']'].value));
	}
	
	if (tot>0) d[item+'_15'].value = tot;
	else d[item+'_15'].value = '';	
	
	
	// total 6-8
	tot=0;
	for (i=6;i<=8;++i){
		tot+=(d[item+'['+i+']'].value==''?0:parseInt(d[item+'['+i+']'].value));
	}
	
	if (tot>0) d[item+'_68'].value = tot;
	else d[item+'_68'].value = '';	
	
	// total 9-10
	tot=0;
	for (i=9;i<=10;++i){
		tot+=(d[item+'['+i+']'].value==''?0:parseInt(d[item+'['+i+']'].value));
	}
	
	if (tot>0) d[item+'_910'].value = tot;
	else d[item+'_910'].value = '';	

	// total  11 - 12
	tot=0;
	for (i=11;i<=12;++i){
		tot+=(d[item+'['+i+']'].value==''?0:parseInt(d[item+'['+i+']'].value));
	}
	
	if (tot>0) d[item+'_1112'].value = tot;
	else d[item+'_1112'].value = '';	
	

}

function a5V(obj){

	// smc pta validation
	
	fixYear(document.forms[0]['smc_y']);
	fixYear(document.forms[0]['pta_y']);
	
	blink('smc_tot_f','smc_tot_t',"Total female members should be less or equal to total");
	blink('smc_tot_d','smc_tot_t',"Total dalit members should be less or equal to total");
	blink('smc_tot_j','smc_tot_t',"Total janjati members should be less or equal to total");
	
	blinkLtConst('smc_tot_t',getValueId('smc_tot_d')+getValueId('smc_tot_j'),"Sum of dalit and janjati should be less or equal to total");

	blink('pta_tot_f','pta_tot_t',"Total female members should be less or equal to total");
	blink('pta_tot_d','pta_tot_t',"Total dalit members should be less or equal to total");
	blink('pta_tot_j','pta_tot_t',"Total janjati members should be less or equal to total");	
	
	blinkLtConst('pta_tot_t',getValueId('pta_tot_d')+getValueId('pta_tot_j'),"Sum of dalit and janjati should be less or equal to total");
	
	blinkConst('smc_m',12,"Month cant be greater than 12");
	blinkConst('smc_d',32,"Number of days should be less or equal to 32");
	
	blinkConst('pta_m',12,"Month cant be greater than 12");
	blinkConst('pta_d',32,"Number of days should be less or equal to 32");
	
	blinkConstRange('smc_y',currentYear-maxYearMinus,currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear));
	blinkConstRange('pta_y',currentYear-maxYearMinus,currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear));

}

function validatePage(){
	
	if (document.forms[0]['smc_y'].className!=''){
		alert("Please correct SMC year");
		document.forms[0]['smc_y'].focus();
		return false;
	}
	
	if (document.forms[0]['pta_y'].className!=''){
		alert("Please correct PTA year");
		document.forms[0]['pta_y'].focus();
		return false;
	}	
	
	return true;
}


