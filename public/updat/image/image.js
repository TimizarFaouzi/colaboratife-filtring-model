function getimg(input){
       var file=$('input[type=file]').get(0).files[0];
       if (file) {
           var reader=new FileReader();
           reader.onload =function(){
               $('#imgpho').attr('src',reader.result);
           }
           reader.readAsDataURL(file);
           
       }
   }
   
   function previewFile() {
   
       const preview =  document.getElementById("myImage");
       const file = document.getElementById("last_image").files[0];
       const reader = new FileReader();
     
       reader.addEventListener("load", function () {
         // convert image file to base64 string
         preview.src = reader.result;
       }, false);
     
       if (file) {
         reader.readAsDataURL(file);
       }
     }