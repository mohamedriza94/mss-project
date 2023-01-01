<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee - Lock Hood</title>
  <meta property="og:title" content="InventoriesPage - Lock Hood" />
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
    <link rel="stylesheet" href="{{ asset('assets/inventories-page.css') }}" />
    
    <div class="inventories-page-container">
      <header
      data-thq="thq-navbar"
      class="inventories-page-navbar-interactive"
      >
      <div
      data-thq="thq-navbar-nav"
      data-role="Nav"
      class="inventories-page-desktop-menu"
      >
      <nav
      data-thq="thq-navbar-nav-links"
      data-role="Nav"
      class="inventories-page-nav"
      >
      <a href="{{ route('employee.dashboard') }}" class="inventories-page-navlink">
        <label id="home" class="inventories-page-text">Home</label>
      </a>
      <a href="{{ route('employee.workshop') }}" class="inventories-page-navlink1">
        <label class="inventories-page-text01">
          Workshops
        </label>
      </a>
      <a href="{{ route('employee.worker') }}" class="inventories-page-navlink2">
        <label class="inventories-page-text02">
          Workers
        </label>
      </a>
      <a href="{{ route('employee.kanbanCard') }}" class="inventories-page-navlink3">
        <label class="inventories-page-text03">
          Kanban Cards
        </label>
      </a>
      <a href="{{ route('employee.inventory') }}" class="inventories-page-navlink4">
        <label class="inventories-page-text04">
          Inventories
        </label>
      </a>
    </nav>
  </div>
  <a href="index.html" class="inventories-page-navlink5">
    <label id="seniormanageraccount" class="inventories-page-text05">
      {{ auth()->guard('employee')->user()->name }} (Supervisor)
    </label>
  </a>
  <div class="inventories-page-container01">
    <a href="{{ route('employee.logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" class="inventories-page-navlink6">
    <label id="login" class="inventories-page-text06">Logout</label>
  </a>
  
  <form id="logout-form" 
  action="{{ route('employee.logout') }}" 
  method="POST" class="d-none">
  @csrf
</form>

</div>
</header>

<div id="inventorycont" class="inventories-page-container03">
  <div class="inventories-page-container04">
    <table width="100%">
      <thead>
        <tr>
          <th>No.</th>
          <th>Inventory</th>
          <th>Available Quantity</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody id="rawMaterialTable">
          
        </tbody>
      </table>
    </div>
    <span class="inventories-page-text08">
      <span>Inventories</span>
      <br />
    </span>
    <button id="btnNext" class="inventories-page-button2 button">
      Next
    </button>
    <button id="btnPrev" class="inventories-page-button3 button">
      Previous
    </button>
  </div>
  
  <div id="inventorycont" class="inventories-page-container05">
    <span class="inventories-page-text11">Inventory Requests</span>
    <div class="inventories-page-container06">
      <table width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
          </thead>
          <tbody id="inventoryRequestTable">
            
          </tbody>
        </table>
      </div>
      <div class="inventories-page-container07">
        <button id="btnPrev_Arrow" class="inventories-page-button4 button">
          <<
        </button>
        <button id="btnNext_Arrow" class="inventories-page-button5 button">
          >>
        </button>
      </div>
    </div>
    
    
    
    <div class="inventories-page-container08">
      <ul id="errorlist" class="inventories-page-ul list"></ul>
      
      <div class="inventories-page-container09">
        
        <span class="inventories-page-text16" id="formHeader"> Add New Raw Material </span>
        <form class="inventories-page-form">
          
          <input type="hidden" id="id"/>
          
          <div class="inventories-page-container10">
            <span class="inventories-page-text17">Inventory Number</span>
            <input type="number" id="inventoryNo" class="inventories-page-textinput input" />
          </div>
          
          <div class="inventories-page-container11">
            <span class="inventories-page-text18">Inventory</span>
            <select id="inventory" class="inventories-page-select" ></select>
          </div>
          
          <div class="inventories-page-container12">
            <span class="inventories-page-text19">Quantity</span>
            <input type="number" id="quantity" class="inventories-page-textinput1 input" />
          </div>
          
          <div class="inventories-page-container13">
            <span class="inventories-page-text20">Minimum Quantity</span>
            <input type="number" id="minimumQuantity" class="inventories-page-textinput2 input" />
          </div>
          
          <div class="inventories-page-container14">
            <span class="inventories-page-text21">Repurchase Quantity</span>
            <input type="number" id="repurchaseQuantity" class="inventories-page-textinput3 input" />
          </div>
          
          <div id="buttonContainer">
            <button id="btnAdd" type="submit" class="inventories-page-button6 button"> Add </button>
          </div>
          
        </form>
      </div>
    </div>
    <div class="inventories-page-container15">
      <span class="inventories-page-text22">Lock Hood Pvt Ltd 2022</span>
    </div>
  </div>
