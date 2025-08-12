$(function() {
	$('#aktivacije-seznam').DataTable({
		"pageLength": 100,
		"bLengthChange" : false,
	 	"order": [[ 0, "desc" ]],
 	  	"width": "20%", "targets": 4,
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
});