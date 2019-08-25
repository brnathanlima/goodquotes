<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/quote.php'; ?>
<?php
  try {
    $quoteObj = new Quote();
    $quotes = $quoteObj->index();
  } catch (\Throwable $th) {
    echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Good Quotes</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">GoodQuotes</a>
</nav>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Got a quote?</h1>
      <p>Store your favorite quotes here to access and read them daily and better your life</p>
      <p><a class="btn btn-primary btn-lg" href="new.php" role="button">Add quote now</a></p>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
    <?php foreach($quotes as $quote): ?>    
      <div class="col-md-12">
        <h2><?= $quote['text']; ?></h2>
        <p><?= $quote['creator']; ?></p>
        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
      </div>
    <?php endforeach; ?>
    </div>

    <hr>

  </div> <!-- /container -->

</main>

<footer class="container">
  <p>&copy; Company 2017-2019</p>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>
</html>