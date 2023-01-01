<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lock Hood</title>
    <meta property="og:title" content="Page - Lock Hood" />
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
        <link href="{{ asset('assets/page.css') }}" rel="stylesheet" />
        <div class="page-container">
            <header data-thq="thq-navbar" class="page-navbar-interactive">
                <div data-thq="thq-navbar-nav" data-role="Nav" class="page-desktop-menu">
                    <nav data-thq="thq-navbar-nav-links" data-role="Nav" class="page-nav">
                        <label id="home" class="page-text"><a href="{{ route('warehouse.dashboard') }}">Home</a></label>
                        <label id="inventory" class="page-text01"><a href="{{ route('warehouse.inventory') }}">Inventory</a></label>
                    </nav>
                </div>
                <label id="warehouseaccount" class="page-text02"><a href="">Warehouse Account</a></label>
                <div class="page-container1">
                    <label id="login" class="page-text03"><a onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" href="{{ route('warehouse.logout') }}">Logout</a></label>
                        
                        <form id="logout-form" 
                        action="{{ route('warehouse.logout') }}" 
                        method="POST" class="d-none">
                        @csrf
                    </form>
                    
                </div>
            </header>
            <div id="inventorycont" class="page-container2">
                <div class="page-container3">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th id="limittest">No.</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit Price (AUD)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTable">
                        </tbody>
                    </table>
                </div>
                <span class="page-text05">Inventories</span>
                <button class="page-button button" id="btnNext">Next</button>
                <button class="page-button1 button" id="btnPrev">Prev</button>
            </div>
            <div class="page-container4">
                
                @if($errors->any())
                <ul id="" class="page-ul list">
                    @foreach ($errors->all() as $error)
                    <li class="page-li list-item"><span class="page-text06">{{$error}}</span></li>
                    @endforeach
                </ul>
                @else
                @endif
                
                <div id="updateErrors" style="display: none;">
                    <ul id="errorlist" class="page-ul list"></ul>
                </div>
                
                
                @if(session('message'))
                <ul id="" class="page-ul list" style="background:green;">
                    <li class="page-li list-item"><span class="page-text06">{{session('message')}}</span></li>
                </ul>
                @endif
                
                <div class="page-container5">
                    <span class="page-text09" id="formHeader">Add Inventory</span>
                    
                    <input type="hidden" id="inventoryId">
                    
                    <form id="addForm" class="page-form" method="POST" action="{{ route('warehouse.addInventory') }}">
                        @csrf
                        <input
                        type="text"
                        id="inventoryNo"
                        name="inventoryNo" readonly
                        class="page-textinput input"
                        value="<?php echo rand(11115,99999) ?>"
                        />
                        <input
                        type="text"
                        id="name"
                        name="name"
                        class="page-textinput1 input" style="margin-bottom: 20px;"
                        value="{{ old('name') }}"
                        />
                        <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        class="page-textinput2 input"
                        value="{{ old('quantity') }}"
                        />
                        <input
                        type="number"
                        id="price"
                        name="price"
                        class="page-textinput3 input" style="margin-bottom: 20px;"
                        value="{{ old('price') }}"
                        />
                        <span class="page-text10">Inventory Number</span>
                        <span class="page-text11">Name</span>
                        <span class="page-text13">Quantity</span>
                        <span class="page-text12">Unit Price</span>
                        
                    </form>
                    
                    <div id="buttonContainer">
                        <button id="btnAdd" class="page-button2 button">Add</button>
                    </div>
                </div>
            </div>
            <div class="page-container6">
                <span class="page-text14">Lock Hood Pvt Ltd 2022</span>
            </div>
        </div>
    </div>
</body>
</html>

{{-- js --}}

