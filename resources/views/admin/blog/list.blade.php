@extends('layouts.app')

@section('contant')

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
                <h6><b>Blogs</b></h6>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12" style="float: right;">
                <button class="btn me-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+Add Blog</button>
            </div>
        </div>

        <div class="row xc-row">
            <div class="xc-parent-div">
                <div style=" background-color: #fff;padding: 1% 6% 0% 2%; text-align: right;">
                    {{-- <input type="text" class="inp-search" value="" id="search" name="search" placeholder="Search"> --}}
                </div>
                <table id="employlist" class="blogtable">
                    <thead>
                        <tr>
                            <th class="sl no.">Sl No.</th>
                            <th class="name">Name</th>
                            <th class="datee">Date</th>
                            <th class="salary">Author</th>
                            <th class="salary">Content</th>
                            <th class="salary">Image</th>
                            <th class="salary">Action</th>
                        </tr>
                        <img src="" alt="">
                    <tbody>
                    </tbody>
                </table>
                <div id='table_warp' class='clearfix'> </div>
            </div>
        </div>
    </section>

    <!-- Modal Add Blog-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel"><b>Add New Blog</b></h6>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-1" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-1" name="author" id="author" placeholder="Author">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-8 col-md-8 col-sm-12">
                            <textarea class="form-control modal-inp mb-1" style="height: 16vh;" name="content" id="content" placeholder="content"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="file" class="form-control modal-inp mb-1" name="image" id="image" placeholder="image">
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input placeholder="Date" class="form-control mb-1 date" name="date" id="date" type="text"  onfocus="(this.type = 'date')">
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
                    <h6 class="modal-title" id="staticBackdropLabel"><b>Edit Employee</b></h6>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="hidden" id="edit_id" name="edit_id">
                            <input type="text" class="form-control modal-inp mb-1" name="edit_name" id="edit_name" placeholder="Name">
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-1" name="edit_author" id="edit_author" placeholder="Author">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-8 col-md-8 col-sm-12">
                            <textarea class="form-control modal-inp mb-1" style="height: 16vh;" name="edit_content" id="edit_content" placeholder="content"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="file" class="form-control modal-inp mb-1" name="edit_image" id="edit_image" placeholder="image">
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input placeholder="Date" class="form-control mb-1 date" name="edit_date" id="edit_date" type="text"  onfocus="(this.type = 'date')">
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
      var table = $('.blogtable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('list_blog') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'Name', name: 'Name'},
              {data: 'Date', name: 'Date'},
              {data: 'Author', name: 'Author'},
              {data: 'Content', name: 'Content'},
              {data: 'imagecostum', name: 'image'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
  </script>
<script>
$('#employeSave').on('click', function () {
    var _token = $("input[name=_token]").val();
    var name = $('#name').val();
    var author = $('#author').val();
    var content = $('#content').val();
    var image = $("#image")[0].files[0]; // Get the file input element

    var date = $('#date').val();

    var formData = new FormData(); // Create a FormData object
    formData.append('name', name);
    formData.append('author', author);
    formData.append('content', content);
    formData.append('image', image);
    formData.append('date', date);
    formData.append('_token', _token);

    $.ajax({
        url: "{{ route('blog.store') }}",
        type: 'post',
        data: formData, // Use the FormData object as the data
        contentType: false, // Set content type to false
        processData: false, // Set processData to false
        dataType: 'json',
        success: function (response) {
            if (response.status == 'true') {
                $('#name').val(" ");
                $('#author').val(" ");
                $('#content').val(" ");
                $('#image').val(" ");
                $('#date').val(" ");

                $('#staticBackdrop').modal('hide');
                location.reload();
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

    function modalincome(id){
        $('#id').val(id);
        $('#staticBackdrop1').modal('show');
    }


    function deletblog(id){
        $('#delet_id').val(id);
        $('#deletemodal').modal('show');
    }

    $('#yes').on('click',function(){
        var id = $('#delet_id').val();
        var _token = $("input[name=_token]").val();
                
        var url = "{{ route('blog.destroy',":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'delete',
            data: {id:id,_token:_token},
            dataType: 'json',
            success: function (response) {
                if(response.status == 'true'){
                    $('#blog'+response.id).remove();
                    $('#deletemodal').modal('hide');
                }
            }
        });
    });

    function editblog(id){
        var _token = $("input[name=_token]").val();
                
        var url = "{{ route('blog.edit',":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'get',
                data: {id:id,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#edit_id').val(response.blog.id);
                        $('#edit_name').val(response.blog.Name);
                        $('#edit_author').val(response.blog.Author);
                        $('#edit_content').val(response.blog.Content);
                        $('#edit_date').val(response.blog.Date);

                        $('#employeeedit').modal('show');
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
    }

    $('#employeUpdate').on('click',function(){
        var _token = $("input[name=_token]").val();
        var name = $('#edit_name').val();
        var author = $('#edit_author').val();
        var content = $('#edit_content').val();
        // var image = $('#edit_image').val();
        var date = $('#edit_date').val();
        var id = $('#edit_id').val();

        var image = $("#edit_image")[0].files[0]; // Get the file input element
        // var formData = new FormData(); // Create a FormData object
                
        var url = "{{ route('blog.update',":id") }}";
        url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'patch',
                data: {name: name,author:author,content:content,image:image,date:date,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#edit_name').val(" ");
                        $('#edit_author').val(" ");
                        $('#edit_content').val(" ");
                        $('#edit_date').val(" ");
                        $('#edit_id').val(" ");

                        $('#employeeedit').modal('hide');
                        location.reload();
                    }
                },
                error:function(xhr,status,error){
                    alert(status);
                }
            });
    });
</script>
@endsection