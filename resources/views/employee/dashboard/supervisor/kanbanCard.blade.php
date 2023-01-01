<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee - Lock Hood</title>
  <meta property="og:title" content="KanbanCardsPage - Lock Hood" />
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
    <link rel="stylesheet" href="{{ asset('assets/kanban-cards-page.css') }}" />
    
    <div class="kanban-cards-page-container">
      <header
      data-thq="thq-navbar"
      class="kanban-cards-page-navbar-interactive"
      >
      <div
      data-thq="thq-navbar-nav"
      data-role="Nav"
      class="kanban-cards-page-desktop-menu"
      >
      <nav
      data-thq="thq-navbar-nav-links"
      data-role="Nav"
      class="kanban-cards-page-nav"
      >
      <a href="{{ route('employee.dashboard') }}" class="kanban-cards-page-navlink">
        <label id="home" class="kanban-cards-page-text">Home</label>
      </a>
      <a href="{{ route('employee.workshop') }}" class="kanban-cards-page-navlink1">
        <label class="kanban-cards-page-text01">
          Workshops
        </label>
      </a>
      <a href="{{ route('employee.worker') }}" class="kanban-cards-page-navlink2">
        <label class="kanban-cards-page-text02">
          Workers
        </label>
      </a>
      <a href="{{ route('employee.kanbanCard') }}" class="kanban-cards-page-navlink3">
        <label class="kanban-cards-page-text03">
          Kanban Cards
        </label>
      </a>
      <a href="{{ route('employee.inventory') }}" class="kanban-cards-page-navlink4">
        <label class="kanban-cards-page-text04">
          Inventories
        </label>
      </a>
    </nav>
  </div>
  <a href="#" class="kanban-cards-page-navlink5">
    <label id="seniormanageraccount" class="kanban-cards-page-text05">
      {{ auth()->guard('employee')->user()->name }} (Supervisor)
    </label>
  </a>
  <div class="kanban-cards-page-container01">
    <a href="{{ route('employee.logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" class="kanban-cards-page-navlink6">
    <label id="login" class="kanban-cards-page-text06">Logout</label>
  </a>
  
  <form id="logout-form" 
  action="{{ route('employee.logout') }}" 
  method="POST" class="d-none">
  @csrf
</form>

</div>
</header>
<div class="kanban-cards-page-container02">
  <a href="#formHeader" class="kanban-cards-page-button button">Create New</a>
  <a href="#taskTableHeader" class="kanban-cards-page-button1 button">Go To Tasks</a>
