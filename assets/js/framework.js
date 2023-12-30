// var paramString = jQuery.param(object);
function navigate(path='', paramString='') {
	if (paramString) {
		path += '?';
        path += paramString;
        path = encodeURI(path);
    }
	window.location  = site_url + path;
}

function getUrlParam(parameter, defaultvalue) {
    var urlparameter = defaultvalue;
    if (window.location.href.indexOf(parameter) > -1) {
        urlparameter = getUrlVars()[parameter];
        urlparameter = decodeURI(urlparameter);
	}
    return urlparameter;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function startSpinner(id) {
    $(id).html(`
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>`);
}

function stopSpinner(id) {
    $(id).remove('div.spinner-border');
}

function startButtonLoading(btn, message='') {
    $(btn).prop('disabled', true);
    $(btn).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' +
        message
    );
}

function stopButtonLoading(btn, message='') {
    $(btn).prop('disabled', false);
    $(btn).html(message);
}

function getError(xhr, errorType, exception) {
	let msg = '';

	if (xhr.status === 0) {
		msg = 'Not connect. Verify Network.';
	} else if (xhr.status == 404) {
		msg = 'Requested page not found. [404]';
	} else if (xhr.status == 500) {
		msg = 'Internal Server Error [500].';
	} else if (exception === 'parsererror') {
		msg = 'Requested JSON parse failed.';
	} else if (exception === 'timeout') {
		msg = 'Time out error.';
	} else if (exception === 'abort') {
		msg = 'Ajax request aborted.';
	} else {
		msg = 'Uncaught Error.\n' + xhr.responseText;
	}

	return msg;
}

function notify(header, message, state) {
	new Noty({
		type: state,
		layout: 'topRight',
		title: header,
		text: message
	}).show();
}

function str_pad(num, pad, limit) {
    return (pad+num).slice(-limit);
}

function validateFields(fields, form) {
    isValidated = true;
    for (i = 0; i < fields.length; i++) {
        if ($(form+' #'+fields[i][0]).val() == '' || $(form+' #'+fields[i][0]).val() == null) {
            isValidated = false;
            if (fields[i][1] == 'text') {
                $(form+' #'+fields[i][0]).addClass('eq-ui-input invalid');
            } else if (fields[i][1] == 'date') {
                $(form+' #'+fields[i][0]).addClass('not-validated');
                $(form+' #'+fields[i][0]).parent().find('.input-group-addon').addClass('not-validated');
            } else {
                $(form+' #'+fields[i][0]).parent().find('input.select-dropdown').css('border-bottom', '2px solid #a94442');
            }
        } else {
            if (fields[i][1] == 'text') {
                $(form+' #'+fields[i][0]).removeClass('not-validated');
            } else if (fields[i][1] == 'date') {
                $(form+' #'+fields[i][0]).removeClass('not-validated');
                $(form+' #'+fields[i][0]).parent().find('.input-group-addon').removeClass('not-validated');
            } else {
                $(form+' #'+fields[i][0]).parent().find('input.select-dropdown').css('border-bottom', '2px solid #a94442');
            }
        }
    }

    return isValidated;
}

function format_number(num) {
    var rgx  = /(\d+)(\d{3})/;

    num += '';
    x    = num.split('.');
    x1   = x[0];
    x2   = (x.length > 1) ? '.' + x[1] : '.00';

    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }

    return (x1 + x2);
}

function format_number2(num) {
    var rgx  = /(\d+)(\d{3})/;

    num += '';
    x    = num.split('.');
    x1   = x[0];

    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }

    return (x1);
}

function currencyFormat(num) {
	//alert('here');
	return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function currencyFormat2(num) {
	return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

// IMAGE PREVIEW
function imagePreview( targetPreview, inputFile ){
    var reader    = new FileReader();
    reader.onload = function(e){
    $('#'+targetPreview).attr('src', e.target.result).css({'opacity':'1'}); // change image source
    }
    reader.readAsDataURL(inputFile.files[0]);
}

// get provinces
function getProvinces ( displayTarget ) {
    $.post(
        site_url+"registration/getProvinces",
        function( records ) {
        for ( i = 0; i < records.length; i++ ) {
            displayTarget.append('<option value="'+ records[i].provinceID +'">'+ records[i].province +'</option>');
        }
        displayTarget.selectpicker("refresh");
        },
        "json"
    );
}

// get cities
function getCities ( displayTarget, provinceID ) {
    $.post(
        site_url+"registration/getCities",
        {provinceID:provinceID},
        function( cities ){
        displayTarget.html('<option value=""></option>');
        for ( i = 0; i < cities.length; i++ ) {
            displayTarget.append('<option value="'+ cities[i].cityID +'">'+ cities[i].city +'</option>');
        }
        displayTarget.selectpicker("refresh");
        },
        "json"
    );
}

// get barangays
function getBarangays ( displayTarget, cityID ) {
    $.post(
        site_url+"registration/getBarangays",
        {cityID:cityID},
        function( barangays ){
        displayTarget.html('<option value=""></option>');
        for ( i = 0; i < barangays.length; i++ ) {
            displayTarget.append('<option value="'+ barangays[i].barangayID +'">'+ barangays[i].barangay +'</option>');
        }
        displayTarget.selectpicker("refresh");
        },
        "json"
    );
}

// get cources
function getCourses ( displayTarget ) {
    $.post(
        site_url+"registration/getCourses",
        function ( courses ) {
          for ( i = 0; i < courses.length; i++ ) {
            displayTarget.append('<option value="'+ courses[i].courseID +'">'+ courses[i].courseCode +'</option>');
          }
          displayTarget.selectpicker("refresh");
        },
        "json"
    );
}

function change_password()
{
	if ($('#new_pswd').val() == $('#new_pswd2').val()) {
		$.post(
	        site_url+"login/change_password",
	        {pswd: $('#new_pswd').val()},
	        function ( response ) {
	        	if (response.success) {
	        		 notify('Notification', response.message, 'success');
	        	}
	        	$('#changepasswordModal').modal('hide')
	        },
	        "json"
	      );
	} else {
		notify('Error', "Password does not match!", 'alert');
	}
}