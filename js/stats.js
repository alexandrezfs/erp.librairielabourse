$(window).ready(function() {

	$("#button-get-stats-per-hour").click(function() {

		$("#container-stats").html('<img src="images/design/loading.gif">');

		var day_start = $("#day_start").val();
		var month_start = $("#month_start").val();
		var year_start = $("#year_start").val();
		var day_end = $("#day_end").val();
		var month_end = $("#month_end").val();
		var year_end = $("#year_end").val();
		var magasin = $("#magasin").val();
		var averageByDay = $("#averageByDay").is(':checked');

		$.ajax({
		  url: "postcall/statsperhour.postcall.php",
		  type: "POST",
		  data: { 
		  	day_start : day_start,
		  	month_start : month_start,
		  	year_start : year_start,
		  	day_end : day_end,
		  	month_end : month_end,
		  	year_end : year_end,
		  	magasin : magasin,
		  	averageByDay : averageByDay
		 	},
		  success : function(result) {

		  	console.log("result : " + averageByDay);

		  	printChart(result);

		  }
		});
	});

});

function printChart(result) {

	var categories = [];
	var dataVentes = [];
	var dataNbProd = [];
	var dataNbTransac = [];
	var magasin;

	result = JSON.parse(result);

	for (var i = result.length - 1; i >= 0; i--) {
		obj = result[i];

		dataVentes.push(obj.totalVentes);
		dataNbTransac.push(obj.nbTransac);
		dataNbProd.push(obj.nbProduit);
		categories.push(obj.hour.toString());

		magasin = obj.magasin;
	};

	dataVentes.reverse();
	dataNbTransac.reverse();
	dataNbProd.reverse();
	categories.reverse();

    $('#container-stats').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Ventes par heure sur ' + magasin
        },
        xAxis: {
            categories: categories
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ventes (€)',
            data: dataVentes

        }, {
            name: 'NB Produits',
            data: dataNbProd

        }, {
            name: 'NB Transac',
            data: dataNbTransac

        }]
    });
}