  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/plugins/tinymce.min.js"></script>
    <script src="js/plugins/loader.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

    <script src="js/common.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Visits', <?php echo $session->count ?>],
          ['Photos', <?php echo Photo::count_all(); ?>],
          ['Users',  <?php echo User::count_all(); ?>],
          ['Comments', <?php echo Comment::count_all(); ?>]
        ]);


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data);
      }
    </script>

</body>

</html>
