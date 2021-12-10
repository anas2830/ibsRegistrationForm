@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="alert alert-dismissible" role="alert" id="Msg" style="display: none" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span id="text"></span>
                </div>

                <div class="card-body">
                    <form id="register">
                        @csrf

                        <div class="col-md-6" style="float:left">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Applicant's Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <span class="text-danger" id="nameErrorMsg"></span>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <span class="text-danger" id="emailErrorMsg"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Address Details</label>

                                <div class="col-md-6">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Language Proficiency</label>

                                <div class="col-md-6">
                                    <input type="checkbox" name="language[]" id="checkbox-1" value="Bangla"> Bangla 
                                    <input type="checkbox" name="language[]" id="checkbox-2" value="English"> English
                                    <input type="checkbox" name="language[]" id="checkbox-3" value="French"> French
                                </div>
                                <span class="text-danger" id="languageErrorMsg"></span> 
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span class="text-danger" id="passwordErrorMsg"></span> 
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-lg-4 col-md-4 text-md-right">Photo </label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="file" class="file-input" name="photo">
                                    <span class="help-block">Allow extensions: <code>jpg/jpeg</code> , <code>png</code>,and  Allow Size: <code>512 KB</code> Only</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-lg-4 col-md-4 text-md-right">Attachment </label>
                                <div class="col-lg-6 col-md-6">
                                    <input type="file" class="file-input" name="attachment">
                                    <span class="help-block">Allow extensions: <code>doc/docx</code> , <code>pdf</code>,and  Allow Size: <code> 1 MB</code> Only</span>
                                </div>
                            </div>

                        </div> <!-- end col -md -6 -->

                        <div class="col-md-6" style="float:left">


                            <div class="row">

                                <div class="col-md-4" style="float:left">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Division</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="division" name="division" required>
                                                <option value="">select</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{$division->id}}">{{$division->division_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="float:left">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">District</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="district" name="district" required>
                                                <option value="">select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="float:left">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Upazila</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="upazila" name="upazila"  required>
                                                <option value="">select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  

                            </div>

                            <div class="clearfix"></div>

                            <h5>Education Qualification</h5>
                            <div class="row">
        
                                <div class="col-lg-3 col-md-3">
                                    <p style="text-align:center"><b>Exam Name</b></p>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <p style="text-align:center"><b>University</b></p>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                        <p style="text-align:center"><b>Board</b></p>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                        <p style="text-align:center"><b>Result</b></p>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <p style="text-align:center"><b>Action</b></p>
                                </div>

                            </div>

                            <div class="row" style="display:grid">

                                <div id="exam_plus">
                                    <div class="exam_top">

                                        <div class="col-md-3" style="float:left">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <select class="form-control" id="exam_name" name="exam_name[]">
                                                        <option value="BSC">BSC</option>
                                                        <option value="HSC">HSC</option>
                                                        <option value="SSC">SSC</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="float:left">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <select class="form-control" id="university" name="university[]">
                                                        <option value="dhaka">Dhaka</option>
                                                        <option value="daffodil">Daffodil</option>
                                                        <option value="brack">Brack</option>
                                                        <option value="auib">AIUB</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="float:left">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <select class="form-control" id="board" name="board[]">
                                                        <option value="dhaka">Dhaka</option>
                                                        <option value="comilla">Comilla</option>
                                                        <option value="khulna">Khulna</option>
                                                        <option value="chittagong">Chittagong</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-2" style="float:left">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="result[]" required />
                                                </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-2" style="float:left">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="col-lg-1 col-md-1 pl0 pr0" id="first_row">
                                                        <i class="fa fa-minus-square hand pub-minus" style="display:none"></i>
                                                        <i class="fa fa-plus-square hand pub-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  

                                    </div>
                                </div>

                            </div>


                            <h5>Training</h5>
                            <input type="radio" name="training" value="1" class="trainingRadio" required>Yes
                            <input type="radio" name="training" value="0" class="trainingRadio" required>No

                            <div class="training_div" style="display:none">

                                <div class="row">
            
                                    <div class="col-lg-5 col-md-5">
                                        <p style="text-align:center"><b>Training Name</b></p>
                                    </div>
                                    <div class="col-lg-5 col-md-5">
                                        <p style="text-align:center"><b>Training Details</b></p>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <p style="text-align:center"><b>Action</b></p>
                                    </div>

                                </div>

                                <div class="row" style="display:grid">

                                    <div id="training_plus">
                                        <div class="training_top">

                                            <div class="col-md-5" style="float:left">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="training_name[]" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5" style="float:left">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="training_details[]" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2" style="float:left">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="col-lg-1 col-md-1 pl0 pr0" id="training_first_row">
                                                            <i class="fa fa-minus-square hand pub-minus" style="display:none"></i>
                                                            <i class="fa fa-plus-square hand pub-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  

                                        </div>
                                    </div>

                                </div>

                            </div>


                           

                        </div> <!-- end col md-6 -->

                        <div class="clearfix"></div>
                    

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- exam clone --}}
<div id="exam_plus_clone" style="display: none;">
    <div class="exam_top exam_top_firstRow">

        <div class="col-md-3" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <select class="form-control" id="exam_name" name="exam_name[]">
                        <option value="BSC">BSC</option>
                        <option value="HSC">HSC</option>
                        <option value="SSC">SSC</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <select class="form-control" id="university" name="university[]">
                        <option value="dhaka">Dhaka</option>
                        <option value="daffodil">Daffodil</option>
                        <option value="brack">Brack</option>
                        <option value="auib">AIUB</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-2" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <select class="form-control" id="board" name="board[]">
                        <option value="dhaka">Dhaka</option>
                        <option value="comilla">Comilla</option>
                        <option value="khulna">Khulna</option>
                        <option value="chittagong">Chittagong</option>
                    </select>
                </div>
            </div>
        </div>  

        <div class="col-md-2" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="text" class="form-control" name="result[]" />
                </div>
            </div>
        </div>  

        <div class="col-md-2" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="col-lg-1 col-md-1 pub-plus-minus" style="margin-top:1%">
                        <i class="fa fa-minus-square hand pub-minus"></i>
                        <i class="fa fa-plus-square hand pub-plus"></i>
                    </div>
                </div>
            </div>
        </div>  

    </div>
    <div class="clearfix"></div>
  </div>
{{-- end exam clone --}}

