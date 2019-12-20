<div class="col-sm-12 input-box">
    @foreach ($fillables as $fillable)
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{$fillable}}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="{{$fillable}}[]" placeholder="{{$title}} Türü {{$fillable}}">
            </div>
        </div>
    @endforeach
    <div class="col-sm-2">
        <button type="button" class="btn btn-block btn-danger remove-button" style="margin-top: -25px">
            <i class="fa fa-trash"></i> Kaldır
        </button>
    </div>
</div>
