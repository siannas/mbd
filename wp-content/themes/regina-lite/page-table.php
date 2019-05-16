<?php /*
 Template Name: table
*/
?>
<?php get_header(); ?>
<?php 
// get_template_part( 'sections/section', 'page-header' ); 
?>
<style>
	th {
		border-bottom: 1px solid rgb(169, 169, 169);
		padding: 8px;
	}

	td {
		padding: 8px 10px;
	}

	table.table-list-search {
		border: 1px solid rgb(169, 169, 169);
	}

	.m-10{
		margin: 10px 0;
	}

	.m-bot-40{
		margin-bottom: 20ch;
	}

	.m-bot-2{
		margin-bottom: 2ch;
	}

	#breadcrumb{
		margin: 0 0 20px;
	}

	select{
		padding: 3px;
	}
</style>
<div class="container m-bot-40">
	<div class="row">
		<?php get_template_part( 'sections/section', 'breadcrumb' ); ?>
		<div id="blog" class="single">
			<div class="col-md-8">
				<div class="row m-bot-2">
					<select class="col-md-4 query-selector">
						<option disabled selected value> -- select an option -- </option>
						<option value="annas 1a">annas 1a</option>
						<option value="annas 1b">annas 1b</option>
						<option value="annas 2a">annas 2a</option>
						<option value="annas 2b">annas 2b</option>
						<!-- <option value="cari obat">cari obat</option> -->
						<option value="annas 3a">annas 3a</option>
						<option value="annas 3b">annas 3b</option>
						<!-- <option value="cek harga kamar">cek harga kamar</option> -->
						<option value="annas 4a">annas 4a</option>
						<option value="annas 4b">annas 4b</option>
						<option value="annas 5a">annas 5a</option>
						<option value="annas 5b">annas 5b</option>
						<option value="annas 6">annas 6</option>
					</select>
					<select class="col-md-4 query-selector">
						<option disabled selected value> -- select an option -- </option>
						<option value="chaniyah 1a">chaniyah 1a</option>
						<option value="chaniyah 1b">chaniyah 1b</option>
						<option value="chaniyah 2a">chaniyah 2a</option>
						<option value="chaniyah 2b">chaniyah 2b</option>
						<option value="chaniyah 3a">chaniyah 3a</option>
						<option value="chaniyah 3b">chaniyah 3b</option>
						<option value="chaniyah 4a">chaniyah 4a</option>
						<option value="chaniyah 4b">chaniyah 4b</option>
						<option value="chaniyah 5a">chaniyah 5a</option>
						<option value="chaniyah 5b">chaniyah 5b</option>
						<option value="chaniyah 6">chaniyah 6</option>
					</select>
					<select class="col-md-4 query-selector">
						<option disabled selected value> -- select an option -- </option>
						<option value="karina 1a">karina 1a</option>
						<option value="karina 1b">karina 1b</option>
						<option value="karina 2a">karina 2a</option>
						<option value="karina 2b">karina 2b</option>
						<option value="karina 3a">karina 3a</option>
						<option value="karina 3b">karina 3b</option>
						<option value="karina 4a">karina 4a</option>
						<option value="karina 4b">karina 4b</option>
						<option value="karina 5a">karina 5a</option>
						<option value="karina 5b">karina 5b</option>
						<option value="karina 6">karina 6</option>
					</select>
				</div>
				<?php

				require_once( get_template_directory() . '/scripts/script-rumahsakit-query.php' );
				
				$result = $wpdb->get_results($query);
				?>
				<div class="row ">
					<!-- <form action="#" method="get">
						<div class="input-group nav-menu-search">
							<input class="search-field form-control" id="search" name="q" placeholder="Search for" required>
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default"><i
										class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</form> -->
				</div>
				<div class="row m-10" style="overflow-x:auto;">
					<table class="table table-list-search">
						<?php if(!isset($_GET['selector'])) : ?>
							<p>pilih menu option</p>
						<?php elseif(count($result)<1) : ?>
							<p>data kosong</p>
						<?php else : ?>
						<thead>
							<tr>
								<?php foreach ($result[0] as $key => $data) { ?>
								<th><?php echo $key; ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result as $key => $data) { ?>
							<tr>
								<?php foreach ($data as $key => $value) { ?>
								<td> 
								<?php if($value==null) echo 'tidak ada';
									  else echo $value; 
								?></td>
								<?php } ?>
							</tr>
							<?php } ?>
						</tbody>
								<?php endif; ?>
					</table>
				</div>
				<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
				<script>
					$(document).ready(function () {
						var activeSystemClass = $('.list-group-item.active');

						//something is entered in search form
						$('#search').keyup(function () {
							var that = this;
							// affect all table rows on in systems table
							var tableBody = $('.table-list-search tbody');
							var tableRowsClass = $('.table-li st-search tbody tr');
							$('.search-sf').remove();
							tableRowsClass.each(function (i, val) {

								//Lower text for case insensitive
								var rowText = $(val).text().toLowerCase();
								var inputText = $(that).val().toLowerCase();
								if (inputText != '') {
									$('.search-query-sf').remove();
									tableBody.prepend(
										'<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "' +
										$(that).val() +
										'"</strong></td></tr>');
								} else {
									$('.search-query-sf').remove();
								}

								if (rowText.indexOf(inputText) == -1) {
									//hide rows
									tableRowsClass.eq(i).hide();

								} else {
									$('.search-sf').remove();
									tableRowsClass.eq(i).show();
								}
							});
							//all tr elements are hidden
							if (tableRowsClass.children(':visible').length == 0) {
								tableBody.append(
									'<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>'
								);
							}
						});

						//query-selector
						$('.query-selector').change(function () {
							var name = $(this).val();
							// $.post("blogku/pasien/",{name:name}, function(data){
							// 	alert();
							// });
							// $.ajax({
							// 	url: "{{ url('/blogku/pasien/') }}",
							// 	method: 'GET',
							// 	data: 'selector='+name,
							// 	success: function(){
							// 		alert();
							// 	}
							// });
							// $.get( "blogku/pasien/", { selector: name }).done(function( data ) {
							// 	// alert( "Load was performed." + data );
							// 	// document.location.reload();
							// });
							
							$.ajax({
							url: "/blogku",
							type: "get", 
							success: function(response) {
								var data = encodeURI(name);
								window.location.href = '/blogku/pasien/?selector='+ data;
							},
							error: function(xhr) {
							
							}
							});
						});
					});
				</script>
			</div>
			<!--.col-lg-8-->
		</div>
		<!--#blog.archive-->
		<?php 
		get_sidebar(); 
		?>
	</div>
	<!--.row-->
</div>
<!--.container-->
<?php get_footer(); ?>