{{-- training clone --}}
<div id="training_plus_clone" style="display: none;">
    <div class="training_top training_top_firstRow">

        <div class="col-md-5" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="text" name="training_name[]" class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-5" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="text" name="training_details[]" class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-2" style="float:left">
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="col-lg-1 col-md-1 pub-plus-minus" style="margin-top:1%">
                        <i class="fa fa-minus-square hand pub-minus"></i>
                        <i class="fa fa-plus-square hand pub-plus"></i>
                    </div>
                </div>
            </div>
        </div>  

    </div>
    <div class="clearfix"></div>
  </div>
{{-- end training clone --}}


@endsection

@push('javascript')
<script type="text/javascript">

    console.log('okk');
    $('.trainingRadio').change(function(){

        var training = $(this).val();
        if(training == 1){
            $('.training_div').show();
        }else{
            $('.training_div').hide();
        }
        
    });

    //training js
    $('#training_plus').on('click', '.pub-plus', function(){
       trainingTrAdd('training_plus');
    });

    $('#training_plus').on('click', '.pub-minus', function(){
        trainingTrRemove('training_plus', $(this));
    });

    function trainingTrAdd(selector)
    {
        $('#'+selector).append($('#'+selector+'_clone').html());
        var $lastChild = $('#'+selector).find('.training_top_firstRow').last();
        $('#'+selector).find('.pub-plus').not($('#'+selector+' .pub-plus').last()).remove();
        $('#'+selector).find('.pub-minus').first().show();
    }

    function trainingTrRemove(selector, $that)
    {
        var $row = $that.parents('.training_top').remove();
        $row.remove();
        if($('#'+selector+' .pub-plus-minus').length==1) {
            $('#'+selector+' .pub-plus-minus').html('<i class="fa fa-minus-square hand pub-minus" style="display:none"></i> <i class="fa fa-plus-square hand pub-plus"></i>');
        } else if($('#'+selector+' .pub-plus-minus').length > 1) {
        $('#'+selector+' .pub-plus-minus').last().html('<i class="fa fa-minus-square hand pub-minus"></i> <i class="fa fa-plus-square hand pub-plus"></i>');
        }
        else
        {
            $('#training_first_row').html('<i class="fa fa-minus-square hand pub-minus" style="display:none"></i><i class="fa fa-plus-square hand pub-plus"></i>');
        }

    }
    //end training js



    //exam js
    $('#exam_plus').on('click', '.pub-plus', function(){
       examTrAdd('exam_plus');
    });

    $('#exam_plus').on('click', '.pub-minus', function(){
        examTrRemove('exam_plus', $(this));
    });

    function examTrAdd(selector)
    {
        $('#'+selector).append($('#'+selector+'_clone').html());
        var $lastChild = $('#'+selector).find('.exam_top_firstRow').last();
        $('#'+selector).find('.pub-plus').not($('#'+selector+' .pub-plus').last()).remove();
        $('#'+selector).find('.pub-minus').first().show();
    }

    function examTrRemove(selector, $that)
    {
        var $row = $that.parents('.exam_top').remove();
        $row.remove();
        if($('#'+selector+' .pub-plus-minus').length==1) {

            console.log('1');

            $('#'+selector+' .pub-plus-minus').html('<i class="fa fa-minus-square hand pub-minus" style="display:none"></i> <i class="fa fa-plus-square hand pub-plus"></i>');
        } else if($('#'+selector+' .pub-plus-minus').length > 1) {

            console.log('2');
        $('#'+selector+' .pub-plus-minus').last().html('<i class="fa fa-minus-square hand pub-minus"></i> <i class="fa fa-plus-square hand pub-plus"></i>');
        }
        else
        {
            console.log('3');
            $('#first_row').html('<i class="fa fa-minus-square hand pub-minus" style="display:none"></i><i class="fa fa-plus-square hand pub-plus"></i>');
        }

    }
    //end exam js

    $('#division').on('change', function(e){
        e.preventDefault();
        var divisionId = $(this).val();
        if(divisionId > 0){
            console.log(divisionId);
            $.ajax({
                type: "get",
                url: "/getDivision",
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
                error: function(response) {
                    console.log('error');
                }
            });
        }
    });

    $('#district').on('change', function(e){
        e.preventDefault();
        var districtId = $(this).val();
        if(districtId > 0){
            console.log(districtId);
            $.ajax({
                type: "get",
                url: "/getDistrict",
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
                error: function(response) {
                    console.log('error');
                }
            });
        }
    });
    
    $("#register").submit(function(e) {

        e.preventDefault();

        var form = $('#register')[0];
        var formData = new FormData($('form')[0]);

        $.ajax({
            type: "post",
            url: "/sign-up",
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                console.log('success');
                console.log(data);
                console.log(data.msgtype);

                if(data.msgtype == "success"){
                    $('#Msg').removeClass('alert-danger');
                    $('#Msg').addClass('alert-success');
                    $('#text').text(data.messege);
                    $('#Msg').show();
                    setTimeout(function(){ 
                        location.reload(); 
                    }, 2000);
                }else{
                    $('#Msg').removeClass('alert-success');
                    $('#Msg').addClass('alert-danger');
                    $('#text').text(data.messege);
                    $('#Msg').show();
                }
            },
            error: function(response) {
                console.log('error');
                $('#nameErrorMsg').text(response.responseJSON.errors.name);
                $('#emailErrorMsg').text(response.responseJSON.errors.email);
                $('#passwordErrorMsg').text(response.responseJSON.errors.password);
                $('#languageErrorMsg').text(response.responseJSON.errors.language);
            }
        });

    });

</script>
@endpush
