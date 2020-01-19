<div class="box-body" id="box-body">
    <div class="col-sm-12 input-box"> 
        @foreach ($fillables as $key => $fillable)        
        <div class="form-group">
            @if($fillables_types[$key] == 'many')            
            <label for="{{$fillable->first()->getTable()}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}} Türleri</label>
            <div class="col-sm-8">
                  <select class="form-control select2" 
                  multiple="multiple" name="{{$fillable->first()->getTable()}}[]" data-placeholder="{{$fillables_titles[$key]}} Türlerini Seçin" style="width: 100%;" required>
                  @foreach ($fillable as $item)
                  
                      <option value="{{ $item->id }}">{{ $item->name()}}</option>
                  @endforeach
                  </select>
            </div>
            @elseif($fillables_types[$key] == 'one')           
            <label for="{{$fillable->first()->getTable()}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}} Türleri</label>
            <div class="col-sm-8">
                  <select class="form-control select2" name="{{$fillable->first()->getTable()}}" data-placeholder="{{$fillables_titles[$key]}} Türünü Seçin" style="width: 100%;" required>
                    <option></option>                    
                    @foreach ($fillable as $item)                    
                      <option value="{{ $item->id }}">{{ $item->name() }}</option>
                  @endforeach
                  </select>
            </div>
            @elseif($fillables_types[$key] == 'auto')            
            <label for="{{$fillable->first()->getTable()}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}} Türleri</label>
            <div class="col-sm-8">
                  <select class="form-control select2" name="{{$fillable->first()->getTable()}}" data-placeholder="{{$fillables_titles[$key]}} Türlerini Seçin" style="width: 100%;" required>
                    <option></option>
                    {{-- @foreach ($fillable as $item)                    
                      <option value="{{ $item->id }}">d</option>
                  @endforeach --}}
                  </select>
            </div>
            @else 
            <label for="{{$fillable}}" class="col-sm-2 control-label">{{$fillables_titles[$key]}}</label>
            <div class="col-sm-8">

                <input  type={{$fillables_types[$key]}} class="form-control"                
                        name="{{$is_multiple ? $fillable.'[]' : $fillable.''}}"
                        id="{{$fillable}}"
                        placeholder="{{$fillables_titles[$key]}} Giriniz" required>
            </div>
                @if($is_multiple && $fillable == end($fillables))
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-success" style="margin-top: {{ count($fillables) == 1 ? '0' : (count($fillables) - 1 )*(-25)  }}px" id="add-button">
                            <i class="fa fa-plus"></i> Ekle
                        </button>
                    </div>
                @endif
            @endif
        </div>        
        @endforeach        
    </div>
  </div>
