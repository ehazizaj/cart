@extends('layouts.app')

@section('title', 'Home')

@section('head_assets')

    <script type="text/javascript" src="{{URL::asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/basket.js')}}"></script>

@endsection


@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Cars</span> - List</h4>
                    <ul class="breadcrumb position-right">
                        <li class="active"><a href="{{route('home')}}">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Search</h5>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Cars" />
                    </div>
                </div>
            </div>
            <div class="container-detached">
                <div class="content-detached">
                    <ul class="media-list data">
{{--                        inside this ul we will the data response form ajax--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){

            fetch_customer_data();

            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"{{ route('search') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('.data').html(data.data);
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });
    </script>
@endsection



