<div class="container">
  <div class="row">

    @if(sizeof($files) > 0)

    @foreach($files as $key => $file)

    <?php $file_name = $file_info[$key]['name'];?>
    <?php $thumb_src = $thumb_url . $file_name;?>

    <div class="col-sm-3 col-md-2 img_wrapper" style="height: 250px;">
        <div class="img-row">
            <div class="caption">
                <div class="btn-group ">
                    <button type="button" onclick="useFile('{{ $file_name }}')" class="btn btn-default btn-xs">
                        {{ str_limit($file_name, $limit = 15, $end = '...') }}
                    </button>
                    <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="javascript:rename('{{ $file_name }}')"><i class="fa fa-edit fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-rename') }}</a></li>
                        <li><a href="javascript:fileView('{{ $file_name }}')"><i class="fa fa-image fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-view') }}</a></li>
                        <li><a href="javascript:download('{{ $file_name }}')"><i class="fa fa-download fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-download') }}</a></li>
                        <li class="divider"></li>
                        {{--<li><a href="javascript:notImp()">Rotate</a></li>--}}
                        <li><a href="javascript:trash('{{ $file_name }}')"><i class="fa fa-trash fa-fw"></i> {{ Lang::get('laravel-filemanager::lfm.menu-delete') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="thumbnail thumbnail-img" data-id="{{ $file_name }}" id="img_thumbnail_{{ $key }}">
                <img id="{{ $file }}" src="{{ $thumb_src }}" alt="" class="pointer" onclick="useFile('{{ $file_name }}')">
            </div>
        </div>
    </div>

    @endforeach

    @else
    <div class="col-md-12">
      <p>{{ Lang::get('laravel-filemanager::lfm.message-empty') }}</p>
    </div>
    @endif

  </div>
</div>
