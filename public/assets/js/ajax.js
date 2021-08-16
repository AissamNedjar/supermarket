(function(window, undefined) {
 	'use strict';
 	$('.switch:checkbox').checkboxpicker();

    $('#tickets').perfectScrollbar({
        wheelPropagation: true
    });

    $('#items').perfectScrollbar({
        wheelPropagation: true
    });
	$("#keyboard").keydown(function(event) {
        if(event.which == 32 || event.which == 106 || event.which == 112) {
            $('.buttonChange').trigger('click');
            return false;
        }else if(event.which == 13) {
            $('#buttonAdd,.searchButton,#submit').trigger('click');
            return false;
        }else if(event.which == 46 || event.which == 110) {
            $('#print').trigger('click');
            return false;
        }
        console.log(event.which);
	});
 	$(document).on('click', '#buttonText', function(){
 		var number = $(this).data("number");
 		$('#focus_field').val($('#focus_field').val() + number);
 		$("#focus_field").focus();
 	});
 	$(document).on('click', '#buttonAdd', function(){
 		var url = $(this).data("url");
 		var url2 = $(this).data("url2");
 		var product = $('input[name=product]').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			data: {product: product},
			success: function(data) {
				$('#pageContents').html(data);
				window.history.pushState({href: url2}, '', url2);
				$('#focus_field').val("");
				$("#focus_field").focus();
			    $('#tickets').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('#items').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('.switch:checkbox').checkboxpicker();
			},
			error: function(data) {
				swal("خطأ!", "لا يمكن تحميل هذه الصفحة حاليا!", "error", {
				    buttons: {
			            confirm: {
			                text: 'إغلاق!',
			                className: "btn-info"
			            }
				    }
		        });
			}
		});
 		return false;
  	});
 	$(document).on('click', '#iconClick', function(){
 		var url = $(this).data("url");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			success: function(data) {
				$('#pageContents').html(data);
				$("#focus_field").focus();
			    $('#tickets').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('#items').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('.switch:checkbox').checkboxpicker();
			},
			error: function(data) {
				swal("خطأ!", "لا يمكن تحميل هذه الصفحة حاليا!", "error", {
				    buttons: {
			            confirm: {
			                text: 'إغلاق!',
			                className: "btn-info"
			            }
				    }
		        });
			}
		});
 		return false;
  	});
 	$(document).on('click', '#print', function(){
 		var url = $(this).data("url");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			success: function(data) {
				var winPrint = window.open('', '', 'left=0,top=0,width=980,height=400,toolbar=0,scrollbars=0,status=0');
				winPrint.document.write(data);
				winPrint.document.close();
				winPrint.focus();
				winPrint.print();
				winPrint.close();
			},
			error: function(data) {
				swal("خطأ!", "لا يمكن تحميل هذه الصفحة حاليا!", "error", {
				    buttons: {
			            confirm: {
			                text: 'إغلاق!',
			                className: "btn-info"
			            }
				    }
		        });
			}
		});
 		return false;
  	});
  	function functionUrl(url){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			success: function(data) {
				$('#pageContents').html(data);
				window.history.pushState({href: url}, '', url);
				$("#focus_field").focus();
			    $('#tickets').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('#items').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('.switch:checkbox').checkboxpicker();
			    $('[data-toggle="tooltip"]').tooltip();
			},
			error: function(data) {
				swal("خطأ!", "لا يمكن تحميل هذه الصفحة حاليا!", "error", {
				    buttons: {
			            confirm: {
			                text: 'إغلاق!',
			                className: "btn-info"
			            }
				    }
		        });
			}
		});
		return false;
	};
 	$(document).on('click', '#urlChange', function(){
 		functionUrl($(this).data("url"));
 	});
 	$(document).on('change', '#urlSelect', function(){
 		functionUrl($(this).find(':selected').data("url"));
 	});
  	$(document).on('click', '#urlSearch', function(){
 		functionUrl($(this).data("url") + $(".search").val());
 	});
 	$(document).on('click', '#submit', function(){
 		var url = $('#form').data("url");
    	var data = $('#form').serialize();
		$("button#submit").attr("disabled", true);
		$("button#submit i").addClass("ft-refresh-cw spinner");
		$('fieldset input,select').attr("readonly", true);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			dataType: "json",
			data: data,
			success: function(data) {
				$('fieldset input').removeClass('is-invalid text-danger');
				$('fieldset select').removeClass('is-invalid text-danger');
				$('fieldset div.row label').removeClass('danger');
				$('fieldset ul.text-danger').remove();
				$('#alert').remove();
				if (data.status == "error") {
					$.each(data.errors, function(x, array) {
						$('input[name='+x+']').addClass('is-invalid text-danger');
						$('select[name='+x+']').addClass('is-invalid text-danger');
						$('fieldset#'+x+' div.row label').addClass('danger');
						$('fieldset#'+x+' div.form-control-position').after('<ul class="text-danger"></ul>');
						$.each(array, function(Y, text) {
							$('fieldset#'+x+' ul.text-danger').append('<li>'+text+'</li>');
						});
					});
					var classMsg = 'danger';
				}else {
					if (data.type == "add") {
						$('#form')[0].reset();
					}
					var classMsg = 'success';
				}
				$('.card-body').prepend('<div id="alert" class="alert alert-'+classMsg+' alert-dismissible mb-2" role="alert"></div>');
				$('#alert').prepend('<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">×</span>'+
					'</button>');
				$('#alert').append('<strong>'+data.message+'</strong>');
			},
			error: function(data) {
				swal("خطأ!", "لا يمكن تحميل هذه الصفحة حاليا!", "error", {
				    buttons: {
			            confirm: {
			                text: 'إغلاق!',
			                className: "btn-info"
			            }
				    }
		        });
			}
		});
		$("button#submit").attr("disabled", false);
		$("button#submit i").removeClass("ft-refresh-cw spinner");
		$('fieldset input,select').attr("readonly", false);
		$("#focus_field").focus();
	});
	$(document).on('click', '.pagination a', function(event){
		event.preventDefault(); 
		var url = $(this).attr('href');
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			success: function(data) {
				$('#pageContents').html(data);
			    $('#tickets').perfectScrollbar({
			        wheelPropagation: true
			    });
			    $('.switch:checkbox').checkboxpicker();
				window.history.pushState({href: url}, '', url);
				$('[data-toggle="tooltip"]').tooltip();
			},
			error: function(data) {
				swal("خطأ!", "لا يمكن تحميل هذه الصفحة حاليا!", "error", {
				    buttons: {
			            confirm: {
			                text: 'إغلاق!',
			                className: "btn-info"
			            }
				    }
		        });
			}
		});
	});
})(window);