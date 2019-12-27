@extends('layouts.partial.edit.form')

@push('scripts')
<script>

function filterBy(selectedElement, url, targetElement) {    
    var id = $(`[name ="${selectedElement}"]`)[0].value; 
    console.log(id);
        $.ajax({
        type:'GET',
        url: `/${url}`,
        data:{
            id: id
        },
        success:function(data){
            console.log(data);    
            $(`[name ="${targetElement}"]`).html('<option></option>').select2();             
            $(`[name ="${targetElement}"]`).select2({
                data: data                
            }); 
        }
        });     
};
    $('[name ="regions"]').change(function() {
        filterBy('regions','region-soils','soils');

    });

    $('[name ="soils"]').change(function() {
        filterBy('soils','soil-plants','plants');
    });

    $('[name ="plants"]').change(function() {
        filterBy('plants','areas','areas');
    });

</script>
@endpush