@extends('layouts.app')

@section('contant')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    @media screen and (max-width: 1000px) {
        .xc-row {
            overflow-x: scroll;
        }

        .xc-parent-div {
            min-width: 1000px;

        }
    }
</style>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row mb-2">
            <div class="col-xl-10 col-md-10 col-sm-12">
                <h6><b>Manage User</b></h6>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12" style="float: right;">
                <button class="btn me-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+Add User</button>
            </div>
        </div>

        <div class="row xc-row">
            <div class="xc-parent-div">
                <div style=" background-color: #fff;padding: 1% 6% 0% 2%; text-align: right;">
                    {{-- <input type="text" class="inp-search" value="" id="search" name="search" placeholder="Search"> --}}
                </div>
                <table id="employlist" class="usertable">
                    <thead>
                        <tr>
                            <th class="sl no.">Sl No.</th>
                            <th class="name">Name</th>
                            <th class="designation">Email id</th>
                            <th class="salary">Contact</th>
                            <th class="salary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                    </tbody>
                </table>
                <div id='table_warp' class='clearfix'> </div>
            </div>
        </div>
    </section>

    <!-- Modal Add employee-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel"><b>Add New User</b></h6>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-1" name="name" id="name" placeholder="Name" required>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="email" class="form-control modal-inp mb-1" name="email" id="email" placeholder="Email ID" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-3" name="contact" id="contact" placeholder="Phone No." required>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-3" name="password" id="password" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn model-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn model-btn1" id="employeSave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add employee-->
    <div class="modal fade" id="employeeedit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel"><b>Edit User</b></h6>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="hidden" id="edit_id" name="edit_id">
                            <input type="text" class="form-control modal-inp mb-1" name="edit_name" id="edit_name" placeholder="Name">
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="email" class="form-control modal-inp mb-1" name="edit_email" id="edit_email" placeholder="Email ID">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-3" name="edit_contact" id="edit_contact" placeholder="Phone No.">
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-3" name="edit_password" id="edit_password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn model-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn model-btn1" id="employeUpdate">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!--delete Modal -->
    <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel"><b></b></h6>
            </div>
            <div class="modal-body">
                <div class="row mb-3" style="text-align: center;font-size: 20px;">
                    <input type="hidden" name="delet_id" id="delet_id">
                    <label><b>Are you sure you want to remove</b></label><br>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn model-btn1" id="yes" style="padding: 8px 30px;">Yes</button>
                <button type="button" class="btn model-btn" data-bs-dismiss="modal" aria-label="Close" style="padding: 8px 30px;">No</button>
            </div>
        </div>
    </div>

</main><!-- End #main -->
    
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {

      var table = $('.usertable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('list') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'contact', name: 'contact'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
</script>
<script>
    $('#employeSave').on('click',function(){
        var _token = $("input[name=_token]").val();
        var name = $('#name').val();
        var email = $('#email').val();
        var contact = $('#contact').val();
        var password = $('#password').val();
            $.ajax({
                url: "{{route('user.store')}}",
                type: 'post',
                data: {name:name,email:email,contact:contact,password:password,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#name').val(" ");
                        $('#email').val(" ");
                        $('#contact').val(" ");
                        $('#password').val(" ");

                        $('#staticBackdrop').modal('hide');
                                        
                        var table = $('.usertable').DataTable();
                        table.ajax.reload();
                    }
                },
                error:function(xhr,status,error){
                    // alert(status);
                    console.log(JSON.parse(xhr.responseText).errors);
                    var errordata = JSON.parse(xhr.responseText).errors;
                    var errorMessages = {};

                        if (errordata) {
                            for (var key in errordata) {
                                if (errordata.hasOwnProperty(key)) {
                                    errorMessages[key] = errordata[key].join(" ");
                                }
                            }
                        }
                        $.each(errorMessages, function (key,value){

                        alert(value);
                        });
                }
            });
    });

    function deletemploye(id){
        $('#delet_id').val(id);
        $('#deletemodal').modal('show');
    }

    $('#yes').on('click',function(){
        var id = $('#delet_id').val();
        var _token = $("input[name=_token]").val();
                
        var url = "{{ route('user.destroy',":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'delete',
            data: {id:id,_token:_token},
            dataType: 'json',
            success: function (response) {
                if(response.status == 'true'){
                    // $('#emp'+response.id).remove();
                    $('#deletemodal').modal('hide');
                                    
                    var table = $('.usertable').DataTable();
                    table.ajax.reload();
                }
            }
        });
    });

    function editemploye(id){
        var _token = $("input[name=_token]").val();
                
        var url = "{{ route('user.edit',":id") }}";
        url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'get',
                data: {id:id,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#edit_id').val(response.user.id);
                        $('#edit_name').val(response.user.name);
                        $('#edit_email').val(response.user.email);
                        $('#edit_contact').val(response.user.contact);

                        $('#employeeedit').modal('show');
                    }
                }
            });
    }

    $('#employeUpdate').on('click',function(){
        var _token = $("input[name=_token]").val();
        var name = $('#edit_name').val();
        var email = $('#edit_email').val();
        var contact = $('#edit_contact').val();
        var password = $('#edit_password').val();
        var id = $('#edit_id').val();
        
        var url = "{{ route('user.update',":id") }}";
        url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'patch',
                data: {id:id,name: name,email:email,contact:contact,password:password,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#edit_name').val(" ");
                        $('#edit_email').val(" ");
                        $('#edit_contact').val(" ");
                        $('#edit_password').val(" ");
                        $('#edit_id').val(" ");

                        $('#employeeedit').modal('hide');
                                        
                        var table = $('.usertable').DataTable();
                        table.ajax.reload();
                    }
                },
                
                error:function(xhr,status,error){
                    // alert(status);
                    console.log(JSON.parse(xhr.responseText).errors);
                    var errordata = JSON.parse(xhr.responseText).errors;
                    var errorMessages = {};

                        if (errordata) {
                            for (var key in errordata) {
                                if (errordata.hasOwnProperty(key)) {
                                    errorMessages[key] = errordata[key].join(" ");
                                }
                            }
                        }
                        $.each(errorMessages, function (key,value){

                        alert(value);
                        });
                }
            });
    });
</script>
@endsection

