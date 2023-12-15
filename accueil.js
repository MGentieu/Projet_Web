//document.cookie = "test1=1; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";
//document.cookie = "test2=2; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";
function jaime(el){
        var id=el.id;
        var val=el.value;
        var span_id=el.name;
        var span_el=document.getElementById(el.name);
        var span_value=span_el.innerHTML;
        var cookie_name="";
        
        if(span_id==1){
                //el.innerHTML=span_value;
                cookie_name="test1";
        }
        if(span_id==2){
                //el.innerHTML=span_value;
                cookie_name="test2";
        }
        if(val==0){
                el.value=1;
                span_value++;
                var new_id="2"+id.substring(1);
                var new_el= document.getElementById(new_id);
                new_el.value=0;
                new_el.style.backgroundColor="white";
                el.style.backgroundColor="blue";
        }
        else{
                el.value=0;
                span_value--;
                el.style.backgroundColor="white";
        }
        document.cookie = cookie_name+"="+span_value+"; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";

}

function jaimepas(el){
        var id=el.id;
        var val=el.value;
        if(val==0){
                el.value=1;
                span_value--;
                var new_id="1"+id.substring(1);
                var new_el= document.getElementById(new_id);
                new_el.value=0;
                new_el.style.backgroundColor="white";
                el.style.backgroundColor="blue";
        }
        else{
                el.value=0;
                span_value++;
                el.style.backgroundColor="white";
        }
        document.cookie = cookie_name+"="+span_value+"; expires=" + new Date(new Date().getTime() + 3600 * 1000).toUTCString() + "; path=/";
}