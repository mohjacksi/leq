@extends('layouts.admin')
@section('content')
@can('hnartna_reja_beshdarboyan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.hnartna-reja-beshdarboyans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.hnartnaRejaBeshdarboyan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.hnartnaRejaBeshdarboyan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body text-info">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-HnartnaRejaBeshdarboyan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.leq') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.lijna') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.bingeh') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wistgeh') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.hejmar') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.dem') }}
                    </th>
                    <th>
                        {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wene') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($leqs as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($lijnas as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($bingehs as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($westgehs as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hnartna_reja_beshdarboyan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hnartna-reja-beshdarboyans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.hnartna-reja-beshdarboyans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'leq_name', name: 'leq.name' },
{ data: 'lijna_name', name: 'lijna.name' },
{ data: 'bingeh_name', name: 'bingeh.name' },
{ data: 'wistgeh_name', name: 'wistgeh.name' },
{ data: 'hejmar', name: 'hejmar' },
{ data: 'dem', name: 'dem' },
{ data: 'wene', name: 'wene', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-HnartnaRejaBeshdarboyan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection