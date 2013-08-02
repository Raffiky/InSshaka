<link href="<?= front_asset('css/fullcalendar.css') ?>" rel="stylesheet" />
<link href="<?= front_asset('css/fullcalendar.print.css') ?>" rel="stylesheet" media="print" />
<script src='js/fullcalendar.min.js'></script>
<script>
  $(function(){
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      editable: true,
      events: <?= site_url('conciertos/load_events') ?>
    });
  });
</script>
<style>
  body {
         margin-top: 40px;
         text-align: center;
         font-size: 14px;
         font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
         }
  #calendar {
         width: 900px;
         margin: 0 auto;
         }
</style>
<div id='calendar'></div>