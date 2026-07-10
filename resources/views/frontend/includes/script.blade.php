

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
$(document).on('click','.addToCartBtn',function(e){
    e.preventDefault();

    let $btn = $(this);
    let product_id = $(this).data('id');
    let qty = 1;
    let $qtyInput = $(this).closest('.product-action').find('.qtySelect');
    if($qtyInput.length){ qty = parseInt($qtyInput.val()) || 1; }

    $btn.addClass('disabled').css('pointer-events', 'none');

    $.ajax({
        url:"{{ url('add-to-cart') }}",
        type:"POST",
        data:{
            product_id:product_id,
            qty: qty,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){

            if(response.status){
                loadCartHeader(function(){
                    $('body').addClass('cart-opened');
                });

                toastr.success('Added to cart');
            }
        },
        error:function(){
            toastr.error('Unable to add product. Please try again.');
        },
        complete:function(){
            $btn.removeClass('disabled').css('pointer-events', '');
        }
    });

});

function loadCartHeader(callback)
{
    $.get("{{ url('cart-header') }}", function(response){

        $('#cartHeaderArea').html(response);

        let count = $('#cartCountValue').val();

        $('#cartCount').text(count || 0);

        if(typeof callback === 'function'){
            callback();
        }
    });
}

$(document).ready(function(){
    loadCartHeader();
});

function refreshCartPageTotals()
{
    let total = 0;

    $('span[class^="itemSubtotal"]').each(function(){
        total += parseFloat($(this).text().replace(/,/g, '')) || 0;
    });

    $('#cartTotal').text(total.toFixed(2));
    $('#grandTotal').text(total.toFixed(2));
}

function updateCartQty($input)
{
    let qty = parseInt($input.val()) || 1;
    if(qty < 1){
        qty = 1;
        $input.val(qty);
    }

    let cart_id = $input.data('cart-id') || $input.data('id');
    let $row = $('#row' + cart_id);
    let price = parseFloat($row.data('price')) || 0;

    $.ajax({
        url:"{{ url('cart/update-qty') }}",
        type:"POST",
        data:{
            cart_id:cart_id,
            qty:qty,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            if(response.status){
                $('.itemSubtotal' + cart_id).text((price * qty).toFixed(2));
                refreshCartPageTotals();
                loadCartHeader();
            }
        },
        error:function(){
            toastr.error('Unable to update cart.');
        }
    });
}

function scheduleCartQtyUpdate($input)
{
    clearTimeout($input.data('cartUpdateTimer'));
    $input.data('cartUpdateTimer', setTimeout(function(){
        updateCartQty($input);
    }, 150));
}

$(document).on('change', '.cartQtyInput, .qtyInput', function(){
    scheduleCartQtyUpdate($(this));
});

$(document).on('click', '.bootstrap-touchspin-up, .bootstrap-touchspin-down', function(){
    let $input = $(this).closest('.bootstrap-touchspin').find('.cartQtyInput');
    if($input.length){
        scheduleCartQtyUpdate($input);
    }
});

$(document).on('click','.removeCartItem',function(e){
    e.preventDefault();

    let cart_id = $(this).data('id');

    if(!confirm('Remove this item?')){
        return false;
    }

    $.ajax({
        url:"{{ url('cart/remove-item') }}",
        type:"POST",
        data:{
            cart_id:cart_id,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            if(response.status){
                $('#row'+cart_id).remove();
                refreshCartPageTotals();
                loadCartHeader();
            }
        },
        error:function(){
            toastr.error('Unable to remove item.');
        }
    });
});


</script>
<script>
// email subscribe
$(".SubscribeBtn").click(function(e){
    e.preventDefault();
    // var data = $(this).serialize();
    var email =  $('#email_subscribe').val();

    if(email!==''){
        var url = '{{ route('store.subscriber') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:url,
            method:'POST',
            data:{
                email:email,
            },
            success:function(response){
                toastr.success("You have subscribed successfully!");
                // toastr.success(response.msg);
               $('#email_subscribe').val('');

            },
            error:function(error){
                console.log(error)
            }
        });
    }else{
        toastr.danger("Email is Required!");
    }
});
// email subscribe
</script>
  <script src="https://code.jquery.com/jquery-3.6.1.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toastr JS File -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
