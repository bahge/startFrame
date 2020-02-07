<!-- Breadcrumb para auxiliar a navegação -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo URL . 'homeController/adm';?>">Página Inicial</a></li>
    <li class="breadcrumb-item active" aria-current="page">user (index.php)</li>
  </ol>
</nav>

<!-- Barra de navegação - Ação: Cadastrar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="cadastrar">Cadastrar</a>
      </li>
    </ul>
  </div>

</nav>

<?php
  if(isset($_SESSION['msg'])):
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  endif;
?>
<!-- Container da aplicação -->
<div class="container">

  <div class="row">

    <div class="col-sm-12">
      <!-- Tabela de usuários e ações - Ações: Visualizar, Editar e Apagar -->
      <table class="table table-striped table-responsive-sm">
        <thead>
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Nível</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
      <?php 
        $pg = $this->dados[1];
        $this->dados = $this->dados[0];
        if (!empty($this->dados)):
          foreach ($this->dados as $user) {
            extract($user);
            ?>               
            <tr>
                <td>
                    <a href="<?php echo URL; ?>userController/visualizar/<?php echo $id; ?>"><button type="button" class="btn btn-primary" title="Visualizar Registro"><i class="fa fa-glasses" aria-hidden="true"></i></button></a>

                    <a href="<?php echo URL; ?>userController/editar/<?php echo $id; ?>"><button type="button" class="btn btn-warning" title="Editar Registro"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                    
                    <?php if ($_SESSION['usuario']['id'] != $id):?>
                      <a href="<?php echo URL; ?>userController/apagar/<?php echo $id; ?>"><button type="button" class="btn btn-danger" title="Apagar Registro"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                    <?php endif;?>
                </td>

                <td><?php echo $nome; ?></td>

                <td><?php echo $email; ?></td>

                <td><?php echo nivelCod($nivel); ?></td>

                <td><?php echo statusCod($status); ?></td>
                
            </tr>

            <?php  
          }
        endif;
      ?>
    </div>

  </div>

</div>
