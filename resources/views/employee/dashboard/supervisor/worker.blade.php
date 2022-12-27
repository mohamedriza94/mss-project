<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Employee - Lock Hood</title>
    <meta property="og:title" content="WorkersPage - Lock Hood" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

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
          <a href="index.html" class="workers-page-navlink5">
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
        <div id="inventorycont" class="workers-page-container2">
          <div class="workers-page-container3">
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
          <span class="workers-page-text08">Workers</span>
          <button id="nextbtn" class="workers-page-button button">Next</button>
          <button id="prevbtn" class="workers-page-button1 button">
            Previous
          </button>
        </div>
        <div class="workers-page-container4">
          <ul id="errorlist" class="workers-page-ul list">
            <li class="workers-page-li list-item">
              <span class="workers-page-text09">Text</span>
            </li>
            <li class="workers-page-li1 list-item">
              <span class="workers-page-text10">Text</span>
            </li>
            <li class="workers-page-li2 list-item">
              <span class="workers-page-text11">Text</span>
            </li>
          </ul>
          <div class="workers-page-container5">
            <span class="workers-page-text12">Add Workers</span>
            <form class="workers-page-form">
              <select
                id="workshopoptdrop"
                type="workshopoptdrop"
                class="workers-page-select"
              >
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
              </select>
              <input
                type="text"
                id="workernumtxt"
                name="workernumtxt"
                class="workers-page-textinput input"
              />
              <input
                type="text"
                id="addresstxt"
                name="addresstxt"
                class="workers-page-textinput1 input"
              />
              <input
                type="email"
                id="emailtxt"
                name="emailtxt"
                class="workers-page-textinput2 input"
              />
              <input
                type="text"
                id="nametxt"
                name="nametxt"
                class="workers-page-textinput3 input"
              />
              <input
                type="password"
                id="passtxt"
                name="passtxt"
                class="workers-page-textinput4 input"
              />
              <input
                type="datetime-local"
                id="dobtxt"
                name="dobtxt"
                class="workers-page-textinput5 input"
              />
              <input
                type="password"
                id="conpasstxt"
                name="conpasstxt"
                class="workers-page-textinput6 input"
              />
              <input
                type="number"
                id="contacttxt"
                name="contacttxt"
                class="workers-page-textinput7 input"
              />
              <input
                type="file"
                id="photoint"
                name="photoint"
                class="workers-page-textinput8 input"
              />
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
            <button
              id="addbtn"
              name="addbtn"
              type="submit"
              class="workers-page-button2 button"
            >
              Add
            </button>
          </div>
        </div>
        <div class="workers-page-container6">
          <span class="workers-page-text23">Lock Hood Pvt Ltd 2022</span>
        </div>
      </div>
    </div>
</html>
