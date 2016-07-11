$(document).ready(function(){
	$("#menu").on("click","a", function (event) {
		//отменяем стандартную обработку нажатия по ссылке
		event.preventDefault();

		//забираем идентификатор бока с атрибута href
		var id  = $(this).attr('href'),

		//узнаем высоту от начала страницы до блока на который ссылается якорь
			top = $(id).offset().top;
		
		//анимируем переход на расстояние - top за 1500 мс
		$('body,html').animate({scrollTop: top}, 1500);
	});
	$('#check').on('click', function(){
		if ($('#check').attr("checked") != 'checked'){
			$('#submit').attr('disabled','disabled');
			$('#check').attr("checked") = 'checked';
			return false;
		}
		else{
			$('#submit').removeAttr('disabled');
		}
		return true;
	});
});