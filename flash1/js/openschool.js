function handleChange(obj){
    var d=document.forms[0];
    var row=obj.name.substring(0,5);
    
    if(row=="lsec1" || row=="lsec2" || row=="secon")
    {
        var column=obj.name.substring(6,7);
        var sex=obj.name.substring(8,9);
        var i1,i2;
        
         
        if(d[row+'_'+column+'_m'].value)
            i1=parseInt(d[row+'_'+column+'_m'].value);
        else
            i1=0;
        if(d[row+'_'+column+'_f'].value)
            i2=parseInt(d[row+'_'+column+'_f'].value);
        else
            i2=0;
        if((i1+i2)!==0)
            d[row+'_'+column+'_t'].value=i1+i2;
        
        //turn red when dalit or janajati is greater than total
        blinkLtConst(row+'_1_'+sex,getValue(d[row+'_2_'+sex].value)+getValue(d[row+'_3_'+sex].value),'Sum of Dalit and Janjati should be less or equal to total.');        
    }
    else if(row=="total" || row=="dalit" || row=="janaj")
    {
        var sum=0;
        for(var i=1;i<11;i++)
        {
            //turn red when dalit or janajati is greater than total
            blinkLtConst('total_'+i,getValue(d['dalit_'+i].value)+getValue(d['janaj_'+i].value),'Sum of Dalit and Janjati should be less or equal to total.');        
            
            if(d[row+"_"+i].value!="")
                sum+=getValue(d[row+"_"+i].value);
        }
        if(sum!==0)
            d[row+"_11"].value=sum;
    }
}
