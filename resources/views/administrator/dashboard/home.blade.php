<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrator - Lock Hood</title>
    <meta property="og:title" content="TaskInfoPage - Lock Hood" />
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
        <link rel="stylesheet" href="{{ asset('assets/task-info-page.css') }}" />
        
        <div class="task-info-page-container">
            <header data-thq="thq-navbar" class="task-info-page-navbar-interactive">
                <div
                data-thq="thq-navbar-nav"
                data-role="Nav"
                class="task-info-page-desktop-menu"
                >
                <nav
                data-thq="thq-navbar-nav-links"
                data-role="Nav"
                class="task-info-page-nav"
                >
                <a href="{{ route('administrator.dashboard') }}" class="task-info-page-navlink">
                    <label class="task-info-page-text">Home</label>
                </a>
                <a href="{{ route('administrator.factory') }}" class="task-info-page-navlink1">
                    <label class="task-info-page-text01">
                        Factories
                    </label>
                </a>
                <a href="{{ route('administrator.department') }}" class="task-info-page-navlink2">
                    <label class="task-info-page-text02">
                        Departments
                    </label>
                </a>
                <a href="{{ route('administrator.supervisor') }}" class="task-info-page-navlink3">
                    <label class="task-info-page-text03">
                        Supervisors
                    </label>
                </a>
            </nav>
        </div>
        <div class="task-info-page-container01">
            <a href="supervisor-page.html" class="task-info-page-navlink4">
                <label class="task-info-page-text04">
                    Senior Manager Account
                </label>
            </a>
            <div class="task-info-page-container02">
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('administrator.logout') }}"
                class="task-info-page-navlink5">
                
                <label class="task-info-page-text05">Logout</label>
                
            </a>
            
            <form id="logout-form" 
            action="{{ route('administrator.logout') }}" 
            method="POST" class="d-none">
            @csrf
        </form>
        
    </div>
</div>
</header>
<div class="task-info-page-container03">
    <button class="task-info-page-button button upper" id="btnGeneratePDF">Get Report PDF</button>
