var controls = $('button[data-control]');

function getCalendar(mes=null,ano=null) {
	var table = $('table');
	$.get('calendar.php', {m: mes, y: ano}, function(data,status){
		$("#title").html(data.title);
		table.find('tbody').html('');
		$.each(controls,function(index,el){
			switch($(el).data('control')){
				case 'prev': $(this).data('month',data.prev.month); $(this).data('year',data.prev.year); break;
				case 'next': $(this).data('month',data.next.month); $(this).data('year',data.next.year); break;
			}
		});
		for(var i=0;i<data.dates.length;i++){
			var temp_line = '<tr>';
			$.each(data.dates[i], function(index,el){
				temp_line += data.actual.year==data.active.year && data.actual.month==data.active.month && data.actual.day==el ? '<td class="active">' : '<td>';
				temp_line += el+'</td>';
			});
			temp_line  += '</tr>';
			table.find('tbody').append(temp_line);
		}
	},'json');
}

controls.on('click', function(event){
	event.preventDefault();
	switch($(this).data('control')){
		case 'prev': getCalendar($(this).data('month'),$(this).data('year')); break;
		case 'next': getCalendar($(this).data('month'),$(this).data('year')); break;
	}
});