@if($include_scripts)
    @include('fullcalendar::files')
@endif

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#{{ $id }}').fullCalendar({!! $options !!});
    });
</script>
