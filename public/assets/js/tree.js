/**
 * Created by NotPrometey on 20.09.2015.
 */

$("#select2_place").select2();



if (data['sid']) {
    $("#select2_place")
        .select2("val", data['sid']);
}

$("#select2_place")
    .on("change", function (e) {
        location = $("#select2_place").attr('data-href') + $(this).val();
    });

$(function(){
    $('#setPlace').click(function(){
        var setPlace = $.ajax({
            url: '/api/set/place/' + data['level'] + '/' + $("#select2_place").select2("val"),
            headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },
            method: "GET",
            dataType: "json"
        });
        setPlace.done(function( response ) {
            if(response['message']) {
                toastr[response['message']['type']](response['message']['message'], response['message']['name']);
            }
        });

        setPlace.fail(function( jqXHR, textStatus ) {
            toastr['error']("Request failed: " + textStatus, 'Error!');
        });
    });

    $('a.tree-circle').click(function(e){
        e.preventDefault();
        if(null == $(this).attr('data-url') || '' == $(this).attr('data-url')){
            return false;
        }
        var bye = $.ajax({
            url: $(this).attr('data-url') + '/' + $("#select2_place").select2("val"),
            headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },
            method: "GET",
            dataType: "json"
        });

        bye.done(function( response ) {
            console.log(response);

            if (response['data']) {
                $.each(response['data'], function(id, data){
                    if('message' == id) {
                        toastr[data.type](data.message, data.name);
                    }else if(null != data[0]) {
                        $('#' + id).attr('data-url', '/tree/build/' + data[2] + '/' + data[1])
                            .text(data[0])
                            .removeClass('no-active');
                    }else{
                        $('#' + id).attr('data-url', '')
                            .text('')
                            .addClass('no-active')
                    }
                });

                if (response['sid']) {
                    $("#select2_place")
                        .select2("val", response['sid']);
                }
            } else {
                if(response['message']) {
                    toastr[response['message']['type']](response['message']['message'], response['message']['name']);
                }
            }

        });

        bye.fail(function( jqXHR, textStatus ) {
            toastr['error']("Request failed: " + textStatus, 'Error!');
        });
    });
});


var m = [30, 120, 30, 120],
    w = 780 - m[1] - m[3],
    h = 800 - m[0] - m[2],
    i = 0,
    root, tree, diagonal, vis;

function drawSheet(root) {
    tree = d3.layout.tree()
        .size([h, w]);

    diagonal = d3.svg.diagonal()
        .projection(function(d) { return [d.x, d.y]; });

    vis = d3.select("#body").append("svg:svg")
        .attr("width", w + m[1] + m[3])
        .attr("height", h + m[0] + m[2])
        .append("svg:g")
        .attr("id","svgTree")
        .attr("transform", "translate(" + m[3] + "," + m[0] + ")");

    root.x0 = h / 2;
    root.y0 = 0;

    update(root);

    // change sizes svg container
    var svgTree = document.getElementById('svgTree');
    var svgTreeOptions = svgTree.getBBox();
    $('#body > svg').height(svgTreeOptions.height + 50);
}

root = doJson(data['data']);

drawSheet(root);

function doJson(data) {
    return jQuery.parseJSON( data.replace(/&quot;/g, '\"') );
}


function viewSheet(d) {
    if (d.sid == null || d.sid == undefined)
        return false;

    var request = $.ajax({
        url: '/tree/build/' + data['level'] + '/' + d.sid + '/' + $("#select2_place").select2("val"),
        headers: {
            'X-CSRF-Token' : $('meta[name=_token]').attr('content')
        },
        method: "GET",
        dataType: "json"
    });

    request.done(function( response ) {
        console.log(response);

        if (response['data']) {
            d3.select("svg").remove();

            root = doJson(response['data']);

            drawSheet(root);

            if (response['sid']) {
                $("#select2_place")
                    .select2("val", response['sid']);
            }
        } else {
            if(response['message']) {
                toastr[response['message']['type']](response['message']['message'], response['message']['name']);
            }
        }

    });

    request.fail(function( jqXHR, textStatus ) {
        toastr['error']("Request failed: " + textStatus, 'Error!');
    });

    return false;
}

