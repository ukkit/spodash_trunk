function getUrlParam() {
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const team = urlParams.get('team');
    return team;
}

var teamsearch  = getUrlParam();
// alert(teamsearch);

$(document).ready(function () {
    $('.select-server-type').select2();
});

$(document).ready(function () {
    $('.select-server-name').select2();
});

$(document).ready(function () {
    $('.select-db-type').select2();
});

$(document).ready(function () {
    $('.select-version').select2();
});

$(document).ready(function () {
    $('.select-app-server').select2();
});

$(document).ready(function () {
    $('.select-database').select2();
});

$(document).ready(function () {
    $('.select-dbdetails').select2();
});

$(document).ready(function () {
    $('.select-sf-version').select2();
});

$(document).ready(function () {
    $('#instanceDetails-table').DataTable({
        // "search": {
        //     "search": teamsearch,
        //     "caseInsensitive": true
        // },
        "ordering": false,
        "processing": true,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

console.log(teamsearch);

$(document).ready(function () {
    $('#serverDetails-table').DataTable({
        "ordering": true,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#databaseDetails-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#productVersions-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#sfBuilds-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#paiBuilds-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#releaseDetails-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#paiDetails-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#dbaDetails-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#actionHistories-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": 60 * 60 * 24,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#users-table').DataTable({
        "ordering": true,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#databaseTypes-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#osTypes-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#productNames-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#serverUses-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#sprintCalendars-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#user-actions-table').DataTable({
        "ordering": true,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#tablespaceDetails-table').DataTable({
        "ordering": false,
        "stateSave": true,
        "stateDuration": -1,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#instance-stats-table').DataTable({
        "ordering": true,
        "stateSave": true,
        "stateDuration": -1,
        // "iDisplayLength": 25,
        // "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#detail-stats-table').DataTable({
        "ordering": true,
        "stateSave": true,
        "stateDuration": -1,
        // "iDisplayLength": 25,
        // "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#other-stats-table').DataTable({
        "ordering": true,
        "stateSave": true,
        "stateDuration": -1,
        // "iDisplayLength": 25,
        // "lengthMenu": [25, 50, 75, 100]
    });
});

$(document).ready(function () {
    $('#intellicusDetails-table').DataTable({
        "lengthMenu": [
            [30, 60, -1],
            [30, 60, "All"]
        ]
    });
});

$(document).ready(function () {
    $('#intellicusVersions-table').DataTable({
        "ordering": false,
        "iDisplayLength": 25,
        "lengthMenu": [25, 50, 75, 100]
    });
});