<?php $this->layout('templates/template', ['title' => 'Home Page']) ?>

<?php $this->push('head') ?>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php $this->end() ?>

<div class="jumbotron">
    <form action="/homePage" method="GET">

        <div class="form-group col-md-4 mx-auto text-center">
            <label for="nameText">Введите пожалуйста ваше число</label>
            <input class="form-control form-control-lg" id="nameText" name="user_number" type="number" min="10" max="99" required>
        </div>

        <div class="row">

            <div class="col-md-4">
                <label for="nameText">Предположение экстрасенса 1</label>
                <input class="form-control form-control-lg" id="nameText" name="one_psychic_number" type="text" value="<?php echo $_SESSION['psychic_1_current_result']?>" readonly>
            </div>

            <div class="col-md-4">
                <label for="nameText">Предположение экстрасенса 2</label>
                <input class="form-control form-control-lg" id="nameText" name="two_psychic_number" type="text" value="<?php echo $_SESSION['psychic_2_current_result']?>" readonly>
            </div>

            <div class="col-md-4">
                <label for="nameText">Предположение экстрасенса 3</label>
                <input class="form-control form-control-lg" id="nameText" name="three_psychic_number" type="text" value="<?php echo $_SESSION['psychic_3_current_result']?>" readonly>
            </div>

        </div>

        <p class="mt-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg">Результат</button>
        </p>

    </form>
</div>

<?php $this->insert('table_user', ['step_d' => $step_d, 'sc' => $sc]); ?>

<?php $this->push('scripts') ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php $this->end() ?>

