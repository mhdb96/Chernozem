
<div class="row input-box">
<div class="col-sm-10">
    @foreach ($fillables as $key => $fillable)
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{$fillables_titles[$key]}}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="{{$fillable}}[]" placeholder="{{$fillables_titles[$key]}} Türü">
            </div>
        </div>
    @endforeach
</div>
<div class="col-sm-2">
    <button type="button" class="btn btn-block btn-danger remove-button" style="margin-top: -25px">
        <i class="fa fa-trash"></i> Kaldır
    </button>
</div>
</div>
{{-- <div class="row input-box">
    <div class="col-sm-10">
        @foreach ($fillables as $fillable)
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">{{$fillable}}</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="{{$fillable}}[]" placeholder="{{$title}} Türü {{$fillable}}">
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-sm-2">
        <button type="button" class="btn btn-block btn-danger remove-button" style="margin-top: 48px">
            <i class="fa fa-trash"></i> Kaldır
        </button>
    </div>
</div> --}}