<script>
    $(document).ready(function(){
        
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //calling function
        fetchInventories();

        //limit and offset for pagination
        var limit = 0;
        $(document).on('click', '#btnNext', function(e) {
            
            limit = limit + 5;
            fetchInventories();

        });

        $(document).on('click', '#btnPrev', function(e) {
            
            limit = limit - 5;

            if(limit < 0)
            {
                limit = 0;
            }

            fetchInventories();

        });
        
        //read
        function fetchInventories()
        {
            var url = '{{ url("warehouse/dashboard/read/:limit") }}';
            url = url.replace(':limit', limit);

            $.ajax({
                type: "GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $('#inventoryTable').html('');
                    
                    $.each(response.inventories,function(key,item){
                        
                        var name = item.name;
                        var name = name.slice(0,10)+'...';
                        
                        var status = "";
                        
                        if(item.status=='NA')
                        {
                            status = "<div style='text-align:center; width:50%; padding:2px; border-radius:6px; background:#f55549; color:white'>N/A</div>";
                        }
                        else
                        {
                            status = "<div style='text-align:center; border-radius:6px; width:60%; padding:2px; background:rgb(10, 187, 10); color:white'>Available</div>";
                        }
                        
                        $('#inventoryTable').append('<tr><td>'+item.inventoryNo+'</td>\
                            <td>'+name+'</td>\
                            <td>'+item.availableQuantity+'</td>\
                            <td>'+item.price+'</td>\
                            <td>'+status+'</td>\
                            <td>\
                                <button value="'+item.id+'" id="btnAddQuantity" style="padding:8px; border-radius:3px; background:#dbfc03; color:#615f5f;">Add</button>\
                                <button value="'+item.id+'" id="btnEdit" style="padding:8px; border-radius:3px; background:#d3e9f5; color:#615f5f;">Edit</button>\
                                <button value="'+item.id+'" id="btnDelete" style="padding:8px; border-radius:3px; background:#fa8169; color:#615f5f;">Del</button>\
                            </td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //delete
        $(document).on('click', '#btnDelete', function(e) {
            
            var id = $(this).val();
            
            var url = '{{ url("warehouse/dashboard/delete/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"DELETE",
                url:url,
                dataType:"json",
            });
            
            
            fetchInventories();
        });
        
        //edit
        $(document).on('click', '#btnEdit', function(e) {
            
            var id = $(this).val();
            
            var url = '{{ url("warehouse/dashboard/readOne/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success: function(response)
                {
                    $('#inventoryNo').val(response.inventories.inventoryNo);
                    $('#name').val(response.inventories.name);
                    $('#price').val(response.inventories.price);
                    $('#quantity').val(response.inventories.availableQuantity);
                    $('#inventoryId').val(response.inventories.id);
                    $('#formHeader').text('Edit Inventory');
                    
                    $('#buttonContainer').html('\
                    <button id="btnUpdate" class="page-button2 button">Update</button>');
                    
                }
            });
            
        });
        
        //add inventory
        $(document).on('click', '#btnAdd', function(e) {
            
            e.preventDefault();
            
            document.getElementById('addForm').submit();
            
        });
        
        //add stocks
        $(document).on('click', '#btnAddQuantity', function(e) {
            
            var id = $(this).val();
            
            var data = {
                'id' : id,
            }
            
            var url = '{{ url("warehouse/dashboard/addQuantity") }}';
            
            $.ajax({
                type:"PUT",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    fetchInventories();
                }
            });
        });
        
        //update inventory
        $(document).on('click', '#btnUpdate', function(e) {
            
            e.preventDefault();
            var id = $('#inventoryId').val();
            var name = $('#name').val();
            var price = $('#price').val();
            var quantity = $('#quantity').val();
            
            var data = {
                'id' : id,
                'name' : name,
                'price' : price,
                'quantity' : quantity,
            }
            
            var url = '{{ url("warehouse/dashboard/update") }}';
            
            $.ajax({
                type:"PUT",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    if(response.status==400)
                    {
                        $('#updateErrors').show();
                        $.each(response.errors,function(key,err_value){
                            $('#errorlist').append('<li class="page-li list-item"><span class="page-text06">'+err_value+'</span></li>');
                        });
                    }
                    else
                    {
                        $('#updateErrors').hide();
                        alert('Updated!')
                        
                        $('#buttonContainer').html('\
                        <button id="btnAdd" class="page-button2 button">Add</button>');
                        
                        $('#inventoryId').val('');
                        $('#name').val('');
                        $('#price').val('');
                        $('#quantity').val('')
                            $('#formHeader').text('Add Inventory');
                        
                        fetchInventories();
                    }
                }
            });
        });
    });
</script>