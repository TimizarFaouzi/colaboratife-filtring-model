<script type="text/javascript">
                    
              $('#ajax-crud-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('ajax-crud-datatable-users') }}",
                  columns: [
                              { data: 'id', name: 'id' },
                              {data: 'image', name: 'image'},
                              { data: 'name', name: 'name'},
                              {data: 'email', name: 'email'},
                  {data: 'action', name: 'action',
                  orderable: true, 
                  searchable: true},
                  ]
                  });
              </script>