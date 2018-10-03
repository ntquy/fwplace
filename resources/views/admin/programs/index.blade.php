@extends('admin.layout.master')
@section('title', trans('Programs') )
@section('module', trans('Programs'))
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet">
                <div class="m-section">
                    <div class="m-section__content">
                        <table class="table m-table m-table--head-bg-success">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('New Program') }}</th>
                                    <th>
                                        <a href="{{ route('programs.create') }}" class="btn m-btn--pill m-btn--air btn-secondary table-middle " data-toggle="m-tooltip" data-placement="left" data-original-title="{{ trans('Add New') }}">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataPrograms as $key => $pro)
                                <tr>
                                    <th scope="row">{{ $key + 1}}</th>
                                    <td>{{ $pro->name }}</td>
                                    <td><a href="{{ route('programs.edit', ['id' => $pro->id]) }}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" data-skin="dark" data-toggle="m-tooltip" data-placement="left" data-original-title="{{ trans('Edit') }}">
                                    <i class="flaticon-edit-1"></i>
                                    </a>
                                    {!! Form::open(['route' => ['programs.destroy', $pro['id'] ],'class' => 'd-inline', 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="flaticon-cancel"></i>', ['class' => 'btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill', 'data-toggle' => 'm-tooltip', 'data-placement' => 'right','data-skin' => 'dark', 'data-original-title' => trans('Delete'), 'type' => 'submit' ]) !!}
                                    {!! Form::close() !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection