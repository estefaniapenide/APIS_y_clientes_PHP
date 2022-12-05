<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title')?>&nbsp;-&nbsp;Cliente API 3 - API Key</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  </head>
  <body>
  <section class="hero is-link">
  <div class="hero-body">
    <p class="title">
      Cliente API 4 - API Key
    </p>
    <p class="subtitle">
      Log in
    </p>
  </div>
</section>
    
<section class="section">
<div class="container">
  <h1 class="title">Login</h1>
  <h2 class="subtitle">
    Para consultar las ventas hay que logearse</h2>

<form action="<?= base_url(route_to('login'))?>" method="POST">
    <div class="field">
        <label class="label">Usuario</label>
        <div class="control">
            <input name="username" value="" class="input" type="text" placeholder="Usuario">
        </div>
        <p class="is-danger help"></p>
    </div>

    <div class="field">
        <label class="label">Contraseña</label>
        <div class="control">
            <input name="password" value=""class="input" type="text" placeholder="Contraseña">
        </div>
        <p class="is-danger help"></p>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="button is-link">Login</button>
        </div>
    </div>
</form>

</div>
</section>


    <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
      <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
      is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
    </p>
  </div>
</footer>
  </body>
</html>