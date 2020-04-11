//Auto fill state when a country has been picked
$('#country_id').change(function(){
    var country = $(this).val();
    if(country){
        $('#state_id').empty();
        $('<option>').val('').text('Loading...').appendTo('#state_id');
        $.ajax({
            url: baseUrl+'/getstates/'+country,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                $('#state_id').empty();
                $('<option>').val('').text('Select State').appendTo('#state_id');
                $.each(data.states, function(k, v) {
                    $('<option>').val(v.id).text(v.name).appendTo('#state_id');
                });
            }
        });
    }
});
//Auto fill city when a state has been picked
$('#state_id').change(function(){
    var state = $(this).val();
    if(state){
        $('#city_id').empty();
        $('<option>').val('').text('Loading...').appendTo('#city_id');
        $.ajax({
            url: baseUrl+'/getcities/'+state,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                $('#city_id').empty();
                $('<option>').val('').text('Select City').appendTo('#city_id');
                $.each(data.cities, function(k, v) {
                    $('<option>').val(v.id).text(v.name).appendTo('#city_id');
                });
            }
        });
    }
});