$(function() {
	var table = $('#aktivacije-seznam').DataTable({
		"pageLength": 100,
		"bLengthChange" : false,
	 	"order": [[ 0, "desc" ]],
 	  	"width": "20%", "targets": 4,
 	  	"paging": false,
 	  	"searching": false,
 	  	"info":     false,
 	  	"ordering": true,
		"language": {
				    "decimal":        "",
				    "emptyTable":     "Ni podatkov za prikaz",
				    "info":           "Prikazanih _START_ do _END_ od _TOTAL_",
				    "infoEmpty":      "Prikazanih 0 do 0 od 0",
				    "infoFiltered":   "(filtrirano od _MAX_ vseh)",
				    "infoPostFix":    "",
				    "thousands":      ",",
				    "lengthMenu":     "Prikaži _MENU_ na stran",
				    "loadingRecords": "Nalaganje...",
				    "processing":     "Procesiranje...",
				    "search":         "Iskanje:",
				    "zeroRecords":    "Ni najdenih zapisov",
				    "paginate": {
				        "first":      "Prvi",
				        "last":       "Zadnji",
				        "next":       "Naslednji",
				        "previous":   "Predhodni"
				    },
				    "aria": {
				        "sortAscending":  ": sort od manjšega do večjega",
				        "sortDescending": ": sort od večjega do manjšega"
				    }
				}
		}
	);

 	$('#aktivacije-seznam tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
	Highcharts.chart('container', {
		    chart: {
		        type: 'column'
		    },

		    title: {
		        text: 'Število paketov po strankah'
		    },		    		   
		    xAxis: {
		        categories: [
		            'Base',
		            'Intensa',
		            'Prima',
		            'Suprema',
		            'Optima',		            
		        ],
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Število paketov'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
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
		    series: [ 
      		{
		        name: stat[0].Naziv,
		        data: [stat[0].stevilo_base, stat[0].stevilo_intensa, stat[0].stevilo_prima, stat[0].stevilo_suprema, stat[0].stevilo_optima],
		        color: '#338800',

		    },{
		        name: stat[1].paket,
		        data: [stat[1].januar, stat[1].februar, stat[1].marec, stat[1].april, stat[1].maj, stat[1].junij, stat[1].julij, stat[1].avgust, stat[1].september, stat[1].oktober, stat[1].november, stat[1].december],
	          	color: '#006b9e',

		    }, {
		        name: stat[2].paket,
		        data: [stat[2].januar, stat[2].februar, stat[2].marec, stat[2].april, stat[2].maj, stat[2].junij, stat[2].julij, stat[2].avgust, stat[2].september, stat[2].oktober, stat[2].november, stat[2].december],
	          	color: '#b91902',

		    }, {
		        name: stat[3].paket,
		        data: [stat[3].januar, stat[3].februar, stat[3].marec, stat[3].april, stat[3].maj, stat[3].junij, stat[3].julij, stat[3].avgust, stat[3].september, stat[3].oktober, stat[3].november, stat[3].december],
	          	color: '#d5a400',

		    } 
			,{
		        name: stat[4].paket,
		        data: [stat[4].januar, stat[4].februar, stat[4].marec, stat[4].april, stat[4].maj, stat[4].junij, stat[4].julij, stat[4].avgust, stat[4].september, stat[4].oktober, stat[4].november, stat[4].december],
	          	color: '#002e5b',

		    }

		    ],
		    credits: {
		      enabled: false
		  },
		});
 
 
	Highcharts.chart('container-sum', {
		    chart: {
		        type: 'line'
		    },

		    title: {
		        text: 'Skupaj število pogodb'
		    },
		    subtitle: {
		        text: 'Leto ' + leto,
		    },
		    xAxis: {
		        categories: [
		            'Januar',
		            'Februar',
		            'Marec',
		            'April',
		            'Maj',
		            'Junij',
		            'Julij',
		            'August',
		            'September',
		            'Oktober',
		            'November',
		            'December'
		        ],
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Število vnesenih pogodb'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
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
		    series: [ 
      		{
	           name: 'Skupaj',
        		data: [stat_sum.januar, stat_sum.februar, stat_sum.marec, stat_sum.april, stat_sum.maj, stat_sum.junij, stat_sum.julij, stat_sum.avgust, stat_sum.september, stat_sum.oktober, stat_sum.november, stat_sum.december],		        
		   }],
	    	credits: {
		      enabled: false
		  },
		});
});