{use class="yii\bootstrap\Nav" type="function"}
{use class="yii\bootstrap\NavBar" type='block'}
{use class="yii\helpers\Url"}

<header class="main-header">



    <!-- Logo -->
    <a href="{$app->homeUrl}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Amp</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Amop</b></span>
    </a>


    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/image/avatar/{$app->user->getIdentity()->avatar}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{$app->user->getIdentity()->surname} {$app->user->getIdentity()->name}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/image/avatar/{$app->user->getIdentity()->avatar}" class="img-circle" alt="User Image">
                            <p>
                                {$app->user->getIdentity()->surname} {$app->user->getIdentity()->name}
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{path route='login/logout'}" class="btn btn-default btn-flat">Выход</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>


</header>