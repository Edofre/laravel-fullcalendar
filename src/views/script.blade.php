<!-- fullcalendar css -->
<link href="/css/fullcalendar.print.css" rel="stylesheet" media="print">
<link href="/css/fullcalendar.css" rel="stylesheet">
<!-- moment js -->
<script src="/js/moment.js"></script>
<!-- fullcalendar js -->
<script src="/js/fullcalendar.js"></script>
<script src="/js/locale-all.js"></script>

@if($include_gcal)
    <script src="/js/gcal.js"></script>
@endif

<script>
    jQuery(document).ready(function () {
        jQuery('#{{ $id }}').fullCalendar({!! $options !!});
    });
</script>