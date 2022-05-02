
$(document).ready( function () {
              $.ajaxSetup({
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              });
              function add(){
              $('#CompanyForm').trigger("reset");
              $('#CompanyModal').html("Add Company");
              $('#company-modal').modal('show');
              $('#id').val('');
              }   
              function editFunc(id){
              $.ajax({
              type:"POST",
              url: "{{ url('edit-company') }}",
              data: { id: id },
              dataType: 'json',
              success: function(res){
              $('#CompanyModal').html("Edit Company");
              $('#company-modal').modal('show');
              $('#id').val(res.id);
              $('#name').val(res.tetle);
              $('#address').val(res.lat);
              $('#email').val(res.lng);
              }
              });
              }  
              function deleteFunc(id){
              if (confirm("Delete Record?") == true) {
              var id = id;
              // ajax
              $.ajax({
              type:"POST",
              url: "{{ url('delete-company') }}",
              data: { id: id },
              dataType: 'json',
              success: function(res){
              var oTable = $('#ajax-crud-datatable').dataTable();
              oTable.fnDraw(false);
              }
              });
              }
              }
              $('#CompanyForm').submit(function(e) {
              e.preventDefault();
              var formData = new FormData(this);
              $.ajax({
              type:'POST',
              url: "{{ url('store-company')}}",
              data: formData,
              cache:false,
              contentType: false,
              processData: false,
              success: (data) => {
              $("#company-modal").modal('hide');
              var oTable = $('#ajax-crud-datatable').dataTable();
              oTable.fnDraw(false);
              $("#btn-save").html('Submit');
              $("#btn-save"). attr("disabled", false);
              },
              error: function(data){
              console.log(data);
              }
              });
              });