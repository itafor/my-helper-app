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


//Auto fill api city when aa api state has been picked
$('#api_state_id').change(function(){
    var state = $(this).val();

    let receiver_state = $('#receiver_state').val();

    if(receiver_state && state !=receiver_state){
        alert('Help Provider and Receiver must come from the same state')
    }

    if(state){
        $('#api_city_id').empty();
        $('<option>').val('').text('Loading...').appendTo('#api_city_id');
        $.ajax({
            url: baseUrl+'/apigetcities/'+state,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                $('#api_city_id').empty();
                $('<option>').val('').text('Select City').appendTo('#api_city_id');
                $.each(data.cities, function(k, v) {
                    $('<option>').val(v.CityCode).text(v.CityName).appendTo('#api_city_id');
                });
            }
        });
    }
});

$('#api_city_id').change(function(){
    var citycode = $(this).val();
    if(citycode){
        $('#api_delivery_town').empty();
        $('<option>').val('').text('Loading...').appendTo('#api_delivery_town');
        $.ajax({
            url: baseUrl+'/apigetdeliverytown/'+citycode,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                console.log('cities',data)
                $('#api_delivery_town').empty();
                $('<option>').val('').text('Select Delivery Town').appendTo('#api_delivery_town');
                $.each(data.towns, function(k, v) {
                    $('<option>').val(v.TownName).text(v.TownName).appendTo('#api_delivery_town');
                });
            }
        });
    }
});

$('#api_city_id').change(function(){
    var citycode = $(this).val();
    if(citycode){
        $('#api_onforwarding_town_id').empty();
        $('<option>').val('').text('Loading...').appendTo('#api_onforwarding_town_id');
        $.ajax({
            url: baseUrl+'/apigetdeliverytown/'+citycode,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                console.log('cities',data)
                $('#api_onforwarding_town_id').empty();
                $('<option>').val('').text('Select Delivery Town').appendTo('#api_onforwarding_town_id');
                $.each(data.towns, function(k, v) {
                    $('<option>').val(v.TownID+'-'+v.TownName).text(v.TownName).appendTo('#api_onforwarding_town_id');
                });
            }
        });
    }
});

  $('#api_onforwarding_town_id').change(function(){
            var api_delivery_town_id = $(this).val();
            var pos = api_delivery_town_id.indexOf("-");
            var onforwarding_town_id = api_delivery_town_id.slice(0, pos);
           console.log('position, onforwarding_town_id',pos + '-'+onforwarding_town_id)
            if(api_delivery_town_id){
                $('#api_delivery_town_id').val(onforwarding_town_id);
            }
            else{
                $('#api_delivery_town_id').val('');
            }
        });


$('#senderCity').change(function(){
    var citycode = $(this).val();
    if(citycode){
        $('#senderTownID').empty();
        $('<option>').val('').text('Loading...').appendTo('#senderTownID');
        $.ajax({
            url: baseUrl+'/apigetdeliverytown/'+citycode,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                //console.log(data)
                $('#senderTownID').empty();
                $('<option>').val('').text('Select sender town Id').appendTo('#senderTownID');
                $.each(data.towns, function(k, v) {
                    $('<option>').val(v.TownID).text(v.TownName +'- Town ID:'+v.TownID).appendTo('#senderTownID');
                });
            }
        });
    }
});