</div>
<div id="inventorycont" class="kanban-cards-page-container03">
  <div class="kanban-cards-page-container04">
    <table width="100%">
      <thead>
        <tr>
          <th>No.</th>
          <th>Title</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody id="kanbanCardTable">
          
        </tbody>
      </table>
    </div>
    <span class="kanban-cards-page-text08">
      <span>Kanban Cards</span>
      <br />
    </span>
    <button id="btnNext" class="kanban-cards-page-button2 button">
      Next
    </button>
    <button id="btnPrev" class="kanban-cards-page-button3 button">
      Previous
    </button>
  </div>
  <div id="inventorycont" class="kanban-cards-page-container05">
    <span class="kanban-cards-page-text11" id="taskTableHeader">Tasks</span>
    <div class="kanban-cards-page-container06">
      <table width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody id="taskTable">
            
          </tbody>
        </table>
      </div>
      <div class="kanban-cards-page-container07">
        <button id="btnPrev_Arrow" class="kanban-cards-page-button4 button">
          <<
        </button>
        <button id="btnNext_Arrow" class="kanban-cards-page-button5 button">
          >>
        </button>
      </div>
    </div>
    
    <div class="kanban-cards-page-container08">
      
      <ul id="errorlist" class="kanban-cards-page-ul list"></ul>
      
      <div class="kanban-cards-page-container09">
        <span class="kanban-cards-page-text16" id="formHeader">Create Card</span>
        
        <form class="kanban-cards-page-form">
          
          <input type="hidden" id="id">
          
          <div class="kanban-cards-page-container10">
            <span class="kanban-cards-page-text17">Card Number</span>
            <input type="number" id="cardNo" readonly class="kanban-cards-page-textinput input"/>
          </div>
          
          <div class="kanban-cards-page-container11">
            <span class="kanban-cards-page-text18">Title</span>
            <input type="text" id="title" class="kanban-cards-page-textinput1 input"/>
          </div>
          
          <div class="kanban-cards-page-container12">
            <span class="kanban-cards-page-text19">Description</span>
            <textarea type="text" id="description" class="kanban-cards-page-textinput2 input"></textarea>
          </div>
          
          <div id="buttonContainer">
            <button id="btnAdd" type="submit" class="kanban-cards-page-button6 button"> Create </button>
          </div>
          
        </form>
        
      </div>
      
      <div class="kanban-cards-page-container13">
        
        <ul id="taskErrorlist" style="margin-bottom: 10px;" class="kanban-cards-page-ul list"></ul>
        
        <span class="kanban-cards-page-text20" id="taskFormHeader">Add Task</span>
        <form class="kanban-cards-page-form1">
          
          <input type="hidden" id="taskId">
          <div class="kanban-cards-page-container14">
            <span class="kanban-cards-page-text21">Card Number</span>
            <input type="number" id="getCardNo" readonly class="kanban-cards-page-textinput3 input" />
          </div>
          
          <div class="kanban-cards-page-container15">
            <span class="kanban-cards-page-text22">Title</span>
            <input type="text" id="taskTitle" class="kanban-cards-page-textinput4 input" />
          </div>
          
          <div class="kanban-cards-page-container16">
            <span class="kanban-cards-page-text23">Description</span>
            <input type="text" id="taskDescription" class="kanban-cards-page-textinput5 input" />
          </div>
          
          <div class="kanban-cards-page-container17">
            <span class="kanban-cards-page-text24">Start Date</span>
            <input type="date" id="start" class="kanban-cards-page-textinput6 input" />
          </div>
          
          <div class="kanban-cards-page-container18">
            <span class="kanban-cards-page-text25">End Date</span>
            <input type="date" id="end" class="kanban-cards-page-textinput7 input" />
          </div>
          
          <div class="kanban-cards-page-container19">
            <span class="kanban-cards-page-text26">Duration (Days)</span>
            <input type="text" id="duration" disabled="" class="kanban-cards-page-textinput8 input" />
          </div>
          
          <button id="btnAutoSchedule" type="submit" class="kanban-cards-page-button7 button" > Auto Schedule </button>
          
          <div id="taskButtonContainer">
            <button id="btnAddTask" type="submit" class="kanban-cards-page-button8 button"> Add </button>
          </div>
          
        </form>
      </div>
    </div>
    <div class="kanban-cards-page-container20">
      <span class="kanban-cards-page-text27">Lock Hood Pvt Ltd 2022</span>
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
    
    //call functions
    fetchKanBanCards();

    //get random number to text field
    $('#cardNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
    
    //limit and offset for pagination of MAIN table
    //
    var limit = 0;
    $(document).on('click', '#btnNext', function(e) {
      
      limit = limit + 5;
      fetchKanBanCards();
      fetchTasks();
    });
    
    $(document).on('click', '#btnPrev', function(e) {
      
      limit = limit - 5;
      
      if(limit < 0)
      {
        limit = 0;
      }
      
      fetchKanBanCards();
      
    });
    
    //limit and offset for pagination of SLOT table
    //
    var limit_arrow = 0;
    $(document).on('click', '#btnNext_Arrow', function(e) {
      
      limit_arrow = limit_arrow + 5;
      fetchTasks();
      
    });
    
    $(document).on('click', '#btnPrev_Arrow', function(e) {
      
      limit_arrow = limit_arrow - 5;
      
      if(limit_arrow < 0)
      {
        limit_arrow = 0;
      }
      
      fetchTasks();
      
    });
    //
    
    //Add Card
    $(document).on('click','#btnAdd', function(e){
      e.preventDefault();
      
      var cardNo = $('#cardNo').val();
      var title = $('#title').val();
      var description = $('#description').val();
      
      var data = {
        'cardNo' : cardNo,
        'title' : title,
        'description' : description,
      };
      
      var url = '{{ url("employee/dashboard/kbc/create") }}';
      
      $.ajax({
        type:"POST", url:url, data:data, dataType:"json",
        success: function(response)
        {
          if(response.status == 400)
          {
            $('#errorlist').html('');
            $.each(response.errors,function(key,err_value){
              $('#errorlist').append('<li class="kanban-cards-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
            });
          }
          else
          {
            $('#errorlist').html('');
            alert('Added!')
            
            $('#buttonContainer').html('\
            <button id="btnAdd" type="submit" class="kanban-cards-page-button6 button"> Create </button>');
            
            $('#cardNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
            $('#title').val('');
            $('#description').val('');
            
            fetchKanBanCards();
          }
        }
      });
    });
    
    //update Card
    $(document).on('click','#btnUpdate', function(e){
      e.preventDefault();
      
      var id = $('#id').val();
      var cardNo = $('#cardNo').val();
      var title = $('#title').val();
      var description = $('#description').val();
      
      var data = {
        'id' : id,
        'cardNo' : cardNo,
        'title' : title,
        'description' : description,
      };
      
      var url = '{{ url("employee/dashboard/kbc/update") }}';
      
      $.ajax({
        type:"POST", url:url, data:data, dataType:"json",
        success: function(response)
        {
          if(response.status == 400)
          {
            $('#errorlist').html('');
            $.each(response.errors,function(key,err_value){
              $('#errorlist').append('<li class="kanban-cards-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
            });
          }
          else
          {
            $('#errorlist').html('');
            alert('Updated!')
            
            $('#buttonContainer').html('\
            <button id="btnAdd" type="submit" class="kanban-cards-page-button6 button"> Create </button>');
            
            $('#formHeader').text('Add Card');
            
            $('#cardNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
            $('#title').val('');
            $('#description').val('');
            $('#id').val('');
            
            fetchKanBanCards();
          }
        }
      });
    });
    
    //read Cards
    function fetchKanBanCards()
    {
      var url = '{{ url("employee/dashboard/kbc/read/:limit") }}';
      url = url.replace(':limit',limit);
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#kanbanCardTable').html('');
          
          $.each(response.cards,function(key,item){
            
            var title = item.title;
            var title = title.slice(0,15)+'...';
            
            var date = item.date;
            var date = date.slice(0,10);
            
            var time = item.time;
            var time = time.slice(11,19);
            
            var status = "";
            
            if(item.status=='started')
            {
              status = "<div style='text-align:center; width:50%; padding:8px; border-radius:6px; background:#14c704; color:white'>In progress</div>";
            }
            else if(item.status=='pending')
            {
              status = "<div style='text-align:center; border-radius:6px; width:60%; padding:8px; background:#c77904; color:white'>Pending</div>";
            }
            else if(item.status=='completed')
            {
              status = "<div style='text-align:center; border-radius:6px; width:60%; padding:8px; background:#e63002; color:white'>Complete</div>";
            }
            
            $('#kanbanCardTable').append('<tr><td>'+item.cardNo+'</td>\
              <td>'+title+'</td>\
              <td>'+date+'</td>\
              <td>'+time+'</td>\
              <td>'+status+'</td>\
              <td>\
                <button value="'+item.cardNo+'" id="btnEdit" style="padding:8px; border-radius:3px; background:#d3e9f5; color:#615f5f;">Edit/Add Task</button>\
                <button value="'+item.cardNo+'" id="btnDelete" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
              </td>\
            </tr>\
            ');
          });
        }
      });
    }
    
    //Edit Card
    $(document).on('click', '#btnEdit', function(e) {
      
      limit_arrow = 0; //set Slot table offset to 0
      
      cardNo = $(this).val();
      
      var url = '{{ url("employee/dashboard/kbc/readOne/:no") }}';
      url = url.replace(':no', cardNo);
      
      $.ajax({
        type:"GET",
        url:url,
        dataType:"json",
        success: function(response)
        {
          $('#id').val(response.cards.id);
          $('#cardNo').val(response.cards.cardNo);
          $('#getCardNo').val(response.cards.cardNo);
          $('#title').val(response.cards.title);
          $('#description').val(response.cards.description);
          
          $('#formHeader').text('Edit Card');
          
          $('#buttonContainer').html('\
          <button id="btnUpdate" type="submit" class="kanban-cards-page-button6 button"> Update </button>');
          
          fetchTasks();
          
          $('html, body').animate({
            scrollTop: $("#formHeader").offset().top
          }, 1);
        }
      });
    });
    
    //fetch tasks
    var cardNo = "";
    function fetchTasks()
    {
      var url = '{{ url("employee/dashboard/task/read/:cardNo/:limit_arrow") }}';
      url = url.replace(':cardNo', cardNo);
      url = url.replace(':limit_arrow', limit_arrow);
      
      $.ajax({
        type: "GET",
        url:url,
        dataType:"json",
        success:function(response){
          
          $('#taskTable').html('');
          
          $.each(response.tasks,function(key,item){
            
            var name = item.name;
            var name = name.slice(0,15)+'...';
            
            var status = "";
            
            if(item.status=='started')
            {
              status = "<div style='text-align:center; width:50%; padding:8px; border-radius:6px; background:#14c704; color:white'>In progress</div>";
            }
            else if(item.status=='pending')
            {
              status = "<div style='text-align:center; border-radius:6px; width:60%; padding:8px; background:#c77904; color:white'>Pending</div>";
            }
            else if(item.status=='completed')
            {
              status = "<div style='text-align:center; border-radius:6px; width:60%; padding:8px; background:#e63002; color:white'>Complete</div>";
            }
            
            $('#taskTable').append('<tr><td>'+item.taskNo+'</td>\
              <td>'+name+'</td>\
              <td>'+item.startDate+'</td>\
              <td>'+item.endDate+'</td>\
              <td>'+item.duration+'</td>\
              <td>'+status+'</td>\
              <td>\
                <button value="'+item.taskNo+'" id="btnEditTask" style="padding:8px; border-radius:3px; background:#d3e9f5; color:#615f5f;">Edit/See</button>\
                <button value="'+item.taskNo+'" id="btnDeleteTask" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
              </td>\
            </tr>\
            ');
          });
        }
      });
    }
    
    //delete card
    $(document).on('click', '#btnDelete', function(e) {
      
      var no = $(this).val();
      
      var url = '{{ url("employee/dashboard/kbc/delete/:no") }}';
      url = url.replace(':no', no); 
      
      $.ajax({
        type:"DELETE",
        url:url,
        dataType:"json",
      });
      
      fetchKanBanCards();
    });
    
    
    //TASKS ===================================================================
    
    //Add Task
    $(document).on('click','#btnAddTask', function(e){
      e.preventDefault();
      
      var taskNo = Math.floor(Math.random() * (19999 - 99999 + 1) + 99999);
      var getCardNo = $('#getCardNo').val();
      var taskTitle = $('#taskTitle').val();
      var description = $('#taskDescription').val();
      var start = $('#start').val();
      var end = $('#end').val();
      var duration = $('#duration').val();
      
      if(getCardNo == "")
      {
        alert('Choose a Card First');
      }
      
      var data = {
        'taskNo' : taskNo,
        'cardNo' : getCardNo,
        'name' : taskTitle,
        'description' : description,
        'startDate' : start,
        'endDate' : end,
        'duration' : duration,
      };
      
      var url = '{{ url("employee/dashboard/task/create") }}';
      
      $.ajax({
        type:"POST", url:url, data:data, dataType:"json",
        success: function(response)
        {
          if(response.status == 400)
          {
            $('#taskErrorlist').html('');
            $.each(response.errors,function(key,err_value){
              $('#taskErrorlist').append('<li class="kanban-cards-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
            });
          }
          else
          {
            $('#taskErrorlist').html('');
            alert('Task Added!')
            
            $('#taskButtonContainer').html('\
            <button id="btnAddTask" type="submit" class="kanban-cards-page-button8 button"> Add </button>');
            
            $('#taskTitle').val('');
            $('#taskDescription').val('');
            $('#start').val('');
            $('#end').val('');
            $('#duration').val('');
            
            fetchTasks();
          }
        }
      });
    });
    
    //Update Task
    $(document).on('click','#btnUpdateTask', function(e){
      e.preventDefault();
      
      var taskId = $('#taskId').val();
      var taskTitle = $('#taskTitle').val();
      var description = $('#taskDescription').val();
      var start = $('#start').val();
      var end = $('#end').val();
      var duration = $('#duration').val();
      
      var data = {
        'taskId' : taskId,
        'name' : taskTitle,
        'description' : description,
        'startDate' : start,
        'endDate' : end,
        'duration' : duration,
      };
      
      var url = '{{ url("employee/dashboard/task/update") }}';
      
      $.ajax({
        type:"POST", url:url, data:data, dataType:"json",
        success: function(response)
        {
          if(response.status == 400)
          {
            $('#taskErrorlist').html('');
            $.each(response.errors,function(key,err_value){
              $('#taskErrorlist').append('<li class="kanban-cards-page-li list-item"><span style="color:white;">'+err_value+'</span></li>');
            });
          }
          else
          {
            $('#taskErrorlist').html('');
            alert('Task Updated!')
            
            $('#taskButtonContainer').html('\
            <button id="btnAddTask" type="submit" class="kanban-cards-page-button8 button"> Add </button>');
            
            $('#getCardNo').val('');
            $('#taskTitle').val('');
            $('#taskDescription').val('');
            $('#start').val('');
            $('#end').val('');
            $('#duration').val('');
            
            $('#taskFormHeader').text('Add Task');
            
            fetchTasks();
          }
        }
      });
    });
    
    //Edit Task
    $(document).on('click', '#btnEditTask', function(e) {
      
      limit_arrow = 0; //set Slot table offset to 0
      
      var taskNo = $(this).val();
      
      var url = '{{ url("employee/dashboard/task/readOne/:no") }}';
      url = url.replace(':no', taskNo);
      
      $.ajax({
        type:"GET",
        url:url,
        dataType:"json",
        success: function(response)
        {
          $('#getCardNo').val(response.tasks.cardNo);
          $('#taskTitle').val(response.tasks.name);
          $('#taskDescription').val(response.tasks.description);
          $('#start').val(response.tasks.startDate);
          $('#end').val(response.tasks.endDate);
          $('#duration').val(response.tasks.duration);
          $('#taskId').val(response.tasks.id);
          
          $('#taskFormHeader').text('Edit Task');
          
          $('#taskButtonContainer').html('\
          <button id="btnUpdateTask" type="submit" class="kanban-cards-page-button8 button"> Update </button>');
          
          fetchTasks();
          
          $('html, body').animate({
            scrollTop: $("#taskFormHeader").offset().top
          }, 1);
        }
      });
    });
    
    //Auto Schedule Task
    $(document).on('click', '#btnAutoSchedule', function(e) {
      e.preventDefault();

      var url = '{{ url("employee/dashboard/task/autoSchedule") }}';
      
      $('#btnAutoSchedule').text('Scheduling...');
      
      $.ajax({
        type:"GET",
        url:url,
        dataType:"json",
        success: function(response)
        {
          if(response.status == 400)
          {
            $('#btnAutoSchedule').text('Auto Schedule');

            alert(response.message);
          }
          else
          {
            setTimeout(() => {
              $('#btnAutoSchedule').text('Auto Schedule');
              
              let startDateString = new Date();
              let endDateString = new Date();
              
              let numDays = response.days;
              endDateString.setDate(endDateString.getDate() + numDays);
              
              let startDate = document.getElementById("start");
              let endDate = document.getElementById("end");
              let duration = document.getElementById("duration");
              
              startDate.value = startDateString.toISOString().split("T")[0];
              endDate.value = endDateString.toISOString().split("T")[0];
              duration.value = numDays;
            }, 2000);
          }
        }
      });
    });
    
    //delete task
    $(document).on('click', '#btnDeleteTask', function(e) {
      
      var no = $(this).val();
      
      var url = '{{ url("employee/dashboard/task/delete/:no") }}';
      url = url.replace(':no', no); 
      
      $.ajax({
        type:"DELETE",
        url:url,
        dataType:"json",
      });
      
      fetchTasks();
    });
    
    //get duration
    function calculateDuration()
    {
      var startDate = document.getElementById("start").value;
      var endDate = document.getElementById("end").value;
      
      var start = new Date(startDate);
      var end = new Date(endDate);
      
      var startTime = start.getTime();
      var endTime = end.getTime();
      
      var days = (endTime - startTime) / 86400000;
      
      $('#duration').val(days);
    }
    
    $('#start').change(function() {
      calculateDuration();
    });
    
    $('#end').change(function() {
      calculateDuration();
    });
  });
</script>