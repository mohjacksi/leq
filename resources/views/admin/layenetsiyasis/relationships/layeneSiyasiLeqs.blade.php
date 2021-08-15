@can('leq_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.leqs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.leq.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.leq.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-layeneSiyasiLeqs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.leq.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.leq.fields.layene_siyasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.leq.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.leq.fields.leq_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.leq.fields.jimara_dengderan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leqs as $key => $leq)
                        <tr data-entry-id="{{ $leq->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $leq->id ?? '' }}
                            </td>
                            <td>
                                {{ $leq->layene_siyasi->name ?? '' }}
                            </td>
                            <td>
                                {{ $leq->name ?? '' }}
                            </td>
                            <td>
                                {{ $leq->leq_code ?? '' }}
                            </td>
                            <td>
                                {{ $leq->jimara_dengderan ?? '' }}
                            </td>
                            <td>
                                @can('leq_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.leqs.show', $leq->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('leq_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.leqs.edit', $leq->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('leq_delete')
                                    <form action="{{ route('admin.leqs.destroy', $leq->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('leq_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.leqs.massDestroy') }}",
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
  let table = $('.datatable-layeneSiyasiLeqs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection