<!DOCTYPE html>
<html lang="en">
  <head>
    <title>LoginPage - Lock Hood</title>
    <meta property="og:title" content="LoginPage - Lock Hood" />
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
      <link href="{{ asset('assets/login-page.css') }}" rel="stylesheet" />

      <div class="login-page-container">
        <div class="login-page-container1">
          <h1 class="login-page-text">Lock Hood</h1>
        </div>
        <div class="login-page-container2">
          <form class="login-page-form" action="{{ route('warehouse.login.submit') }}" method="POST">
            @csrf
            <input
              type="text"
              id="username"
              name="username"
              placeholder="username"
              class="login-page-textinput input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"
            />
            <input
              type="password"
              id="password"
              name="password"
              placeholder="password"
              class="login-page-textinput1 input"
            />
            <label id="emailerrorlabel" class="login-page-text1">
                @error('username')
                    {{ $message }}
                @enderror
            </label>
            <label id="passerrorlabel" class="login-page-text2">
              @error('password')
                  {{ $message }}
              @enderror
            </label>
            <span class="login-page-text3">Warehouse Login</span>
            <button
              id="loginbtn"
              name="loginbtn"
              type="submit"
              class="login-page-button button"
            >
              Login
            </button>
            <label class="login-page-text4">Username :</label>
            <label class="login-page-text5">Password :</label>
          </form>
        </div>
        <div class="login-page-container3">
          <span class="login-page-text6">LockHood Pvt Ltd 2022</span>
        </div>
      </div>
    </div>
  </body>
</html>
