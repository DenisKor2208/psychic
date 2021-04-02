<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$this->e($title)?></title>
    <?=$this->section('head')?>
</head>

<body>
    <main role="main" class="container">

        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a href="/clearSession" class="list-group-item list-group-item-action list-group-item-primary">Обнулить прогресс</a>
            </li>
        </ul>

        <?=$this->section('content')?>

    </main>
</body>

    <?=$this->section('scripts')?>

</html>
