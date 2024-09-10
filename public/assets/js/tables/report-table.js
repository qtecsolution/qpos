$(document).ready(function() {
  $('#tablereport').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'excel', 'print'
    ],
    searching: true,
  });
});