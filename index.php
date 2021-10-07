<!DOCTYPE html>
<html lang="">

  <head>
    <meta charset="utf-8">
    <title> The Raven Desk </title>

    <style>
    body {
        background-image: url("style/img/background.png");
    }
    
    #logo{
        position: fixed;
        width: 10%;
    }
    
    h1{
        position: fixed;
        margin-left: 12%;
        margin-top: 2%;
        color: white;
        font-size: 60px;
    }

    #bgvideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
    }
 
    #loginBox {
      position: fixed;
      width: 20%;
      height: 60%;
      margin-top: 8%;
      margin-left: 70%;
      background: #d9d8d9;
      color: black;
      padding: 2%;
      border-radius: 1.5em;
      box-shadow: 0px 11px 35px 2px rgb(0, 0, 0);
    }

    form {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    </style>
  </head>


  <body>
    
    <img id="logo" src="style/img/logo.png">
    
    <h1> The Raven Desk </h1>

    <div id="loginBox">
      <form>
        <h3> Begin </h3>
        <label for="email"> Email </label>
        <input type="email" name="email">
        <label for="pass">Password</label>
        <input type="password" name="pass">

        <button type="submit"> Log In </button>
        <a href="#"> Don't Have an Account? </a>
      </form>
    </div>

  </body>
</html>