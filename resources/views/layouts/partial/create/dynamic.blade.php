
<div class="col-sm-12 input-box">
    @foreach ($fillables as $key => $fillable)
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{$fillables_titles[$key]}}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="{{$fillable}}[]" placeholder="{{$fillables_titles[$key]}} Türü" required>
            </div>
            @if($fillable == end($fillables))
                <div class="col-sm-2">
                    <button type="button" class="btn btn-block btn-danger remove-button" style="margin-top: {{ count($fillables) == 1 ? '0' : (count($fillables) - 1 )*(-25)  }}px">
                        <i class="fa fa-trash"></i> Kaldır
                    </button>
                </div>   
            @endif
        </div> 
    @endforeach  
</div>
