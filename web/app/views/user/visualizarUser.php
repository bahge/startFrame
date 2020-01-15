<!-- Breadcrumb para auxiliar a navegação -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index">user</a></li>
    <li class="breadcrumb-item active" aria-current="page">visualizarUser.php</li>
  </ol>
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
            
            <div class="card">
            <h3 class="card-header"><i class="fas fa-user-tag fa-2x text-info align-middle col-sm-2"></i> Detalhes do usuário</h3>
            
                <?php
                if (isset($_SESSION['msg'])):
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                endif;
                if (!empty($this->dados[0]['id'])):
                    ?>
            
                    <div class="row mt-3 px-4">
                        <p class="col-sm-4 text-md-right"><strong> Código:</strong></p>
                        <p class="col-sm-8"><?php echo $this->dados[0]['id']; ?></p>

                        <p class="col-sm-4 text-md-right"><strong> Nome:</strong></p>
                        <p class="col-sm-8"><?php echo $this->dados[0]['nome']; ?></p>

                        <p class="col-sm-4 text-md-right"><strong> E-mail:</strong></p>
                        <p class="col-sm-8"><?php echo $this->dados[0]['email']; ?></p>

                        <p class="col-sm-4 text-md-right"><strong> Status:</strong></p>
                        <p class="col-sm-8"><?php echo statusCod($this->dados[0]['status']); ?></p>

                        <p class="col-sm-4 text-md-right"><strong> Nivel:</strong></p>
                        <p class="col-sm-8"><?php echo nivelCod($this->dados[0]['nivel']); ?></p>
                        
                        <p class="col-sm-8 text-md-right"><button class="btn btn-secondary" onclick="location.href = '<?php echo URL . '/userController/index';?>';" title="Voltar"><i class="fas fa-arrow-circle-left"></i></button></p>
                    </div>    

                    <?php
                else:
                    echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
                endif;
                ?>
            
            </div>
        </div>

    </div>

</div>