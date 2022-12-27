<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator - Lock Hood</title>
  <meta property="og:title" content="SupervisorPage - Lock Hood" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
  <div>
    <link rel="stylesheet" href="{{ asset('assets/supervisor-page.css') }}" />
    
    <div class="supervisor-page-container">
      <header
      data-thq="thq-navbar"
      class="supervisor-page-navbar-interactive"
      >
      <div
      data-thq="thq-navbar-nav"
      data-role="Nav"
      class="supervisor-page-desktop-menu"
      >
      <nav
      data-thq="thq-navbar-nav-links"
      data-role="Nav"
      class="supervisor-page-nav"
      >
      <a href="{{ route('administrator.dashboard') }}" id="home" class="supervisor-page-text">Home</a>
      <a href="{{ route('administrator.factory') }}" id="factories" class="supervisor-page-text01">
        Factories
      </a>
      <a href="{{ route('administrator.department') }}" id="departments" class="supervisor-page-text02">
        Departments
      </a>
      <a href="{{ route('administrator.supervisor') }}" id="supervisors" class="supervisor-page-text03">
        Supervisors
      </a>
    </nav>
  </div>
  <label id="seniormanageraccount" class="supervisor-page-text04">
    Senior Manager Account
  </label>
  <div class="supervisor-page-container1">
    <a onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" href="{{ route('administrator.logout') }}"
    class="supervisor-page-text05">Log Out</a>
    
    <form id="logout-form" 
    action="{{ route('administrator.logout') }}" 
    method="POST" class="d-none">
    @csrf
  </form>
