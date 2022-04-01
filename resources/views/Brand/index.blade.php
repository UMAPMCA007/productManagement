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
                                      <form id="BrandEdit">
                                          <div class="form-group">

                                              <label for="exampleInputEmail1">Brand name</label>
                                              <input type="text" class="form-control" id="brand"  name="brand" placeholder="Brand name" >
                                              @error('brand')
                                              <div class="alert alert-danger">{{ $message }}</div>
                                              @enderror

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
                                  <form id="editBrand">
                                      <div class="form-group">
                                          <input type="hidden" id="id" name="id" value="">
                                          <label for="exampleInputEmail1">Brand name</label>
                                          <input type="text" class="form-control" id="Rbrand"  name="brand" placeholder="Brand name" >
                                          @error('brand')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror

                                      </div>
                                      <div class="form-group">
                                          <button type="submit" id="submit" class="btn col-md-3 btn-primary"  >Save changes</button>

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
                              <th scope="col">Brand name</th>
                              <th scope="col">action</th>
                          </tr>
                          </thead>
                          <tbody id="brandData">
                          </tbody>
                      </table>
                  </div>

              </div>

          </div>
      </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <script>
  $(document).ready(function () {


      call()

             $('#submit').on('click',function (e) {

                 $('#formBrand').trigger('submit');
                     e.preventDefault();

                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });
                     let brand=$('#brand').val();
                     $.ajax({
                      type:'POST',
                      url:'{{route('createB')}}',
                      data:{brand:brand},
                       success:function (data) {
                          console.log(data);
                       }
                     });
                     call()
                 $('.modal').modal( 'hide' );
               });


      $('#formBrand').validate({
          rules: {
              'brand': {
                  required: true,
              },
          },
          messages :{
              "brand" : {
                  required : 'Enter brand name'
              }
          }
      });




        function call(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#brandData').html(" ");
            $.ajax({
               type:'POST',
               url:'brandData',
               success:function (data) {
                   console.log(data.brands);
                   let brands=data.brands;
                   $.each(brands,function (key,value) {
                       $('#brandData').append('<tr id="tr"><td>'+value.id+'</td><td id="brand'+value.id+'">'+value.brand+'</td><td><button   type="button" class="btn btn-success edit mr-2" data="'+value.id+'" id="edit">Edit</button><button type="button" class="btn btn-danger" data="'+value.id+'" id="delete">Delete</button></td></tr>');

                   });

               }
            });
        }



      $('#brandData').on('click','#delete',function(e){
          var id= $(this).attr('data');
          console.log(id);
          $.ajax({
              type:'get',
              url:'/remove_brand/'+id,
              success:function (data) {
                  console.log(data);
              }
          });
          call()

      });



      $('#brandData').on('click','#edit',function(e){
          let id= $(this).attr('data');
          let brand=$('#brand'+id).text();
          $('#Rbrand').val(brand);
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
