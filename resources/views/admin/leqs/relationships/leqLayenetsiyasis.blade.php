@can('layenetsiyasi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.layenetsiyasis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.layenetsiyasi.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.layenetsiyasi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-leqLayenetsiyasis">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.code_siyasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.leq') }}
                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.ala') }}
                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.jimara_kandida') }}
                        </th>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.extra') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($layenetsiyasis as $key => $layenetsiyasi)
                        <tr data-entry-id="{{ $layenetsiyasi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $layenetsiyasi->id ?? '' }}
                            </td>
                            <td>
                                {{ $layenetsiyasi->name ?? '' }}
                            </td>
                            <td>
                                {{ $layenetsiyasi->code_siyasi ?? '' }}
                            </td>
                            <td>
                                {{ $layenetsiyasi->leq->name ?? '' }}
                            </td>
                            <td>
                                @foreach($layenetsiyasi->ala as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $layenetsiyasi->jimara_kandida ?? '' }}
                            </td>
                            <td>
                                {{ $layenetsiyasi->extra ?? '' }}
                            </td>
                            <td>
                                @can('layenetsiyasi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.layenetsiyasis.show', $layenetsiyasi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('layenetsiyasi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.layenetsiyasis.edit', $layenetsiyasi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('layenetsiyasi_delete')
                                    <form action="{{ route('admin.layenetsiyasis.destroy', $layenetsiyasi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('layenetsiyasi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.layenetsiyasis.massDestroy') }}",
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
  let table = $('.datatable-leqLayenetsiyasis:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection