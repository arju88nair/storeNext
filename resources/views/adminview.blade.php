<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>StoreNext admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Bootstrap Core CSS -->
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{!! asset('css/style1.css') !!}" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="{!! asset('css/lines.css') !!}" rel='stylesheet' type='text/css'/>
    <link href="{!! asset('css/font-awesome.css') !!}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{!! asset('js/jquery.min.js') !!}"></script>
    <!----webfonts--->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href='https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <!---//webfonts--->
    <!-- Nav CSS -->
    <link href="{!! asset('css/custom.css') !!}" rel="stylesheet">
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{!! asset('js/metisMenu.min.js') !!}"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <!-- Graph JavaScript -->
    <script src="{!! asset('js/d3.v3.js') !!}"></script>
    <script src="{!! asset('js/rickshaw.js') !!}"></script>
    <style></style>
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">StoreNext Admin</a>
        </div>
        <!-- /.navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index.html"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
        <div class="col-md-12 graphs">
            <div class="spinner" style='display: none'>
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>

            <div id="createFormId" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="email">GST:</label>
                                    <input type="text" class="form-control" id="gst">
                                </div>
                                <div class="form-group">
                                    <label for="email">VAT:</label>
                                    <input type="text" class="form-control" id="vat">
                                </div>
                                <div class="form-group">
                                    <label for="email">TIN number:</label>
                                    <input type="text" class="form-control" id="tin">
                                </div>
                                <input type="hidden" class="form-control" id="uid" value="">
                                <input type="hidden" class="form-control" id="lid" value="">
                                <div class="form-group">
                                    <label for="radio" class="col-sm-2 control-label">Activate ? :</label>
                                    <div class="col-sm-8">
                                        <div class="radio-inline"><label><input type="radio" value="1" name="status"
                                                                                id="yesRadion">
                                                Yes</label></div>
                                        <div class="radio-inline"><label><input type="radio" value="0" name="status"
                                                                                id="noRadio"> No</label>
                                        </div>
                                    </div>
                                </div>

                                <a class="btn btn-success " onclick="updateUser()">Update</a>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>


            <div class="xs">
                <h3>Registered users</h3>
                <div class="bs-example4" data-example-id="contextual-table">
                    <table class="table table-striped" id="tableData">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>City,State</th>
                            <th>Pincode</th>
                            <th>Status</th>
                            <th>Edit</th>
                            {{--<th>Column heading</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)

                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->location_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile_number }}</td>
                                <td>{{ $item->address }},{{ $item->landmark }}</td>
                                <td>{{ $item->city }},{{ $item->state }}</td>
                                <td>{{ $item->pincode }}</td>
                                <td>{{ $item->is_authenticated }}</td>
                                <td><a class="btn btn-primary announce" data-toggle="modal" data-id="{{ $item->id }}">Edit</a>
                                </td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script>
    $(document).ready(function () {
        $('#tableData').DataTable({
            "order": [[ 0, "desc" ]]
        } );


        $(".announce").click(function () { // Click to only happen on announce links
            $(".spinner").show()

            var lid = $(this).data('id')
            $.ajax({
                type: 'GET',
                url: '/getUserDetails?id=' + $(this).data('id'),
                success: function (data) {
                    $(".spinner").hide();
                    console.log(data);

                    if (data.length !== 0) {
                        $("#gst").val(data[0]['gst'])
                        $("#vat").val(data[0]['vat'])
                        $("#tin").val(data[0]['tin'])
                        $("#uid").val(data[0]['id'])
                        $("#lid").val(lid);
                        if (data[0]['active'] === 0) {
                            $("#noRadio").attr('checked', 'checked');

                        }
                        else {
                            $("#yesRadion").attr('checked', 'checked');

                        }
                    }
                    else {
                        $("#gst").val('')
                        $("#vat").val('')
                        $("#tin").val('')
                        $("#uid").val('')
                        $("#lid").val(lid);
                        $("#yesRadion").attr('checked', false);
                        $("#noRadio").attr('checked', false);
                    }
                    $('#createFormId').modal('show');

                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });


        });
    });


    function updateUser() {
        $(".spinner").show()
        var radioValue = $("input[name='status']:checked").val();
        if (radioValue) {
            radioValue = radioValue;
        }
        else {
            alert("Please select status");
            return false;
        }

        $(".spinner").show
        $.ajax({
            type: 'GET',
            url: '/updateUser?id=' + $("#uid").val() + "&location_id=" + $("#lid").val() + "&gst=" + $("#gst").val() + "&vat=" + $("#vat").val() + "&tin=" + $("#tin").val() + "&status=" + radioValue,
            success: function (data) {
                $(".spinner").hide();
                if (data === "success") {
                    alert("Successfully updated")
                }
                else {
                    alert("Something went wrong.Please try again.")
                }


            },
            error: function (err) {
                console.log(err.responseText);
            }
        });

    }
</script>
</body>
</html>
