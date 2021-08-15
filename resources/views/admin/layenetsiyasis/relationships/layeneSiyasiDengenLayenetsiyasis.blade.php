@can('dengen_layenetsiyasi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.dengen-layenetsiyasis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dengenLayenetsiyasi.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.dengenLayenetsiyasi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-layeneSiyasiDengenLayenetsiyasis">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.leq') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.lijna') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.bingeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.westgeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.layene_siyasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.jimara_dengan') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.weene') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.file') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.extra_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.extra_2') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dengenLayenetsiyasis as $key => $dengenLayenetsiyasi)
                        <tr data-entry-id="{{ $dengenLayenetsiyasi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->id ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->leq->name ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->lijna->name ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->bingeh->name ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->westgeh->name ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->layene_siyasi->name ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->jimara_dengan ?? '' }}
                            </td>
                            <td>
                                @foreach($dengenLayenetsiyasi->weene as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($dengenLayenetsiyasi->file as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->extra_1 ?? '' }}
                            </td>
                            <td>
                                {{ $dengenLayenetsiyasi->extra_2 ?? '' }}
                            </td>
                            <td>
                                @can('dengen_layenetsiyasi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.dengen-layenetsiyasis.show', $dengenLayenetsiyasi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dengen_layenetsiyasi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.dengen-layenetsiyasis.edit', $dengenLayenetsiyasi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dengen_layenetsiyasi_delete')
                                    <form action="{{ route('admin.dengen-layenetsiyasis.destroy', $dengenLayenetsiyasi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('dengen_layenetsiyasi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.dengen-layenetsiyasis.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-layeneSiyasiDengenLayenetsiyasis:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection