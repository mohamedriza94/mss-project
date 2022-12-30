<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee - Lock Hood</title>
  <meta property="og:title" content="WorkshopPage - Lock Hood" />
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
    <link rel="stylesheet" href="{{ asset('assets/workshop-page.css') }}" />
    
    <div class="workshop-page-container">
      <header data-thq="thq-navbar" class="workshop-page-navbar-interactive">
        <div
        data-thq="thq-navbar-nav"
        data-role="Nav"
        class="workshop-page-desktop-menu"
        >
        <nav
        data-thq="thq-navbar-nav-links"
        data-role="Nav"
        class="workshop-page-nav"
        >
        <a href="{{ route('employee.dashboard') }}" class="workshop-page-navlink">
          <label id="home" class="workshop-page-text">Home</label>
        </a>
        <a href="{{ route('employee.workshop') }}" class="workshop-page-navlink1">
          <label class="workshop-page-text01">
            Workshops
          </label>
        </a>
        <a href="{{ route('employee.worker') }}" class="workshop-page-navlink2">
          <label class="workshop-page-text02">
            Workers
          </label>
        </a>
        <a href="{{ route('employee.kanbanCard') }}" class="workshop-page-navlink3">
          <label class="workshop-page-text03">
            Kanban Cards
          </label>
        </a>
        <a href="{{ route('employee.inventory') }}" class="workshop-page-navlink4">
          <label class="workshop-page-text04">
            Inventories
          </label>
        </a>
      </nav>
    </div>
    <a href="#" class="workshop-page-navlink5">
      <label id="seniormanageraccount" class="workshop-page-text05">
        {{ auth()->guard('employee')->user()->name }} (Supervisor)
      </label>
    </a>
    <div class="workshop-page-container01">
      <a href="{{ route('employee.logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="workshop-page-navlink6">
      <label id="login" class="workshop-page-text06">Logout</label>
    </a>
    
    <form id="logout-form" 
    action="{{ route('employee.logout') }}" 
    method="POST" class="d-none">
    @csrf
  </form>
  
