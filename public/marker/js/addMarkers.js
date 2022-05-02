
 
 $(document).on('click', '.btn_update_marker', function (e) {
       e.preventDefault();
      alert($("#roteform").val());
      
      var all_datat=$("#Form_Marker :input").serializeArray();
      $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
        $.ajax({
            url:$("#roteform").val(),
            method: 'GET',
            data: all_datat,
               dataType: "json",
               beforeSand:function(){
                      
                      alert("جاري ارسال المعلومات");
                      //جاري ارسال المعلومات
               },
               statusCode:{
                      404:function(){
                             
                      alert("بيانات غير كاملة او صفحة غير موجود");
                             //بيانات غير كاملة او صفحة غير موجود
                      },
                      401:function(){
                      alert("تير مصرح لك");
                             //غير مصرح لك
                      }
               },
               success:function(data){
                      alert(data.message);
               },
               complete:function(){
                     
                   $(".content").load("listPoi");//code html table POI 
                   $(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI  
               }
        })
   })
   
   
   
   
   
   $('#Form_Marker').on('submit', function(event){
       event.preventDefault();
       alert( $("#roteform").val());
       $.ajax({
            url:"update-markers",
            method:"GET",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
               beforeSand:function(){
                      
                      alert("جاري ارسال المعلومات");
                      //جاري ارسال المعلومات
               },
               statusCode:{
                      404:function(){
                             
                      alert("بيانات غير كاملة او صفحة غير موجود");
                             //بيانات غير كاملة او صفحة غير موجود
                      },
                      401:function(){
                      alert("تير مصرح لك");
                             //غير مصرح لك
                      }
               },
               success:function(data){
                      alert(data.success);
               },
               complete:function(){
                     
                   //$(".content").load("listPoi");//code html table POI 
                   //$(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI  
               }
        })
   })