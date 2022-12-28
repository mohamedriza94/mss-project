<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee - Lock Hood</title>
  <meta property="og:title" content="WorkersPage - Lock Hood" />
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
    <link rel="stylesheet" href="{{ asset('assets/workers-page.css') }}" />
    
    <div class="workers-page-container">
      <header data-thq="thq-navbar" class="workers-page-navbar-interactive">
        <div
        data-thq="thq-navbar-nav"
        data-role="Nav"
        class="workers-page-desktop-menu"
        >
        <nav
        data-thq="thq-navbar-nav-links"
        data-role="Nav"
        class="workers-page-nav"
        >
        <a href="index.html" class="workers-page-navlink">
          <label id="home" class="workers-page-text">Home</label>
        </a>
        <a href="{{ route('employee.workshop') }}" class="workers-page-navlink1">
          <label id="factories" class="workers-page-text01">
            Workshops
          </label>
        </a>
        <a href="{{ route('employee.worker') }}" class="workers-page-navlink2">
          <label id="departments" class="workers-page-text02">
            Workers
          </label>
        </a>
        <a href="{{ route('employee.kanbanCard') }}" class="workers-page-navlink3">
          <label id="supervisors" class="workers-page-text03">
            Kanban Cards
          </label>
        </a>
        <a href="{{ route('employee.inventory') }}" class="workers-page-navlink4">
          <label id="factories" class="workers-page-text04">
            Inventories
          </label>
        </a>
      </nav>
    </div>
    <a href="#" class="workers-page-navlink5">
      <label id="seniormanageraccount" class="workers-page-text05">
        Supervisor Account
      </label>
    </a>
    <div class="workers-page-container1">
      <a href="{{ route('employee.logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="workers-page-navlink6">
      <label id="login" class="workers-page-text06">Logout</label>
    </a>
    
    <form id="logout-form" 
    action="{{ route('employee.logout') }}" 
    method="POST" class="d-none">
    @csrf
  </form>
  