</div>
</body>
</html>


<script>
  $(document).ready(function(){
    
    //csrf token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    //call functions
    fetchRawMaterials();
    fetchInventories();

    //generate random number into text field
    $('#inventoryNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
    
    //limit and offset for pagination of MAIN table
    //
    var limit = 0;
    $(document).on('click', '#btnNext', function(e) {
      
      limit = limit + 5;
      fetchRawMaterials();
      fetchInventories();
    });
    
    $(document).on('click', '#btnPrev', function(e) {
      
      limit = limit - 5;
      
      if(limit < 0)
      {
        limit = 0;
      }
      
      fetchRawMaterials();
      fetchInventories();
      
    });
    
    //limit and offset for pagination of SLOT table
    //
    var limit_arrow = 0;
    $(document).on('click', '#btnNext_Arrow', function(e) {
      
      limit_arrow = limit_arrow + 5;
      fetchInventoryRequests();
      
    });
    
    $(document).on('click', '#btnPrev_Arrow', function(e) {
      
      limit_arrow = limit_arrow - 5;
      
      if(limit_arrow < 0)
      {
        limit_arrow = 0;
      }
      
      fetchInventoryRequests();
      
    });
    //
    
    //read raw materials
    function fetchRawMaterials()
    {
      var url = '{{ url("employee/dashboard/rm/read/:limit") }}';
      url = url.replace(':limit',limit);
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#rawMaterialTable').html('');
          
          $.each(response.rawMaterials,function(key,item){
            
            var name = item.name;
            var name = name.slice(0,15)+'...';
            
            var status = "";
            
            if(item.status=='available')
            {
              status = "<div style='text-align:center; width:50%; padding:2px; border-radius:6px; background:#25b305; color:white'>In Stock</div>";
            }
            else
            {
              status = "<div style='text-align:center; border-radius:6px; width:60%; padding:2px; background:#cc1302; color:white'>Out of Stock</div>";
            }
            
            $('#rawMaterialTable').append('<tr><td>'+item.no+'</td>\
              <td>'+name+'</td>\
              <td>'+item.quantity+'</td>\
              <td>'+status+'</td>\
              <td>\
                <button value="'+item.no+'" id="btnEdit" style="padding:8px; border-radius:3px; background:#d3e9f5; color:#615f5f;">Edit Min Qty</button>\
                <button value="'+item.no+'" id="btnDelete" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
              </td>\
            </tr>\
            ');
          });
        }
      });
    }
    
    //read warehouse inventory options
    function fetchInventories()
    {
      var url = '{{ url("employee/dashboard/rm/readWarehouseInventory") }}';
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#inventory').html('');
          
          $.each(response.inventories,function(key,item){
            
            $('#inventory').append('<option value="'+item.no+'">'+item.name+'</option>');
            
          });
        }
      });
    }
    
    //Add raw materials
    $(document).on('click','#btnAdd', function(e){
      e.preventDefault();
      
      var inventoryNo = $('#inventoryNo').val();
      var inventory = $('#inventory').val();
      var quantity = $('#quantity').val();
      var minimumQuantity = $('#minimumQuantity').val();
      var repurchaseQuantity = $('#repurchaseQuantity').val();
      
      var data = {
        'no' : inventoryNo,
        'inventoryNo' : inventory,
        'quantity' : quantity,
        'minimumQuantity' : minimumQuantity,
        'repurchaseQuantity' : repurchaseQuantity
      };
      
      var url = '{{ url("employee/dashboard/rm/create") }}';
      
      $.ajax({
        type:"POST", url:url, data:data, dataType:"json",
        success: function(response)
        {
          if(response.status == 400)
          {
            $('#errorlist').html('');
            $.each(response.errors,function(key,err_value){
              $('#errorlist').append('<li class="inventories-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
            });
          }
          else if(response.status == 404)
          {
            alert(response.message);
          }
          else
          {
            $('#errorlist').html('');
            alert('Added!')
            
            $('#buttonContainer').html('\
            <button id="btnAdd" class="inventories-page-button6 button">Add</button>');
            
            $('#inventoryNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
            $('#inventory').val('');
            $('#quantity').val('');
            $('#minimumQuantity').val('');
            $('#repurchaseQuantity').val('');
            
            fetchRawMaterials();
            fetchInventories();
          }
        }
      });
    });
    
    //Edit
    $(document).on('click', '#btnEdit', function(e) {
      
      limit_arrow = 0; //set Slot table offset to 0
      
      inventoryNo = $(this).val();
      
      var url = '{{ url("employee/dashboard/rm/readOne/:inventoryNo") }}';
      url = url.replace(':inventoryNo', inventoryNo);
      
      $.ajax({
        type:"GET",
        url:url,
        dataType:"json",
        success: function(response)
        {
          $('#inventoryNo').val(response.rawMaterials.no);
          $('#inventory').val(response.rawMaterials.inventoryNo);
          $('#quantity').val(response.rawMaterials.quantity);
          $('#minimumQuantity').val(response.rawMaterials.minimumQuantity);
          $('#repurchaseQuantity').val(response.rawMaterials.repurchaseQuantity);
          $('#id').val(response.rawMaterials.id);
          
          $('#formHeader').text('Edit Inventory');
          
          $('#buttonContainer').html('\
          <button id="btnUpdate" class="inventories-page-button6 button">Update</button>');
          
          $('#inventory').html('<option value="'+response.rawMaterials.no+'">'+response.rawMaterials.name+'</option>');
          
          fetchInventoryRequests();
        }
      });
    });
    
    //fetch inventory requests into table{
      var inventoryNo = "";
      function fetchInventoryRequests()
      {
        var url = '{{ url("employee/dashboard/rm/readInventoryRequest/:inventoryNo/:limit_arrow") }}';
        url = url.replace(':inventoryNo', inventoryNo);
        url = url.replace(':limit_arrow', limit_arrow);
        
        $.ajax({
          type: "GET",
          url:url,
          dataType:"json",
          success:function(response){
            
            $('#inventoryRequestTable').html('');
            
            $.each(response.inventoryRequests,function(key,item){
              
              var status = "";
              
              if(item.status=='pending')
              {
                status = "<div style='text-align:center; width:50%; padding:2px; border-radius:6px; background:#e69602; color:white'>Pending</div>";
                
              }
              else
              {
                status = "<div style='text-align:center; border-radius:6px; width:60%; padding:2px; background:#0259e6; color:white'>Fulfilled</div>";
                
              }
              
              $('#inventoryRequestTable').append('<tr><td>'+item.requestNo+'</td>\
                <td>'+item.date+'</td>\
                <td>'+item.time+'</td>\
                <td>'+status+'</td>\
              </tr>\
              ');
            });
          }
        });
      }
      //}
      
      //Update raw materials
      $(document).on('click','#btnUpdate', function(e){
        e.preventDefault();
        
        var id = $('#id').val();
        var minimumQuantity = $('#minimumQuantity').val();
        var repurchaseQuantity = $('#repurchaseQuantity').val();
        
        var data = {
          'id' : id,
          'minimumQuantity' : minimumQuantity,
          'repurchaseQuantity' : repurchaseQuantity,
        };
        
        var url = '{{ url("employee/dashboard/rm/update") }}';
        
        $.ajax({
          type:"POST", url:url, data:data, dataType:"json",
          success: function(response)
          {
            if(response.status == 400)
            {
              $('#errorlist').html('');
              $.each(response.errors,function(key,err_value){
                $('#errorlist').append('<li class="inventories-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
              });
            }
            else
            {
              $('#errorlist').html('');
              alert('Updated Minimum AND Repurchase Quantity!')
              
              $('#buttonContainer').html('\
              <button id="btnAdd" class="inventories-page-button6 button">Add</button>');
              
              $('#inventoryNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
              $('#inventory').val('');
              $('#quantity').val('');
              $('#minimumQuantity').val('');
              $('#repurchaseQuantity').val('');
              
              fetchRawMaterials();
              fetchInventories();
            }
          }
        });
      });
      
      //delete
      $(document).on('click', '#btnDelete', function(e) {
        
        var no = $(this).val();
        
        var url = '{{ url("employee/dashboard/rm/delete/:no") }}';
        url = url.replace(':no', no); 
        
        $.ajax({
          type:"DELETE",
          url:url,
          dataType:"json",
        });
        
        fetchRawMaterials();
        fetchInventories();
      });
      
    });
    
  </script>