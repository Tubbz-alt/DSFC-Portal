var dataset = {
  apples: [53245, 28479, 19697, 24037, 40245],
};

var width = 460,
    height = 300,
    radius = Math.min(width, height) / 2;

var color = d3.scale.category20();

var pie = d3.layout.pie()
    .sort(null);

var arc = d3.svg.arc()
    .innerRadius(radius - 100)
    .outerRadius(radius - 50);

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var path = svg.selectAll("path")
    .data(pie(dataset.apples))
  .enter().append("path")
    .attr("fill", function(d, i) { return color(i); })
    .attr("d", arc);

d3.select("body")
    .append("p")
    .text("New paragraph!");

var body = d3.select("body");
var p = body.append("p");
p.text("New paragraph!");

var dataset1 = [ 5, 10, 15, 20, 25 ];
d3.select("body").selectAll("p")
    .data(dataset1)
    .enter()
    .append("p")
    .text(function(d) {
    return "I can count up to " + d;
});