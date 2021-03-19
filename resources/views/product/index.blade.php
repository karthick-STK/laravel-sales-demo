<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <body>
    <div class="container">

   <div><h3>Product List</h3></div>

   <div style="float:right;"><a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="d-none d-sm-block"> Logout</span></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          </div> <br> <br>

    <div style="float:right;">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Add Product</button>
    <a href="{{url('/')}}/admin/dashboard"><button type="button" class="btn btn-info btn-lg" >Category List</button></a>
    </div>
   
   <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Category</th>
      <th scope="col">Action</th>      
    </tr>
  </thead>
  <tbody>
  <?php $i=1; ?>
  @foreach($product as $data)
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td>{{$data->name}}</td>
      <td>{{$data->price}}</td>
      <td>{{$data->category}}</td>
      <td class="text-truncate"><a class="primary edit mr-1"  id="{{$data->id}}" onclick = "product_edit(this.id);"><i class="glyphicon glyphicon-pencil"></i></a>
      <a class="danger delete mr-1" id="{{ $data->id}}" onclick="deletepro(this.id);" href="#"><i class="glyphicon glyphicon-trash"></i></a></td>     
    </tr>
    <?php $i++; ?>
  @endforeach  
  </tbody>
</table>
    </div> 

  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">

        <select class="form-select" aria-label="Default select example" id="p-cat">
          <option selected>Select Category</option>
          @foreach($datas as $data)
          <option value="{{$data->name}}">{{$data->name}}</option>
          @endforeach
        </select>
        <br><br>
            <label for="projectinput1"> Product Name<span style="color: red;font-size: large;"> *</span></label>
						<input type="text" id="p-name" class="form-control" placeholder="First Name" name="c_name">

            <label for="projectinput1"> Product Price<span style="color: red;font-size: large;"> *</span></label>
						<input type="text" id="p-price" class="form-control" placeholder="First Name" name="c_name">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addpro();">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>


 <!-- Modal -->
 <div class="modal fade" id="myModal11" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
       <div id="up_pr"></div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="update_product();">Update</button>
      </div>
    </div>
  </div>
</div>


   </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
 function addpro(){
        var cuser = $('meta[name="csrf-token"]').attr('content');
        var p_name=document.getElementById("p-name").value;
        var p_price=document.getElementById("p-price").value;
        var p_cat=document.getElementById("p-cat").value;      
      
         $.ajax({
            type:'post',
            url:'{{url('/')}}/products/store',
            data:{
              _token: "{{ csrf_token() }}",
              name:p_name,
              price:p_price,
              category:p_cat,
            },
            success:function(response){
                if(response.result=="success"){
                  location.reload();
                }
            }
         }); 
    }


    function product_edit(id){

      $.ajax({
            type:'post',
            url:'{{url('/')}}/products/edit/'+id,
            data:{
              _token: "{{ csrf_token() }}",              
            },
            success:function(response){
                if(response.result=="success"){                  
                  var x='';  
                  x+='<label for="projectinput1"> Product Name<span style="color: red;font-size: large;"> *</span></label>';
                  x+='<input type="text" id="pr-cat" class="form-control" value="'+response.product.category+'">';                   
                 
                  x+='<label for="projectinput1"> Product Name<span style="color: red;font-size: large;"> *</span></label>';
                  x+='<input type="text" id="pr-pr" class="form-control" value="'+response.product.name+'">';
                  x+='<label for="projectinput1"> Product Price<span style="color: red;font-size: large;"> *</span></label>';
                  x+='<input type="text" id="pr-price" class="form-control" Value="'+response.product.price+'" name="c_name">';  
                  x+='<input type="hidden" id="pro_id" value="'+response.product.id+'">';          
                  
              }
              document.getElementById("up_pr").innerHTML= x;
                $("#myModal11").modal();
            }
         }); 
    }



    function update_product(){
      
        var cuser = $('meta[name="csrf-token"]').attr('content'); 
        var id=document.getElementById("pro_id").value;
        var price=document.getElementById("pr-price").value;
        var cat=document.getElementById("pr-cat").value; 
        var pro=document.getElementById("pr-pr").value;      
         
         $.ajax({
            type:'post',
            url:'{{url('/')}}/products/update/'+id,
            data:{
              _token: "{{ csrf_token() }}",
              cate:cat,
              pro:pro,
              price:price,              
            },
            success:function(response){
                if(response.result=="success"){
                  location.reload();           
                }
                
            }
         }); 
      }   

    function deletepro(id){
        var cuser = $('meta[name="csrf-token"]').attr('content');      
         $.ajax({
            type:'post',
            url:'{{url('/')}}/products/delete/'+id,
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


</script>

</html>