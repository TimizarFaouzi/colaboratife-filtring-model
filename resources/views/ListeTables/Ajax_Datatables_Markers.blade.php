<script type="text/javascript">
foreacheData()
   $('#modelDelet-form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"deletemarkers",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   
beforeSend:function(){

    $('.spinner-border ').css('display', 'block');
},
statusCode:{
404:function(){
                alert("الصفحة غير موجودة يرجى المحاولة فيما بعد");
			  },
401:function(){  
                alert("غير مصرح لك");
			  }
			  
           },
		
   success:function(data)
   {
       $("#exampleModalCenter").modal('fade');
   // foreacheData()
   }/**,
   complete:function(){
    foreacheData()
        }*/
  })
 });




       $(document).on('click', '.delete-Marker', function (e) {
            e.preventDefault();

           $.ajax({
        type: "GET",
        url: "/editmarkers"+$(this).val(),
        dataType: "json",
        success: function (response) {
            if (response.status == 404) {
            } else {
              $(".Title").html( response.markers.tetle);      
                $("#idm").val(response.markers.id);
                document.getElementById("image_marker").src = 'public/marker/'+response.markers.image;
               var  map = L.map('maps').setView([response.markers.lat,response.markers.lng], 13);
                           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                          }).addTo(map);
                          
                  var marker = new L.marker([response.markers.lat,response.markers.lng])
                  .bindPopup(response.markers.tetle).addTo(map);
               }
        }
    });



}); 
function foreacheData(){
                    
$('#ajax-crud-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('ajax-crud-datatable-markers') }}",
    columns: [
                { data: 'id', name: 'id' },
                { data: 'tetle', name: 'tetle'},
                {data: 'lat', name: 'lat'},
                {data: 'lng', name: 'lng'},
                {data: 'imagePOI', name: 'imagePOI'},
                {data: 'nb_visited', name: 'nb_visited'},
    {data: 'action', name: 'action',
    orderable: true, 
    searchable: true},
    ]
    });
}
</script>