<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <body>
    <div class="container">

   <div><h3>Emplyer Dashboard</h3></div>
   <div style="float:right;"><a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="d-none d-sm-block"> Logout</span></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          </div>
   <br><br>   
   <form method="post" action="{{url('/')}}/emp/addsale">
   @csrf
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-12">
        <select class="select2 form-control block" id="p_cate" name="category" onchange="get_pro();">
          <optgroup>
              <option selected>Select Category</option>
              @foreach($datas as $data)
              <option value="{{$data->name}}">{{$data->name}}</option>
              @endforeach				 
          </optgroup>
        </select>
      </div>   
      <div class="col-xl-3 col-lg-3 col-12">
        <select class="select2 form-control block" id="p_prod" name="price" onchange="get_pr_name();">          
        </select>
      </div>   
      <input type="hidden"  class="form-control" id="c_pr" placeholder="qty" name="pr_name" value="">
      <div class="col-xl-2 col-lg-2 col-12">          
					<input type="text" id="p-qty" class="form-control" placeholder="qty" name="qty" oninput="get_tot();">
          
      </div>   
      <div class="col-xl-2 col-lg-2 col-12">      
					<input type="text" id="p-tot" class="form-control" placeholder="Total"  name="tot" value="">
      </div>   
      <div class="col-xl-2 col-lg-2 col-12">      
      <button type="submit" class="btn btn-info btn-md">sale</button>
      </div> 
    </div>
    </form>
    <br>
    <div><h3>Sales Product List</h3></div><br>
   <table class="table">
  <thead class="thead-dark">
      <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>  
      <th scope="col">Total</th>  
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=1; ?>
  @foreach($employer as $data)
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td>{{$data->p_name}}</td>
      <td>{{$data->p_cat}}</td>
      <td>{{$data->qty}}</td>
      <td>{{$data->p_price}}</td>
      <td>{{$data->total}}</td>
      <td class="text-truncate"><a class="primary edit mr-1" id="{{ $data->id}}" onclick="sale_edit(this.id);"><i class="glyphicon glyphicon-pencil"></i></a>
      <a class="danger delete mr-1" id="{{ $data->id}}" onclick="deletesale(this.id);" href="#"><i class="glyphicon glyphicon-trash"></i></a></td>     
    </tr>
    <?php $i++; ?>
  @endforeach  
  </tbody>
</table>
    </div>   




    <!-- Modal -->
 <div class="modal fade" id="myModal12" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
       <div id="sal_pr"></div>
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
 function get_pro(){
        var cuser = $('meta[name="csrf-token"]').attr('content');
        var cate=document.getElementById("p_cate").value;
        var x='';
         $.ajax({
            type:'post',
            url:'{{url('/')}}/emp/getcat',
            data:{
              _token: "{{ csrf_token() }}",
              name:cate,
            },
            success:function(response){
              
                if(response.result=="success"){                  
                  x+='<optgroup>';
                  x+='<option selected>Select Product</option>';
                  for(i in response.category){
                  x+='<option value="'+response.category[i].price+'">'+response.category[i].name+'</option>';
                  }
                  x+='</optgroup>';              
                                     
                }
               document.getElementById('p_prod').innerHTML = x; 
            }
         }); 
    }
    
    function get_pr_name(){      
     var xx=  $("#p_prod option:selected").text();     
     document.getElementById("c_pr").value = xx;

    }
    function get_tot(){

      var price = document.getElementById("p_prod").value;
      var qty = document.getElementById("p-qty").value;
      var tot = price * qty;
      document.getElementById("p-tot").value = tot;      
    }




    function sale_edit(id){

$.ajax({
      type:'post',
      url:'{{url('/')}}/emp/edit/'+id,
      data:{
        _token: "{{ csrf_token() }}",              
      },
      success:function(response){
          if(response.result=="success"){                  
            var x='';  
            x+='<label for="projectinput1"> Product Name<span style="color: red;font-size: large;"> *</span></label>';
            x+='<input type="text" id="e-pr" class="form-control" value="'+response.sale.p_name+'">';             
           
            x+='<label for="projectinput1"> Category Name<span style="color: red;font-size: large;"> *</span></label>';
            x+='<input type="text" id="e-cat" class="form-control" value="'+response.sale.p_cat+'">';            
            x+='<input type="hidden" id="e_id" value="'+response.sale.id+'">';          
            
        }
        document.getElementById("sal_pr").innerHTML= x;
          $("#myModal12").modal();
      }
   }); 
}



function update_product(){
  var cuser = $('meta[name="csrf-token"]').attr('content'); 
  var id=document.getElementById("e_id").value;  
  var cat=document.getElementById("e-cat").value; 
  var pro=document.getElementById("e-pr").value;      
   
   $.ajax({
      type:'post',
      url:'{{url('/')}}/emp/update/'+id,
      data:{
        _token: "{{ csrf_token() }}",
        cate:cat,
        pro:pro,
                  
      },
      success:function(response){
          if(response.result=="success"){
            location.reload();           
          }
          
      }
   }); 
}  

    function deletesale(id){
        var cuser = $('meta[name="csrf-token"]').attr('content');      
         $.ajax({
            type:'post',
            url:'{{url('/')}}/emp/del/'+id,
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