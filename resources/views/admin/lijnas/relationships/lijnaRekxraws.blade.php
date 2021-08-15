@can('rekxraw_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.rekxraws.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.rekxraw.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.rekxraw.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-lijnaRekxraws">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.rekxraw.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.rekxraw.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.rekxraw.fields.code_rekxraw') }}
                        </th>
                        <th>
                            {{ trans('cruds.rekxraw.fields.lijna') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekxraws as $key => $rekxraw)
                        <tr data-entry-id="{{ $rekxraw->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $rekxraw->id ?? '' }}
                            </td>
                            <td>
                                {{ $rekxraw->name ?? '' }}
                            </td>
                            <td>
                                {{ $rekxraw->code_rekxraw ?? '' }}
                            </td>
                            <td>
                                {{ $rekxraw->lijna->name ?? '' }}
                            </td>
                            <td>
                                @can('rekxraw_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.rekxraws.show', $rekxraw->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('rekxraw_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.rekxraws.edit', $rekxraw->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('rekxraw_delete')
                                    <form action="{{ route('admin.rekxraws.destroy', $rekxraw->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('rekxraw_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rekxraws.massDestroy') }}",
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
  let table = $('.datatable-lijnaRekxraws:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection