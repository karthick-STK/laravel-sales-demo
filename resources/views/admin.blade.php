<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <body>
    <div class="container">

   <div><h3>Categories List</h3></div>


   <div style="float:right;"><a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="d-none d-sm-block"> Logout</span></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          </div>

          <br><br>

    <div style="float:right;">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Category</button>
    <a href="{{url('/')}}/products"><button type="button" class="btn btn-info btn-lg" >Product List</button></a>
    </div>
   
   <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>      
    </tr>
  </thead>
  <tbody>
  <?php $i=1; ?>
  @foreach($datas as $data)
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td>{{$data->name}}</td>
      <td class="text-truncate"><a class="primary edit mr-1" id="{{$data->id}}" onclick="editcat(this.id);"><i class="glyphicon glyphicon-pencil"></i></a>
      <a class="danger delete mr-1" id="{{ $data->id}}" onclick="deletecat(this.id);" href="#"><i class="glyphicon glyphicon-trash"></i></a></td>     
    </tr>
    <?php $i++; ?>
  @endforeach  
  </tbody>
</table>
    </div> 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Category</h4>
        </div>
        <div class="modal-body">
            <label for="projectinput1"> Category Name<span style="color: red;font-size: large;"> *</span></label>
						<input type="text" id="c-name" class="form-control" placeholder="First Name" name="c_name">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addcat();">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Category</h4>
        </div>
        <div class="modal-body">
            <label for="projectinput1"> Category Name<span style="color: red;font-size: large;"> *</span></label>
						<div id="edi_ca"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="update_cat();">Update</button>
        </div>
      </div>
    </div>
  </div>
</div>

   </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
 function addcat(){
        var cuser = $('meta[name="csrf-token"]').attr('content');
        var c_name=document.getElementById("c-name").value;
      
         $.ajax({
            type:'post',
            url:'{{url('/')}}/admin/addcat',
            data:{
              _token: "{{ csrf_token() }}",
              name:c_name,
            },
            success:function(response){
                if(response.result=="success"){
                  location.reload();
                }
            }
         }); 
    }

    function deletecat(id){
        var cuser = $('meta[name="csrf-token"]').attr('content');      
         $.ajax({
            type:'post',
            url:'{{url('/')}}/admin/delcat/'+id,
            data:{
              _token: "{{ csrf_token() }}",              
            },
            success:function(response){
                if(response.result=="success"){
                  location.reload();
                }
            }
         }); 
      }   

      function editcat(id){
        var cuser = $('meta[name="csrf-token"]').attr('content');      
         $.ajax({
            type:'post',
            url:'{{url('/')}}/admin/editcat/'+id,
            data:{
              _token: "{{ csrf_token() }}",              
            },
            success:function(response){
                if(response.result=="success"){
                  var x=response.data.name;                  
                  x+='<input type="text" id="'+response.data.id+'" class="form-control" name ="ass_cat" value="'+response.data.name+'">';           
                }
                document.getElementById("edi_ca").innerHTML= x;
                $("#myModal1").modal();
            }
         }); 
      }   


      function update_cat(){
        var cuser = $('meta[name="csrf-token"]').attr('content'); 
        var name =  $('[name="ass_cat"]').val();
        var id =  $('[name="ass_cat"]').attr('id');     
         $.ajax({
            type:'post',
            url:'{{url('/')}}/admin/updatecat/'+id,
            data:{
              _token: "{{ csrf_token() }}",
              name:name,              
            },
            success:function(response){
                if(response.result=="success"){
                  location.reload();           
                }
                
            }
         }); 
      }   

</script>

</html>