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
              <a href="index.html" class="workshop-page-navlink">
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
              Supervisor Account
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
                  <th>ID
                  <th>First Name
                  <th>Last Name
                  <th>Goes By
                  <th>Gender
                  <th>Class
                  <th>Alive
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
          <span class="workshop-page-text08">
            <span>Workshops</span>
            <br />
          </span>
          <button id="nextbtn" class="workshop-page-button button">Next</button>
          <button id="prevbtn" class="workshop-page-button1 button">
            Previous
          </button>
        </div>
        <div id="inventorycont" class="workshop-page-container04">
          <div class="workshop-page-container05">
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
          <span class="workshop-page-text12">Work Slots</span>
          <div class="workshop-page-container06">
            <button id="worknextbtn" class="workshop-page-button2 button">
              &gt;&gt;
            </button>
            <button id="workprevbtn" class="workshop-page-button3 button">
              &lt;&lt;
            </button>
          </div>
        </div>
        <div class="workshop-page-container07">
          <ul id="errorlist" class="workshop-page-ul list">
            <li class="workshop-page-li list-item">
              <span class="workshop-page-text13">Text</span>
            </li>
            <li class="workshop-page-li1 list-item">
              <span class="workshop-page-text14">Text</span>
            </li>
            <li class="workshop-page-li2 list-item">
              <span class="workshop-page-text15">Text</span>
            </li>
          </ul>
          <div class="workshop-page-container08">
            <span class="workshop-page-text16">Add Workshop</span>
            <form class="workshop-page-form">
              <select
                id="workshopoptdrop"
                type="workshopoptdrop"
                class="workshop-page-select"
              >
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
              </select>
              <input
                type="text"
                id="workernumtxt"
                name="workernumtxt"
                class="workshop-page-textinput input"
              />
              <input
                type="text"
                id="nametxt"
                name="nametxt"
                class="workshop-page-textinput1 input"
              />
              <input
                type="number"
                id="noofworkslotstxt"
                name="dobtxt"
                target="noofworkslotstxt"
                class="workshop-page-textinput2 input"
              />
              <span class="workshop-page-text17">Workshop Number</span>
              <span class="workshop-page-text18">Name</span>
              <span class="workshop-page-text19">Status</span>
              <span class="workshop-page-text20">Number of workslots</span>
              <button
                id="addbtn"
                name="addbtn"
                type="submit"
                class="workshop-page-button4 button"
              >
                Add
              </button>
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
