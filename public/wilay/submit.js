$(document).on('click', '#saveWilayabd', function (e) {
    
              e.preventDefault();
              //alert();
              
      wilay.forEach((val,index)=>{
          if(wilay[index]!==null){
              //alert(val.name);
              //ajax
           
              var data = {
                            'name': val.name ,
                            'code':val.code,
                            'ar_name': val.ar_name,
                            'longitude':val.longitude,
                            'latitude':val.latitude
                        };
            
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
            
                        $.ajax({
                            type: "POST",
                            url: "/'Add-Wilaya",
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                    alert(response.message);
                                
                            }
                        });
             
          }
      });
      
      
      })