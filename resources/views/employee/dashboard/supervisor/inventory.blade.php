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
              <a href="index.html" class="inventories-page-navlink">
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
              Supervisor Account
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
                  <th>ID
                  <th>First Name
                  <th>Last Name
                  <th>Goes By
                  <th>Gender
                  <th>Class
                  <th>Alive
              </thead>
              <tbody>
                <tr>
                  <td>1
                  <td>Malcolm
                  <td>Reynolds
                  <td>Mal, Cap'n
                  <td>M
                  <td>Captain
                  <td>Yes
                <tr>
                  <td>2
                  <td>Zoe
                  <td>Washburn
                  <td>Zoe
                  <td>F
                  <td>First Mate
                  <td>Yes
                <tr class="disabled">
                  <td>3
                  <td>Hoban
                  <td>Washburn
                  <td>Wash
                  <td>M
                  <td>Pilot
                  <td>No
                <tr>
                  <td>4
                  <td>Kaylee
                  <td>Frye
                  <td>Kaylee
                  <td>F
                  <td>Mechanic
                  <td>Yes
                <tr>
                  <td>5
                  <td>Jayne
                  <td>Cobb
                  <td>Jayne
                  <td>M
                  <td>Muscle
                  <td>Yes
                <tr class="disabled">
                  <td>6
                  <td>[unknown]
                  <td>Book
                  <td>Shepherd
                  <td>M
                  <td>Passenger
                  <td>No
                <tr>
                  <td>7
                  <td>Simon
                  <td>Tam
                  <td>Simon
                  <td>M
                  <td>Passenger
                  <td>Yes
                <tr>
                  <td>8
                  <td>River
                  <td>Tam
                  <td>River
                  <td>F
                  <td>Passenger
                  <td>Yes
              </tbody>
            </table>
          </div>
          <span class="inventories-page-text08">
            <span>Inventories</span>
            <br />
          </span>
          <button id="nextbtn" class="inventories-page-button2 button">
            Next
          </button>
          <button id="prevbtn" class="inventories-page-button3 button">
            Previous
          </button>
        </div>
        <div id="inventorycont" class="inventories-page-container05">
          <span class="inventories-page-text11">Inventory Requests</span>
          <div class="inventories-page-container06">
            <table width="100%">
              <thead>
                <tr>
                  <th>ID
                  <th>First Name
                  <th>Last Name
                  <th>Goes By
                  <th>Gender
                  <th>Class
                  <th>Alive
              </thead>
              <tbody>
                <tr>
                  <td>1
                  <td>Malcolm
                  <td>Reynolds
                  <td>Mal, Cap'n
                  <td>M
                  <td>Captain
                  <td>Yes
                <tr>
                  <td>2
                  <td>Zoe
                  <td>Washburn
                  <td>Zoe
                  <td>F
                  <td>First Mate
                  <td>Yes
                <tr class="disabled">
                  <td>3
                  <td>Hoban
                  <td>Washburn
                  <td>Wash
                  <td>M
                  <td>Pilot
                  <td>No
                <tr>
                  <td>4
                  <td>Kaylee
                  <td>Frye
                  <td>Kaylee
                  <td>F
                  <td>Mechanic
                  <td>Yes
                <tr>
                  <td>5
                  <td>Jayne
                  <td>Cobb
                  <td>Jayne
                  <td>M
                  <td>Muscle
                  <td>Yes
              </tbody>
            </table>
          </div>
          <div class="inventories-page-container07">
            <button id="invreqprevbtn" class="inventories-page-button4 button">
              &lt;&lt;
            </button>
            <button id="invreqnextbtn" class="inventories-page-button5 button">
              &gt;&gt;
            </button>
          </div>
        </div>
        <div class="inventories-page-container08">
          <ul id="errorlist" class="inventories-page-ul list">
            <li class="inventories-page-li list-item">
              <span class="inventories-page-text13">Text</span>
            </li>
            <li class="inventories-page-li1 list-item">
              <span class="inventories-page-text14">Text</span>
            </li>
            <li class="inventories-page-li2 list-item">
              <span class="inventories-page-text15">Text</span>
            </li>
          </ul>
          <div class="inventories-page-container09">
            <span class="inventories-page-text16">
              Add new raw material to purchase
            </span>
            <form class="inventories-page-form">
              <div class="inventories-page-container10">
                <span class="inventories-page-text17">Inventory Number</span>
                <input
                  type="number"
                  id="invnumbertxt"
                  name="invnumbertxt"
                  target="noofworkslotstxt"
                  class="inventories-page-textinput input"
                />
              </div>
              <div class="inventories-page-container11">
                <span class="inventories-page-text18">Inventory</span>
                <select
                  id="invselect"
                  name="invselect"
                  class="inventories-page-select"
                >
                  <option value="Option 1">Option 1</option>
                  <option value="Option 2">Option 2</option>
                  <option value="Option 3">Option 3</option>
                </select>
              </div>
              <div class="inventories-page-container12">
                <span class="inventories-page-text19">Quantity</span>
                <input
                  type="number"
                  id="quantitytxt"
                  name="quantitytxt"
                  class="inventories-page-textinput1 input"
                />
              </div>
              <div class="inventories-page-container13">
                <span class="inventories-page-text20">Minimum Quantity</span>
                <input
                  type="number"
                  id="minquantitytxt"
                  name="minquantitytxt"
                  class="inventories-page-textinput2 input"
                />
              </div>
              <div class="inventories-page-container14">
                <span class="inventories-page-text21">Unit Cost</span>
                <input
                  type="number"
                  id="unitcosttxt"
                  name="unitcosttxt"
                  class="inventories-page-textinput3 input"
                />
              </div>
              <button
                id="addbtn"
                name="addbtn"
                type="submit"
                class="inventories-page-button6 button"
              >
                Add
              </button>
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
