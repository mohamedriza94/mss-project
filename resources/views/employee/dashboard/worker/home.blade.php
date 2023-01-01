<!DOCTYPE html>
<html lang="en">
<head>
    <title>Worker - Lock Hood</title>
    <meta property="og:title" content="TaskPage - Lock Hood" />
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
        <link rel="stylesheet" href="{{ asset('assets/task-page.css') }}" />
        
        <div class="task-page-container">
            <header data-thq="thq-navbar" class="task-page-navbar-interactive">
                <div
                data-thq="thq-navbar-nav"
                data-role="Nav"
                class="task-page-desktop-menu"
                >
                <nav
                data-thq="thq-navbar-nav-links"
                data-role="Nav"
                class="task-page-nav"
                >
                <a href="{{ route('employee.dashboard') }}" class="task-page-navlink">
                    <label id="home" class="task-page-text">Home</label>
                </a>
            </nav>
        </div>
        <a href="index.html" class="task-page-navlink1">
            <label id="warehouseaccount" class="task-page-text01">
                {{ auth()->guard('employee')->user()->name }} (Worker)
            </label>
        </a>
        <div class="task-page-container01">
            <a href="{{ route('employee.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="task-page-navlink2">
            <label id="login" class="task-page-text02">Logout</label>
        </a>
        
        <form id="logout-form" 
        action="{{ route('employee.logout') }}" 
        method="POST" class="d-none">
        @csrf
    </form>
    
</div>
</header>
<div class="task-page-container02">
    <span class="task-page-text03">Task</span>
    <div class="task-page-container03">
        <div class="task-page-container04">
            <table width="100%">
                <thead>
                    <tr>
                        <th>TASK NO.</th>
                        <th>NAME</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="taskNo"></td>
                        <td id="name" style="width:850px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="task-page-container05">
            <table width="100%">
                <thead>
                    <tr>
                        <th>DEADLINE</th>
                        <th>DESCRIPTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="deadline"></td>
                        <td id="description" style="width:800px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="task-page-container06">
            <div class="task-page-container07">
                <div class="task-page-container08">
                    <span>Raw Materials</span>
                </div>
                <div class="task-page-container09">
                    
                    <div class="task-page-container10">
                        <span>Raw Material</span>
                        <select class="task-page-select" id="rawMaterialSelect"></select>
                    </div>
                    
                    <div class="task-page-container11">
                        <span id="qtyLabel">Quantity</span>
                        <input type="number" id="quantity" min="1" class="task-page-textinput input" />
                    </div>
                </div>
                <button id="btnUse" class="task-page-button button" > Use </button>
            </div>
        </div>
        <div class="task-page-container12">
            
            <table width="100%">
                <thead>
                    <tr>
                        <th>RAW MATERIAL</th>
                        <th>QUANTITY USED</th>
                    </thead>
                    <tbody id="usedRMTable">
                    </tbody>
                </table>
            </div>
            
            {{-- get task data --}}
            <input type="hidden" id="task_input">
            <input type="hidden" id="card_input">
            <input type="hidden" id="factory_input">
            <input type="hidden" id="rawMaterial_input">
            <input type="hidden" id="workshop_input">
            <input type="hidden" id="startDate_input">
            <input type="hidden" id="worker_input" value="{{ auth()->guard('employee')->user()->no }}">
    
            <div class="task-page-container13">
                <div class="task-page-container14"><span>Controls</span></div>
                <div class="task-page-container15">
                    <button id="btnStart" class="task-page-button1 button" > Start </button>
                    <button id="btnFinish" class="task-page-button2 button" > Finish </button>
                </div>
            </div>
        </div>
    </div>
    <div class="task-page-container16">
        <span class="task-page-text11">Lock Hood Pvt Ltd 2022</span>
    </div>
