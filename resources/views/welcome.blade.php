<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scheduler</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="build/css/bootstrap-datetimepicker.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    </body>
</head>
<style>
    .container {
        margin-top: 20px;
    }
</style>

<body>
    <div class="container">
        <h3> Tasks </h3>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-info btn-air pull-right mb-0 text-white" data-toggle="modal"
                    data-target="#addATaskPopup">Add Task</button>
            </div>
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @if($data)
                        @foreach ($data as $list)
                        <tr>

                            <td>{{ $list->name }}</td>
                            <td ><span class="btn btn-info">{{ \Carbon\Carbon::parse($list->datetime)->timezone($ipInfo->timezone)->format('g:i A jS F') }}</span></td>            
                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>



        </div>
    </div>
    @include('model.create-schedule')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="build/js/bootstrap-datetimepicker.min.js"></script>

    
    
</body>
<script type="text/javascript">
    $(document).ready(function () {
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
        // Add
        $('#addSchedule').click(function () {
            // $('#addSchedule').prop('disabled', true);
            $.ajax({
                method: "POST",
                url: "tasks",
                data: $('#scheduleFormDataAdd').serialize(),
                success: function (res) {
                    if(res.error)
                   
                    // $('#addSchedule').prop('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: res.success,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout("location.reload(true);", 2000);

                   
                },
                error: function (res) {
                    // console.log(res);
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(res.responseJSON.error, function (key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value +
                            '</li>');
                    });



                }
            });
        });
    });
</script>

</html>