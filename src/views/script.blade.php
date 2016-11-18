<link href="/css/fullcalendar.print.css" rel="stylesheet" media="print">
<link href="/css/fullcalendar.css" rel="stylesheet">

<script src="/js/moment.js"></script>
<script src="/js/fullcalendar.js"></script>

<script>
    jQuery(document).ready(function () {
        jQuery('#{{ $id }}').fullCalendar({!! $options !!});
    });
</script>