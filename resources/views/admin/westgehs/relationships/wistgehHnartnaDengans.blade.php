@can('hnartna_dengan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.hnartna-dengans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.hnartnaDengan.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.hnartnaDengan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-wistgehHnartnaDengans">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.dem') }}
                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.leq') }}
                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.lijna') }}
                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.bingeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.wistgeh') }}
                        </th>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.wene') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hnartnaDengans as $key => $hnartnaDengan)
                        <tr data-entry-id="{{ $hnartnaDengan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $hnartnaDengan->id ?? '' }}
                            </td>
                            <td>
                                {{ $hnartnaDengan->dem ?? '' }}
                            </td>
                            <td>
                                {{ $hnartnaDengan->leq->name ?? '' }}
                            </td>
                            <td>
                                {{ $hnartnaDengan->lijna->name ?? '' }}
                            </td>
                            <td>
                                {{ $hnartnaDengan->bingeh->name ?? '' }}
                            </td>
                            <td>
                                {{ $hnartnaDengan->wistgeh->name ?? '' }}
                            </td>
                            <td>
                                @foreach($hnartnaDengan->wene as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('hnartna_dengan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.hnartna-dengans.show', $hnartnaDengan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('hnartna_dengan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.hnartna-dengans.edit', $hnartnaDengan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('hnartna_dengan_delete')
                                    <form action="{{ route('admin.hnartna-dengans.destroy', $hnartnaDengan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('hnartna_dengan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hnartna-dengans.massDestroy') }}",
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
  let table = $('.datatable-wistgehHnartnaDengans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection