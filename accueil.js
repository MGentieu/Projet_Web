//document.cookie = "test1=1; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";
//document.cookie = "test2=2; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";
function jaime(el){
        var id=el.id;
        var val=el.value;
        if(val==0){
                el.value=1;
                
                //el.name=id;
                //el.innerHTML=id;
                
                
                var new_id="2"+id.substring(1);
                var new_el= document.getElementById(new_id);
                new_el.value=0;
                new_el.style.backgroundColor="white";
                el.style.backgroundColor="blue";
                //el.innerHTML=id;
        }
        else{
                el.value=0;
                //el.name=id;
                el.style.backgroundColor="white";
        }
        //el.innerHTML="name : "+name;
}

function jaimepas(el){
        var id=el.id;
        var val=el.value;
        if(val==0){
                el.value=1;
                //el.name=id;
                
                
                var new_id="1"+id.substring(1);
                var new_el= document.getElementById(new_id);
                new_el.value=0;
                new_el.style.backgroundColor="white";
                
                //el.innerHTML=new_id;
                el.style.backgroundColor="blue";
        }
        else{
                el.value=0;
                //el.name=id;
                el.style.backgroundColor="white";
        }
        //el.innerHTML="name : "+name;
}