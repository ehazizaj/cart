@extends('admin.layouts.app')

@section('title')
    Edit Car {{$car->model}}
@endsection

@section('head_assets')

    <script type="text/javascript" src="{{URL::asset('assets/js/plugins/forms/tags/tagsinput.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/plugins/ui/prism.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/pages/form_tags_input.js')}}"></script>
    <style>
        .invalid-feedback{
            color: red;
            font-weight: lighter;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>
                        <i class="icon-arrow-left52 position-left"></i>
                        <span class="text-semibold">Edit Car</span>
                    </h4>
                    <ul class="breadcrumb position-right">
                        <li><a href="{{route('admin.index')}}">Home</a></li>
                        <li><a href="{{route('admin.cars.index')}}">Cars </a></li>
                        <li class="active">Edit Car {{$car->model}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabbable">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="settings">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Edit Car {{$car->model}}</h6>
                                    </div>
                                    <div class="panel-body">
                                        <form method="POST" action="{{ route('admin.cars.update',$car->id) }}">
                                            @method('PUT')
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="control-label col-lg-12">Brand
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               value="{{$car->brand}}"
                                                               class="form-control"
                                                               @error('brand') is-invalid @enderror
                                                               name="brand"
                                                               required
                                                               placeholder="Brand Name">
                                                        @error('brand')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="control-label col-lg-12">Model
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="model" @error('model') is-invalid @enderror
                                                               value="{{$car->model}}"
                                                               required
                                                               placeholder="Model Type">
                                                        @error('model')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="control-label col-lg-12">Registration Year
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="registration"
                                                               @error('registration') is-invalid @enderror
                                                               value="{{$car->registration}}"
                                                               placeholder="Registration Year"
                                                               required>
                                                        @error('registration')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="control-label col-lg-12">
                                                            Engine Size
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="engine" @error('engine') is-invalid @enderror
                                                               value="{{$car->engine}}"
                                                               required
                                                               placeholder="Engine Size">
                                                        @error('engine')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="control-label col-lg-12">Price
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="price"
                                                               @error('price') is-invalid @enderror
                                                               value="{{$car->price}}"
                                                               required
                                                               placeholder="Price">
                                                        @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Tags
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               class="form-control tokenfield"
                                                               name="tags" @error('tags') is-invalid @enderror
                                                            value="{{$tags}}"
                                                               >
                                                        @error('tags')
                                                        <span class="invalid-feedback" role="alert">
                                                             <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">
                                                    Save
                                                    <i class="icon-arrow-right14 position-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
