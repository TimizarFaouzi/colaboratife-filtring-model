
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function de vi form  historique                |             | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
   
     $('.VI-FORM').click(function(){
      $.ajax({
       url:"/VI_form_Notification"+$('#user_id').val(),
       method:"GET",
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       
        beforeSend:function(){
    
                         // $('.spinner-border ').css('display', 'block');
        },
        statusCode:{
                  04:function(){
                         alert("الصفحة غير موجودة يرجى المحاولة فيما بعد");
           },
                  401:function(){  
                         alert("غير مصرح لك");
    }
    
           },
    
        success:function(response)
         
        { 
        }
   })
    
    
});


  /*
     *********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function rest notification par chaque  1s      |             | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     *********************************************************************************|                                           */
    // sane(1)
     function sane(noti){
       
       for (let index = 0; index < noti; index++) {
        // var audio = new Audio('audio/harping-all-the-way-ringtone.mp3');
      // audio.play();
       }
     }
var i
var actin="true"
var vi="false"
setInterval(() => {
   fetch("/Show_Notification"+$('#user_id').val()).then(response=>response.json()).then(data=>{
      $('.notification-item-list').html("") 
     // alert(vi)
                      if (!data.number==0) {
                          $('.noti-icon-badge').html(data.number)
                        }else{
                         $('.noti-icon-badge').html("")
                        }
                           //alert(vi)
                         data.tablenotification.forEach((val,index)=>{
                           if (vi=="false") {
                              i=val.id
                              vi="true"
                              if (!data.number==0) {
                                 sane(data.number)
                              }
                            } 
                            //alert(i+" "+vi)
                                if (val.vi_form==null ) {
                                
                                    if (i<val.id) {
                                       vi="false"
                                       
                                      // i=val.id
                                      // var audio = new Audio('audio/i-did-it-message-tone.ogg');
                                      // audio.play(); 
                                    }
                                }
                                   var color=""
                                   if (val.vi_this==null ||val.vi_this==0) {
                                      color="text-danger"
                                       
                                      // var audio1 = new Audio('audio/harping-all-the-way-ringtone.mp3');
                                       //audio1.play();
                                   }else{
                                      color="text-secondary" 
                                      }
   
                               $('.notification-item-list').append('<a href="#" class="VI_This_noti dropdown-item notify-item " rel="'+val.id+'"onclick="vi_this('+val.id+')">'+
                               '<div class="notify-icon bg-success"><img src="public/profile/'+val.image+'" alt="user" class="rounded-circle notify-icon "></div>'+
                               '<p class="notify-details '+color+'"><b>'+val.name+'  Was evaluated on :</b><span class="text-muted">'+val.title+' '+val.created_at+' :  '+val.rating+' : étiole.</span></p>'+
                           '</a>')

                           
                                
                         
                        
                         })
                        
   })
}, 1000);


function vi_this(id){
   //alert(id)
  $(".content").load("/myProfile"+id); //code html table Historique
}