$('#RecipientCity').change(function(){
    var citycode = $(this).val();
    if(citycode){
        $('#RecipientTownID').empty();
        $('<option>').val('').text('Loading...').appendTo('#RecipientTownID');
        $.ajax({
            url: baseUrl+'/apigetdeliverytown/'+citycode,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#RecipientTownID').empty();
                $('<option>').val('').text('Select sender town Id').appendTo('#RecipientTownID');
                $.each(data.towns, function(k, v) {
                    $('<option>').val(v.TownID).text(v.TownName +' - Town ID:'+v.TownID).appendTo('#RecipientTownID');
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
        url: baseUrl+"/checkemail",
        data: {email:email},
        dataType: "json",
        success: function(res) {
            if(res.exists){
                alert('Email taken, please Login');
                $('#finish').prop('disabled', true)
                $('.loginLink').show();
                $(":input").not("[name=email]").prop("readonly", true)
            } else {
                $(":input").not("[name=email]").prop("readonly", false)
                $('#finish').prop('disabled', false)
                $('.loginLink').hide();
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
        url: baseUrl+"/checkusername",
        data: {username:username},
        dataType: "json",
        success: function(res) {
            if(res.exists){
                alert('Username taken, Choose another');
                $('#finish').prop('disabled', true);
                $(":input").not("[name=username]").prop("readonly", true)
            } else {
                $(":input").not("[name=username]").prop("readonly", false)
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

// make rows clickable
$(".clickable-row").click(function() {
    window.location = $(this).data("href");
});

$(document).ready( function () {
    $('#requests').DataTable();
} );

// $('#finish').click(function() {
//     if (!$('.select_corporate') || !$('.select_individual')) {
//         alert('Please pick a user type')
//     }
// })

function disableButton() 
{
    $('#email').prop('disabled', true);
}

//sticky header
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 200) {
        $("#topHeader").addClass("sticky-header");
    } else {
        $("#topHeader").removeClass("sticky-header");
    }
});

function rejectRequest(request_id)
{
  Swal.fire({
  title: 'Do you really want to reject the selected request?',
  text: 'You can\'t revert this action!',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, reject it!',
  cancelButtonText: 'No, don\'t reject it'
}).then((result) => {
  if (result.value) {

 $.ajax({
        url: baseUrl+'/request/reject/'+request_id,
        type: "get",
        data: {'request_id':request_id},
        success: function(data) {
     Swal.fire(
      'Rejected!',
      'The selected item has been rejected successfully.',
      'success'
    )
   window.location.href=window.location.href// refresh page
                    }
                });

  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Cancelled',
      'An attempt to reject the selected request failed :)',
      'error'
    )
  }
})
}

  function identifier(){
            return Math.floor(Math.random() * (99999999 - 10000000 + 1)) + 10000000;
        }

        var row = 1;

        $('#addMorePhoto').click(function(e) {
           // console.log('ok')
            e.preventDefault();

            if(row >= 5){
                alert("You've reached the maximum limit");
                return;
            }

            var rowId = identifier();

            $("#photoContainer").append(
                '<div>'
                    +'<div style="float:right; margin-right:50px; margin-top: 14px;" class="remove_project_file"><span style="cursor:pointer; " class="badge badge-danger" border="2"><i class="fa fa-minus"></i> Remove</span></div>'
                    +'<div style="clear:both"></div>'
                              
                                 +  '<input type="file" name="photos['+rowId+'][image_url]" class="form-control" style="margin-top: -30px;">'
                               
                        +'<div style="clear:both"></div>'
                        +'<br>'
                    +'</div>'

            );
            row++;
            $(".select"+rowId).select2({
                    theme: "bootstrap"
                });
        });

        // Remove parent of 'remove' link when link is clicked.
        $('#photoContainer').on('click', '.remove_project_file', function(e) {
            e.preventDefault();
            $(this).parent().remove();
            row--;
        });



              $('#addMoreItem').click(function(e) {
           // console.log('ok')
            e.preventDefault();

            if(row >= 5){
                alert("You've reached the maximum limit");
                return;
            }

            var rowId = identifier();

            $("#shipmentItemsContainer").append(
                '<div>'
                    +'<div style="float:right; margin-right:50px; margin-top: 30px;" class="remove_shipmentitem"><span style="cursor:pointer; " class="badge badge-danger" border="2"><i class="fa fa-minus"></i> Remove</span></div>'
                    +'<div style="clear:both"></div>'
                        +' <div class="row">'

                              +'<div class="col-sm-3">'
                                 +  '<input type="text" name="ShipmentItems['+rowId+'][ItemName]" class="form-control" style="margin-top: 10px;">'
                               +'</div>'

                                +'<div class="col-sm-2">'
                                 +  '<input type="number" name="ShipmentItems['+rowId+'][ItemUnitCost]" class="form-control" style="margin-top: 10px;">'
                               +'</div>'

                                +'<div class="col-sm-2">'
                                 +  '<input type="number" name="ShipmentItems['+rowId+'][ItemQuantity]" class="form-control" style="margin-top: 10px;">'
                               +'</div>'

                               +'<div class="col-sm-3">'
                                 +  '<input type="text" name="ShipmentItems['+rowId+'][ItemColour]" class="form-control" style="margin-top: 10px;">'
                               +'</div>'

                                +'<div class="col-sm-2">'
                                 +  '<input type="text" name="ShipmentItems['+rowId+'][ItemSize]" class="form-control" style="margin-top: 10px;">'
                               +'</div>'

                               +'</div>'
                        +'<div style="clear:both"></div>'
                        +'<br>'
                    +'</div>'

            );
            row++;
            $(".select"+rowId).select2({
                    theme: "bootstrap"
                });
        });

        // Remove parent of 'remove' link when link is clicked.
        $('#shipmentItemsContainer').on('click', '.remove_shipmentitem', function(e) {
            e.preventDefault();
            $(this).parent().remove();
            row--;
        });


        function myFunction(imgs) {
  // Get the expanded image
  var expandImg = document.getElementById("expandedImg");
  // Get the image text
  var imgText = document.getElementById("imgtext");
  // Use the same src in the expanded image as the image being clicked on from the grid
  expandImg.src = imgs.src;
  // Use the value of the alt attribute of the clickable image as text inside the expanded image
  imgText.innerHTML = imgs.alt;
  // Show the container element (hidden with CSS)
  expandImg.parentElement.style.display = "block";
}