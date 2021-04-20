<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$this->e($title)?></title>
    <?=$this->section('head')?>
</head>

<body class="p-5">

<div class="container">

    <?=$this->section('content')?>

</div>

</body>

<?=$this->section('scripts')?>

</html>
