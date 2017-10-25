<!-- fullcalendar css -->
<link href="{{ asset('css/fullcalendar.print.css') }}" rel="stylesheet" media="print">
<link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet">
<!-- moment js -->
<script src="{{ asset('js/moment.js') }}"></script>
<!-- fullcalendar js -->
<script src="{{ asset('js/fullcalendar.js') }}"></script>
<script src="{{ asset('js/locale-all.js') }}"></script>

@if($include_gcal)
    <script src="{{ asset('js/gcal.js') }}"></script>
@endif
