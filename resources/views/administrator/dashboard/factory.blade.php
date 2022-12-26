<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrator - Lock Hood</title>
    <meta property="og:title" content="FactoriesPage - Lock Hood" />
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
        <link rel="stylesheet" href="{{ asset('assets/factories-page.css') }}" />
        
        <div class="factories-page-container">
            <header data-thq="thq-navbar" class="factories-page-navbar-interactive">
                <div
                data-thq="thq-navbar-nav"
                data-role="Nav"
                class="factories-page-desktop-menu"
                >
                <nav
                data-thq="thq-navbar-nav-links"
                data-role="Nav"
                class="factories-page-nav"
                >
                <a href="{{ route('administrator.dashboard') }}" id="home" class="factories-page-text">Home</a>
                <a href="{{ route('administrator.factory') }}" id="factories" class="factories-page-text01">
                    Factories
                </a>
                <a href="{{ route('administrator.department') }}" id="departments" class="factories-page-text02">
                    Departments
                </a>
                <a href="{{ route('administrator.supervisor') }}" id="supervisors" class="factories-page-text03">
                    Supervisors
                </a>
            </nav>
        </div>
        <label id="seniormanageraccount" class="factories-page-text04">
            Senior Manager Account
        </label>
        <div class="factories-page-container1">
            <a onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" href="{{ route('administrator.logout') }}"
            class="factories-page-text05">Log Out</a>
            
            <form id="logout-form" 
            action="{{ route('administrator.logout') }}" 
            method="POST" class="d-none">
            @csrf
        </form>
        
    </div>
