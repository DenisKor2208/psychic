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
                <button type="button" class="btn btn-primary" onclick="window.location.href = '/clearSession';">Обнулить</button>
            </li>
        </ul>

        <?=$this->section('content')?>

    </main>
</body>

    <?=$this->section('scripts')?>

</html>
