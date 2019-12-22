<div class="box-body">

    @foreach ($fillables as $key => $fillable)
    @if(is_a($fillable, 'Illuminate\Database\Eloquent\Collection') || is_array($fillable))
    <div class="form-group">
      @if($fillables_types[$key] == 'many')
        <label for="{{$fillable[0]->first()->getTable()}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}} Türleri</label>
        <div class="col-sm-8">
          <select class="form-control select2" multiple="multiple" name="{{$fillable[0]->first()->getTable()}}[]" data-placeholder="{{$fillables_titles[$key]}} Türlerini Seçin" style="width: 100%;">
            @foreach ($fillable[0] as $item)
              <option value="{{ $item->id }}" {{ in_array($item->id, $fillable[1]) ? 'selected' : '' }}>{{ $item->name() }}</option>
            @endforeach
          </select>
        </div>
        @elseif($fillables_types[$key] == 'one')
        <label for="{{$fillable[0]->first()->getTable()}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}} Türleri</label>
        <div class="col-sm-8">
          <select class="form-control select2" name="{{$fillable[0]->first()->getTable()}}" data-placeholder="{{$fillables_titles[$key]}} Türlerini Seçin" style="width: 100%;">
            @foreach ($fillable[0] as $item)
              <option value="{{ $item->id }}" {{ in_array($item->id, $fillable[1]) ? 'selected' : '' }}>{{ $item->name() }}</option>
            @endforeach
          </select>
        </div>
        @endif
      </div>
      @else
        <div class="form-group">
            <label for="{{$fillable}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name={{$fillable}} id={{$fillable}} placeholder="{{$fillables_titles[$key]}} Giriniz" value="{{ $data->$fillable}}">
            </div>
        </div>
        @endif
    @endforeach
</div>

