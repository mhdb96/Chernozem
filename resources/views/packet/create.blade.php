@extends('layouts.partial.create.form')

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
        filterBy('regions','region-soils','region_soil');

    });

    $('[name ="soil_plant"]').change(function() {
        filterBy('soil_plant','areas','areas');
    });

    $('[name ="region_soil"]').change(function() {
        filterBy('region_soil','soil-plants','soil_plant');
    });

</script>
@endpush