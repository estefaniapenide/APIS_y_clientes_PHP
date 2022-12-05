<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title')?>&nbsp;-&nbsp;Cliente API 1 - Basic Auth</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <?= $this->renderSection('css')?>
  </head>
  <body>
    <?= $this->include('layout/header')?>
    <?= $this->renderSection('content')?>
    <?= $this->include('layout/footer')?>

    <?= $this->renderSection('js')?>
  </body>
</html>