</div>
<div id="content" class="task-info-page-container04">
    <div class="task-info-page-container05">
        
        <div class="task-info-page-container06">
            <div id="factorydetailcontainer" class="task-info-page-container07">
                <span class="task-info-page-text06">Factories</span>
                <span class="task-info-page-text07" id="factories"></span>
            </div>
            <div id="workersdetailcontainer" class="task-info-page-container08">
                <span class="task-info-page-text08">Workers</span>
                <span class="task-info-page-text09" id="workers"></span>
            </div>
        </div>
        
        <div class="task-info-page-container09">
            <div id="departmentdetailcontainer" class="task-info-page-container10" >
                <span class="task-info-page-text10">Departments</span>
                <span class="task-info-page-text11" id="departments"></span>
            </div>
            <div id="workshopsdetailcontainer" class="task-info-page-container11">
                <span class="task-info-page-text12">Workshops</span>
                <span class="task-info-page-text13" id="workshops"></span>
            </div>
        </div>
        
        <div class="task-info-page-container12">
            <div id="supervisorsdetailcontainer" class="task-info-page-container13" >
                <span class="task-info-page-text14">Supervisors</span>
                <span class="task-info-page-text15" id="supervisors"></span>
            </div>
            <div id="inventoriesdetailcontainer" class="task-info-page-container14" >
                <span class="task-info-page-text16" id="check">Inventories in warehouse</span>
                <span class="task-info-page-text17" id="inventories"></span>
            </div>
        </div>
        
    </div>
    
    <style>
        .upper{
            text-transform: uppercase;
        }
    </style>
    
    <script>
        $(document).ready(function(){
            
            //csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            setInterval(() => {
                counts();
            }, 1000);
            
            //statistics
            function counts()
            {
                var url = '{{ url("administrator/dashboard/counts") }}';
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        
                        $('#factories').text(response.factoryCount);
                        $('#workers').text(response.departmentCount);
                        $('#departments').text(response.supervisorCount);
                        $('#workshops').text(response.workerCount);
                        $('#supervisors').text(response.workshopCount);
                        $('#inventories').text(response.inventoryCount);
                        
                    }
                });
            }
            
            //limit and offset for pagination
            var limit_PKBC = 0;
            var limit_PTT = 0;
            var limit_CTT = 0;
            var limit_AIT = 0;
            var limit_FT = 0;
            
            var type_PKBC = 'limit';
            var type_PTT = 'limit';
            var type_CTT = 'limit';
            var type_AIT = 'limit';
            var type_FT = 'limit';
            
            //next
            function next_PKBC(){ limit_PKBC = limit_PKBC + 5; }
            function next_PTT(){ limit_PTT = limit_PTT + 5; }
            function next_CTT(){ limit_CTT = limit_CTT + 5; }
            function next_AIT(){ limit_AIT = limit_AIT + 5; }
            function next_FT(){ limit_FT = limit_FT + 5; }
            
            //click limit
            $(document).on('click', '#btnNext_PKBC', function(e){ next_PKBC(); });
            $(document).on('click', '#btnNext_PTT', function(e){ next_PTT(); });
            $(document).on('click', '#btnNext_CTT', function(e){ next_CTT(); });
            $(document).on('click', '#btnNext_AIT', function(e){ next_AIT(); });
            $(document).on('click', '#btnNext_FT', function(e){ next_FT(); });
            
            //prev
            function prev_PKBC(){ limit_PKBC = limit_PKBC - 5; if(limit_PKBC < 0) { limit_PKBC = 0;} }
            function prev_PTT(){ limit_PTT = limit_PTT - 5; if(limit_PTT < 0) { limit_PTT = 0;} }
            function prev_CTT(){ limit_CTT = limit_CTT - 5; if(limit_CTT < 0) { limit_CTT = 0;} }
            function prev_AIT(){ limit_AIT = limit_AIT - 5; if(limit_AIT < 0) { limit_AIT = 0;} }
            function prev_FT(){ limit_FT = limit_FT - 5; if(limit_FT < 0) { limit_FT = 0;} }
            
            //click prev
            $(document).on('click', '#btnPrev_PKBC', function(e){ prev_PKBC(); });
            $(document).on('click', '#btnPrev_PTT', function(e){ prev_PTT(); });
            $(document).on('click', '#btnPrev_CTT', function(e){ prev_CTT(); });
            $(document).on('click', '#btnPrev_AIT', function(e){ prev_AIT(); });
            $(document).on('click', '#btnPrev_FT', function(e){ prev_FT(); });
            
            //click all
            $(document).on('click', '#btnAll_PKBC', function(e){ type_PKBC = 'all'; });
            $(document).on('click', '#btnAll_PTT', function(e){ type_PTT = 'all'; });
            $(document).on('click', '#btnAll_CTT', function(e){ type_CTT = 'all'; });
            $(document).on('click', '#btnAll_AIT', function(e){ type_AIT = 'all'; });
            $(document).on('click', '#btnAll_FT', function(e){ type_FT = 'all'; });
            
            //click limit
            $(document).on('click', '#btnLimit_PKBC', function(e){ type_PKBC = 'limit'; limit_PKBC = 0; });
            $(document).on('click', '#btnLimit_PTT', function(e){ type_PTT = 'limit'; limit_PTT = 0; });
            $(document).on('click', '#btnLimit_CTT', function(e){ type_CTT = 'limit'; limit_CTT = 0; });
            $(document).on('click', '#btnLimit_AIT', function(e){ type_AIT = 'limit'; limit_AIT = 0; });
            $(document).on('click', '#btnLimit_FT', function(e){ type_FT = 'limit'; limit_FT = 0; });
            
            //get PDF
            $(document).on('click', '#btnPDF_PKBC', function(e){ $('#content_PKBC').printThis(); });
            $(document).on('click', '#btnPDF_PTT', function(e){ $('#content_PTT').printThis(); });
            $(document).on('click', '#btnPDF_CTT', function(e){ $('#content_CTT').printThis(); });
            $(document).on('click', '#btnPDF_AIT', function(e){ $('#content_AIT').printThis(); });
            $(document).on('click', '#btnPDF_FT', function(e){ $('#content_FT').printThis(); });
            $(document).on('click', '#btnGeneratePDF', function(e){ $('#content').printThis(); });
            
            function PKBC()
            {
                var url = "{{ url('administrator/dashboard/PKBC/:limit/:type') }}";
                url = url.replace(':limit',limit_PKBC);
                url = url.replace(':type',type_PKBC);
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        $('#PKBC_table').html('');
                        $.each(response.pkbc,function(key,item){
                            
                        });
                        
                    }
                });
            };
            function PTT()
            {
                var url = "{{ url('administrator/dashboard/PTT/:limit/:type') }}";
                url = url.replace(':limit',limit_PTT);
                url = url.replace(':type',type_PTT);
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        $('#PTT_table').html('');
                        $.each(response.ptt,function(key,item){
                            
                        });
                        
                    }
                });
            };
            function CTT()
            {
                var url = "{{ url('administrator/dashboard/CTT/:limit/:type') }}";
                url = url.replace(':limit',limit_CTT);
                url = url.replace(':type',type_CTT);
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        $('#CTT_table').html('');
                        $.each(response.ctt,function(key,item){
                            
                        });
                        
                    }
                });
            };
            function AIT()
            {
                var url = "{{ url('administrator/dashboard/AIT/:limit/:type') }}";
                url = url.replace(':limit',limit_AIT);
                url = url.replace(':type',type_AIT);
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        $('#AIT_table').html('');
                        $.each(response.ait,function(key,item){
                            
                        });
                        
                    }
                });
            };
            function FT()
            {
                var url = "{{ url('administrator/dashboard/FT/:limit/:type') }}";
                url = url.replace(':limit',limit_FT);
                url = url.replace(':type',type_FT);
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        $('#FT_table').html('');
                        $.each(response.ft,function(key,item){
                            
                        });
                        
                    }
                });
            };
        });
    </script>
    
    <div class="task-info-page-container15" id="content_PKBC">
        <div class="task-info-page-container16">
            <h1 class="task-info-page-text18 upper">Pending Kanban Cards</h1>
        </div>
        <div class="task-info-page-container17">
            <div class="task-info-page-container18">
                <div id="pendingkanbancardstable" class="task-info-page-div">
                    <div>
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Cards</th>
                                </tr>
                            </thead>
                            <tbody id="PKBC_table">
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="task-info-page-container19">
                <button id="btnPrev_PKBC" class="task-info-page-button16 button"> Previous </button>
                <button id="btnNext_PKBC" class="task-info-page-button17 button"> Next </button>
                <button id="btnAll_PKBC" class="task-info-page-button18 button">  All </button>
                <button id="btnLimit_PKBC" class="task-info-page-button19 button"> Limit </button>
                <button id="btnPDF_PKBC" class="task-info-page-button20 button"> PDF </button>
            </div>
        </div>
    </div>
    <div class="task-info-page-container20" id="content_PTT">
        <div class="task-info-page-container21">
            <h1 class="task-info-page-text19 upper">Pending Tasks</h1>
        </div>
        <div class="task-info-page-container22">
            <div class="task-info-page-container23">
                <div id="pendingtaskstable" class="task-info-page-div1">
                    <div>
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Tasks</th>
                                </tr>
                            </thead>
                            <tbody id="PTT_table">
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="task-info-page-container24">
                <button id="btnPrev_PTT" class="task-info-page-button16 button"> Previous </button>
                <button id="btnNext_PTT" class="task-info-page-button17 button"> Next </button>
                <button id="btnAll_PTT" class="task-info-page-button18 button">  All </button>
                <button id="btnLimit_PTT" class="task-info-page-button19 button"> Limit </button>
                <button id="btnPDF_PTT" class="task-info-page-button20 button"> PDF </button>
            </div>
        </div>
    </div>
    <div class="task-info-page-container25" id="content_CTT">
        <div class="task-info-page-container26">
            <h1 class="task-info-page-text20 upper">Completed Tasks</h1>
        </div>
        <div class="task-info-page-container27">
            <div class="task-info-page-container28">
                <div id="completedtaskstable" class="task-info-page-div2">
                    <div id="pendingkanbancardstable">
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Tasks</th>
                                </tr>
                            </thead>
                            <tbody id="CTT_table">
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="task-info-page-container29">
                <button id="btnPrev_CTT" class="task-info-page-button16 button"> Previous </button>
                <button id="btnNext_CTT" class="task-info-page-button17 button"> Next </button>
                <button id="btnAll_CTT" class="task-info-page-button18 button">  All </button>
                <button id="btnLimit_CTT" class="task-info-page-button19 button"> Limit </button>
                <button id="btnPDF_CTT" class="task-info-page-button20 button"> PDF </button>
            </div>
        </div>
    </div>
    <div class="task-info-page-container30" id="content_AIT">
        <div class="task-info-page-container31">
            <h1 class="task-info-page-text21 upper">Aggregate Inventory Usage</h1>
        </div>
        <div class="task-info-page-container32">
            <div class="task-info-page-container33">
                <div id="agginvusagetable" class="task-info-page-div3">
                    <div id="pendingkanbancardstable">
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Inventory Request Frequency</th>
                                    <th>Raw Material Usage</th>
                                </tr>
                            </thead>
                            <tbody id="AIT_table">
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="task-info-page-container34">
                <button id="btnPrev_AIT" class="task-info-page-button16 button"> Previous </button>
                <button id="btnNext_AIT" class="task-info-page-button17 button"> Next </button>
                <button id="btnAll_AIT" class="task-info-page-button18 button">  All </button>
                <button id="btnLimit_AIT" class="task-info-page-button19 button"> Limit </button>
                <button id="btnPDF_AIT" class="task-info-page-button20 button"> PDF </button>
            </div>
        </div>
    </div>
    <div class="task-info-page-container35" id="content_FT">
        <div class="task-info-page-container36">
            <h1 class="task-info-page-text22 upper">Finance</h1>
        </div>
        <div class="task-info-page-container37">
            <div class="task-info-page-container38">
                <div id="financetable" class="task-info-page-div4">
                    <div id="pendingkanbancardstable">
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Factory</th>
                                    <th>Inventory Expense</th>
                                    <th>Date Range</th>
                                </tr>
                            </thead>
                            <tbody id="FT_table">
                                <tr>
                                    <td>Data</td>
                                    <td>Data</td>
                                    <td>Data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="task-info-page-container39">
                <button id="btnPrev_FT" class="task-info-page-button16 button"> Previous </button>
                <button id="btnNext_FT" class="task-info-page-button17 button"> Next </button>
                <button id="btnAll_FT" class="task-info-page-button18 button">  All </button>
                <button id="btnLimit_FT" class="task-info-page-button19 button"> Limit </button>
                <button id="btnPDF_FT" class="task-info-page-button20 button"> PDF </button>
            </div>
        </div>
    </div>
</div>
<div class="task-info-page-container40">
    <span class="task-info-page-text23">Lock Hood Pvt Ltd 2022</span>
</div>
</div>
</div>
</body>
</html>
