<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->


        <div class="user-panel">
            {if (isset($user.data.avatar))}
                <div class="pull-left image">
                    <img src="/image/avatar/{$user.data.avatar}" class="img-circle" alt="User Image">
                </div>
            {/if}

            {if (isset($user.data.surname) and isset($user.data.name))}
                <div class="pull-left info">
                    <p>{$user.data.surname} {$user.data.name}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            {/if}
        </div>

        <ul class="sidebar-menu">
            {if (isset($menu.header))}<li class="header">{$menu.header}</li>{/if}

            {foreach $menu.item as $valueItem}
                <li class="{if isset($valueItem.item)}treeview{/if} {if isset($valueItem.active)}active{/if}">
                    <a href="{if isset($valueItem.url)}{$valueItem.url}{/if}">
                        <i class="{$valueItem.icon_class}"></i> <span>{$valueItem.label}</span>

                        {if isset($valueItem.badges)}
                            <{if !isset($valueItem.badges.tag)}span{else}{$valueItem.badges.tag}{/if}
                                    class="{if isset($valueItem.badges.class)}{$valueItem.badges.class}{/if}">
                                {if isset($valueItem.badges.label)}{$valueItem.badges.label}{/if}
                            </{if !isset($valueItem.badges.tag)}span{else}{$valueItem.badges.tag}{/if}>
                        {/if}
                    </a>

                    {if isset($valueItem.item)}
                        <ul class="treeview-menu">

                            {foreach $valueItem.item as $valueItem2}
                                <li class="{if isset($valueItem2.active)}active{/if}">
                                    <a href="{if isset($valueItem2.url)}{$valueItem2.url}{/if}">
                                        <i class="{$valueItem2.icon_class}"></i> <span>{$valueItem2.label}</span>

                                        {if isset($valueItem2.badges)}
                                            <{if !isset($valueItem2.badges.tag)}span{else}{$valueItem2.badges.tag}{/if}
                                                    class="{if isset($valueItem2.badges.class)}{$valueItem2.badges.class}{/if}">
                                                {if isset($valueItem2.badges.label)}{$valueItem2.badges.label}{/if}
                                            </{if !isset($valueItem2.badges.tag)}span{else}{$valueItem2.badges.tag}{/if}>
                                        {/if}
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    {/if}
                </li>
            {/foreach}
        </ul>



    </section>
</aside>