function update(source) {
    var duration = d3.event && d3.event.altKey ? 5000 : 500;

    // Compute the new tree layout.
    var nodes = tree.nodes(root).reverse();

    // Normalize for fixed-depth.
    nodes.forEach(function(d) { d.y = d.depth * 180; });

    // Update the nodes…
    var node = vis.selectAll("g.node")
        .data(nodes, function(d) { return d.id || (d.id = ++i); });

    // Enter any new nodes at the parent's previous position.
    var nodeEnter = node.enter().append("svg:g")
        .attr("class", "node")
        .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
        .on("click", function(d) {  viewSheet(d); /*alert(d.name + ' ' + d.id);*/ /*update(d);*/ })
        .on("mouseenter", function(d, e) {
            if (!d.fio) return;

            $('#toolTip #head').text(d.fio)
                .next().text(d.email)
                .next().text(d.usid);

            if(d.statistic && d.statistic.length == 4) {

                console.log(d.statistic);
                $('#toolTip #triangle .value').text(d.statistic[0] + ' / '  + d.statistic[1]);
                $('#toolTip #structure .value').text(d.statistic[2] + ' / '  + d.statistic[3]);

                $('#toolTip #statistic').show();
            } else {
                $('#toolTip #statistic').hide();
            }

            var elem = this;
            var tooltipElem = document.getElementById('toolTip');
            var coords = elem.getBoundingClientRect();

            var left = coords.left + 50;//+ (elem.offsetWidth - tooltipElem.offsetWidth) / 2;
            if (left < 0) left = 50; // не вылезать за левую границу экрана

            // не вылезать за верхнюю границу окна
            var top = coords.top - 70 ;// - tooltipElem.offsetHeight - 5;
            if (top < 50) {
                top = coords.top + elem.offsetHeight + 5;
            }

            $('#toolTip').css({ opacity: 0.9, left: left, top: top, position: 'fixed'}).show(200);
        })
        .on("mouseleave", function(d) {
            if (!d.fio) return;
            $('#toolTip').hide();
        });

    nodeEnter.append("svg:circle")
        .attr("r", 1e-6)
        .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

    nodeEnter.append("svg:text")
        .attr("dy", ".35em")
        .attr("text-anchor", function(d) { return "middle"; })
        .text(function(d) { return d.short; })
        .style("fill-opacity", 1e-6)
        .style("fill", "steelblue")
        .on("mouseover", function(d) { $(this).prev().css({fill: '#E1E1E1'}); })
        .on("mouseout", function(d) { $(this).prev().css({fill: '#fff'}); })


    // Transition nodes to their new position.
    var nodeUpdate = node.transition()
        .duration(duration)
        .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

    nodeUpdate.select("circle")
        .attr("r", 20)
        .style("fill", function(d) { return "#fff"; });

    nodeUpdate.select("text")
        .style("fill-opacity", 1);

    // Transition exiting nodes to the parent's new position.
    var nodeExit = node.exit().transition()
        .duration(duration)
        .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
        .remove();

    nodeExit.select("circle")
        .attr("r", 1e-6);

    nodeExit.select("text")
        .style("fill-opacity", 1e-6);

    // Update the links…
    var link = vis.selectAll("path.link")
        .data(tree.links(nodes), function(d) { return d.target.id; });

    // Enter any new links at the parent's previous position.
    link.enter().insert("svg:path", "g")
        .attr("class", "link")
        .attr("d", function(d) {
            var o = {x: source.x0, y: source.y0};
            return diagonal({source: o, target: o});
        })
        .transition()
        .duration(duration)
        .attr("d", diagonal);

    // Transition links to their new position.
    link.transition()
        .duration(duration)
        .attr("d", diagonal);

    // Transition exiting nodes to the parent's new position.
    link.exit().transition()
        .duration(duration)
        .attr("d", function(d) {
            var o = {x: source.x, y: source.y};
            return diagonal({source: o, target: o});
        })
        .remove();

    // Stash the old positions for transition.
    nodes.forEach(function(d) {
        d.x0 = d.x;
        d.y0 = d.y;
    });
}

