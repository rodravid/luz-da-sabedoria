<div class="row">

    <div class="col-xs-12">
        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
            <li class="{{ currentTabActive('#tabData', 'active', true) }}"><a href="#tabData" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Projeto</a></li>

            @if(isset($projects))
                <li class="{{ currentTabActive('#tabGallery') }}"><a href="#tabGallery" data-toggle="tab" aria-expanded="true"><i class="fa fa-cubes"></i> Galeria</a></li>
            @endif
        </ul>
        <div class="tab-content">
            <input type="hidden" name="current-tab" id="currentTab" value="{{ old('current-tab', '#tabData') }}">

            @include('cms::projects.tabs.project')

            @if(isset($projects))
                @include('cms::projects.tabs.gallery')
            @endif
        </div>
    </div>
</div>