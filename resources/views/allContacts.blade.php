<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Lajax</title>
  </head>
  <body>
    

    <div class="container" style="margin-top:50px;">
        <a onclick="addContact()" class="btn btn-success" style="float: right; margin:15px;">Add Contact</a>
        <table id="allContacts" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>  
        @include('form')   
    </div>


    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script> -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    
    <script>
        // read all contact with yajra
        var allContacts = $('#allContacts').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('all.contacts') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data:'action', name:'action', orderable: false, searchable: false}
            ]
        });

        // display modal form
        function addContact() {
            save_method= 'add';
            $('input[name=_method]').val('POST');
            $('#showModal').modal('show');
            $('#showModal form')[0].reset();
            $('#modalTitle').text('Add New Contact');
            $('#modalSubmit').text('Save');
        }

        // insert contact
        $(function() {
            $('#showModal form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    // var 
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('contacts') }}";
                    else url = "{{ url('contacts') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
                        data: new FormData($("#showModal form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#showModal').modal('hide');
                            allContacts.ajax.reload();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Contact Has Been Added',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error : function(data){
                            swal.fire({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });

        // edit single contact details
       function editData(id) {
          save_method = 'edit';
          $('input[name=_method]').val('PATCH');
          $('#showModal form')[0].reset();
          $.ajax({
              url: "{{ url('contacts') }}" + '/' + id + "/edit",
              type: "GET",
              dataType: "JSON",
             success: function(data) {
                $('#showModal').modal('show');
                $('#modalTitle').text('Edit Contact Details');
                $('#modalSubmit').text('Save Changes');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
            },
            error : function() {
                alert("Data Not Found");
            }
          });
        }

    </script>

  </body>
</html>