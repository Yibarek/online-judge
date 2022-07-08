<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - 403 Forbidden</title>
  <style>
    @import url("https://fonts.googleapis.com/css?family=Lato");
* {
  position: relative;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Lato", sans-serif;
}

body {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: linear-gradient(to bottom right, #FFF, rgb(207, 204, 204));
}

h1 {
  margin: 40px 0 20px;
}

.lock {
  border-radius: 5px;
  width: 55px;
  height: 45px;
  background-color: #333;
  animation: dip 1s;
  animation-delay: 1.5s;
}
.lock::before, .lock::after {
  content: "";
  position: absolute;
  border-left: 5px solid #333;
  height: 20px;
  width: 15px;
  left: calc(50% - 12.5px);
}
.lock::before {
  top: -30px;
  border: 5px solid #333;
  border-bottom-color: transparent;
  border-radius: 15px 15px 0 0;
  height: 30px;
  animation: lock 2s, spin 2s;
}
.lock::after {
  top: -10px;
  border-right: 5px solid transparent;
  animation: spin 2s;
}

@keyframes lock {
  0% {
    top: -45px;
  }
  65% {
    top: -45px;
  }
  100% {
    top: -30px;
  }
}
@keyframes spin {
  0% {
    transform: scaleX(-1);
    left: calc(50% - 30px);
  }
  65% {
    transform: scaleX(1);
    left: calc(50% - 12.5px);
  }
}
@keyframes dip {
  0% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(10px);
  }
  100% {
    transform: translateY(0px);
  }
}
  </style>

</head>
<body  class="login100-form">
<!-- partial:index.partial.html -->
<div class="lock"></div>
<div class="message">
  <h1 style="padding-left: 15%;">Access Denied 403 </h1>
  <h1>Access to this page is restricted</h1>
  <p>Please check with the site admin if you believe this is a mistake.</p>
</div>
<!-- partial -->

</body>
</html>