</div>
</header>
<div id="inventorycont" class="supervisor-page-container2">
  <div class="supervisor-page-container3">
    <table width="100%">
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Photo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="supervisorTable">
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function(){
    
    //csrf token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    fetchSupervisors();
    fetchDepartment();
    
    $('#supervisorNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
    
    //limit and offset for pagination
    var limit = 0;
    $(document).on('click', '#btnNext', function(e) {
      
      limit = limit + 4;
      fetchSupervisors();
      
    });
    
    $(document).on('click', '#btnPrev', function(e) {
      
      limit = limit - 4;
      
      if(limit < 0)
      {
        limit = 0;
      }
      
      fetchSupervisors();
      
    });
    
    //read
    function fetchSupervisors()
    {
      var url = '{{ url("administrator/dashboard/supervisor/read/:limit") }}';
      url = url.replace(':limit', limit);
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#supervisorTable').html('');
          
          $.each(response.employees,function(key,item){
            
            var name = item.name;
            var name = name.slice(0,15)+'...';
            
            $('#supervisorTable').append('<tr><td>'+item.no+'</td>\
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
    function fetchDepartment()
    {
      var url = '{{ url("administrator/dashboard/department/read/:limit") }}';
      url = url.replace(':limit', 0);
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#department').html('');
          
          $.each(response.departments,function(key,item){
            
            $('#department').append('<option value="'+item.no+' '+item.factoryNo+'">'+item.name+'</option>\
            ');
          });
        }
      });
    }
    
    //add Supervisor
    $(document).on('click', '#btnAdd', function(e) {
      e.preventDefault();
      
      if( $('#password').val() == $('#confirmPassword').val())
      {
        let formData = new FormData($('#addForm')[0]);
        $.ajax({
          type: "POST",
          url: "{{ url('administrator/dashboard/supervisor/create') }}",
          data: formData,
          contentType:false,
          processData:false,
          success: function(response){
            if(response.status==400)
            {
              $('#errorlist').html('');
              $.each(response.errors,function(key,err_value){
                $('#errorlist').append('<li class="supervisor-page-li list-item"><span class="supervisor-page-text08">'+err_value+'</span></li>');
              });
            }
            else
            {
              $('#errorlist').html('');
              alert('Added!')
              
              $('#buttonContainer').html('\
              <button id="btnAdd" class="supervisor-page-button2 button">Add</button>');
              
              $('#supervisorNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
              $('#address').val('');
              $('#email').val('');
              $('#name').val('');
              $('#password').val('');
              $('#dob').val('');
              $('#confirmPassword').val('');
              $('#contact').val('');
              $('#photo').val('');
              
              fetchSupervisors();
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
      
      var url = '{{ url("administrator/dashboard/supervisor/readOne/:id") }}';
      url = url.replace(':id', id);
      
      $.ajax({
        type:"GET",
        url:url,
        dataType:"json",
        success: function(response)
        {
          $('#supervisorNo').val(response.employees.no);
          $('#address').val(response.employees.address);
          $('#department').val(response.employees.departmentNo);
          $('#email').val(response.employees.email);
          $('#name').val(response.employees.name);
          $('#dob').val(response.employees.dob);
          $('#contact').val(response.employees.contact);
          $('#id').val(response.employees.id);
          $('#password').val('');
          
          $('#formHeader').text('Edit Supervisor');
          
          $('#buttonContainer').html('\
          <button id="btnUpdate" class="supervisor-page-button2 button">Update</button>');
        }
      });
      
    });
    
    //Update Supervisor
    function update()
    {
      let formData = new FormData($('#addForm')[0]);
      $.ajax({
        type: "POST",
        url: "{{ url('administrator/dashboard/supervisor/update') }}",
        data: formData,
        contentType:false,
        processData:false,
        success: function(response){
          if(response.status==400)
          {
            $('#errorlist').html('');
            $.each(response.errors,function(key,err_value){
              $('#errorlist').append('<li class="supervisor-page-li list-item"><span class="supervisor-page-text08">'+err_value+'</span></li>');
            });
          }
          else
          {
            $('#errorlist').html('');
            alert('Updated!')
            
            $('#buttonContainer').html('\
            <button id="btnAdd" class="supervisor-page-button2 button">Add</button>');
            
            $('#supervisorNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
            $('#address').val('');
            $('#email').val('');
            $('#name').val('');
            $('#password').val('');
            $('#dob').val('');
            $('#confirmPassword').val('');
            $('#contact').val('');
            $('#photo').val('');
            
            fetchSupervisors();
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
      
      var url = '{{ url("administrator/dashboard/supervisor/delete/:id") }}';
      url = url.replace(':id', id);
      
      $.ajax({
        type:"DELETE",
        url:url,
        dataType:"json",
      });
      
      
      fetchSupervisors();
    });
    
  });
  
</script>


<span class="supervisor-page-text07">Supervisors</span>
<button id="btnNext" class="supervisor-page-button button">
  Next
</button>
<button id="btnPrev" class="supervisor-page-button1 button">
  Prev
</button>
</div>
<div class="supervisor-page-container4">
  
  <ul id="errorlist" class="supervisor-page-ul list">
  </ul>
  
  <div class="supervisor-page-container5">
    <span class="supervisor-page-text11" id="formHeader">Add Supervisors</span>
    
    <form class="supervisor-page-form" id="addForm" method="POST" enctype="multipart/form-data">
      <select id="department" name="department" class="supervisor-page-select" >
      </select>
      
      <input type="hidden" id="id" name="id">
      <input
      type="text"
      id="supervisorNo" readonly
      name="no"
      class="supervisor-page-textinput input"
      />
      <input
      type="text"
      id="address"
      name="address"
      class="supervisor-page-textinput1 input"
      />
      <input
      type="email"
      id="email"
      name="email"
      class="supervisor-page-textinput2 input"
      />
      <input
      type="text"
      id="name"
      name="name"
      class="supervisor-page-textinput3 input"
      />
      <input
      type="password"
      id="password"
      name="password"
      class="supervisor-page-textinput4 input"
      />
      <input
      type="date"
      id="dob"
      name="dob"
      class="supervisor-page-textinput5 input"
      />
      <input
      type="password"
      id="confirmPassword"
      name="confirmPassword"
      class="supervisor-page-textinput6 input"
      />
      <input
      type="number"
      id="contact"
      name="contact"
      class="supervisor-page-textinput7 input"
      />
      <input
      type="file"
      id="photo"
      name="photo"
      class="supervisor-page-textinput8 input"
      />
      <span class="supervisor-page-text12">Supervisor Number</span>
      <span class="supervisor-page-text13">Address</span>
      <span class="supervisor-page-text14">Email</span>
      <span class="supervisor-page-text15">Name</span>
      <span class="supervisor-page-text16">Password</span>
      <span class="supervisor-page-text17">Department</span>
      <span class="supervisor-page-text18">Contact</span>
      <span class="supervisor-page-text19">Photo</span>
      <span class="supervisor-page-text20">Date Of Birth</span>
      <span class="supervisor-page-text21">Confirm Password</span>
      
    </form>
    
    <div id="buttonContainer">
      <button id="btnAdd" type="submit" class="supervisor-page-button2 button"> Add </button>
    </div>
    
  </div>
</div>
<div class="supervisor-page-container6">
  <span class="supervisor-page-text22">Lock Hood Pvt Ltd 2022</span>
</div>
</div>
</div>
</body>
</html>