</div>
</header>
<div id="inventorycont" class="workshop-page-container02">
  <div class="workshop-page-container03">
    <table width="100%">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody id="workshopTable">
          
        </tbody>
      </table>
    </div>
    <span class="workshop-page-text08">
      <span>Workshops</span>
      <br />
    </span>
    <button id="btnNext" class="workshop-page-button button">
      Next
    </button>
    <button id="btnPrev" class="workshop-page-button1 button">
      Prev
    </button>
  </div>
  <div id="inventorycont" class="workshop-page-container04">
    <div class="workshop-page-container05">
      <table width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody id="slotTable">
            
          </tbody>
        </table>
      </div>
      <span class="workshop-page-text12">Work Slots</span>
      <div class="workshop-page-container06">
        <button id="btnNext_Arrow" class="workshop-page-button2 button">
          >>
        </button>
        <button id="btnPrev_Arrow" class="workshop-page-button3 button">
          <<
        </button>
      </div>
    </div>
    
    <script>
      $(document).ready(function(){
        
        //csrf token
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        
        fetchWorkshops();
        $('#workshopNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
        
        //limit and offset for pagination of MAIN table
        //{
          var limit = 0;
          $(document).on('click', '#btnNext', function(e) {
            
            limit = limit + 5;
            fetchWorkshops();
            
          });
          
          $(document).on('click', '#btnPrev', function(e) {
            
            limit = limit - 5;
            
            if(limit < 0)
            {
              limit = 0;
            }
            
            fetchWorkshops();
            
          });
          //}
          
          //limit and offset for pagination of SLOT table
          //{
            var limit_arrow = 0;
            $(document).on('click', '#btnNext_Arrow', function(e) {
              
              limit_arrow = limit_arrow + 5;
              fetchSlots();
              
            });
            
            $(document).on('click', '#btnPrev_Arrow', function(e) {
              
              limit_arrow = limit_arrow - 5;
              
              if(limit_arrow < 0)
              {
                limit_arrow = 0;
              }
              
              fetchSlots();
              
            });
            //}
            
            //read
            function fetchWorkshops()
            {
              var url = '{{ url("employee/dashboard/workshop/read/:limit") }}';
              url = url.replace(':limit', limit);
              
              $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                  
                  $('#workshopTable').html('');
                  
                  $.each(response.workshops,function(key,item){
                    
                    var name = item.name;
                    var name = name.slice(0,15)+'...';
                    
                    var status = "";
                    var statusButton = "";
                    
                    if(item.status=='active')
                    {
                      status = "<div style='text-align:center; width:50%; padding:2px; border-radius:6px; background:#25b305; color:white'>Active</div>";
                      statusButton = '<button value="'+item.id+'" id="btnDeactivate" style="padding:8px; border-radius:3px; background:#f25500; color:#f2efed;">Deactivate</button>';
                    }
                    else
                    {
                      status = "<div style='text-align:center; border-radius:6px; width:60%; padding:2px; background:#cc1302; color:white'>Inactive</div>";
                      statusButton = '<button value="'+item.id+'" id="btnActivate" style="padding:8px; border-radius:3px; background:#319101; color:#f2efed;">Activate</button>';
                    }
                    
                    $('#workshopTable').append('<tr><td>'+item.no+'</td>\
                      <td>'+name+'</td>\
                      <td>'+status+'</td>\
                      <td>\
                        '+statusButton+'\
                        <button value="'+item.no+'" id="btnEdit" style="padding:8px; border-radius:3px; background:#d3e9f5; color:#615f5f;">See/Edit</button>\
                        <button value="'+item.no+'" id="btnDelete" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
                      </td>\
                    </tr>\
                    ');
                  });
                }
              });
            }
            
            //Add Workshop
            $(document).on('click','#btnAdd', function(e){
              e.preventDefault();
              
              var workshopNo = $('#workshopNo').val();
              var name = $('#name').val();
              var status = $('#status').val();
              var slot = $('#slot').val();
              
              var data = {
                'no' : workshopNo,
                'name' : name,
                'status' : status,
                'slot' : slot
              };
              
              var url = '{{ url("employee/dashboard/workshop/create") }}';
              
              $.ajax({
                type:"POST", url:url, data:data, dataType:"json",
                success: function(response)
                {
                  if(response.status == 400)
                  {
                    $('#errorlist').html('');
                    $.each(response.errors,function(key,err_value){
                      $('#errorlist').append('<li class="workshop-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
                    });
                  }
                  else
                  {
                    $('#errorlist').html('');
                    alert('Added!')
                    
                    $('#buttonContainer').html('\
                    <button id="btnAdd" class="workshop-page-button4 button">Add</button>');
                    
                    $('#workshopNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
                    $('#name').val('');
                    $('#slot').val('');
                    
                    fetchWorkshops();
                  }
                }
              });
            });
            
            //Edit
            $(document).on('click', '#btnEdit', function(e) {
              
              limit_arrow = 0; //set Slot table offset to 0
              
              workshopNo = $(this).val();
              
              var url = '{{ url("employee/dashboard/workshop/readOne/:workshopNo") }}';
              url = url.replace(':workshopNo', workshopNo);
              
              $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                  $('#status').val(response.workshops.status);
                  $('#workshopNo').val(response.workshops.no);
                  $('#name').val(response.workshops.name);
                  $('#slot').val(response.slots);
                  $('#id').val(response.workshops.id);
                  $('#formHeader').text('Edit Workshop');
                  $('#slotLabel').text('How many more Work slots?');
                  
                  $('#buttonContainer').html('\
                  <button id="btnUpdate" class="workshop-page-button4 button">Update</button>');
                  
                  fetchSlots();
                }
              });
            });
            
            //fetch work slots into table{
              var workshopNo = "";
              
              function fetchSlots()
              {
                var url = '{{ url("employee/dashboard/workshop/readSlot/:workshopNo/:limit_arrow") }}';
                url = url.replace(':workshopNo', workshopNo);
                url = url.replace(':limit_arrow', limit_arrow);
                
                $.ajax({
                  type: "GET",
                  url:url,
                  dataType:"json",
                  success:function(response){
                    
                    $('#slotTable').html('');
                    
                    $.each(response.slots,function(key,item){
                      
                      var status = "";
                      
                      if(item.status=='available')
                      {
                        status = "<div style='text-align:center; width:50%; padding:2px; border-radius:6px; background:#f55549; color:white'>Available</div>";
                        
                      }
                      else
                      {
                        status = "<div style='text-align:center; border-radius:6px; width:60%; padding:2px; background:rgb(10, 187, 10); color:white'>Occupied</div>";
                        
                      }
                      
                      $('#slotTable').append('<tr><td>'+item.slotNo+'</td>\
                        <td>'+status+'</td>\
                        <td>\
                          <button value="'+item.id+'" id="btnDeleteSlot" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
                        </td>\
                      </tr>\
                      ');
                    });
                  }
                });
              }
              //}
              
              //delete slot
              $(document).on('click', '#btnDeleteSlot', function(e) {
                
                var id = $(this).val();
                
                var url = '{{ url("employee/dashboard/workshop/deleteSlot/:id") }}';
                url = url.replace(':id', id); 
                
                $.ajax({
                  type:"DELETE",
                  url:url,
                  dataType:"json",
                });
                
                fetchSlots();
              });
              
              //Update Workshop
              $(document).on('click','#btnUpdate', function(e){
                e.preventDefault();
                
                var id = $('#id').val();
                var no = $('#workshopNo').val();
                var name = $('#name').val();
                var status = $('#status').val();
                var slot = $('#slot').val();
                
                var data = {
                  'id' : id,
                  'no' : no,
                  'name' : name,
                  'status' : status,
                  'slot' : slot
                };
                
                var url = '{{ url("employee/dashboard/workshop/update") }}';
                
                $.ajax({
                  type:"PUT", url:url, data:data, dataType:"json",
                  success: function(response)
                  {
                    if(response.status == 400)
                    {
                      $('#errorlist').html('');
                      $.each(response.errors,function(key,err_value){
                        $('#errorlist').append('<li class="workshop-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
                      });
                    }
                    else
                    {
                      $('#errorlist').html('');
                      alert('Updated!')
                      
                      $('#buttonContainer').html('\
                      <button id="btnAdd" class="workshop-page-button4 button">Add</button>');
                      
                      $('#formHeader').text('Add Workshop');
                      $('#slotLabel').text('How many Work Slots?');
                      
                      $('#workshopNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
                      $('#name').val('');
                      $('#slot').val('');
                      
                      fetchWorkshops();
                    }
                  }
                });
              });
              
              //update Status
              //{
                var status_id = "";
                var newStatus = "";
                
                $(document).on('click','#btnActivate',function(e){
                  
                  status_id = $(this).val();
                  newStatus = "active";
                  
                  updateStatus();
                  
                });
                
                $(document).on('click','#btnDeactivate',function(e){
                  
                  status_id = $(this).val();
                  newStatus = "inactive";
                  
                  updateStatus()
                  
                });
                
                function updateStatus()
                {
                  var id = status_id;
                  var status = newStatus;
                  
                  var url = '{{ url("employee/dashboard/workshop/updateStatus/:id/:status") }}';
                  url = url.replace(':id', id); 
                  url = url.replace(':status', status); 
                  
                  $.ajax({
                    type:"PUT",
                    url:url,
                    dataType:"json",
                  });
                  
                  fetchWorkshops();
                }
                //}
                
                //delete
                $(document).on('click', '#btnDelete', function(e) {
                  
                  var no = $(this).val();
                  
                  var url = '{{ url("employee/dashboard/workshop/delete/:no") }}';
                  url = url.replace(':no', no); 
                  
                  $.ajax({
                    type:"DELETE",
                    url:url,
                    dataType:"json",
                  });
                  
                  fetchWorkshops();
                });
                
                
              });
            </script>
            
            
            
            <div class="workshop-page-container07">
              <ul id="errorlist" class="workshop-page-ul list">
                
              </ul>
              <div class="workshop-page-container08">
                <span class="workshop-page-text16" id="formHeader">Add Workshop</span>
                
                
                <form class="workshop-page-form">
                  
                  <input type="hidden" id="id"/>
                  <select id="status" class="workshop-page-select" >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                  <input readonly type="text" id="workshopNo" class="workshop-page-textinput input" />
                  <input type="text" id="name" class="workshop-page-textinput1 input" />
                  <input type="number" id="slot" class="workshop-page-textinput2 input" />
                  
                  <span class="workshop-page-text17">Workshop Number</span>
                  <span class="workshop-page-text18">Name</span>
                  <span class="workshop-page-text19">Status</span>
                  <span class="workshop-page-text20" id="slotLabel">Number of Slots</span>
                  
                  <div id="buttonContainer">
                    <button id="btnAdd" class="workshop-page-button4 button" > Add </button>
                  </div>
                  
                </form>
              </div>
            </div>
            <div class="workshop-page-container09">
              <span class="workshop-page-text21">Lock Hood Pvt Ltd 2022</span>
            </div>
          </div>
        </div>
      </body>
      </html>
