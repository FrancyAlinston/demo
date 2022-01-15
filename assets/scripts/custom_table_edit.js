$(document).ready(function(){
	$('#data_table').Tabledit({
		deleteButton: false,
		editButton: false,
		columns: {
		  identifier: [0, 'id'],
		  editable: [[1, 'nes_id'], [2, 'acnumber'], [3, 'acname'], [4, 'ifsc'], [5, 'branchid'], [6, 'bank_name'], [7, 'scheme_amt'], [8, 'nidhi_amt']]
		},
		hideIdentifier: true,
		url: 'live_edit.php'
	});
});