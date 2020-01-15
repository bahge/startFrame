<!-- Breadcrumb para auxiliar a navegação -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index">user</a></li>
    <li class="breadcrumb-item active" aria-current="page">editar.php</li>
  </ol>
</nav>

<?php
  if (isset($this->dados[0])):
      $valorForm = $this->dados[0];
  endif;

  if(isset($_SESSION['msg'])):
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  endif;
?>

<!-- Formulário de Edição de usuários -->
<form name="formEditUser" action="" method="post" id="formEditUser">

  <div class="form-group row">

    <label for="nome" class="col-sm-2 col-form-label text-right">Nome</label>
    <div class="col-sm-9">
      <input type="hidden" name="id" value="<?php echo ( isset($valorForm['id']) ? $valorForm['id']  : "");?>">
      <input type="text" class="form-control" id="nome" name="nome" value="<?php echo ( isset($valorForm['nome']) ? $valorForm['nome']  : "");?>">
    </div>

  </div>

  <div class="form-group row">

    <label for="email" class="col-sm-2 col-form-label text-right">E-mail</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="email" name="email" value="<?php echo ( isset($valorForm['email']) ? $valorForm['email']  : "");?>">
    </div>

  </div>

  <div class="form-group row">

    <label for="pass" class="col-sm-2 col-form-label text-right">Senha</label>
    <div class="col-sm-9">
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Só substitua a senha se deseja alterá-la">
    </div>

  </div>

  <div class="form-group row">

    <label for="nivel" class="col-sm-2 col-form-label text-right">Nível</label>
    <div class="col-sm-9">
      <select class="form-control" id="nivel" name="nivel">
        <option value=3 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 3 )?'selected="selected"':''?>>Usuário</option>
        <option value=2 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 2 )?'selected="selected"':''?>>Supervisor</option>
        <option value=1 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 1 )?'selected="selected"':''?>>Coordenador</option>
        <option value=0 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 0 )?'selected="selected"':''?>>Administrador</option>
      </select>
    </div>

  </div>

  <div class="form-group row">

    <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
    <div class="col-sm-9">
      <select class="form-control" id="status" name="status">
        <option value=1 <?php echo ( isset($valorForm['status'])) && ( $valorForm['status'] == 1)?'selected="selected"':""?>>Ativo</option>
        <option value=0 <?php echo ( isset($valorForm['status'])) && ( $valorForm['status'] == 0)?'selected="selected"':""?>>Inativo</option>
      </select>
    </div>

  </div>

  <div class="form-group row">

    <button class="btn btn-primary col-md-2 offset-md-8" type="submit" form="formEditUser" name="SendEditUser" value="SendEditUser"><i class="fas fa-save"></i></button>

  </div>
  
</form>