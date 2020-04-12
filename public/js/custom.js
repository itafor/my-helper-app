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
// hide login link
$('.loginLink').hide();

// check the db if the email has been used before submitting
function duplicateEmail(element){
    var email = $(element).val();
    $.ajax({
        type: "GET",
        url: "/checkemail",
        data: {email:email},
        dataType: "json",
        success: function(res) {
            if(res.exists){
                alert('Email taken, please Login');
                $('#finish').prop('disabled', true)
                $('.loginLink').show();
            }else{
                $('#finish').prop('disabled', false)
            }
        },
        error: function (jqXHR, exception) {

        }
    });
}
// #e14eca
// check the db if the username has been used before submitting
function duplicateUserName(element){
    var username = $(element).val();
    $.ajax({
        type: "GET",
        url: "/checkusername",
        data: {username:username},
        dataType: "json",
        success: function(res) {
            if(res.exists){
                alert('Username taken, Choose another');
                $('#finish').prop('disabled', true);
            }else{
                $('#finish').prop('disabled', false)
            }
        },
        error: function (jqXHR, exception) {

        }
    });
}


$('.individual').hide();
$('.corporate').hide();

$('input:radio[name="user_type"]').click(function(){
    if ($(this).val() == '1'){
        $('.individual').show();
        $(".individual :input").attr("disabled", false);
        $('.corporate').hide();
        $(".corporate :input").attr("disabled", true);


    }
    if ($(this).val() == '2')
    {
        $('.corporate').show();
        $(".corporate :input").attr("disabled", false);
        $('.individual').hide();
        $(".individual :input").attr("disabled", true);

    }
})