</div>
</header>
<div class="workers-page-container2">
  <div class="workers-page-container3">
    <table width="100%">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Address</th>
          <th>Contact</th>
          <th>Photo</th>
          <th>Action</th>
        </thead>
        <tbody id="workerTable">
          
        </tbody>
      </table>

      <script>
        $(document).ready(function(){
          
          //csrf token
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          
          fetchWorkers();
          fetchWorkshop();
          
          $('#workerNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
          
          //limit and offset for pagination
          var limit = 0;
          $(document).on('click', '#btnNext', function(e) {
            
            limit = limit + 4;
            fetchWorkers();
            
          });
          
          $(document).on('click', '#btnPrev', function(e) {
            
            limit = limit - 4;
            
            if(limit < 0)
            {
              limit = 0;
            }
            
            fetchWorkers();
            
          });
          
          //read
          function fetchWorkers()
          {
            var url = '{{ url("employee/dashboard/worker/read/:limit") }}';
            url = url.replace(':limit', limit);
            
            $.ajax({
              type: "GET",
              url:url,
              dataType:"json",
              success:function(response){
                
                $('#workerTable').html('');
                
                $.each(response.employees,function(key,item){
                  
                  var name = item.name;
                  var name = name.slice(0,15)+'...';
                  
                  $('#workerTable').append('<tr><td>'+item.no+'</td>\
                    <td>'+name+'</td>\
                    <td>'+item.address+'</td>\
                    <td>'+item.contact+'</td>\
                    <td><img src="'+item.photo+'" style="width:50px;"></td>\
                    <td>\
                      <button value="'+item.id+'" id="btnEdit" style="padding:8px; border-radius:3px; background:#d3e9f5; color:#615f5f;">Edit</button>\
                      <button value="'+item.id+'" id="btnDelete" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
                    </td>\
                  </tr>\
                  ');
                });
              }
            });
          }
          
          //read department
          function fetchWorkshop()
          {
            var url = '{{ url("employee/dashboard/workshop/readToSelect") }}';
            
            $.ajax({
              type: "GET",
              url:url,
              dataType:"json",
              success:function(response){
                
                $('#workshop').html('');
                
                $.each(response.workshops,function(key,item){
                  
                  var urlGetDepartment = '{{ url("employee/dashboard/department/readRelation/:departmentNo") }}';
                  urlGetDepartment = urlGetDepartment.replace(':departmentNo', item.departmentNo);
                  
                  $.ajax({
                    type: "GET",
                    url:urlGetDepartment,
                    dataType:"json",
                    success:function(response){
                      $.each(response.departments,function(key,itemDepartment){
      
                        $('#workshop').append('<option value="'+item.no+' '+item.departmentNo+'">'+item.name+' - '+itemDepartment.name+'</option>\
                        ');
      
                      })
                    }
                  });
                  
                  
                });
              }
            });
          }
          
          //add Worker
          $(document).on('click', '#btnAdd', function(e) {
            e.preventDefault();
            
            if( $('#password').val() == $('#confirmPassword').val())
            {
              let formData = new FormData($('#addForm')[0]);
              $.ajax({
                type: "POST",
                url: "{{ url('employee/dashboard/worker/create') }}",
                data: formData,
                contentType:false,
                processData:false,
                success: function(response){
                  if(response.status==400)
                  {
                    $('#errorlist').html('');
                    $.each(response.errors,function(key,err_value){
                      $('#errorlist').append('<li class="worker-page-li list-item"><span style="color:white" class="worker-page-text08">'+err_value+'</span></li>');
                    });
                  }
                  else
                  {
                    $('#errorlist').html('');
                    alert('Added!')
                    
                    $('#buttonContainer').html('\
                    <button id="btnAdd" class="workers-page-button2 button">Add</button>');
                    
                    $('#workerNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
                    $('#address').val('');
                    $('#email').val('');
                    $('#name').val('');
                    $('#password').val('');
                    $('#dob').val('');
                    $('#confirmPassword').val('');
                    $('#contact').val('');
                    $('#photo').val('');
                    
                    fetchWorkers();
                  }
                }
              });
            }
            else
            {
              alert('Passwords Do Not Match');
            }
            
          });
          
          //Edit
          $(document).on('click', '#btnEdit', function(e) {
            
            var id = $(this).val();
            
            var url = '{{ url("employee/dashboard/worker/readOne/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
              type:"GET",
              url:url,
              dataType:"json",
              success: function(response)
              {
                $('#workerNo').val(response.employees.no);
                $('#address').val(response.employees.address);
                $('#department').val(response.employees.departmentNo);
                $('#email').val(response.employees.email);
                $('#name').val(response.employees.name);
                $('#dob').val(response.employees.dob);
                $('#contact').val(response.employees.contact);
                $('#id').val(response.employees.id);
                $('#password').val('');
                
                $('#formHeader').text('Edit Worker');
                
                $('#buttonContainer').html('\
                <button id="btnUpdate" class="workers-page-button2 button">Update</button>');
              }
            });
            
          });
          
          //Update Worker
          function update()
          {
            let formData = new FormData($('#addForm')[0]);
            $.ajax({
              type: "POST",
              url: "{{ url('employee/dashboard/worker/update') }}",
              data: formData,
              contentType:false,
              processData:false,
              success: function(response){
                if(response.status==400)
                {
                  $('#errorlist').html('');
                  $.each(response.errors,function(key,err_value){
                    $('#errorlist').append('<li class="worker-page-li list-item"><span style="color:white" class="worker-page-text08">'+err_value+'</span></li>');
                  });
                }
                else
                {
                  $('#errorlist').html('');
                  alert('Updated!')
                  
                  $('#buttonContainer').html('\
                  <button id="btnAdd" class="workers-page-button2 button">Add</button>');
                  
                  $('#workerNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
                  $('#address').val('');
                  $('#email').val('');
                  $('#name').val('');
                  $('#password').val('');
                  $('#dob').val('');
                  $('#confirmPassword').val('');
                  $('#contact').val('');
                  $('#photo').val('');
                  
                  fetchWorkers();
                }
              }
            });
          } 
          
          $(document).on('click', '#btnUpdate', function(e) {
            
            e.preventDefault();
            
            if( $('#password').val() == "")
            {
              if( $('#password').val() == $('#confirmPassword').val())
              {
                update();
              }
              else
              {
                alert('Passwords Do Not Match');
              }
            }
            else
            {
              update();
            }
            
          });
          
          //delete
          $(document).on('click', '#btnDelete', function(e) {
            
            var id = $(this).val();
            
            var url = '{{ url("employee/dashboard/worker/delete/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
              type:"DELETE",
              url:url,
              dataType:"json",
            });
            
            
            fetchWorkers();
          });
          
        });
        
      </script>

    </div>
    <span class="workers-page-text08">Workers</span>
    <button id="btnNext" class="workers-page-button button">Next</button>
    <button id="btnPrev" class="workers-page-button1 button">
      Prev
    </button>
  </div>
  <div class="workers-page-container4">
    <ul id="errorlist" class="workers-page-ul list"></ul>
    
    <div class="workers-page-container5">

      <span class="workers-page-text12" id="formHeader">Add Workers</span>
      
      <form class="workers-page-form" id="addForm" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" id="id">
        <select id="workshop" name="workshop" class="workers-page-select"></select>
        <input type="text" id="workerNo" name="no" readonly class="workers-page-textinput input"/>
        <input type="text" id="address" name="address" class="workers-page-textinput1 input"/>
        <input type="email" id="email" name="email" class="workers-page-textinput2 input"/>
        <input type="text" id="name" name="name" class="workers-page-textinput3 input"/>
        <input type="password" id="password" name="password" class="workers-page-textinput4 input"/>
        <input type="date" id="dob" name="dob" class="workers-page-textinput5 input"/>
        <input type="password" id="confirmPassword" name="confirmPassword" class="workers-page-textinput6 input"/>
        <input type="number" id="contact" name="contact" class="workers-page-textinput7 input"/>
        <input type="file" id="photo" name="photo" class="workers-page-textinput8 input"/>
        
        <span class="workers-page-text13">Worker Number</span>
        <span class="workers-page-text14">Address</span>
        <span class="workers-page-text15">Email</span>
        <span class="workers-page-text16">Name</span>
        <span class="workers-page-text17">Password</span>
        <span class="workers-page-text18">Workshop</span>
        <span class="workers-page-text19">Contact</span>
        <span class="workers-page-text20">Photo</span>
        <span class="workers-page-text21">Date Of Birth</span>
        <span class="workers-page-text22">Confirm Password</span>
      </form>
      
      <div id="buttonContainer">
        <button id="btnAdd" type="submit" class="workers-page-button2 button"> Add </button>
      </div>
      
    </div>
  </div>
  <div class="workers-page-container6">
    <span class="workers-page-text23">Lock Hood Pvt Ltd 2022</span>
  </div>
</div>
</div>
</html>
