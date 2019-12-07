@extends('admin.layouts.app')
@section('title', 'Cars')
@section('head_assets')
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/datatables_advanced.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/gallery.js')}}"></script>
@endsection

@section('content')
    <style>
        #DataTables_Table_0_info{
            visibility: hidden;
        }

        .add-button {
            background: #4caf50;
            color: white!important;
            box-shadow: 0 5px 8px #5c5c5cb8;
        }
        .add-button:hover {
            box-shadow: 0px 10px 8px #5c5c5cdb;
            transform: translateY(-5px);
            opacity: 1!important;
        }
    </style>
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>
                        <i class="icon-arrow-left52 position-left"></i>
                        <span class="text-semibold">Cars</span>
                    </h4>
                    <ul class="breadcrumb position-right">
                        <li><a href="{{route('admin.index')}}">Home</a></li>
                        <li class="active">Cars</li>
                    </ul>
                </div>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li>
                            <a type="button"
                               data-toggle="modal"
                               href="{{route('admin.cars.create')}}"
                               class="btn add-button btn-xlg">
                                <i class=" icon-plus3"></i>
                                Add New Car
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="panel panel-flat">
                    <div class="panel-body">

                        <table class="table datatable-show-all">
                            <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Registration</th>
                                <th>Engine</th>
                                <th>Price</th>
                                <th>Active</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($cars as $car)
                                <tr>
                                    <td id="myBrandRow{{$car->id}}">{{$car->brand}}</td>
                                    <td id="myModelRow{{$car->id}}">{{$car->model}}</td>
                                    <td id="myRegistrationRow{{$car->id}}"> {{$car->registration}}</td>
                                    <td id="myEngineRow{{$car->id}}">{{$car->engine}}</td>
                                    <td id="myPriceRow{{$car->id}}">{{ number_format($car->price, 2) }} $</td>

                                    <td align="center" id="myTableRow{{$car->id}}">
                                        @if($car->isActive == '1')
                                            <span class="label label-success" id="area{{$car->id}}">Active</span>
                                        @else($user->isActive == '0')
                                            <span class="label label-danger" id="area{{$car->id}}">Inactive</span>
                                        @endif
                                    </td>

                                    <td class="text-center" id="myButtonRow{{$car->id}}">

                                        <button
                                            class="btn btn-default"
                                            onclick="changeStatus({{$car->id}})"
                                            title="Change Visability"
                                            type="button">
                                            <i class="icon-switch"></i>
                                        </button>
                                        <button
                                            onclick="location.href='{{ route('admin.cars.edit',$car->id) }}'"
                                            class="btn btn-default"
                                            title="Edit"
                                            type="button">
                                            <i class="icon-wrench"></i>
                                        </button>
                                        <button
                                            data-toggle="modal"
                                            title="Delete"
                                            data-target="#myModal{{$car->id}}"
                                            class="btn btn-default delete">
                                            <i class="icon-bin2"></i>
                                        </button>


                                    </td>
                                </tr>
                                <div id="myModal{{$car->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">
                                                <div class="p-4 text-center">
                                                    <i class="icon-exclamation text-danger" style="font-size: 60px"></i>
                                                    <h1 class="font-weight-normal">Delete "<span style="font-weight: 600;">{{$car->model}}</span>" ?</h1>
                                                </div>
                                                <h3 class="text-center" style="font-weight: 600;">Warning: This cannot be undone!</h3>
{{--                                                <p style="color: red; font-weight: bolder">Are you sure you want to delete this car?--}}
{{--                                                </p>--}}

                                            </div>
                                            <div class="modal-footer" style="background-color: #F9F9FB; padding: 30px; border-top: 1px solid #b7b7b770; text-align: center;">
                                                <div class="row">
                                                    <button
                                                        class="btn btn-danger"
                                                        onclick="deleteRow({{$car->id}})"
                                                        title="Delete"
                                                        type="button">
                                                        <i class="icon-bin"></i>
                                                        Yes, Delete Model
                                                    </button>
                                                    <button
                                                        class="btn btn-outline-secondary"
                                                        data-dismiss="modal"
                                                        type="button">
                                                        <i class="icon-cross2"></i>
                                                        No, Don't Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function changeStatus(id) {
            $.ajax({
                url: '{!! URL('/admin/status') !!}',
                type: 'post',
                dataType: 'json',
                data:
                    {
                        'car': id,
                        _token: "{{csrf_token()}}"
                    },
                success: function (response) {
                    if (response === 1) {
                        $('#area'+id).removeClass('label-danger').addClass('label-success').html('Active');

                    }
                    else if (response === 0) {
                        $('#area'+id).removeClass('label-success').addClass('label-danger').html('Inactive');
                    }
                }, error: function (error) {
                }
            });
        }



        function deleteRow(id) {
            $.ajax({
                url: '{{ url('/admin/cars') }}' + '/' + id,
                type: 'delete',
                dataType: 'json',
                data:
                    {
                        _token: "{{csrf_token()}}"
                    },
                success: function (response) {
                    $('#myModal' + id).modal('toggle');
                    $('#myBrandRow' + id).remove();
                    $('#myModelRow' + id).remove();
                    $('#myRegistrationRow' + id).remove();
                    $('#myPriceRow' + id).remove();
                    $('#myEngineRow' + id).remove();
                    $('#myTableRow' + id).remove();
                    $('#myButtonRow' + id).remove();
                   console.log(response)
                }, error: function (error) {
                }
            });
        }

    </script>
@endsection

