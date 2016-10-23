function draw(formid){
    var margin = {top: 40, right: 50, bottom: 60, left: 60},
    width =  800- margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

    var formatPercent = d3.format("d");

    var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .5);

    var y = d3.scale.linear()
    .range([height, 0]);

    var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

    var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .tickFormat(formatPercent);

    var tip = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .style('z-index', '99999999')
    .html(function(d) {
        return "<strong>"+d.time+" : </strong> <span style='color:red'>" + d.total + "</span>";
    })

    var svg = d3.select("#analysisd3").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    svg.call(tip);

    d3.json(api_site_url+'api.php?hw='+formid, function(error, data) {
        console.log(data);
        x.domain(data.map(function(d,index) { return d.time; }));
        y.domain([0, d3.max(data, function(d) { return d.total; })]);
        svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

        svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

        svg.selectAll(".bar")
        .data(data)
        .enter().append("rect")
        .attr("class", "bar")
        .attr("x", function(d,index) { return x(d.time); })
        .attr("width", x.rangeBand())
        .attr("y", function(d) { return y(d.total); })
        .attr("height", function(d) { return height - y(d.total); })
        .on('mouseover', tip.show)
        .on('mouseout', tip.hide)

    });
}

$( document ).ready(function() {
    draw(nowid);
});