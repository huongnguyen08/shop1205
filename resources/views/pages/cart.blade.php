@extends('layout')
@section('content')
        <div class="page-container">
          <div data-bottom-top="background-position: 50% 50px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -50px;" class="page-title page-reservation">
            <div class="container">
              <div class="title-wrapper">
                <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(-5px);" data--50-top="transform: translateY(-15px);opacity:0.8;" data--120-top="transform: translateY(-30px);opacity:0;" data-anchor-target=".page-title" class="title">Giỏ hàng của bạn</div>
                <div data-top="opacity:1;" data--120-top="opacity:0;" data-anchor-target=".page-title" class="divider"><span class="line-before"></span><span class="dot"></span><span class="line-after"></span></div>
                <div data-top="transform: translateY(0px);opacity:1;" data--20-top="transform: translateY(5px);" data--50-top="transform: translateY(15px);opacity:0.8;" data--120-top="transform: translateY(30px);opacity:0;" data-anchor-target=".page-title" class="subtitle">Just a few click to make the reservation online for saving your time and money</div>
              </div>
            </div>
          </div>
          <div class="page-content-wrapper">
            <section class="section-reservation-form padding-top-100 padding-bottom-100">
              <div class="container">
                <div class="section-content">
                  <div class="swin-sc swin-sc-title style-2">
                    <h3 class="title thongbao">
                      <span>
                        @if(isset($cart))
                          Chi tiết giỏ hàng 
                        @else
                          Giỏ hàng đang rỗng
                        @endif

                        @if(Session::has('thongbao'))
                            <div>{{Session::get('thongbao')}}</div>
                        @endif
                      </span>
                    </h3>
                  </div>
                  @if(isset($cart))
                  <div class="reservation-form">
                    <div class="swin-sc swin-sc-contact-form light mtl">
                      <table class="table table-striped" style="text-align: center;">
                          <thead>
                            <tr>
                              <th width="30%" style="text-align: center;">Product</th>
                              <th width="20%" style="text-align: center;">Price</th>
                              <th width="20%" style="text-align: center;">Qty.</th>
                              <th width="20%" style="text-align: center;">Total</th>
                              <th width="10%" style="text-align: center;">Remove</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($cart->items as $sanpham)
                            <tr class="trHide-{{$sanpham['item']->id}}">
                              <td>
                                <img src="fooday/assets/images/hinh_mon_an/{{$sanpham['item']->image}}" width="250px">
                                <p><br><b>{{$sanpham['item']->name}}</b></p>
                              </td>
                              <td style="font-size: 18px; color: blue">{{number_format($sanpham['item']->price)}} vnđ</td>
                              <td>
                              <select name="product-qty" id="product-qty" class="form-control Qty" width="50" idSP="{{$sanpham['item']->id}}">
                                @for($i=1;$i<=5;$i++)
                                <option value="<?=$i;?>" {{$sanpham['qty'] == $i ? "selected" : '' }}><?=$i;?></option>
                                @endfor
                              </select>
                              </td>
                              <td style="font-size: 18px; color: blue" class="price-{{$sanpham['item']->id}}">{{number_format($sanpham['price'])}} vnđ</td>
                              <td>
                                <a class="remove" idSP="{{$sanpham['item']->id}}"  title="Remove this item"><i class="fa fa-trash-o fa-2x"></i></a></td>
                            </tr>
                            @endforeach
                            <tr>
                              <td colspan="4" style="text-align: right; font-size: 20px; color: blue">Tổng tiền: <b class="total" >{{number_format($cart->totalPrice)}}</b> vnđ</td>
                            </tr>
                          </tbody>
                      </table>     
                     
                    </div>
                    
                    <div class="swin-sc swin-sc-contact-form light mtl style-full">
                      <div class="swin-sc swin-sc-title style-2">
                        <h3 class="title"><span>Đặt hàng</span></h3>
                        <br><br>

                        @if($errors->any())

                          <div class="alert alert-danger">
                            @foreach($errors->all() as $loi)
                              <li>{{$loi}}</li>
                            @endforeach
                          </div>

                        @endif                        


                      </div>
                      <form method="POST" action="{{route('checkout')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" placeholder="Fullname" name="fullname" class="form-control" required value="{{ old('fullname') }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                           
                            <label style="margin-right: 30px">
                              <input type="radio" name="gender" value="nam" checked> Nam
                            </label>
                            <label style="margin-right: 30px">
                              <input type="radio" name="gender" value="nữ"> Nữ
                            </label>
                            <label style="margin-right: 30px">
                              <input type="radio" name="gender" value="other"> Khác
                            </label>

                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input type="email" placeholder="Email" name="email" value="{{old('email')}}" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <div class="fa fa-map-marker"></div>
                            </div>
                            <input type="text" placeholder="Address" name="address" class="form-control"  value="{{old('address')}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <div class="fa fa-phone"></div>
                            </div>
                            <input type="text" placeholder="Phone" name="phone" value="{{old('phone')}}" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <select name="payment">
                              <option value="Tiền mặt" selected>Tiền mặt</option>
                              <option value="COD">Ship COD</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <textarea placeholder="Message" name="note" class="form-control">
                            <?=old('note');?>
                          </textarea>
                        </div>
                         <div class="form-group">
                          <div class="swin-btn-wrap center"><button class="btn btn-primary btn-lg"> <span>Checkout</span></button></div>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                  @endif
                </div>
              </div>
            </section>
            <section data-bottom-top="background-position: 50% 100px;" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;" class="section-reservation-service padding-top-100 padding-bottom-100">
              <div class="container">
                <div class="section-content">
                  <div class="swin-sc swin-sc-title style-2 light">
                    <h3 class="title"><span>Fooday Best Service</span></h3>
                  </div>
                  <div class="swin-sc swin-sc-iconbox light">
                    <div class="row">
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-dish"></i><span class="number">1</span></div>
                          <h4 class="title">Reservation</h4>
                          <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div data-wow-delay="0.5s" class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-dinner-2"></i><span class="number">2</span></div>
                          <h4 class="title">Private Event</h4>
                          <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div data-wow-delay="1s" class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-browser"></i><span class="number">3</span></div>
                          <h4 class="title">Online Order</h4>
                          <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div data-wow-delay="1.5s" class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-delivery"></i><span class="number">4</span></div>
                          <h4 class="title">Fast Delivery</h4>
                          <div class="description">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
  <script>
      $(document).ready(function(){
        $('.remove').click(function() {
            
            var id = $(this).attr('idSP');
           
            $.ajax({
                url:"{{route('delete-item-cart')}}",
                data: {id:id}, //biến truyền đi: line_164
                type: 'GET',
                success:function(data){
                    data = jQuery.trim(data)
                    if(data=='null'){
                        $('.thongbao').html('<span>Giỏ hàng đang rỗng</span>')
                        $('.reservation-form').hide()
                        return false;
                    }
                    console.log(data);
                    $('.total').html(data)
                    $('.trHide-'+id).hide();

                }
            })
        });

        $('.Qty').change(function() {
            var soluong = $(this).val();
            var idSP = $(this).attr('idSP')
            $.ajax({
                url: "{{route('update-item-cart')}}",
                data:{
                    qty: soluong,
                    id: idSP
                },
                type: 'GET',
                success:function(data){
                    console.log(data)
                    data = JSON.parse(data)
                    $('.price-'+idSP).html(data.totalPriceItem + ' vnđ')
                    $('.total').html(data.totalPrice)
                    console.log(data.qty)
                }
            })

        });
        

      })
  </script>
@endsection