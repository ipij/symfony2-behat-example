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
		o.attr('title', o.attr('datetime'))
	})
	
	$('.btn-cancel').on('click', function(e) {
		e.preventDefault()
		history.back(-1)
	})
})
