function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var r = document.getElementById(e).getAttribute("data-colors");
        return (r = JSON.parse(r)).map(function (e) {
            var r = e.replace(" ", "");
            if (-1 == r.indexOf("--")) return r;
            var t = getComputedStyle(document.documentElement).getPropertyValue(r);
            return t || void 0
        })
    }
}

var barchartColors = getChartColorsArray("mini-1"), sparklineoptions1 = {
    series: [{data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14]}],
    chart: {type: "area", width: 110, height: 35, sparkline: {enabled: !0}},
    fill: {
        type: "gradient",
        gradient: {shadeIntensity: 1, inverseColors: !1, opacityFrom: .45, opacityTo: .05, stops: [20, 100, 100, 100]}
    },
    stroke: {curve: "smooth", width: 2},
    colors: barchartColors,
    tooltip: {
        fixed: {enabled: !1}, x: {show: !1}, y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        }, marker: {show: !1}
    }
}, sparklinechart1 = new ApexCharts(document.querySelector("#mini-1"), sparklineoptions1);
sparklinechart1.render();
sparklineoptions1 = {
    series: [{data: [65, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14]}],
    chart: {type: "area", width: 110, height: 35, sparkline: {enabled: !0}},
    fill: {
        type: "gradient",
        gradient: {shadeIntensity: 1, inverseColors: !1, opacityFrom: .45, opacityTo: .05, stops: [20, 100, 100, 100]}
    },
    stroke: {curve: "smooth", width: 2},
    colors: barchartColors = getChartColorsArray("mini-2"),
    tooltip: {
        fixed: {enabled: !1}, x: {show: !1}, y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        }, marker: {show: !1}
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#mini-2"), sparklineoptions1)).render();
sparklineoptions1 = {
    series: [{data: [12, 75, 2, 47, 42, 15, 47, 75, 65, 19, 14]}],
    chart: {type: "area", width: 110, height: 35, sparkline: {enabled: !0}},
    fill: {
        type: "gradient",
        gradient: {shadeIntensity: 1, inverseColors: !1, opacityFrom: .45, opacityTo: .05, stops: [20, 100, 100, 100]}
    },
    stroke: {curve: "smooth", width: 2},
    colors: barchartColors = getChartColorsArray("mini-3"),
    tooltip: {
        fixed: {enabled: !1}, x: {show: !1}, y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        }, marker: {show: !1}
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#mini-3"), sparklineoptions1)).render();
sparklineoptions1 = {
    series: [{data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 70]}],
    chart: {type: "area", width: 110, height: 35, sparkline: {enabled: !0}},
    fill: {
        type: "gradient",
        gradient: {shadeIntensity: 1, inverseColors: !1, opacityFrom: .45, opacityTo: .05, stops: [20, 100, 100, 100]}
    },
    stroke: {curve: "smooth", width: 2},
    colors: barchartColors = getChartColorsArray("mini-4"),
    tooltip: {
        fixed: {enabled: !1}, x: {show: !1}, y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        }, marker: {show: !1}
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#mini-4"), sparklineoptions1)).render();
var options = {
    series: [{data: [4, 6, 10, 17, 15, 19, 23, 27, 29, 25, 32, 35]}],
    chart: {
        toolbar: {show: !1}, height: 323, type: "bar", events: {
            click: function (e, r, t) {
            }
        }
    },
    plotOptions: {bar: {columnWidth: "80%", distributed: !0, borderRadius: 8}},
    fill: {opacity: 1},
    stroke: {show: !1},
    dataLabels: {enabled: !1},
    legend: {show: !1},
    colors: barchartColors = getChartColorsArray("overview"),
    xaxis: {categories: ["Jan", "Feb", "Mar", "Apr", "May", "jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]}
}, chart = new ApexCharts(document.querySelector("#overview"), options);
chart.render();

var worldemapmarkers = new jsVectorMap({
    map: "world_merc",
    selector: "#world-map-markers",
    zoomOnScroll: !1,
    zoomButtons: !1,
    selectedMarkers: [0, 2],
    markersSelectable: !0,
    regionStyle: {initial: {fill: "#cfd9ed"}},
    markers: [{name: "United States", coords: [31.9474, 35.2272]}, {
        name: "Italy",
        coords: [61.524, 105.3188]
    }, {name: "French", coords: [56.1304, -106.3468]}, {name: "Spain", coords: [71.7069, -42.6043]}],
    markerStyle: {initial: {fill: "#1f58c7"}, selected: {fill: "#1f58c7"}},
    labels: {
        markers: {
            render: function (e) {
                return e.name
            }
        }
    }
});
