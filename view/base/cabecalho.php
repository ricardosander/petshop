<html>
<head>

  <?php  foreach ($aCss as $sCss) { ?>
  <link href="<?= $sCss ?>" type="text/css" rel="stylesheet" >
  <?php } ?>

  <?php  foreach ($aScripts as $sScript) { ?>
    <script src="<?= $sScript ?>" type="text/javascript"></script>
  <?php } ?>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">

  <div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a href="/" class="navbar-brand">Pet Shop</a>
  </div>

  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">

      <li class="dropdown">
        <a tabindex="0" data-toggle="dropdown" data-submenu="">
          Animais<span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li><a href="/animal/cadastro/" tabindex="0">Cadastrar</a></li>
          <li><a href="/animal/lista/" tabindex="0">Listar</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a tabindex="0" data-toggle="dropdown" data-submenu="">
          Clientes<span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li><a href="/clientes/cadastro/" tabindex="0">Cadastrar</a></li>
          <li><a href="/clientes/lista/" tabindex="0">Listar</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a tabindex="0" data-toggle="dropdown" data-submenu="">
          Usuários<span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li><a href="/usuario/cadastro" tabindex="0">Cadastrar</a></li>
          <li><a href="/usuario/lista/" tabindex="0">Listar</a></li>
        </ul>

      </li>
    </ul>

    <!-- TODO colocar configurações   -->
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a tabindex="0" data-toggle="dropdown" aria-expanded="false">
          Dropdown 3<span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li><a tabindex="0">Action</a></li>
          <li><a tabindex="0">Another action</a></li>
          <li><a tabindex="0">Something else here</a></li>
          <li class="divider"></li>
          <li><a tabindex="0">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

<div class="container">
  <div class="principal">