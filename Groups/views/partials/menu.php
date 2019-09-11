<div class="uk-margin-large-top">
    <span class="uk-text-upper uk-text-small uk-text-bold">@lang('Addons') &raquo; @lang('Groups')</span>
</div>

<ul class="uk-grid uk-grid-small uk-grid-width-1-2 uk-grid-width-medium-1-4 uk-text-center">
    <li class="uk-grid-margin">
        <a class="uk-display-block uk-panel-card-hover uk-panel-box uk-panel-space" href="@route('/groups')">
            <div class="uk-svg-adjust">
                <img class="uk-margin-small-right inherit-color" src="/assets/app/media/icons/accounts.svg" width="40" height="40" data-uk-svg alt="assets" />
            </div>
            <div class="uk-text-truncate uk-text-small uk-margin-small-top">@lang('Groups')</div>
        </a>
    </li>
    <li class="uk-grid-margin">
        <a class="uk-display-block uk-panel-card-hover uk-panel-box uk-panel-space " href="@route('/groups/info')">
            <div class="uk-svg-adjust">
                <img class="uk-margin-small-right inherit-color" src="/assets/app/media/icons/text.svg" width="40" height="40" data-uk-svg alt="assets" />
            </div>
            <div class="uk-text-truncate uk-text-small uk-margin-small-top">@lang('Info')</div>
        </a>
    </li>
</ul>