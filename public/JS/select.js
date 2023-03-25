function populate(s1,s2){
 let s1=document.getElementById('s1');
 let s2=document.getElementById('s2');
 s2.value="";
 if(s1.value =="Kigali"){
     let optionArray=['nyarugenge|Nyarugenge','kicukiro|Kicukiro','gasabo|Gasabo'];
 }

 for(option in optionArray){
    let pair=optionArray[option].split("|");
    let newOption=document.createElement("option");
    newOption.value=pair[0];
    newOption.innerHTML=pair[1];
    s2.options.add(newOption);
 }
}