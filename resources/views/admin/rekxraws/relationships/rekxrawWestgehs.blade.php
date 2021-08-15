@can('westgeh_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.westgehs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.westgeh.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.westgeh.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-rekxrawWestgehs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.westgeh_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.jimara_dengderan') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.leq') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.lijna') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.bingeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.westgeh.fields.rekxraw') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($westgehs as $key => $westgeh)
                        <tr data-entry-id="{{ $westgeh->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $westgeh->id ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->name ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->westgeh_code ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->jimara_dengderan ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->leq->leq_code ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->lijna->lijna_code ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->bingeh->bingeh_code ?? '' }}
                            </td>
                            <td>
                                {{ $westgeh->rekxraw->code_rekxraw ?? '' }}
                            </td>
                            <td>
                                @can('westgeh_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.westgehs.show', $westgeh->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('westgeh_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.westgehs.edit', $westgeh->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('westgeh_delete')
                                    <form action="{{ route('admin.westgehs.destroy', $westgeh->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('westgeh_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.westgehs.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-rekxrawWestgehs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection