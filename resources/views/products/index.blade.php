@extends('layouts.main')
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <h1>Brand</h1>
              <div class="card mt-3">
                  <div class="card-body">

                      <button type="button" class="btn btn-primary col-md-2 offset-md-10" data-toggle="modal" data-target="#exampleModalCenter">
                          Add Brand
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Brand Details</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form id="product" enctype="multipart/form-data">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Product Code</label>
                                              <input type="text" class="form-control" id="pcode"  name="pcode" placeholder="Product Code" >
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Product name</label>
                                              <input type="text" class="form-control" id="pname"  name="pname" placeholder="Product name" >
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Brand </label>
                                              <select  class="form-control" id="brand"  name="brand" >
                                                  <option disabled>Select Brand</option>
                                                  @foreach($brands as $brand)
                                                     <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Selling Price</label>
                                              <input type="number" class="form-control" id="sprice"  name="sprice" placeholder="selling price" >
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Offer price</label>
                                              <input type="number" class="form-control" id="oprice"  name="oprice" placeholder="Offer Price" >
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">product Image</label>
                                              <input type="file" class="form-control" id="files"  name="img[]"  multiple >
                                          </div>

                                          <div class="form-group">
                                              <button type="button" class="btn col-md-2 btn-secondary " data-dismiss="modal">Close</button>
                                              <button type="button" id="submit" class="btn col-md-3 btn-primary"  >Save changes</button>

                                          </div>

                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Modal -->
                      <div class="popup-overlay">
                          <!--Creates the popup content-->
                          <div class="popup-content">
                              <div class="modal-body">
                                  <form id="productEdit" enctype="multipart/form-data">

                                      <input type="hidden" id="id" >
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product Code</label>
                                          <input type="text" class="form-control" id="pcode"  name="pcode" placeholder="Product Code" >
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Product name</label>
                                          <input type="text" class="form-control" id="pname"  name="pname" placeholder="Product name" >
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Brand </label>
                                          <select  class="form-control" id="brand"  name="brand" >
                                              <option disabled>Select Brand</option>
                                              @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Selling Price</label>
                                          <input type="number" class="form-control" id="sprice"  name="sprice" placeholder="selling price" >
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Offer price</label>
                                          <input type="number" class="form-control" id="oprice"  name="oprice" placeholder="Offer Price" >
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">product Image</label>
                                          <input type="file" class="form-control" id="files"  name="img" placeholder="product image" >
                                      </div>

                                      <div class="form-group">
                                          <button type="button" class="btn col-md-2 btn-secondary " data-dismiss="modal">Close</button>
                                          <button type="button" id="submit" class="btn col-md-3 btn-primary"  >Save changes</button>

                                      </div>

                                  </form>
                              </div>
                              <!--popup's close button-->
                              <button class="close">Close</button> </div>
                      </div>


                      <table class="table table-striped">
                          <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Product Code</th>
                              <th scope="col">Product name</th>
                              <th scope="col">brand</th>
                              <th scope="col">Selling Price</th>
                              <th scope="col">offer Price</th>
                              <th scope="col">image</th>
                              <th scope="col">action</th>
                          </tr>
                          </thead>
                          <tbody id="productData">
                          </tbody>
                      </table>
                  </div>

              </div>

          </div>
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function () {


      call()
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

             $('#submit').on('click',function (e) {

                 $('#product').trigger('submit');
                   e.preventDefault();

                     $.ajax({
                      type:'POST',
                      url:'{{route('createP')}}',
                         data:new FormData($('#product')[0]),
                         dataType:'JSON',
                         contentType: false,
                         cache: false,
                         processData: false,
                       success:function (data) {
                          console.log(data);
                       }
                     });
                     call()
                 $('.modal').modal( 'hide' );
               });


      $('#product').validate({
          rules: {
              'pcode': {
                  required: true,
              },'pname': {
                  required: true,
              },'brand': {
                  required: true,
              },'sprice': {
                  required: true,
              },'oprice': {
                  required: true,
              },'img': {
                  required: true,
              },

          },
          messages :{
              "pcode" : {
                  required : 'Enter product code'
              },"pname" : {
                  required: 'Enter pname name'
              },"brand" : {
                  required : 'Enter brand name'
              },"sprice" : {
                  required : 'Enter selling price'
              },"oprice" : {
                  required : 'Enter offer price'
              },"img" : {
                  required : 'select image'
              }

          }
      });



         var pic;
        function call(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#productData').html(" ");
            $.ajax({
               type:'POST',
               url:'productData',
               success:function (data) {
                  /* console.log(data.products);*/
                   let products=data.products;
                   $.each(products,function (key,value) {
                       var img=JSON.parse(value.img)
                       console.log(img);

                           $('#productData').append('<tr id="tr"><td>'+value.id+'</td><td id="brand'+value.id+'">'+value.pcode+'</td><td>'+value.pname+'</td><td>'+value.brand+'</td><td>'+value.sprice+'</td><td>'+value.oprice+'</td><td><img src="{{asset('images')}}/'+pic+'"></td><td><button type="button" class="btn btn-success edit mr-2" data="'+value.id+'" id="edit">Edit</button><button type="button" class="btn btn-danger" data="'+value.id+'" id="delete">Delete</button></td></tr>');

                       });
               }
            });
        }



      $('#productData').on('click','#delete',function(e){
          var id= $(this).attr('data');
          console.log(id);
          $.ajax({
              type:'get',
              url:'/remove_product/'+id,
              success:function (data) {
                  console.log(data);
              }
          });
          call()

      });



      $('#productData').on('click','#edit',function(e){
          let pcode=$('#pcode').val();
          let pname=$('#pname').val();
          let brand=$('#brand').val();
          let sprice=$('#sprice').val();
          let oprice=$('#oprice').val();
          let img=$('#img').val();
          $('#pcode').val(pcode);
          $('#pname').val(pname);
          $('#brand').val(brand);
          $('#sprice').val(sprice);
          $('#oprice').val(oprice);
          $('#id').val(id);
          $(".popup-overlay, .popup-content").addClass("active");

          $('#editBrand').submit(function (e) {
              e.preventDefault()

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              let brand=$('#Rbrand').val();
              let id=$('#id').val()
              console.log(brand,id);
              $.ajax({
                  type:'post',
                  url:'editBrand/'+id,
                  data:{brand:brand},
                  success:function (data) {
                      console.log(data);
                  }

              });
             call()
              $(".popup-overlay, .popup-content").removeClass("active");
          });




      });


      $(".close").on("click", function() {
          $(".popup-overlay, .popup-content").removeClass("active");
      });






    });
</script>
@endsection
