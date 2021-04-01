<?php $this->layout('templates/template', ['title' => 'Home Page']) ?>

<?php $this->push('head') ?>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php $this->end() ?>

<div class="jumbotron text-center">
    <form action="/resultPage" method="GET">
        <div class="container">
            <div class="col-md-8 mx-auto text-center">
                <?php echo "<h3>Здравствуйте {$_SESSION['user_name']}!</h3>";?>
            </div>
            <h2>Загадайте двузначное число.</h2>
            <p class="mt-5 text-center">
                <button type="submit" class="btn btn-secondary btn-lg">Загадал</button>
            </p>
        </div>
    </form>
</div>

<?php $this->insert('table_user', ['step_d' => $step_d, 'sc' => $sc]); ?>

<?php $this->push('scripts') ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php $this->end() ?>

