@can('daxlkrna_dengen_kandida_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.daxlkrna-dengen-kandidas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.daxlkrnaDengenKandida.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.daxlkrnaDengenKandida.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-bingehDaxlkrnaDengenKandidas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.leq') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.lijna') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.bingeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.westgeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.layenesiyasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_kandidi') }}
                        </th>
                        <th>
                            {{ trans('cruds.kandid.fields.nav') }}
                        </th>
                        <th>
                            {{ trans('cruds.kandid.fields.extra') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_dengan') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.weene') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.file') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.extra_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.extra_2') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($daxlkrnaDengenKandidas as $key => $daxlkrnaDengenKandida)
                        <tr data-entry-id="{{ $daxlkrnaDengenKandida->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->id ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->leq->name ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->lijna->name ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->bingeh->name ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->westgeh->name ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->layenesiyasi->name ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->jimara_kandidi->jimara_kandidi ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->jimara_kandidi->nav ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->jimara_kandidi->extra ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->jimara_dengan ?? '' }}
                            </td>
                            <td>
                                @foreach($daxlkrnaDengenKandida->weene as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($daxlkrnaDengenKandida->file as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->extra_1 ?? '' }}
                            </td>
                            <td>
                                {{ $daxlkrnaDengenKandida->extra_2 ?? '' }}
                            </td>
                            <td>
                                @can('daxlkrna_dengen_kandida_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.daxlkrna-dengen-kandidas.show', $daxlkrnaDengenKandida->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('daxlkrna_dengen_kandida_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.daxlkrna-dengen-kandidas.edit', $daxlkrnaDengenKandida->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('daxlkrna_dengen_kandida_delete')
                                    <form action="{{ route('admin.daxlkrna-dengen-kandidas.destroy', $daxlkrnaDengenKandida->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('daxlkrna_dengen_kandida_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.daxlkrna-dengen-kandidas.massDestroy') }}",
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
  let table = $('.datatable-bingehDaxlkrnaDengenKandidas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection