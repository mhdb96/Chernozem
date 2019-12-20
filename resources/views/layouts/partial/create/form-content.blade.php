<div class="box-body" id="box-body">
    <div class="col-sm-12 input-box">
        @foreach ($fillables as $fillable)
        @if(is_a($fillable, 'Illuminate\Database\Eloquent\Collection'))
        <div class="form-group">
        <label for="{{$fillable->first()->getTable()}}" class="col-sm-2 control-label">{{$fillable->first()->getTable()}} Türleri</label>
            <div class="col-sm-8">
                  <select class="form-control select2" multiple="multiple" name="{{$fillable->first()->getTable()}}[]" data-placeholder="{{$fillable->first()->getTable()}} Türlerini Seçin" style="width: 100%;">
                  @foreach ($fillable as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                  </select>
            </div>
          </div>
        @else
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{$fillable}}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control"
              name="{{$is_multiple ? $fillable.'[]' : $fillable.''}}"
              id="{{$fillable}}"
              placeholder="{{$title}} Türü {{$fillable}}">
            </div>
          </div>
        @endif
        @endforeach
        @if($is_multiple)
            <div class="form-group">
                <div class="col-sm-2">
                    <button type="button" class="btn btn-block btn-success" style="margin-top: -25px" id="add-button">
                        <i class="fa fa-plus"></i> Ekle
                    </button>
                </div>
            </div>
        @endif
    </div>
  </div>
