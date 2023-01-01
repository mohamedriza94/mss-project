<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lock Hood</title>
  <meta property="og:title" content="Lock Hood" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <style data-tag="reset-style-sheet">
    html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }
    
    body {
      font-weight: 400;
      font-style:normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);
      
    }
  </style>
  <link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
  data-tag="font"
  />
  <!--This is the head section-->
  <!-- <style> ... </style> -->
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
</head>
<body>
  <div>
    <link href="{{ asset('assets/home.css') }}" rel="stylesheet" />
    
    <div class="home-container">
      <header data-thq="thq-navbar" class="home-navbar-interactive">
        <div
        data-thq="thq-navbar-nav"
        data-role="Nav"
        class="home-desktop-menu"
        >
        <nav
        data-thq="thq-navbar-nav-links"
        data-role="Nav"
        class="home-nav"
        >
        <label id="home" class="home-text"><a href="{{ route('warehouse.dashboard') }}">Home</a></label>
        <label id="inventory" class="home-text01"><a href="{{ route('warehouse.inventory') }}">Inventory</a></label>
      </nav>
    </div>
    <label id="warehouseaccount" class="home-text02"><a href="#">Warehouse Account</a></label>
    <div class="home-container1">
      <label id="login" class="home-text03"><a href="{{ route('warehouse.logout') }}">Logout</a></label>
    </div>
  </header>
  
  <div id="inventorycont" class="home-container2">
    <div class="home-container3">
      <table width="100%">
        <thead>
          <tr>
            <th>Request No.</th>
            <th>Inventory</th>
            <th>Date</th>
            <th>Status</th>
            <th>Quantity</th>
          </thead>
          <tbody id="irTable">
          </tbody>
        </table>
      </div>
      <a id="sample" href="{{ url("warehouse/dashboard/fillRequest/75238>") }}"></a>
      
      <span class="home-text08">Inventory Requests</span>
      <button class="home-button button" id="btnNext">Next</button>
      <button class="home-button1 button" id="btnPrev">Prev</button>
    </div>
    <div class="home-container4">
      <span class="home-text09">Lock Hood Pvt Ltd 2022</span>
    </div>
  </div>
</div>
</body>
</html>

{{-- Js --}}
<script>
  $(document).ready(function(){
    
    //csrf token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    //calling the function
    fetchInventoryRequests();
    
    //limit and offset for pagination
    var limit = 0;
    $(document).on('click', '#btnNext', function(e) {
      
      limit = limit + 5;
      fetchInventoryRequests();
      
    });
    
    $(document).on('click', '#btnPrev', function(e) {
      
      limit = limit - 5;
      
      if(limit < 0)
      {
        limit = 0;
      }
      
      fetchInventoryRequests();
      
    });
    
    //read
    function fetchInventoryRequests()
    {
      var url = '{{ url("warehouse/dashboard/ir/read/:limit") }}';
      url = url.replace(':limit', limit);
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#irTable').html('');
          
          $.each(response.requests,function(key,item){
            
            var name = item.name;
            var name = name.slice(0,10)+'...';
            
            var date = item.date;
            var date = date.slice(0,10);
            
            var status = "";
            var button = "";
            
            if(item.status=='pending')
            {
              status = "<div style='text-align:center; width:100%; padding:2px; border-radius:6px; background:#a67a02; color:white'>Pending</div>";
              button = '<button value="'+item.rawMaterial+'" id="btnFill" style="width:100px; padding:8px; border-radius:3px; background:#dbfc03; color:#615f5f;">Fill</button>';
            }
            else
            {
              status = "<div style='text-align:center; border-radius:6px; width:100%; padding:2px; background:#1da602; color:white'>Completed</div>";
              button = '-';
            }
            
            $('#irTable').append('<tr><td>'+item.no+'</td>\
              <td>'+name+'</td>\
              <td>'+date+'</td>\
              <td>'+status+'</td>\
              <td>'+item.quantity+'</td>\
              <td>'+button+'</td>\
            </tr>\
            ');
          });
        }
      });
    }
    
    //fill requests
    $(document).on('click', '#btnFill', function(e) {
      
      var rawMaterial = $(this).val();
      
      var data = {
        'rawMaterial' : rawMaterial,
      }
      
      var url = '{{ url("warehouse/dashboard/fillRequest") }}';
      
      //ajax request
      $.ajax({
        type:"POST",
        url: url,
        data:data,
        dataType:"json",
        success: function(response){
          if(response.status==400)
          {
            alert(response.message);
          }
          else
          {
            fetchInventoryRequests();
          }
        }
      });
    });
    
  });
</script>
