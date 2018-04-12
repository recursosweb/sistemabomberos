<div class="footer">
    <!--<div class="pull-right">-->
    <!--    10GB of <strong>250GB</strong> Free.-->
    <!--</div>-->
    <div>
        <!--<strong>Version 1.0</strong> - Copyright © <a href="http://aleverarise.com.ve/" target="_blank">AleVerArise</a>, C.A. Todos los derechos reservados-->
        <strong>Version 1.0</strong> - Copyright ©, Todos los derechos reservados
    </div>
</div>
        </div>
        <div id="right-sidebar">
            <div class="sidebar-container">
                <ul class="nav nav-tabs navs-3">
                    <!--<li class="active"><a data-toggle="tab" href="#tab-1">-->
                    <!--    Notes-->
                    <!--</a></li>-->
                    <!--<li><a data-toggle="tab" href="#tab-2">-->
                    <!--    Projects-->
                    <!--</a></li>-->
                    <li class=""><a data-toggle="tab" href="#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
                </ul>
                <!--<div class="tab-content">-->

                <!--    <div id="tab-1" class="tab-pane active">-->

                <!--        <div class="sidebar-title">-->
                <!--            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>-->
                <!--            <small><i class="fa fa-tim"></i> You have 10 new message.</small>-->
                <!--        </div>-->

                <!--        <div>-->
                <!--            <div class="sidebar-message">-->
                <!--                <a href="#">-->
                <!--                    <div class="pull-left text-center">-->
                <!--                        <img alt="image" class="img-circle message-avatar" src="<?= base_url() ?>img/a1.jpg">-->

                <!--                        <div class="m-t-xs">-->
                <!--                            <i class="fa fa-star text-warning"></i>-->
                <!--                            <i class="fa fa-star text-warning"></i>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="media-body">-->

                <!--                        There are many variations of passages of Lorem Ipsum available.-->
                <!--                        <br>-->
                <!--                        <small class="text-muted">Today 4:21 pm</small>-->
                <!--                    </div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--        </div>-->

                <!--    </div>-->

                <!--</div>-->
            </div>
        </div>
    </div>
    
    <!--javascript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--FONTAWESONE-->
    <script src="https://use.fontawesome.com/bced716c0e.js"></script>
    <!--input mask-->
    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <!-- Flot -->
    <script src="<?= base_url() ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= base_url() ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= base_url() ?>js/plugins/flot/jquery.flot.spline.js"></script>
    <!--<script src="<?= base_url() ?>js/plugins/flot/jquery.flot.resize.js"></script>-->
    <script src="<?= base_url() ?>js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url() ?>js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?= base_url() ?>js/plugins/flot/jquery.flot.time.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?= base_url() ?>js/inspinia.js"></script>
    <script src="<?= base_url() ?>js/plugins/pace/pace.min.js"></script>

    <!--HACER LAS TABLAS RESPONSIVE-->
    <script src="<?= base_url() ?>js/stacktable.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url() ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--multiselect-->
    <script src="<?= base_url() ?>js/chosen.jquery.js"></script>
    
      <!-- Mainly scripts -->
    <script src="<?= base_url() ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= base_url() ?>/js/plugins/jeditable/jquery.jeditable.js"></script>
    
    <!--dataTables-->
    <script src="<?= base_url() ?>/js/plugins/dataTables/datatables.min.js"></script>
    
    <!-- Page-Level Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>js/zxcvbn.js"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>
    
    <script>
        $(document).ready(function() {

            var sparklineCharts = function(){
                $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16,8], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1C84C6',
                    fillColor: "transparent"
                });
            };

            // var sparkResize;

            // $(window).resize(function(e) {
            //     clearTimeout(sparkResize);
            //     sparkResize = setTimeout(sparklineCharts, 500);
            // });

            sparklineCharts();

            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13],[13,4],[14,7],[15,8],[16,12]
            ];
            var data2 = [
                [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5],[13,2],[14,5],[15,2],[16,0]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
                        data1,  data2
                    ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,

                            borderWidth: 2,
                            color: 'transparent'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                        },
                        tooltip: false
                    }
            );

        });
    </script>
</body>
</html>
