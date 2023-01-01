<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee - Lock Hood</title>
    <meta property="og:title" content="InventoryInfoPage - Lock Hood" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('assets/print/printThis.js') }}"></script>
    
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
        <script
        type="text/javascript"
        src="https://unpkg.com/dangerous-html@0.1.11/dist/default/lib.umd.js"
        ></script>
        <link rel="stylesheet" href="{{ asset('assets/inventory-info-page.css') }}" />
        
        <div class="inventory-info-page-container">
            <header data-thq="thq-navbar" class="inventory-info-page-navbar-interactive" >
                <div data-thq="thq-navbar-nav" data-role="Nav" class="inventory-info-page-desktop-menu" >
                    <nav data-thq="thq-navbar-nav-links" data-role="Nav" class="inventory-info-page-nav" >
                        
                        <a href="{{ route('employee.dashboard') }}" class="inventory-info-page-navlink">
                            <label class="inventory-info-page-text">Home</label>
                        </a>
                        <a href="{{ route('employee.workshop') }}" class="inventory-info-page-navlink1" >
                            <label class="inventory-info-page-text01">
                                Workshops
                            </label>
                        </a>
                        <a href="{{ route('employee.worker') }}" class="inventory-info-page-navlink2" >
                            <label class="inventory-info-page-text02">
                                Workers
                            </label>
                        </a>
                        <a href="{{ route('employee.kanbanCard') }}" class="inventory-info-page-navlink3" >
                            <label class="inventory-info-page-text03">
                                Kanban Cards
                            </label>
                        </a>
                        <a href="{{ route('employee.inventory') }}" class="inventory-info-page-navlink4" >
                            <label class="inventory-info-page-text04">
                                Inventories
                            </label>
                        </a>
                    </nav>
                </div>
                <div class="inventory-info-page-container01">
                    <a href="supervisor-page.html" class="inventory-info-page-navlink5">
                        <label class="inventory-info-page-text05">
                            {{ auth()->guard('employee')->user()->name }} (Supervisor)
                        </label>
                    </a>
                    <div class="inventory-info-page-container02">
                        <a href="{{ route('employee.logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="inventory-info-page-navlink6">
                        <label class="inventory-info-page-text06">
                            Logout
                        </label>
                    </a>
                    
                    <form id="logout-form" 
                    action="{{ route('employee.logout') }}" 
                    method="POST" class="d-none">
                    @csrf
                </form>
                
            </div>
        </div>
    </header>
    <div class="inventory-info-page-container03">
        <button class="inventory-info-page-button button upper" id="btnGeneratePDF">Get Report PDF</button>
    </div>
    <div id="content" class="inventory-info-page-container04">
        <div class="inventory-info-page-container05">
            <div class="inventory-info-page-container06">
                <div id="rawmatavailcont" class="inventory-info-page-container07">
                    <span class="inventory-info-page-text07">
                        Raw Materials Available
                    </span>
                    <span class="inventory-info-page-text08" id="rawMaterials"></span>
                </div>
                <div
                id="workersdetailcontainer"
                class="inventory-info-page-container08"
                >
                <span class="inventory-info-page-text09">
                    Work Slots Available
                </span>
                <span class="inventory-info-page-text10" id="slots"></span>
            </div>
        </div>
        <div class="inventory-info-page-container09">
            <div id="totworkerscont" class="inventory-info-page-container10">
                <span class="inventory-info-page-text11">Total Workers</span>
                <span class="inventory-info-page-text12" id="workers"></span>
            </div>
            <div id="penkancardscont" class="inventory-info-page-container11">
                <span class="inventory-info-page-text13">
                    Pending Kanban Cards
                </span>
                <span class="inventory-info-page-text14" id="kanbanCards"></span>
            </div>
        </div>
        <div class="inventory-info-page-container12">
            <div id="workshopscont" class="inventory-info-page-container13">
                <span class="inventory-info-page-text15">Workshops</span>
                <span class="inventory-info-page-text16" id="workshops"></span>
            </div>
            <div id="pentaskscont" class="inventory-info-page-container14">
                <span class="inventory-info-page-text17">Pending Tasks</span>
                <span class="inventory-info-page-text18" id="tasks"></span>
            </div>
        </div>
    </div>
    
    <div class="inventory-info-page-container15" id="content_IR">
        <div class="inventory-info-page-container16">
            <h1 class="inventory-info-page-text19">INVENTORY REQUESTS</h1>
        </div>
        <div class="inventory-info-page-container17">
            <div class="inventory-info-page-container18">
                <div
                id="inventoryrequeststable"
                class="inventory-info-page-div"
                >
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Inventory</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="IR_table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inventory-info-page-container19">
            <button id="btnPrev_IR" class="inventory-info-page-button16 button"> Previous </button>
            <button id="btnNext_IR" class="inventory-info-page-button17 button"> Next </button>
            <button id="btnAll_IR" class="inventory-info-page-button18 button">  All </button>
            <button id="btnLimit_IR" class="inventory-info-page-button19 button"> Limit </button>
            <button id="btnPDF_IR" class="inventory-info-page-button20 button"> PDF </button>
        </div>
    </div>
