@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- DESIGN HERE -->
<div class="container">
    <div class="row ml-auto mr-auto">
        <div class="col-lg-10 col-sm-12">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid' ],
    timeZone: 'UTC',    
    fixedWeekCount: false,
    selectable: true,
    eventBackgroundColor: '#8C7F7F',
    eventBorderColor: '#CDC0B0',
    defaultView: 'dayGridMonth', 
    
    events: [
    {
      id: 1,
      title: 'Ola',
      start: '2019-12-12',
      end: '2019-12-12',
    },
    {
        id: 2,
        title: 'very long title very long title very long title',
        start: '2020-01-01T10:30:00',
        end: '2020-01-01',
    }
  ]
  });

  calendar.render();
});
</script>

@endsection