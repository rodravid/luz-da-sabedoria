<?php
function asset_web($path, $secure = null) {
    return asset("assets/website/{$path}", $secure);
}

function asset_cms($path, $secure = null) {
    return asset("assets/cms/{$path}", $secure);
}

function cmsUser()
{
    return auth('cms')->user();
}

function currentTabActive($tabName, $activeClass = 'active', $first = false)
{
    if (old('current-tab') == $tabName) {
        return $activeClass;
    } else {

        if ($first && old('current-tab') == null) {
            return $activeClass;
        }

    }
}

function activeItem($pattern, $activeClass = 'active')
{
    if (app('request')->is($pattern . '*')) {
        return $activeClass;
    }
}

function present_status_html($status)
{
    switch($status) {
        case 0:
            return '<span class="text-info"><i class="fa fa-edit"></i> Rascunho</span>';
            break;

        case 1:
            return '<span class="text-success"><i class="fa fa-check"></i> Publicado</span>';
            break;

        case 2:
            return '<span class="text-danger"><i class="fa fa-ban"></i> Desativado</span>';
            break;
    }
}