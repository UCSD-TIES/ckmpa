$(document).ready(function () {
  var table_default_Patrols = {
    "aoColumnDefs": [
      {
        "bSortable": false,
        "aTargets": [3]
      },
    ],
    "iDisplayLength": 15,
    "aLengthMenu": [
      [15, 30, 50, -1],
      [15, 30, 50, "All"]
    ]

  };

  $('#PatrolTable').dataTable(table_default_Patrols);

  var table_default_volunteer = {
    "aoColumnDefs": [
      {
        "bSortable": false,
        "aTargets": [2]
      },
    ],
    "iDisplayLength": 15,
    "aLengthMenu": [
      [15, 30, 50, -1],
      [15, 30, 50, "All"]
    ]

  };

  $('#VolunteerTable').dataTable(table_default_volunteer);

  var table_unconfirmed_volunteer = {
    "aoColumnDefs": [
      {
        "bSortable": false,
        "aTargets": [1, 2]
      }
    ],
    "iDisplayLength": 15,
    "aLengthMenu": [
      [15, 30, 50, -1],
      [15, 30, 50, "All"]
    ]

  };

  $('#UnconfirmedTable').dataTable(table_unconfirmed_volunteer);

  var table_default_MPA = {
    "aoColumnDefs": [
      {
        "bSortable": false,
        "aTargets": [2]
      },
    ],
    "iDisplayLength": 15,
    "aLengthMenu": [
      [15, 30, 50, -1],
      [15, 30, 50, "All"]
    ]

  };

  $('#MPATable').dataTable(table_default_MPA);

  var table_default_DataSheet = {
    "aoColumnDefs": [
      {
        "bSortable": false,
        "aTargets": [1]
      },
    ],
    "iDisplayLength": 15,
    "aLengthMenu": [
      [15, 30, 50, -1],
      [15, 30, 50, "All"]
    ]

  };

  $('#DataSheetTable').dataTable(table_default_DataSheet);


});
