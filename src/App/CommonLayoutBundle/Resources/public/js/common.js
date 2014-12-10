$(function() {
	
	$('.datepicker.datepicker-date').datepicker({
		format: 'yyyy-mm-dd',
		viewMode: 'days',
		minViewMode: 'days'
	})
	
	$('time.fromnow').each(function(i, elem) {
		var o = $(elem)
		var text = moment(o.attr('datetime')).fromNow()
		
		o.text(text)
	})
})
