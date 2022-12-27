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
              <a href="index.html" class="kanban-cards-page-navlink">
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
              Supervisor Account
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
          <button class="kanban-cards-page-button button">Create New</button>
          <button class="kanban-cards-page-button1 button">Go To Tasks</button>
        </div>
        <div id="inventorycont" class="kanban-cards-page-container03">
          <div class="kanban-cards-page-container04">
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
          <span class="kanban-cards-page-text08">
            <span>Kanban Cards</span>
            <br />
          </span>
          <button id="nextbtn" class="kanban-cards-page-button2 button">
            Next
          </button>
          <button id="prevbtn" class="kanban-cards-page-button3 button">
            Previous
          </button>
        </div>
        <div id="inventorycont" class="kanban-cards-page-container05">
          <span class="kanban-cards-page-text11">Tasks</span>
          <div class="kanban-cards-page-container06">
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
          <div class="kanban-cards-page-container07">
            <button id="tasksprevbtn" class="kanban-cards-page-button4 button">
              &lt;&lt;
            </button>
            <button id="tasksnextbtn" class="kanban-cards-page-button5 button">
              &gt;&gt;
            </button>
          </div>
        </div>
        <div class="kanban-cards-page-container08">
          <ul id="errorlist" class="kanban-cards-page-ul list">
            <li class="kanban-cards-page-li list-item">
              <span class="kanban-cards-page-text13">Text</span>
            </li>
            <li class="kanban-cards-page-li1 list-item">
              <span class="kanban-cards-page-text14">Text</span>
            </li>
            <li class="kanban-cards-page-li2 list-item">
              <span class="kanban-cards-page-text15">Text</span>
            </li>
          </ul>
          <div class="kanban-cards-page-container09">
            <span class="kanban-cards-page-text16">Create Card</span>
            <form class="kanban-cards-page-form">
              <div class="kanban-cards-page-container10">
                <span class="kanban-cards-page-text17">Card Number</span>
                <input
                  type="number"
                  id="cardnumbertxt"
                  name="cardnumbertxt"
                  target="noofworkslotstxt"
                  class="kanban-cards-page-textinput input"
                />
              </div>
              <div class="kanban-cards-page-container11">
                <span class="kanban-cards-page-text18">Title</span>
                <input
                  type="text"
                  id="titletxt"
                  name="titletxt"
                  class="kanban-cards-page-textinput1 input"
                />
              </div>
              <div class="kanban-cards-page-container12">
                <span class="kanban-cards-page-text19">Description</span>
                <input
                  type="text"
                  id="descriptiontxt"
                  name="descriptiontxt"
                  class="kanban-cards-page-textinput2 input"
                />
              </div>
              <button
                id="addbtn"
                name="addbtn"
                type="submit"
                class="kanban-cards-page-button6 button"
              >
                Add
              </button>
            </form>
          </div>
          <div class="kanban-cards-page-container13">
            <span class="kanban-cards-page-text20">Add Task</span>
            <form class="kanban-cards-page-form1">
              <div class="kanban-cards-page-container14">
                <span class="kanban-cards-page-text21">Card Number</span>
                <input
                  type="number"
                  id="cardnumbertxt"
                  name="cardnumbertxt"
                  target="noofworkslotstxt"
                  class="kanban-cards-page-textinput3 input"
                />
              </div>
              <div class="kanban-cards-page-container15">
                <span class="kanban-cards-page-text22">Title</span>
                <input
                  type="text"
                  id="titletxt"
                  name="titletxt"
                  class="kanban-cards-page-textinput4 input"
                />
              </div>
              <div class="kanban-cards-page-container16">
                <span class="kanban-cards-page-text23">Description</span>
                <input
                  type="text"
                  id="descriptiontxt"
                  name="descriptiontxt"
                  class="kanban-cards-page-textinput5 input"
                />
              </div>
              <div class="kanban-cards-page-container17">
                <span class="kanban-cards-page-text24">Start Date</span>
                <input
                  type="date"
                  id="startdatetxt"
                  name="startdatetxt"
                  target="noofworkslotstxt"
                  class="kanban-cards-page-textinput6 input"
                />
              </div>
              <div class="kanban-cards-page-container18">
                <span class="kanban-cards-page-text25">End Date</span>
                <input
                  type="date"
                  id="enddatetxt"
                  name="enddatetxt"
                  target="noofworkslotstxt"
                  class="kanban-cards-page-textinput7 input"
                />
              </div>
              <div class="kanban-cards-page-container19">
                <span class="kanban-cards-page-text26">Duration</span>
                <input
                  type="text"
                  id="durationtxt"
                  name="durationtxt"
                  disabled=""
                  class="kanban-cards-page-textinput8 input"
                />
              </div>
              <button
                id="autoschedulebtn"
                name="autoschedulebtn"
                type="submit"
                class="kanban-cards-page-button7 button"
              >
                Auto Schedule
              </button>
              <button
                id="savebtn"
                name="savebtn"
                type="submit"
                class="kanban-cards-page-button8 button"
              >
                Save
              </button>
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
