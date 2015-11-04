{use class="yii\helpers\Html"}


{title}{$name}{/title}
<div class="site-error">

    <h1>{Html::encode($this->title)}</h1>

    <div class="alert alert-danger">
        {Html::encode($message)|nl2br}
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