</div>
<div class="inventory-info-page-container20" id="content_AI">
    <div class="inventory-info-page-container21">
        <h1 class="inventory-info-page-text20">AVAILABLE INVENTORY</h1>
    </div>
    <div class="inventory-info-page-container22">
        <div class="inventory-info-page-container23">
            <div id="availableinvtable" class="inventory-info-page-div1">
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Inventory</th>
                            <th>Quantity Percentage</th>
                        </tr>
                    </thead>
                    <tbody id="AI_table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inventory-info-page-container24">
            
            <button id="btnPrev_AI" class="inventory-info-page-button16 button"> Previous </button>
            <button id="btnNext_AI" class="inventory-info-page-button17 button"> Next </button>
            <button id="btnAll_AI" class="inventory-info-page-button18 button">  All </button>
            <button id="btnLimit_AI" class="inventory-info-page-button19 button"> Limit </button>
            <button id="btnPDF_AI" class="inventory-info-page-button20 button"> PDF </button>
        </div>
    </div>
</div>
<div class="inventory-info-page-container25" id="content_WI">
    <div class="inventory-info-page-container26">
        <h1 class="inventory-info-page-text21">WORKER INFORMATION</h1>
    </div>
    <div class="inventory-info-page-container27">
        <div class="inventory-info-page-container28">
            <div id="workerinformationtable" class="inventory-info-page-div2">
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Worker No</th>
                            <th>Name</th>
                            <th>Total Tasks Done</th>
                            <th>Current Task</th>
                            <th>Fastest Completion Time</th>
                        </tr>
                    </thead>
                    <tbody id="WI_table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inventory-info-page-container29">
            
            <button id="btnPrev_WI" class="inventory-info-page-button16 button"> Previous </button>
            <button id="btnNext_WI" class="inventory-info-page-button17 button"> Next </button>
            <button id="btnAll_WI" class="inventory-info-page-button18 button">  All </button>
            <button id="btnLimit_WI" class="inventory-info-page-button19 button"> Limit </button>
            <button id="btnPDF_WI" class="inventory-info-page-button20 button"> PDF </button>
        </div>
    </div>
</div>
<div class="inventory-info-page-container30" id="content_T">
    <div class="inventory-info-page-container31">
        <h1 class="inventory-info-page-text22">TASKS</h1>
    </div>
    <div class="inventory-info-page-container32">
        <div class="inventory-info-page-container33">
            <div id="taskstable" class="inventory-info-page-div3">
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Tasks Number</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Duration</th>
                            <th>Worker</th>
                        </tr>
                    </thead>
                    <tbody id="T_table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inventory-info-page-container34">
            
            <button id="btnPrev_T" class="inventory-info-page-button16 button"> Previous </button>
            <button id="btnNext_T" class="inventory-info-page-button17 button"> Next </button>
            <button id="btnAll_T" class="inventory-info-page-button18 button">  All </button>
            <button id="btnLimit_T" class="inventory-info-page-button19 button"> Limit </button>
            <button id="btnPDF_T" class="inventory-info-page-button20 button"> PDF </button>
            
            <div class="inventory-info-page-container41">
                <button id="btnStatusPending_T" class="inventory-info-page-button35 button" > Pending </button>
                <button id="btnStatusCompleted_T" class="inventory-info-page-button36 button" > Completed </button>
            </div>
        </div>
    </div>
