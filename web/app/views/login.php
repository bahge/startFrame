<style>
html, body { height: 100%; }

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-image: url("../assets/img/back.png");
  background-repeat: repeat;
  background-color: #386093;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox { font-weight: 400; }

.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {  z-index: 2; }

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
.card:hover{ box-shadow: 5px 6px 8px rgb(56, 96, 147) !important; }

#menubar { display: none !important; }
</style>

<!-- Formulário de Login -->
<form class="form-signin card" method="POST" action="">

    <h1 class="h3 mb-3 font-weight-normal"> <img class="mb-4" src="../assets/img/icon.svg" alt="" width="72" height="72"> Vitrine Manager</h1>

    <label for="login" class="sr-only">Endereço de email</label>
    <input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>

    <label for="pass" class="sr-only">Senha</label>
    <input type="password" id="pass" name="pass" class="form-control" placeholder="Senha" required>
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

</form>