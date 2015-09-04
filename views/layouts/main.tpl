{use class="app\assets\AppAsset"}
{use class="yii\helpers\Html"}

{AppAsset::register($this)|void}

{$this->beginPage()}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {Html::csrfMetaTags()}
    <title>{Html::encode($this->title)}</title>
    {$this->head()}
</head>
<body class="sidebar-mini skin-blue">
{$this->beginBody()}

<div class="wrapper">

    {include '_header.tpl'}
    {include '_leftMenu.tpl'}

</div>


{$this->endBody()}
</body>
</html>
{$this->endPage()}