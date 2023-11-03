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
                <h6><b>Category</b></h6>
            </div>
            <div class="col-xl-2 col-md-2 col-sm-12" style="float: right;">
                <button class="btn me-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">+Add Category</button>
            </div>
        </div>

        <div class="row xc-row">
            <div class="xc-parent-div">
                <div style=" background-color: #fff;padding: 1% 6% 0% 2%; text-align: right;">
                    {{-- <input type="text" class="inp-search" value="" id="search" name="search" placeholder="Search"> --}}
                </div>
                <table id="employlist" class="catetable">
                    <thead>
                        <tr>
                            <th class="sl no.">Sl No.</th>
                            <th class="category">Category</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
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
                    <h6 class="modal-title" id="staticBackdropLabel"><b>Add New Category</b></h6>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control modal-inp mb-1" name="name" id="name" placeholder="Categort Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn model-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn model-btn1" id="categorySave">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add employee-->
    <div class="modal fade" id="employeeedit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel"><b>Edit Category</b></h6>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <input type="hidden" id="edit_id" name="edit_id">
                            <input type="text" class="form-control modal-inp mb-1" name="edit_name" id="edit_name" placeholder="Name">
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
      var table = $('.catetable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('list_cat') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'category_name', name: 'category_name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
</script>
<script>
    $('#categorySave').on('click',function(){
        var _token = $("input[name=_token]").val();
        var name = $('#name').val();
            $.ajax({
                url: "{{route('category.store')}}",
                type: 'post',
                data: {name: name,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#name').val(" ");

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

    function deletemploye(id){
        $('#delet_id').val(id);
        $('#deletemodal').modal('show');
    }

    $('#yes').on('click',function(){
        var id = $('#delet_id').val();
        var _token = $("input[name=_token]").val();

        
        var url = "{{ route('category.destroy',":id") }}";
            url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'delete',
            data: {id:id,_token:_token},
            dataType: 'json',
            success: function (response) {
                if(response.status == 'true'){
                    $('#cat'+response.id).remove();
                    $('#deletemodal').modal('hide');
                }
            }
        });
    });

    function editCategory(id){
        var _token = $("input[name=_token]").val();
        
            var url = "{{ route('category.edit',":id") }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'get',
                data: {_token:_token},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(response.status == 'true'){
                        alert(122);
                        $('#edit_name').val(response.category.category_name);
                        $('#edit_id').val(response.category.id);
                        $('#employeeedit').modal('show');
                    }
                }
            });
    }

    $('#employeUpdate').on('click',function(){
        var _token = $("input[name=_token]").val();
        var name = $('#edit_name').val();
        var id = $('#edit_id').val();

            var url = "{{ route('category.update',":id") }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: 'patch',
                data: {id:id,name: name,_token:_token},
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'true'){
                        $('#edit_name').val(" ");
                        $('#edit_id').val(" ");

                        $('#employeeedit').modal('hide');
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

    $('#search').on('input',function(){
        var value = $(this).val();
        var _token = $("input[name=_token]").val();
        $.ajax({
            url: "{{route('category.store')}}",
            type: 'get',
            data: {value:value,_token:_token},
            dataType: 'json',
            success: function (response) {
                if(response.status == 'true'){
                    var itemDetails = '';
                        var i = 0;
                        $.each(response.employees, function (i, itemDetail){
                            i = i + 1;
                            itemDetails += '<tr class="table-custom" id="emp'+itemDetail.id+'">';
                            itemDetails += '<td>' + i + '</td>' ;
                            itemDetails += '<td>' + itemDetail.employee_id + '</td>' ;
                            itemDetails += '<td>' + itemDetail.employee_name + '</td>' ;
                            itemDetails += '<td>' + itemDetail.employee_designation + '</td>' ;
                            itemDetails += '<td>' + itemDetail.employee_salary + '</td>' ;
                            itemDetails += '<td>' + itemDetail.employee_target + '</td>' ;
                            // itemDetails += '<td> \<input type="button" class="btn-popup-pd plus" data-id=" '+itemDetail.id +'" value="+">\</td>'
                            itemDetails += '<td> \<div><i style="font-size: 16px;margin: 0px 5px;color: #00C708;" data-bs-toggle="modal"  onclick="modalincome('+itemDetail.id+');" class="bi bi-currency-rupee"></i><i style="font-size: 16px;margin: 0px 5px;color: #4E9AFF;" class="bi bi-pencil-fill" onclick="editemploye('+itemDetail.id+')"></i> <i style="font-size: 16px;margin: 0px 5px;color: #FF5F5F;" class="bi bi-trash-fill" onclick="deletemploye('+itemDetail.id+')"></i> </div>\</td>'
                            itemDetails += '</tr>';
                        });
                        $('#employlist tbody').html(itemDetails);
                }
            }
        });
    });
</script>
@endsection