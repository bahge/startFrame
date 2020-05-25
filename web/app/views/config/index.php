<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo URL;?>/homeController/adm">Página Inicial</a></li>
    <li class="breadcrumb-item active" aria-current="page">Configurações</li>
  </ol>
</nav>

<?php
  if(isset($_SESSION['msg'])):
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  endif;
?>

<div class="container">

    <nav class="nav nav-pills nav-fill my-4" id="config-tab" role="tablist" >
        <a class="nav-item nav-link active" id="a-config-tab" data-toggle="pill" href="#config-row" role="tab" aria-controls="config-row" aria-selected="true">Configurações</a>
    </nav>
    <hr>
    <div class="row tab-content" id="pills-tabContent">     
        <div class="tab-pane fade show active col-sm-12" id="config-row" role="tabpanel" aria-labelledby="a-config-tab">
          
          <form action="" method="post" id="formEditCFG">
          
            <h2 class="display-3 mb-5">Configurações:</h2>
          
              <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $this->dados['nome'];?>">
                </div>
              </div>
          
              <div class="form-group row">
                <button class="btn btn-primary col-md-2 offset-md-8" type="submit" id='sendForm' form="formEditCFG" title="Salvar"><i class="fas fa-save"></i></button>
              </div>
          
          </form>

        </div>

    </div>

</div>
<hr>