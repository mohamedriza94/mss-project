<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SupervisorPage - Lock Hood</title>
    <meta property="og:title" content="SupervisorPage - Lock Hood" />
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
          </div>
        </header>
        <div id="inventorycont" class="supervisor-page-container2">
          <div class="supervisor-page-container3">
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
          <span class="supervisor-page-text07">Supervisors</span>
          <button id="nextbtn" class="supervisor-page-button button">
            Next
          </button>
          <button id="prevbtn" class="supervisor-page-button1 button">
            Previous
          </button>
        </div>
        <div class="supervisor-page-container4">
          <ul id="errorlist" class="supervisor-page-ul list">
            <li class="supervisor-page-li list-item">
              <span class="supervisor-page-text08">Text</span>
            </li>
            <li class="supervisor-page-li1 list-item">
              <span class="supervisor-page-text09">Text</span>
            </li>
            <li class="supervisor-page-li2 list-item">
              <span class="supervisor-page-text10">Text</span>
            </li>
          </ul>
          <div class="supervisor-page-container5">
            <span class="supervisor-page-text11">Add Supervisors</span>
            <form class="supervisor-page-form">
              <select
                id="depoptiondrop"
                type="depoptiondrop"
                class="supervisor-page-select"
              >
                <option value="Option 1">Option 1</option>
                <option value="Option 2">Option 2</option>
                <option value="Option 3">Option 3</option>
              </select>
              <input
                type="text"
                id="supnumtxt"
                name="supnumtxt"
                class="supervisor-page-textinput input"
              />
              <input
                type="text"
                id="addresstxt"
                name="addresstxt"
                class="supervisor-page-textinput1 input"
              />
              <input
                type="email"
                id="emailtxt"
                name="emailtxt"
                class="supervisor-page-textinput2 input"
              />
              <input
                type="text"
                id="nametxt"
                name="nametxt"
                class="supervisor-page-textinput3 input"
              />
              <input
                type="password"
                id="passtxt"
                name="passtxt"
                class="supervisor-page-textinput4 input"
              />
              <input
                type="datetime-local"
                id="dobtxt"
                name="dobtxt"
                class="supervisor-page-textinput5 input"
              />
              <input
                type="password"
                id="conpasstxt"
                name="conpasstxt"
                class="supervisor-page-textinput6 input"
              />
              <input
                type="number"
                id="contacttxt"
                name="contacttxt"
                class="supervisor-page-textinput7 input"
              />
              <input
                type="file"
                id="photoint"
                name="photoint"
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
            <button
              id="addbtn"
              name="addbtn"
              type="submit"
              class="supervisor-page-button2 button"
            >
              Add
            </button>
          </div>
        </div>
        <div class="supervisor-page-container6">
          <span class="supervisor-page-text22">Lock Hood Pvt Ltd 2022</span>
        </div>
      </div>
    </div>
  </body>
</html>
