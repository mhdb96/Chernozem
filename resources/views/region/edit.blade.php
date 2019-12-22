@extends('layouts.partial.edit.form')

@push('scripts')
<script>
$(document).ready(function(){
    selectValues = $('[name ="soils[]"]').val();

    var controlData = [];
    $.ajax({
        type:'GET',
        url:'/control-data',
        data:{
            region_id: {{ $data->id }},
            soilIds: selectValues
        },
        success:function(data){   
            data.forEach(item => controlData.push(item));
        }
    }); 

    $('[name ="soils[]"]').on("select2:unselecting", function(e) {        

        controlData.forEach(item => {
            if (item.soil_id == e.params.args.data.id && item.isOpen == true) {                
                e.preventDefault();
                $('#showDeleteMessage').modal('show');
            } else {
                return true;
            }
        });          
    });
});


</script>
@endpush