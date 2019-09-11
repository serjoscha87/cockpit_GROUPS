<div>
    <ul class="uk-breadcrumb">
        <li class="uk-active"><span>@lang('Info')</span></li>
    </ul>
</div>

<div class="uk-grid uk-grid-gutter uk-grid-match uk-grid-width-medium-1-1">
    <div>
        <div class="uk-panel uk-panel-space uk-panel-box uk-panel-card">
            <div class="uk-margin">
                <?php ob_start(); ?>
                # Cockpit Groups Addon
                I am looking for supporters, because I am short on time.

                Feel free to commit a pull request:

                https://github.com/serjoscha87/cockpit_GROUPS
                <?= $markdown(implode("\n", array_map('trim', explode("\n",  ob_get_clean()))), true) ?>
            </div>
        </div>
    </div>
</div>
