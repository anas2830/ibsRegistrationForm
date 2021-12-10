@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(Auth::user()->is_admin == 0)
                        {{ 'You are logged in Mr '. Auth::user()->name }}
                    @else 
                        <div class="col-md-6" style="padding-left:0; float:left">
                            <label>Applicant Name</label>
                            <input type="text" class="form-control" id="userSearchName" placeholder="search for applicant name">
                        </div>
                        <div class="col-md-6" style="padding-left:0; float:left">
                            <label>Applicant Email</label>
                            <input type="text" class="form-control" id="userSearchEmail" placeholder="search for applicant email">
                        </div>

                        <div class="row" style="margin-top:2%">

                            <div class="col-md-4" style="float:left">
                                <label class="col-form-label text-md-right">Division</label>
                                <select class="form-control" id="userSearchDivision" name="division" required>
                                    <option value="">select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{$division->id}}">{{$division->division_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4" style="float:left">
                                <label class="col-form-label text-md-right">District</label>
                                <select class="form-control" id="userSearchDistrict" name="district" required>
                                    <option value="">select</option>
                                </select>
                            </div>

                            <div class="col-md-4" style="float:left">
                                <label class="col-form-label text-md-right">Upazila</label>
                                <select class="form-control" id="userSearchUpazila" name="upazila"  required>
                                    <option value="">select</option>
                                </select>
                            </div>  

                        </div>

                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th class="user_sorting sorting" data-sorting_type="asc" data-column_name="name" style="cursor:pointer">Name</th>
                                    <th>Email</th>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Upazila</th>
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="userBody">
                                
                                @include('user-data');
                                
                            </tbody>
                        </table>


                        

                    @endif

                    
                </div>

                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

            </div> <!-- END CARD -->
        </div>
    </div>
</div>

@endsection

@push('javascript')
<script type="text/javascript">

    $(document).on("keyup", '#userSearchName', function(){
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var page = $('#hidden_page').val();
        var userSearchName = $('#userSearchName').val();
        var userSearchEmail = $('#userSearchEmail').val();
        var userSearchDivision = $('#userSearchDivision').val();
        var userSearchDistrict = $('#userSearchDistrict').val();
        var userSearchUpazila = $('#userSearchUpazila').val();
        fetch_data(page, sort_type, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);
    });

    $(document).on("keyup", '#userSearchEmail', function(){
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var page = $('#hidden_page').val();
        var userSearchName = $('#userSearchName').val();
        var userSearchEmail = $('#userSearchEmail').val();
        var userSearchDivision = $('#userSearchDivision').val();
        var userSearchDistrict = $('#userSearchDistrict').val();
        var userSearchUpazila = $('#userSearchUpazila').val();
        fetch_data(page, sort_type, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);
    });

    $('#userSearchDivision').on('change', function(e){
        e.preventDefault();
        var divisionId = $(this).val();
        if(divisionId > 0){
            console.log(divisionId);
            $.ajax({
                type: "GET",
                url: "/getDivisionHome",
                data:{divisionId: divisionId},
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('select[name="district"]').empty();
                    $('select[name="district"]').append('<option value="">Select</option>');
                    $.each(data, function(key, value) {
                        $('select[name="district"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                },
            });

            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = $('#hidden_page').val();
            var userSearchName = $('#userSearchName').val();
            var userSearchEmail = $('#userSearchEmail').val();
            var userSearchDivision = divisionId;
            var userSearchDistrict = $('#userSearchDistrict').val();
            var userSearchUpazila = $('#userSearchUpazila').val();
            fetch_data(page, sort_type, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);
        }
    });

    $('#userSearchDistrict').on('change', function(e){
        e.preventDefault();
        var districtId = $(this).val();
        if(districtId > 0){
            console.log(districtId);
            $.ajax({
                type: "get",
                url: "/getDistrictHome",
                data:{districtId: districtId},
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('select[name="upazila"]').empty();
                    $('select[name="upazila"]').append('<option value="">Select</option>');
                    $.each(data, function(key, value) {
                        $('select[name="upazila"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                },
            });

            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = $('#hidden_page').val();
            var userSearchName = $('#userSearchName').val();
            var userSearchEmail = $('#userSearchEmail').val();
            var userSearchDivision = $('#userSearchDivision').val();
            var userSearchDistrict = districtId;
            var userSearchUpazila = $('#userSearchUpazila').val();
            fetch_data(page, sort_type, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);
        }
    });

    $('#userSearchUpazila').on('change', function(e){
        e.preventDefault();
        var upazilaId = $(this).val();
        if(upazilaId > 0){
            console.log(upazilaId);

            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = $('#hidden_page').val();
            var userSearchName = $('#userSearchName').val();
            var userSearchEmail = $('#userSearchEmail').val();
            var userSearchDivision = $('#userSearchDivision').val();
            var userSearchDistrict = $('#userSearchDistrict').val();
            var userSearchUpazila = upazilaId;
            fetch_data(page, sort_type, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);
        }
    });



    $(document).on('click', '.user_sorting', function(){
        var column_name = $(this).data('column_name');
        var order_type = $(this).data('sorting_type');
        var reverse_order = "";
        if(order_type == "asc"){
            $(this).data('sorting_type', 'desc');
            reverse_order = "desc";
        }else{
            $(this).data('sorting_type', 'asc');
            reverse_order = "asc";
        }
        $('#hidden_column_name').val(column_name);
        $('#hidden_sort_type').val(reverse_order);
        var page = $('#hidden_page').val();
        var userSearchName = $('#userSearchName').val();
        var userSearchEmail = $('#userSearchEmail').val();
        var userSearchDivision = $('#userSearchDivision').val();
        var userSearchDistrict = $('#userSearchDistrict').val();
        var userSearchUpazila = $('#userSearchUpazila').val();

        fetch_data(page, reverse_order, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);
    });

    $(document).on('click', '.exam_pagin_link a', function(e){
        e.preventDefault();
        var userSearchName = $('#userSearchName').val();
        var userSearchEmail = $('#userSearchEmail').val();
        var userSearchDivision = $('#userSearchDivision').val();
        var userSearchDistrict = $('#userSearchDistrict').val();
        var userSearchUpazila = $('#userSearchUpazila').val();
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page, sort_type, column_name, userSearchName, userSearchEmail, userSearchDivision, userSearchDistrict, userSearchUpazila);

    });

    
    function fetch_data(page, sort_type="", sort_by="", userSearchName="", userSearchEmail="", userSearchDivision="", userSearchDistrict="", userSearchUpazila=""){
        $.ajax({
            url: "/userDataAjax?page="+page+"&sorttype="+sort_type+"&sortby="+sort_by+"&userSearchName="+userSearchName+"&userSearchEmail="+userSearchEmail+"&userSearchDivision="+userSearchDivision+"&userSearchDistrict="+userSearchDistrict+"&userSearchUpazila="+userSearchUpazila,
            type: "GET",
            dataType: "HTML",
            success: function(data) {
                console.log(data);
                $('#userBody').html(data);
            },
        });
    }
</script>

@endpush
