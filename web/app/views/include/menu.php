<?php if (!isset($_SESSION['usuario']['id'])):?>
<!-- Menu deslogado -->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm" id="menubar">

      <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo APP_TITLE;?></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?php echo URL;?>homeController/login">Área Restrita</a>
      </nav>

</div>

<?php else:?>
<!-- Menu logado -->
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm" id="menubar">
    
    <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo APP_TITLE;?></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="<?php echo URL;?>homeController/deslogar">Deslogar</a>
    </nav>
    
</div>

<?php endif; ?>