@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DaxlkrnaDengenKandida">
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($layenetsiyasis as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($kandids as $key => $item)
                                <option value="{{ $item->jimara_kandidi }}">{{ $item->jimara_kandidi }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('daxlkrna_dengen_kandida_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.daxlkrna-dengen-kandidas.massDestroy') }}",
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
    ajax: "{{ route('admin.daxlkrna-dengen-kandidas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'leq_name', name: 'leq.name' },
{ data: 'lijna_name', name: 'lijna.name' },
{ data: 'bingeh_name', name: 'bingeh.name' },
{ data: 'westgeh_name', name: 'westgeh.name' },
{ data: 'layenesiyasi_name', name: 'layenesiyasi.name' },
{ data: 'jimara_kandidi_jimara_kandidi', name: 'jimara_kandidi.jimara_kandidi' },
{ data: 'jimara_kandidi.nav', name: 'jimara_kandidi.nav' },
{ data: 'jimara_kandidi.extra', name: 'jimara_kandidi.extra' },
{ data: 'jimara_dengan', name: 'jimara_dengan' },
{ data: 'weene', name: 'weene', sortable: false, searchable: false },
{ data: 'file', name: 'file', sortable: false, searchable: false },
{ data: 'extra_1', name: 'extra_1' },
{ data: 'extra_2', name: 'extra_2' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-DaxlkrnaDengenKandida').DataTable(dtOverrideGlobals);
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