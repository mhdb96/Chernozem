@if(session()->get('warning'))
    <div class="col-xs-12">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> UYARI!</h4>
            {{ session()->get('warning') }}
        </div>
    </div>
@endif 

@if(session()->get('success'))
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> BAŞARILI!</h4>
            {{ session()->get('success') }}
        </div>
    </div>
@endif 
