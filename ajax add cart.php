
<!doctype html>
<html lang="en">
  <head>
    <title>ajax-ad-cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  </head>
  <style>
    
    .photo{
      height: 220px;
      object-fit: cover;
    }
  </style>
  <body>
    <div class="container">
      <h1 class="text-center" style="color: crimson;"><a class="mask">#防疫人人有責,沒事請勿外出！！！</a></h1>
      <div class="row mt-3 mb-3" id="target">
      
  
      </div>
      <div class="row justify-content-center">
          <div class="col-4">
              <div id="cart" class="cart card">
                  <div class="card-body">
                   
                      <h3 class="card-title h5" style="color: crimson;">購物車</h3>
                      <table class="table table-sm" >
                          <thead>
                              <tr>
                                <th class="text-nowrap">品名</th>
                                <th class="text-nowrap">單價</th>
                                <th width="80px">數量</th>
                                <th >小計</th>
                              </tr>
                          </thead>
                          <tbody class="table table-lg" id="cart-list">

                          </tbody>
                          <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">
                                  總價:
                                  <span id="total">0</span>
                                </td>
                            </tr>
                        </tfoot>
                      </table>
                      <button class="btn btn-success btn-block">結帳</button>
                  </div>
              </div>
          </div>
      </div>
      <h1 class="text-center" style="color: crimson;"><a class="mask">#STAY HOME</a></h1>
      <h1 class="text-center" style="color: rgb(220, 117, 20);"><a class="mask">#STAY SAFE</a></h1>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      $.ajax({
        url: 'my.json',
        type: 'GET',
        dataType: 'json'
      }).done(function(data){
        // console.log(data);
        let my = "";
        data.forEach((data)=>{
          my +=`
          <div class="col-md-3">
                  <div class="card">
                    <div class="card-body">
                        <img class="photo card-img" src="img/${data.img}" alt="">
                        <h5 class="card-title mt-3">${data.name}</h5>
                        <h5>${data.text}</h5>
                        <div class="d-flex justify-content-between">
                            <div class="h5 text-info price">$${data.price}</div>
                            <div><a class="btn btn-success text-white add-card" data-name="${data.name}" data-price="${data.price}"><i class="fas fa-cart-plus"></i></a></div>
                        </div>
                    </div>
                  </div>
              </div>
          `;
        })
        $("#target").append(my);
      }).fail({

      });
      
      // ---------------------------------------------
      $("#target").on("click", ".add-card", function () {
        let name = $(this).data("name");
        let price = $(this).data("price");
        let item = `
            <tr>
                <td>${name}</td>
                <td class="price">$${price}</td>
                <td><input type="number" class="form-control text-center number" min="1" value="1"></td>
                <td class="text-right s_price"></td>
            </tr>
        `;
        $("#cart-list").append(item);

        // ---------------------------------------------subtotal
        $(".number").on("change keyup", function(){
            cart()
        })
        function cart(){
            let result=0;
            $("tbody tr").each(function(){
                let item=$(this);
                let s_price=item.find(".price").text()*item.find(".number").val();
                item.find(".s_price").text(s_price);
                total+=s_price;
            })
            $("#total").text(result)
        }
        cart()  

    })
    </script>
  </body>
</html>