//   AOS.init();
  $(document).ready(function() {
      toastr.options.timeOut = 5000;
      @if (Session::has('alert-danger'))
          toastr.error('{{ Session::get('alert-danger') }}');
      @elseif(Session::has('alert-success'))
          toastr.success('{{ Session::get('alert-success') }}');
      @elseif(Session::has('alert-warning'))
          toastr.success('{{ Session::get('alert-warning') }}');
      @endif
  });
</script>


{{-- /// new  --}}


<!-- Plugins JS File -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ static_asset('assets/assets_web/js/jquery.min.js') }}"></script>
<script src="{{ static_asset('assets/assets_web/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ static_asset('assets/assets_web/js/optional/isotope.pkgd.min.js') }}"></script>
<script src="{{ static_asset('assets/assets_web/js/plugins.min.js') }}"></script>
<script src="{{ static_asset('assets/assets_web/js/jquery.appear.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ static_asset('assets/assets_web/js/main.min.js') }}"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"ecd4920e43e14654b78e65dbf8311922","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
crossorigin="anonymous"></script>
<script>
    (function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9fe0cf4d0cfd9822',t:'MTc3OTE2OTY3Ng=='};var a=document.createElement('script');a.src='../../cdn-cgi/challenge-platform/h/g/scripts/jsd/825e783f7fae/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();
</script>

<script>
    WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
</script>

<script>
var url = 'https://cdn.waplus.io/waplus-crm/settings/ossembed.js';
var s = document.createElement('script');
s.type = 'text/javascript';
s.async = true;
s.src = url;
var options = {
"enabled": true,
"chatButtonSetting": {
"backgroundColor": "#16BE45",
"ctaText": "Message Us",
"borderRadius": "8",
"marginLeft": "20",
"marginBottom": "72",
"marginRight": "20",
"position": "right",
"textColor": "#ffffff",
"phoneNumber": "+918790720793",
"messageText": "Hello",
"trackClick": true
}
}
s.onload = function() {
CreateWhatsappBtn(options);
};
var x = document.getElementsByTagName('script')[0];
x.parentNode.insertBefore(s, x);
</script>

<!--<script>
$('.custom-products').owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2500,
    autoplayHoverPause: false,
    smartSpeed: 1000,

    responsive:{
        0:{
            items:1
        },
        576:{
            items:2
        },
        768:{
            items:3
        },
        1200:{
            items:4
        }
    }
});
</script>-->

<script>

$(document).ready(function() {
    //console.log('Function okay');
    $('#fstate').on('change', function() {
        //console.log('Function okay 2');
        var state = this.value;
        $("#fcity").html('');

        $.ajax({
            url: "{{ url('get-cities-by-state') }}",
            type: "POST",
            data: {
                state: state,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
				console.log(result);
                $('#fcity').html('<option value="">Select City</option>');
                $.each(result.cities, function(key, value) {
                    $("#fcity").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: ", status, error);
            }
        });
    });
});



 function toggleSidebar() {
    document.getElementById('sidebarr').classList.toggle('open');
  }

  $(document).on('click', '.home_form_make_enquiry', function(e) {
        e.preventDefault();
        var clk_btn = $(".make_enquiry");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("home-enquiry-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $.ajax({
            type: "POST",
            url: "{{ route('enq.homePageEnquiry') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data) {
                // console.log('status ' + data.status);
                if (data.status == true) {
                    document.getElementById("home-enquiry-form").reset();
                    alert("Thank you for your enquiry. Our team will get in touch with you shortly.");
                    // location.reload();
                } else {
                    // toastr.error('Something went wrong.');
                    alert("Something went wrong!");
                }
            }
            , error: function(err) {

                document.getElementById('show-home-form-error').style = "display: block";
                clk_btn.prop('disabled', false);
                let error = err.responseJSON;
                console.log(error);
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span class="text-danger">' + value +

                        '<span>' + '<br>');
                });

            }
        });
    });
</script>

@yield('script')



