$(document).ready(function () {
    buildLineChartGraphic();
    buildBarChartGraphic();

    new Vue({
        el: '#app',
        data: {
            workers: [],
            error: false
        },
        mounted: function() {
            var self = this;

            if ($("#queueWorkersWidget").length > 0) {
                self.listWorkers();

                setInterval(function () {

                    self.listWorkers();

                }, 3000);
            }

        },
        methods: {
            listWorkers: function() {

                this.$http.get('/cms/queue-worker').then(function(response) {

                    this.workers = response.data;
                    this.error = false;

                }.bind(this), function(response) {

                    this.error = true;

                }.bind(this));

            }
        }
    });
});

function buildLineChartGraphic() {
    $.ajax({
        url: '/cms/LineChartPedidos',
        success: function (response) {
            buildLineChartData(response);
        }
    });
}
function buildLineChartData(response) {
    var $data = [];

    $.each(response, function (index, values) {
        $.merge($data, [{ date: values.year + '-' + values.month + '-' + values.day, orders: values.orders }]);
    });

    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: $data,
        xkey: 'date',
        ykeys: ['orders'],
        xLabelFormat: function (date) {
            return ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();
        },
        labels: ['Pedidos'],
        lineColors: ['#efefef'],
        lineWidth: 2,
        hoverCallback: function (index, options, content, row) {
            var arrayDate = row.date.split("-");

            return  "<div class='morris-hover-row-label'>" +
                        ('0' + arrayDate[2]).slice(-2) + "/" + ('0' + arrayDate[1]).slice(-2) + "/" + arrayDate[0] +
                    "</div>" +
                    "<div class='morris-hover-point' style='color: #efefef'> Pedidos: " + row.orders + "</div>";
        },
        hideHover: 'auto',
        gridTextColor: "#fff",
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ["#efefef"],
        gridLineColor: "#efefef",
        gridTextFamily: "Open Sans",
        gridTextSize: 10
    });
}



function buildBarChartGraphic() {
    $.ajax({
        url: '/cms/BarChartPedidos',
        success: function (response) {
            buildBarChartData(response)

        }
    });
}
function buildBarChartData(response) {
    var $data = [];

    $.each(response, function (index, values) {
        $.merge($data, [{
                            date: ('0' + values.day).slice(-2) + '/' + ('0' + values.month).slice(-2) + '/' + values.year,
                            allOrders: values.orders,
                            paidOrders: values.paidOrders,
                            completedOrders: values.completedOrders
                        }]);
    });

    var area = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: $data,
        xkey: 'date',
        ykeys: ['allOrders', 'paidOrders', 'completedOrders'],
        labels: ['Total', 'Pagos', 'Concluídos'],
        barColors: ['#a0d0e0', '#3c8dbc', '#4da74d'],
        hideHover: 'auto'
    });
}

$(function () {

    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    //jQuery UI sortable for the todo list
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    $('.daterange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    /* jQueryKnob */
    $(".knob").knob();

    //jvectormap data
    var visitorsData = {
        "US": 398, //USA
        "SA": 400, //Saudi Arabia
        "CA": 1000, //Canada
        "DE": 500, //Germany
        "FR": 760, //France
        "CN": 300, //China
        "AU": 700, //Australia
        "BR": 600, //Brazil
        "IN": 800, //India
        "GB": 320, //Great Britain
        "RU": 3000 //Russia
    };
    //World map by jvectormap
    $('#world-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: "transparent",
        regionStyle: {
            initial: {
                fill: '#e4e4e4',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            }
        },
        series: {
            regions: [{
                values: visitorsData,
                scale: ["#92c1dc", "#ebf4f9"],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionLabelShow: function (e, el, code) {
            if (typeof visitorsData[code] != "undefined")
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
        }
    });

    //Sparkline charts
    var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
    $('#sparkline-1').sparkline(myvalues, {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: "#ebf4f9",
        height: '50',
        width: '80'
    });
    myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
    $('#sparkline-2').sparkline(myvalues, {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: "#ebf4f9",
        height: '50',
        width: '80'
    });
    myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
    $('#sparkline-3').sparkline(myvalues, {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: "#ebf4f9",
        height: '50',
        width: '80'
    });

    //The Calender
    $("#calendar").datepicker();

    //SLIMSCROLL FOR CHAT WIDGET
    $('#chat-box').slimScroll({
        height: '250px'
    });

    /* Morris.js Charts */
    // // Sales chart
    // var area = new Morris.Area({
    //   element: 'revenue-chart',
    //   resize: true,
    //   data: [
    //     {y: '2011 Q1', item1: 2666, item2: 2666},
    //     {y: '2011 Q2', item1: 2778, item2: 2294},
    //     {y: '2011 Q3', item1: 4912, item2: 1969},
    //     {y: '2011 Q4', item1: 3767, item2: 3597},
    //     {y: '2012 Q1', item1: 6810, item2: 1914},
    //     {y: '2012 Q2', item1: 5670, item2: 4293},
    //     {y: '2012 Q3', item1: 4820, item2: 3795},
    //     {y: '2012 Q4', item1: 15073, item2: 5967},
    //     {y: '2013 Q1', item1: 10687, item2: 4460},
    //     {y: '2013 Q2', item1: 8432, item2: 5713}
    //   ],
    //   xkey: 'y',
    //   ykeys: ['item1', 'item2'],
    //   labels: ['Item 1', 'Item 2'],
    //   lineColors: ['#a0d0e0', '#3c8dbc'],
    //   hideHover: 'auto'
    // });
    //Donut Chart
    // var donut = new Morris.Donut({
    //   element: 'sales-chart',
    //   resize: true,
    //   colors: ["#3c8dbc", "#f56954", "#00a65a"],
    //   data: [
    //     {label: "Download Sales", value: 12},
    //     {label: "In-Store Sales", value: 30},
    //     {label: "Mail-Order Sales", value: 20}
    //   ],
    //   hideHover: 'auto'
    // });

    //Fix for charts under tabs
    $('.box ul.nav a').on('shown.bs.tab', function () {
        area.redraw();
        donut.redraw();
        line.redraw();
    });

    /* The todo list plugin */
    $(".todo-list").todolist({
        onCheck: function (ele) {
            window.console.log("The element has been checked");
            return ele;
        },
        onUncheck: function (ele) {
            window.console.log("The element has been unchecked");
            return ele;
        }
    });

});



// (function() {
//
//     new Vue({
//         el: '#queueWorkersWidget',
//         data: {
//             workers: [],
//             error: false
//         },
//         ready: function() {
//
//             var self = this;
//
//             self.listWorkers();
//
//             setInterval(function() {
//
//                 self.listWorkers();
//
//             }, 3000);
//
//         },
//         methods: {
//             listWorkers: function() {
//
//                 this.$http.get('/cms/queue-worker').then(function(response) {
//
//                     this.workers = response.data;
//                     this.error = false;
//
//                 }, function(response) {
//
//                     this.error = true;
//
//                 });
//
//             }
//         }
//     });
//
// }());