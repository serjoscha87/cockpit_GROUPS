<div>
   <div class="uk-panel-box uk-panel-card">
      <div class="uk-panel-box-header uk-flex">
         <strong class="uk-panel-box-header-title uk-flex-item-1">
            @lang('Groups')

            @hasaccess?('cockpit', 'groups_create')
            <a href="@route('/groups/create')" class="uk-icon-plus uk-margin-small-left" title="@lang('Create Group')" data-uk-tooltip></a>
            @end
         </strong>
         @if(count($groups))
         <span class="uk-badge uk-flex uk-flex-middle"><span>{{ count($groups) }}</span></span>
         @endif
      </div>
        @if(count($groups))
            <div class="uk-margin">
                <ul class="uk-list uk-list-space uk-margin-top">
                    @foreach(array_slice($groups, 0, count($groups) > 5 ? 5: count($groups)) as $col)
                    <li>
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-flex-item-1">
                                <a href="@route('/groups/group/'.$col['_id'])">
                                    <img class="uk-margin-small-right uk-svg-adjust" src="@url('assets:app/media/icons/accounts.svg')" width="18px" alt="icon" data-uk-svg>
                                    {{ @$col['group'] }}
                                </a>
                            </div>
                            <div>
                                @if($app->module('cockpit')->hasaccess('cockpit', 'accounts_create'))
                                <a class="uk-text-muted" href="@route('/accounts/create')#{{ $col['group'] }}" title="@lang('Add user to group')" data-uk-tooltip="pos:'right'">
                                    <img src="@url('assets:app/media/icons/plus-circle.svg')" width="1.2em" data-uk-svg />
                                </a>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="uk-panel-box-footer">
                <a href="@route('/groups')">@lang('See all')</a>
            </div>
        @else
            <div class="uk-margin uk-text-center uk-text-muted">
                <p>
                    <img src="@url('assets:app/media/icons/accounts.svg')" width="30" height="30" alt="Groups" data-uk-svg />
                </p>
                @lang('No groups').

                @hasaccess?('groups', 'create')
                <a href="@route('/groups/group/create')">@lang('Create a groups')</a>.
                @end
            </div>
        @endif
    </div>

</div>

