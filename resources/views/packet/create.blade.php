@extends('layouts.partial.create.form')

@push('scripts')
<script>
$('[name ="regions"]').change(function() {
    var regionId = $('[name ="regions"]')[0].value;
    
    $.ajax({
        type:'GET',
        url:'/region-soils',
        data:{
            regionId: regionId
        },
        success:function(data){    
            $('[name ="region_soil"]').html('<option></option>').select2();              
            $('[name ="region_soil"]').select2({
                data: data
            }); 
        }
    }); 
});

$('[name ="region_soil"]').change(function() {
    var regionSoilId = $('[name ="region_soil"]')[0].value;
         
    $.ajax({
        type:'GET',
        url:'/soil-plants',
        data:{
            regionSoilId: regionSoilId
        },
        success:function(data){     
            $('[name ="soil_plant"]').html('<option></option>').select2();             
            $('[name ="soil_plant"]').select2({
                data: data
            }); 
        }
    }); 
});

$('[name ="soil_plant"]').change(function() {
    var plantId = $('[name ="soil_plant"]')[0].value;
         
    $.ajax({
        type:'GET',
        url:'/areas',
        data:{
            plantId: plantId
        },
        success:function(data){     
            $('[name ="areas"]').html('<option></option>').select2();             
            $('[name ="areas"]').select2({
                data: data
            }); 
        }
    }); 
});

</script>
@endpush