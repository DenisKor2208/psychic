<?php $this->layout('templates/template', ['title' => '404']) ?>

<?php $this->push('head') ?>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
<?php $this->end() ?>

<div style="text-align:center;">
    <p style="font-size: 130px; margin: auto;">404</p>
    <p style="font-size: 60px;">The page you are trying to reach doesn't exist.</p>
</div>