{use class="app\assets\AppAsset"}
{use class="yii\helpers\Html"}
{use class="app\assets\plugin\ICheckAsset"}

{AppAsset::register($this)|void}
{ICheckAsset::register($this)|void}


{$this->beginPage()}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {Html::csrfMetaTags()}
    <title>{Html::encode($this->title)}</title>
    {$this->head()}
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

</head>
<body class="hold-transition login-page">
{$this->beginBody()}
{$content}
{$this->endBody()}
</body>
</html>
{$this->endPage()}