</div>
<div class="inventory-info-page-container36" id="content_KBC">
    <div class="inventory-info-page-container37">
        <h1 class="inventory-info-page-text23">Kanban Cards</h1>
    </div>
    <div class="inventory-info-page-container38">
        <div class="inventory-info-page-container39">
            <div id="kanbancardstable" class="inventory-info-page-div4">
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Card Number</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="KBC_table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inventory-info-page-container40">
            
            <button id="btnPrev_KBC" class="inventory-info-page-button16 button"> Previous </button>
            <button id="btnNext_KBC" class="inventory-info-page-button17 button"> Next </button>
            <button id="btnAll_KBC" class="inventory-info-page-button18 button">  All </button>
            <button id="btnLimit_KBC" class="inventory-info-page-button19 button"> Limit </button>
            <button id="btnPDF_KBC" class="inventory-info-page-button20 button"> PDF </button>
            
            <div class="inventory-info-page-container41">
                <button id="btnStatusPending_KBC" class="inventory-info-page-button35 button" > Pending </button>
                <button id="btnStatusCompleted_KBC" class="inventory-info-page-button36 button" > Completed </button>
            </div>
        </div>
    </div>
</div>
<div class="inventory-info-page-container42" id="content_S">
    <div class="inventory-info-page-container43">
        <h1 class="inventory-info-page-text24">SLOTS</h1>
    </div>
    <div class="inventory-info-page-container44">
        <div class="inventory-info-page-container45">
            <div id="slotstable" class="inventory-info-page-div5">
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Slot Number</th>
                            <th>Workshop</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody id="S_table">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inventory-info-page-container46">
            
            <button id="btnPrev_S" class="inventory-info-page-button16 button"> Previous </button>
            <button id="btnNext_S" class="inventory-info-page-button17 button"> Next </button>
            <button id="btnAll_S" class="inventory-info-page-button18 button">  All </button>
            <button id="btnLimit_S" class="inventory-info-page-button19 button"> Limit </button>
            <button id="btnPDF_S" class="inventory-info-page-button20 button"> PDF </button>
            
            <div class="inventory-info-page-container47">
                <button id="btnStatusOccupied_S" class="inventory-info-page-button35 button" > Occupied </button>
                <button id="btnStatusAvailable_S" class="inventory-info-page-button36 button" > Available </button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="inventory-info-page-container48">
    <span class="inventory-info-page-text25">Lock Hood Pvt Ltd 2022</span>
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
        
        //button color setting 
        $('#btnLimit_IR').css('background','#403e3b');
        $('#btnLimit_AI').css('background','#403e3b');
        $('#btnLimit_WI').css('background','#403e3b');
        $('#btnLimit_T').css('background','#403e3b');
        $('#btnLimit_KBC').css('background','#403e3b');
        $('#btnLimit_S').css('background','#403e3b');
        
        //status button color setting
        $('#btnStatusPending_T').css('background','#403e3b');
        $('#btnStatusPending_KBC').css('background','#403e3b');
        $('#btnStatusOccupied_S').css('background','#403e3b');
        
        //limit and offset for pagination
        var limit_IR = 0;
        var limit_AI = 0;
        var limit_WI = 0;
        var limit_T = 0;
        var limit_KBC = 0;
        var limit_S = 0;
        
        var type_IR = 'limit';
        var type_AI = 'limit';
        var type_WI = 'limit';
        var type_T = 'limit';
        var type_KBC = 'limit';
        var type_S = 'limit';
        
        //status for category selection
        var status_T = 'pending';
        var status_KBC = 'pending';
        var status_S = 'occupied';
        
        //next
        function next_IR(){ limit_IR = limit_IR + 5; IR();}
        function next_AI(){ limit_AI = limit_AI + 5; AI()}
        function next_WI(){ limit_WI = limit_WI + 5; WI()}
        function next_T(){ limit_T = limit_T + 5; T()}
        function next_KBC(){ limit_KBC = limit_KBC + 5; KBC()}
        function next_S(){ limit_S = limit_S + 5; S()}
        
        //click limit
        $(document).on('click', '#btnNext_IR', function(e){ next_IR(); });
        $(document).on('click', '#btnNext_AI', function(e){ next_AI(); });
        $(document).on('click', '#btnNext_WI', function(e){ next_WI(); });
        $(document).on('click', '#btnNext_T', function(e){ next_T(); });
        $(document).on('click', '#btnNext_KBC', function(e){ next_KBC(); });
        $(document).on('click', '#btnNext_S', function(e){ next_S(); });
        
        //prev
        function prev_IR(){ limit_IR = limit_IR - 5; if(limit_IR < 0) { limit_IR = 0;} IR();}
        function prev_AI(){ limit_AI = limit_AI - 5; if(limit_AI < 0) { limit_AI = 0;} AI()}
        function prev_WI(){ limit_WI = limit_WI - 5; if(limit_WI < 0) { limit_WI = 0;} WI()}
        function prev_T(){ limit_T = limit_T - 5; if(limit_T < 0) { limit_T = 0;} T()}
        function prev_KBC(){ limit_KBC = limit_KBC - 5; if(limit_KBC < 0) { limit_KBC = 0;} KBC()}
        function prev_S(){ limit_S = limit_S - 5; if(limit_S < 0) { limit_S = 0;} S()}
        
        //click prev
        $(document).on('click', '#btnPrev_IR', function(e){ prev_IR(); });
        $(document).on('click', '#btnPrev_AI', function(e){ prev_AI(); });
        $(document).on('click', '#btnPrev_WI', function(e){ prev_WI(); });
        $(document).on('click', '#btnPrev_T', function(e){ prev_T(); });
        $(document).on('click', '#btnPrev_KBC', function(e){ prev_KBC(); });
        $(document).on('click', '#btnPrev_S', function(e){ prev_S(); });
        
        //click all
        $(document).on('click', '#btnAll_IR', function(e){ type_IR = 'all'; IR(); $(this).css('background', '#403e3b'); $('#btnLimit_IR').css('background','#ee6c4d');});
        $(document).on('click', '#btnAll_AI', function(e){ type_AI = 'all'; AI(); $(this).css('background', '#403e3b'); $('#btnLimit_AI').css('background','#ee6c4d');});
        $(document).on('click', '#btnAll_WI', function(e){ type_WI = 'all'; WI(); $(this).css('background', '#403e3b'); $('#btnLimit_WI').css('background','#ee6c4d');});
        $(document).on('click', '#btnAll_T', function(e){ type_T = 'all'; T(); $(this).css('background', '#403e3b'); $('#btnLimit_T').css('background','#ee6c4d');});
        $(document).on('click', '#btnAll_KBC', function(e){ type_KBC = 'all'; KBC(); $(this).css('background', '#403e3b'); $('#btnLimit_KBC').css('background','#ee6c4d');});
        $(document).on('click', '#btnAll_S', function(e){ type_S = 'all'; S(); $(this).css('background', '#403e3b'); $('#btnLimit_S').css('background','#ee6c4d');});
        
        //click status button//click status button
        $(document).on('click', '#btnStatusPending_T', function(e){ status_T = 'pending'; T(); $(this).css('background', '#403e3b'); $('#btnStatusCompleted_T').css('background','#ee6c4d');});
        $(document).on('click', '#btnStatusPending_KBC', function(e){ status_KBC = 'pending'; KBC(); $(this).css('background', '#403e3b'); $('#btnStatusCompleted_KBC').css('background','#ee6c4d');});
        $(document).on('click', '#btnStatusOccupied_S', function(e){ status_S = 'occupied'; S(); $(this).css('background', '#403e3b'); $('#btnStatusAvailable_S').css('background','#ee6c4d');});
        $(document).on('click', '#btnStatusCompleted_T', function(e){ status_T = 'completed'; T(); $(this).css('background', '#403e3b'); $('#btnStatusPending_T').css('background','#ee6c4d');});
        $(document).on('click', '#btnStatusCompleted_KBC', function(e){ status_KBC = 'completed'; KBC(); $(this).css('background', '#403e3b'); $('#btnStatusPending_KBC').css('background','#ee6c4d');});
        $(document).on('click', '#btnStatusAvailable_S', function(e){ status_S = 'available'; S(); $(this).css('background', '#403e3b'); $('#btnStatusOccupied_S').css('background','#ee6c4d');});
        
        //click limit
        $(document).on('click', '#btnLimit_IR', function(e){ type_IR = 'limit'; limit_IR = 0; IR(); $(this).css('background', '#403e3b'); $('#btnAll_IR').css('background','#ee6c4d')});
        $(document).on('click', '#btnLimit_AI', function(e){ type_AI = 'limit'; limit_AI = 0; AI(); $(this).css('background', '#403e3b'); $('#btnAll_AI').css('background','#ee6c4d')});
        $(document).on('click', '#btnLimit_WI', function(e){ type_WI = 'limit'; limit_WI = 0; WI(); $(this).css('background', '#403e3b'); $('#btnAll_WI').css('background','#ee6c4d')});
        $(document).on('click', '#btnLimit_T', function(e){ type_T = 'limit'; limit_T = 0; T(); $(this).css('background', '#403e3b'); $('#btnAll_T').css('background','#ee6c4d')});
        $(document).on('click', '#btnLimit_KBC', function(e){ type_KBC = 'limit'; limit_KBC = 0; KBC(); $(this).css('background', '#403e3b'); $('#btnAll_KBC').css('background','#ee6c4d')});
        $(document).on('click', '#btnLimit_S', function(e){ type_S = 'limit'; limit_S = 0; S(); $(this).css('background', '#403e3b'); $('#btnAll_S').css('background','#ee6c4d')});
        
        //get PDF
        $(document).on('click', '#btnPDF_IR', function(e){ $('#content_IR').printThis(); });
        $(document).on('click', '#btnPDF_AI', function(e){ $('#content_AI').printThis(); });
        $(document).on('click', '#btnPDF_WI', function(e){ $('#content_WI').printThis(); });
        $(document).on('click', '#btnPDF_T', function(e){ $('#content_T').printThis(); });
        $(document).on('click', '#btnPDF_KBC', function(e){ $('#content_KBC').printThis(); });
        $(document).on('click', '#btnPDF_S', function(e){ $('#content_S').printThis(); });
        $(document).on('click', '#btnGeneratePDF', function(e){ $('#content').printThis(); });
        
        //call functions
        IR();
        AI();
        WI();
        T();
        KBC();
        S();
        
        //call function every second
        setInterval(() => {
            counts();
        }, 1000);
        
        //statistics
        function counts()
        {
            var url = '{{ url("employee/dashboard/counts") }}';
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#rawMaterials').text(response.rawMaterialsCount);
                    $('#slots').text(response.slotsCount);
                    $('#workers').text(response.workersCount);
                    $('#kanbanCards').text(response.kanbanCardsCount);
                    $('#workshops').text(response.workshopsCount);
                    $('#tasks').text(response.tasksCount);
                    
                }
            });
        }
        
        //read inventory requests of the factory
        function IR()
        {
            var url = "{{ url('employee/dashboard/IR/:limit/:type') }}";
            url = url.replace(':limit',limit_IR);
            url = url.replace(':type',type_IR);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#IR_table').html('');
                    $.each(response.data,function(key,item){
                        
                        var date = item.date;
                        var date = date.slice(0,10);
                        
                        var time = item.time;
                        var time = time.slice(10,19);
                        
                        var status = "";
                        
                        if(item.status=='pending')
                        {
                            status = "<div style='text-align:center; width:50%; padding:8px; border-radius:6px; background:#14c704; color:white'>Pending</div>";
                        }
                        else if(item.status=='completed')
                        {
                            status = "<div style='text-align:center; border-radius:6px; width:60%; padding:8px; background:#e63002; color:white'>Complete</div>";
                        }
                        
                        $('#IR_table').append('<tr><td>'+item.name+'</td>\
                            <td>'+date+'</td>\
                            <td>'+time+'</td>\
                            <td>'+item.quantity+'</td>\
                            <td>'+status+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //read available inventories of the factory
        function AI()
        {
            var url = "{{ url('employee/dashboard/AI/:limit/:type') }}";
            url = url.replace(':limit',limit_AI);
            url = url.replace(':type',type_AI);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#AI_table').html('');
                    $.each(response.data,function(key,item){
                        
                        $('#AI_table').append('<tr><td>'+item.name+'</td>\
                            <td>'+item.availablePercentage+' %</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }

        //read worker information of the factory
        function WI()
        {
            var url = "{{ url('employee/dashboard/WI/:limit/:type') }}";
            url = url.replace(':limit',limit_WI);
            url = url.replace(':type',type_WI);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#WI_table').html('');
                    $.each(response.data,function(key,item){
                        
                        //get current task of worker
                        var urlGetCurrentTask = "{{ url('employee/dashboard/WI_CurrentTask/:worker') }}";
                        urlGetCurrentTask = urlGetCurrentTask.replace(':worker',item.no);
                        $.ajax({
                            type: "GET", url:urlGetCurrentTask, dataType:"json",
                            success:function(response){
                                $('#WI_table').append('<tr><td>'+item.no+'</td>\
                                    <td>'+item.name+'</td>\
                                    <td>'+item.task_count+'</td>\
                                    <td>'+response.taskData+'</td>\
                                    <td>'+response.taskFCT+' Day(s)</td>\
                                </tr>\
                                ');
                            }
                        })
                        
                    });
                }
            });
        }
        
        //read tasks of the factory
        function T()
        {
            var url = "{{ url('employee/dashboard/T/:limit/:type/:status') }}";
            url = url.replace(':limit',limit_T);
            url = url.replace(':type',type_T);
            url = url.replace(':status',status_T);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#T_table').html('');
                    $.each(response.data,function(key,item){
                        
                        $('#T_table').append('<tr><td>'+item.taskNo+'</td>\
                            <td>'+item.name+'</td>\
                            <td>'+item.start+'</td>\
                            <td>'+item.end+'</td>\
                            <td>'+item.duration+'</td>\
                            <td>'+item.worker+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }

        //read Kanban Card of the factory
        function KBC()
        {
            var url = "{{ url('employee/dashboard/KBC/:limit/:type/:status') }}";
            url = url.replace(':limit',limit_KBC);
            url = url.replace(':type',type_KBC);
            url = url.replace(':status',status_KBC);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#KBC_table').html('');
                    $.each(response.data,function(key,item){
                        
                        var status = "";
                        
                        if(item.status=='pending')
                        {
                            status = "<div style='text-align:center; width:50%; padding:8px; border-radius:6px; background:#14c704; color:white'>Pending</div>";
                        }
                        else if(item.status=='completed')
                        {
                            status = "<div style='text-align:center; border-radius:6px; width:60%; padding:8px; background:#e63002; color:white'>Complete</div>";
                        }
                        
                        $('#KBC_table').append('<tr><td>'+item.cardNo+'</td>\
                            <td>'+item.title+'</td>\
                            <td>'+status+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }

        //read slots of the factory
        function S()
        {
            var url = "{{ url('employee/dashboard/S/:limit/:type/:status') }}";
            url = url.replace(':limit',limit_S);
            url = url.replace(':type',type_S);
            url = url.replace(':status',status_S);
            
            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#S_table').html('');
                    $.each(response.data,function(key,item){
                        
                        $('#S_table').append('<tr><td>'+item.slotNo+'</td>\
                            <td>'+item.workshopNo+'</td>\
                            <td>'+item.task+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
    });
</script>