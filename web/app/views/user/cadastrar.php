<!-- Breadcrumb para auxiliar a navegação -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index">user</a></li>
    <li class="breadcrumb-item active" aria-current="page">cadastrar.php</li>
  </ol>
</nav>

<?php
  if(isset($_SESSION['msg'])):
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  endif;
?>

<!-- Formulário de cadastro de usuários -->
<form action="" method="post" id="formCadUser">

  <div class="form-group row">

    <label for="nome" class="col-sm-2 col-form-label text-right">Nome</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="nome" name="nome" >
    </div>

  </div>

  <div class="form-group row">

    <label for="email" class="col-sm-2 col-form-label text-right">E-mail</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="email" name="email">
    </div>
  
  </div>
  
  <div class="form-group row">
  
    <label for="pass" class="col-sm-2 col-form-label text-right">Senha</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="pass" name="pass">
    </div>
  
  </div>
  
  <div class="form-group row">
  
    <label for="nivel" class="col-sm-2 col-form-label text-right">Nível</label>
    <div class="col-sm-9">
      <select class="form-control" id="nivel" name="nivel">
        <option value="3">Usuário</option>
        <option value="2">Supervisor</option>
        <option value="1">Coordenador</option>
        <option value="0">Administrador</option>
      </select>
    </div>
  
  </div>
  
  <div class="form-group row">
  
    <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
    <div class="col-sm-9">
      <select class="form-control" id="status" name="status">
        <option value="1">Ativo</option>
        <option value="0">Inativo</option>
      </select>
    </div>
  
  </div>
  
  <div class="form-group row">
  
    <button class="btn btn-primary col-md-2 offset-md-8" type="submit" form="formCadUser" value="SendCadUser" title="Cadastrar"><i class="fas fa-save"></i></button>

  </div>
  
</form>
