<!DOCTYPE html>
<html>
<head>
<title>REST API</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="jquery.js"></script> -->
</head>
<body>

    <div class="container">
        <br />
        <h3 align="center">REST API</h3>
        <br />
        <div align="right" style="margin-bottom:5px;">
            <button type="button" name="add_button" id="add_button"
            class="btn btn-success btn-xs">ADD</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><center>NO</center></th>
                        <th><center>NIK</center></th>
                        <th><center>NAMA</center></th>
                        <th><center>NO TELP</center></th>
                        <th><center>ALAMAT</center></th>
                        <th><center>EDIT</center></th>
                        <th><center>DELETE</center></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="api_crud_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Data</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>NAMA</label>
                            <input type="text" name="nama" id="nama" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>NO TELP</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>ALAMAT</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" />
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="insert" />
                    <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</diV>

<script type="text/javascript">
    $(document).ready(function(){

        fetch_data();

        function fetch_data(){
            $.ajax({
                url: 'fetch.php',
                success:function(data){
                    $('tbody').html(data);
                }
            })
        }

        $('#add_button').click(function(){
            $('#action').val('insert');
            $('#button_action').val('Insert'); 
            $('.modal-title').text('Add Data');
            $('#apicrudModal').modal('show');
        });

        $('#api_crud_form').on('submit', function(event){
            event.preventDefault();
            if($('#nik').val() == ''){
                alert("Enter NIK");
            }
            else if($('#nama').val() == ''){
                alert("Enter Your Name");
            }
            else if($('#no_telp').val() == ''){
                alert("Enter Your No Telp");
            }
            else if($('#alamat').val() == ''){
                alert("Enter Your Address");
            }
            else{
                var form_data = $(this).serialize();
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:form_data,
                    success:function(data){
                        fetch_data();
                        $('#api_crud_form')[0].reset();
                        $('#apicrudModal').modal('hide');
                        if(data == 'insert'){
                            alert("Data telah dimasukkan menggunakan PHP API");
                        }
                        if(data == 'update'){
                            alert("Data telah terubah menggunakan PHP API");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            var action = 'fetch_single';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:"id="+id+"&action="+action,
                dataType:"json",
                success:function(result){
                    $('#hidden_id').val(id);
                    $('#nik').val(result.nik);
                    $('#nama').val(result.nama);
                    $('#no_telp').val(result.no_telp);
                    $('#alamat').val(result.alamat);
                    $('#action').val('update');
                    $('#button_action').val('Update');
                    $('.modal-title').text('Edit Data');
                    $('#apicrudModal').modal('show');
                }
            })
        }); 

        $(document).on('click', '.delete', function(){
            var id = $(this).attr('id');
            var action = 'delete';
            if(confirm("Apakah Anda yakin ingin menghapusnya?")){
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:"id="+id+"&action="+action,
                    success:function(result){
                        fetch_data();
                        alert("Data telah terhapus");
                    }
                })
            }
        }); 

    });


</script>