</div>
</div>
<script
data-section-id="navbar"
src="https://unpkg.com/@teleporthq/teleport-custom-scripts"
></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
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
        
        //disable keyboard input to number input elements
        $("[type='number']").keypress(function (evt) {
            evt.preventDefault();
        });
        
        //calling functions
        fetchRawMaterials();
        fetchTask();
        
        //call function one second after page loads
        setTimeout(() => {
            fetchUsedRawMaterial();
        }, 1000);
        
        //disable button on page load
        $('#btnFinish').attr('disabled','disabled');
        document.getElementById('btnFinish').setAttribute("style", "background:#0a5aa1;");
        document.getElementById('btnStart').setAttribute("style", "background:#029ef2;");
        
        //Use raw materials
        $(document).on('click','#btnUse', function(e){
            e.preventDefault();
            
            var task_input = $('#task_input').val();
            var card_input = $('#card_input').val();
            var factory_input = $('#factory_input').val();
            var rawMaterial_input = $('#rawMaterial_input').val();
            var workshop_input = $('#workshop_input').val();
            var worker_input = $('#worker_input').val();
            var quantity = $('#quantity').val();
            
            var data = {
                'task' : task_input,
                'card' : card_input,
                'factory' : factory_input,
                'rawMaterial' : rawMaterial_input,
                'workshop' : workshop_input,
                'worker' : worker_input,
                'quantity' : quantity
            };
            
            var url = '{{ url("employee/dashboard/workerDash/useRawMaterial") }}';
            
            $.ajax({
                type:"POST", url:url, data:data, dataType:"json",
                success: function(response)
                {
                    if(response.status == 400)
                    {
                        alert(response.message);
                    }
                    else
                    {
                        fetchRawMaterials(); //in select option
                        alert(response.message);
                        
                        fetchUsedRawMaterial();
                    }
                }
            });
        });
        
        //read warehouse inventory options
        function fetchRawMaterials()
        {
            var url = '{{ url("employee/dashboard/workerDash/readForTaskOptions") }}';
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#rawMaterialSelect').html('');
                    
                    $.each(response.rawMaterials,function(key,item){
                        
                        $('#rawMaterialSelect').append('<option value="'+item.no+','+item.quantity+'">'+item.name+'</option>');
                        
                        splitString();
                    });
                }
            });
        }
        
        //read warehouse inventory options
        function fetchTask()
        {
            var url = '{{ url("employee/dashboard/workerDash/getWorkerTask") }}';
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    if(response.status==400)
                    {
                        alert(response.message);   
                    }
                    else
                    {
                        
                        $('#taskNo').text(response.task.taskNo);
                        $('#name').text(response.task.name);
                        $('#deadline').text(response.task.endDate);
                        $('#description').text(response.task.description);
                        
                        //fill inputs
                        $('#workshop_input').val(response.task.workshop);
                        $('#startDate_input').val(response.task.startDate);
                        $('#factory_input').val(response.task.factory);
                        $('#card_input').val(response.task.cardNo);
                        $('#task_input').val(response.task.taskNo);
                    }
                }
            });
        }
        
        //read used raw materials
        function fetchUsedRawMaterial()
        {
            var taskNo = $('#task_input').val();
            
            var url = '{{ url("employee/dashboard/workerDash/readUsedRawMaterial/:taskNo") }}';
            url = url.replace(':taskNo', taskNo);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#usedRMTable').html('');

                    $.each(response.usedRM,function(key,item){
                        $('#usedRMTable').append('<tr><td>'+item.name+'</td>\
                            <td>'+item.quantity+'</td>\
                        </tr>\
                        ');
                    })
                }
            });
        }
        
        //split string to get quantity
        function splitString()
        {
            //split array to get quantity seperately
            
            var qty = $('#rawMaterialSelect').val();
            var arr_qty = qty.split(","); 
            var qty_new = arr_qty[1]; 
            
            $("#quantity").attr("max", qty_new);
            $("#quantity").val(0);
            $("#qtyLabel").text('Quantity ( Limit - '+qty_new+')');
            
            //fill input
            $("#rawMaterial_input").val(arr_qty[0]);
        }
        
        //get quantity on change
        $(document).ready(function() {
            $('#rawMaterialSelect').on('change', function() {
                
                splitString();
                
            });
        });
        
        //start task
        $(document).on('click','#btnStart', function(e){
            e.preventDefault();
            
            var task_input = $('#task_input').val();
            var card_input = $('#card_input').val();
            var worker_input = $('#worker_input').val();
            
            var data = {
                'task' : task_input,
                'card' : card_input,
                'worker' : worker_input,
            };
            
            var url = '{{ url("employee/dashboard/workerDash/startTask") }}';
            
            $.ajax({
                type:"POST", url:url, data:data, dataType:"json",
                success: function(response)
                {
                    if(response.status == 400)
                    {
                        alert(response.message);
                    }
                    else
                    {
                        $('#btnStart').text('Starting...');
                        
                        setTimeout(() => {
                            $('#btnStart').text('Started');

                            $('#btnStart').attr('disabled','disabled');
                            $('#btnFinish').removeAttr('disabled','disabled');

                            document.getElementById('btnStart').setAttribute("style", "background:#0a5aa1;");
                            
                            document.getElementById('btnFinish').setAttribute("style", "background:#029ef2;");
                        }, 1000);
                    }
                }
            });
        });
        
        //finish task
        $(document).on('click','#btnFinish', function(e){
            e.preventDefault();
            
            //calculate days
            var endDate_ISO_format = new Date().toISOString().slice(0, 10);
            
            var start = new Date(document.getElementById("startDate_input").value);
            var end = new Date(endDate_ISO_format);
            
            var startTime = start.getTime();
            var endTime = end.getTime();
            
            var days = (endTime - startTime) / 86400000;
            
            var task_input = $('#task_input').val();
            var card_input = $('#card_input').val();
            
            var data = {
                'endDate' : endDate_ISO_format,
                'days' : days,
                'task' : task_input,
                'card' : card_input
            };
            
            var url = '{{ url("employee/dashboard/workerDash/endTask") }}';
            
            $.ajax({
                type:"POST", url:url, data:data, dataType:"json",
                success: function(response)
                {
                    if(response.status == 400)
                    {
                        alert(response.message);
                    }
                    else
                    {
                        $('#btnFinish').text('Finished');
                        document.getElementById('btnFinish').setAttribute("style", "background:#0a5aa1;");
                        
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        });
    });
</script>