</header>
<div id="inventorycont" class="factories-page-container2">
    <div class="factories-page-container3">
        <table width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="factoryTable">
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
            
            fetchFactories();
            
            $('#factoryNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
            
            //limit and offset for pagination
            var limit = 0;
            $(document).on('click', '#btnNext', function(e) {
                
                limit = limit + 5;
                fetchFactories();
                
            });
            
            $(document).on('click', '#btnPrev', function(e) {
                
                limit = limit - 5;
                
                if(limit < 0)
                {
                    limit = 0;
                }
                
                fetchFactories();
                
            });
            
            //read
            function fetchFactories()
            {
                var url = '{{ url("administrator/dashboard/factory/read/:limit") }}';
                url = url.replace(':limit', limit);
                
                $.ajax({
                    type: "GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        
                        $('#factoryTable').html('');
                        
                        $.each(response.factories,function(key,item){
                            
                            var name = item.name;
                            var name = name.slice(0,15)+'...';
                            
                            $('#factoryTable').append('<tr><td>'+item.no+'</td>\
                                <td>'+name+'</td>\
                                <td>'+item.contact+'</td>\
                                <td>'+item.address+'</td>\
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
            
            //Add Factory
            $(document).on('click', '#btnAdd', function(e) {
                
                e.preventDefault();
                var no = $('#factoryNo').val();
                var name = $('#name').val();
                var contact = $('#contact').val();
                var address = $('#address').val();
                
                var data = {
                    'no' : no,
                    'name' : name,
                    'contact' : contact,
                    'address' : address,
                }
                
                var url = '{{ url("administrator/dashboard/factory/create") }}';
                
                $.ajax({
                    type:"POST",
                    url: url,
                    data:data,
                    dataType:"json",
                    success: function(response){
                        if(response.status==400)
                        {
                            $('#errorlist').html('');
                            $.each(response.errors,function(key,err_value){
                                $('#errorlist').append('<li class="factories-page-li list-item"><span class="factories-page-text08">'+err_value+'</span></li>');
                            });
                        }
                        else
                        {
                            $('#errorlist').html('');
                            alert('Added!')
                            
                            $('#buttonContainer').html('\
                            <button id="btnAdd" class="factories-page-button2 button">Add</button>');
                            
                            $('#factoryNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
                            $('#name').val('');
                            $('#contact').val('');
                            $('#address').val('')
                            
                            fetchFactories();
                        }
                    }
                });
            });
            
            //Edit
            $(document).on('click', '#btnEdit', function(e) {
                
                var id = $(this).val();
                
                var url = '{{ url("administrator/dashboard/factory/readOne/:id") }}';
                url = url.replace(':id', id);
                
                $.ajax({
                    type:"GET",
                    url:url,
                    dataType:"json",
                    success: function(response)
                    {
                        $('#factoryNo').val(response.factories.no);
                        $('#name').val(response.factories.name);
                        $('#contact').val(response.factories.contact);
                        $('#address').val(response.factories.address);
                        $('#id').val(response.factories.id);
                        $('#formHeader').text('Edit Factory');
                        
                        $('#buttonContainer').html('\
                        <button id="btnUpdate" class="factories-page-button2 button">Update</button>');
                        
                    }
                });
                
            });
            
            //Update Factory
            $(document).on('click', '#btnUpdate', function(e) {
                
                e.preventDefault();
                var id = $('#id').val();
                var name = $('#name').val();
                var contact = $('#contact').val();
                var address = $('#address').val();
                
                var data = {
                    'id' : id,
                    'name' : name,
                    'contact' : contact,
                    'address' : address,
                }
                
                var url = '{{ url("administrator/dashboard/factory/update") }}';
                
                $.ajax({
                    type:"PUT",
                    url: url,
                    data:data,
                    dataType:"json",
                    success: function(response){
                        if(response.status==400)
                        {
                            $('#errorlist').html('');
                            $.each(response.errors,function(key,err_value){
                                $('#errorlist').append('<li class="factories-page-li list-item"><span class="factories-page-text08">'+err_value+'</span></li>');
                            });
                        }
                        else
                        {
                            $('#errorlist').html('');
                            alert('Updated!')
                            
                            $('#buttonContainer').html('\
                            <button id="btnAdd" class="factories-page-button2 button">Add</button>');
                            
                            $('#factoryNo').val(Math.floor(Math.random() * (19999 - 99999 + 1) + 99999));
                            $('#name').val('');
                            $('#contact').val('');
                            $('#address').val('')
                            $('#formHeader').text('Add Factory');
                            
                            fetchFactories();
                        }
                    }
                });
            });
            
            //delete
            $(document).on('click', '#btnDelete', function(e) {
                
                var id = $(this).val();
                
                var url = '{{ url("administrator/dashboard/factory/delete/:id") }}';
                url = url.replace(':id', id);
                
                $.ajax({
                    type:"DELETE",
                    url:url,
                    dataType:"json",
                });
                
                
                fetchFactories();
            });
        });
        
    </script>
    
    <span class="factories-page-text07">Factories</span>
    <button id="btnNext" class="factories-page-button button">
        Next
    </button>
    <button id="btnPrev" class="factories-page-button1 button">
        Prev
    </button>
</div>
<div class="factories-page-container4">
    <ul id="errorlist" class="factories-page-ul list">
        
    </ul>
    <div class="factories-page-container5">
        <span class="factories-page-text11" id="formHeader">Add Factory</span>
        <form class="factories-page-form">
            <input type="hidden" id="id">
            <input type="text" id="factoryNo" readonly value="<?php echo rand(19999,99999) ?>" class="factories-page-textinput input"
            />
            <input type="number" id="contact" multiple="contacttxt" class="factories-page-textinput1 input"
            />
            <input type="text" id="name" class="factories-page-textinput2 input"
            />
            <input type="text" id="address" target="addresstxt" class="factories-page-textinput3 input"
            />
            <span class="factories-page-text12">Factory number</span>
            <span class="factories-page-text13">Contact</span>
            <span class="factories-page-text14">Name</span>
            <span class="factories-page-text15">Location</span>
        </form>
        <div id="buttonContainer">
            <button id="btnAdd" type="submit" class="factories-page-button2 button"> Add </button>
        </div>
    </div>
</div>
<div class="factories-page-container6">
    <span class="factories-page-text16">Lock Hood Pvt Ltd 2022</span>
</div>
</div>
</div>
</html>
