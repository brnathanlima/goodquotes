<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/quote.php'; ?>
<?php
    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
    try {
        $quoteObj = new Quote();
        $quote = $quoteObj->getSingle($get['id']);
    } catch (\Throwable $th) {
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (isset($post['submit'])) {
        $id = $get['id'];
        $text = $post['text'] ?: null;
        $creator = $post['creator'] ?: 'Unkown';
        
        try {
            $quoteObj = new Quote();
            $quoteObj->update($id, $text, $creator);
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }
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
    <title>Add Quote</title>

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
  <a class="navbar-brand" href="index.php">GoodQuotes</a>
</nav>

<main role="main">

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
    <h2 class="page-header">Add new quote</h2>
    </div>
    <div class="row">
      <form method="post" action="edit.php?id=<?= $get['id'] ?>">
        <div class="form-group">
            <label for="text">Quote text</label>
            <input type="text" name="text" id="text" class="form-control" value="<?= $quote['text'] ?>">
        </div>
        <div class="form-group">
            <label for="creator">Creator</label>
            <input type="text" name="creator" id="creator" class="form-control" value="<?= $quote['creator'] ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </form>
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